window.roomId = 0;
window.orientationType = "right";
window.prepared = [];
window.selected = {
    id: "",
    count: 0,
    orientation: ""
};
window.ships = {
    one: [
        [
            {
                index: "",
                isBroken: false,
            }
        ],
        [
            {
                index: "",
                isBroken: false,
            }
        ],
        [
            {
                index: "",
                isBroken: false,
            }
        ],
        [
            {
                index: "",
                isBroken: false,
            }
        ]
    ],
    two: [
        [
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            }
        ],
        [
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            }
        ],
        [
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            }
        ]
    ],
    three: [
        [
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            }
        ],
        [
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            }
        ]
    ],
    four: [
        [
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            },
            {
                index: "",
                isBroken: false,
            }
        ]
    ]
};
window.allShipsAreReady = [];
window.gameStarted = false;
window.gameFinished = false;
window.setAndResetLoading = false;
window.chooseTime = new Date().getTime() / 1000;
window.volume = "on";
window.healthyChecked = [];
window.shoting = false;

$(window).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".orientation").on('click', function () {
        $(".orientation").removeClass('btn-primary');
        $(this).addClass('btn-primary');
        window.orientationType = $(this).data('orientation');
    });

    if (window.roomId !== 0) {
        let healthyCheckedCache = window.localStorage.getItem('healthyChecked_' + window.roomId);
        let messagesCache = window.localStorage.getItem('messages_' + window.roomId);
        if (healthyCheckedCache && messagesCache) {
            $('#chat-body').html(messagesCache);
            window.healthyChecked = JSON.parse(healthyCheckedCache);
            for (let i = 0; i < window.healthyChecked.length; i++) {
                $('[data-opponent="' + window.healthyChecked[i] + '"]').addClass('healthyChecked');
            }
        } else {
            window.localStorage.setItem('healthyChecked_' + window.roomId, JSON.stringify(window.healthyChecked));
            window.localStorage.setItem('messages_' + window.roomId, '');
        }

        $('#chat-body').animate({
            scrollTop: $("#chat-body").find('span').last().offset().top
        }, 2000);

        let ownerCells = 'td[data-index]';

        $(ownerCells).on('mouseover', function () {
            window.prepared = [];
            $("td[data-used='false']").css('background', '#7bc4ff');
            if (window.selected.count > 0) {
                let index = $(this).data('index');
                if (index != undefined) {
                    let row = index.split("-")[0];
                    let column = index.split("-")[1];
                    let goesOutside = window.checkIfGoesOutside(parseInt(row), parseInt(column));
                    let cellsUsed = window.checkIfCellsUsed(parseInt(row), parseInt(column));
                    let color = goesOutside === cellsUsed ? goesOutside : "red";
                    window.showInsertPlace(parseInt(row), parseInt(column), color);
                }
            }
        });

        $(ownerCells).on('click', function () {
            if (window.prepared.length > 0) {
                window.setShip();
            } else {
                if ($(this).attr('data-used') === 'true' && !window.gameStarted) {
                    window.resetShip($(this).data('ship'));
                }
            }
        });

        $('td[data-opponent!=""]').on('click', function () {
            let clean = $(this).attr('data-clean');
            if (typeof clean !== typeof undefined && clean !== false && clean !== "true") {
                let coordinates = $(this).attr('data-opponent').split('-');
                window.fire(coordinates[0], coordinates[1]);
            }
        });

        $('td[data-opponent!=""]').contextmenu(function (event) {
            let opponent = $(this).attr('data-opponent');
            if (!$(this).hasClass('healthy') && !$(this).hasClass('wounded') && !$(this).hasClass('broken')) {
                if (typeof opponent !== typeof undefined && opponent !== false && opponent !== "") {
                    event.preventDefault();
                    $(this).toggleClass('healthyChecked');
                    if ($(this).hasClass('healthyChecked')) {
                        window.healthyChecked.push(opponent);
                        window.localStorage.setItem('healthyChecked_' + window.roomId, JSON.stringify(window.healthyChecked));
                    } else {
                        window.healthyChecked = window.healthyChecked.filter((healthyChecked) => healthyChecked !== opponent);
                        window.localStorage.setItem('healthyChecked_' + window.roomId, JSON.stringify(window.healthyChecked));
                    }
                }
            }
        });
    }
});

window.showInsertPlace = function(row, column, color) {
    let preparedTemp = [];
    if (window.orientationType === "down") {
        for (let j = 0; j < window.selected.count; j++) {
            let index = (parseInt(row) + j) + '-' + column;
            let used = $('td[data-index="' + index + '"]').attr('data-used');
            if (used == "false") {
                $('td[data-index="' + index + '"]').css('background', color);
            }
            preparedTemp.push(index);
        }
    } else if (window.orientationType === "right") {
        for (let j = 0; j < window.selected.count; j++) {
            let index = row + '-' + (parseInt(column) + j);
            let used = $('td[data-index="' + index + '"]').attr('data-used');
            if (used == "false") {
                $('td[data-index="' + index + '"]').css('background', color);
            }
            preparedTemp.push(index);
        }
    }
    if (color === "#35a5ff") {
        for (let i = 0; i < preparedTemp.length; i++) {
            window.prepared.push(preparedTemp[i])
        }
    }
};

window.checkIfGoesOutside = function(row, column) {
    let color = "#35a5ff";
    if (window.orientationType === "down" && (parseInt(row) + window.selected.count - 1) > 10) {
        color = "red";
    } else if (window.orientationType === "right" && (parseInt(column) + window.selected.count - 1) > 10) {
        color = "red";
    }
    return color;
};

window.checkIfCellsUsed = function(row, column) {
    let color = "#35a5ff";
    if (window.orientationType === "down") {
        for (let i = 0; i < window.selected.count; i++) {
            let used = $('td[data-index="' + (parseInt(row) + i) + '-' + column + '"]').attr('data-used');
            if (used == "true") {
                color = "red";
            }
        }
    } else if (window.orientationType === "right") {
        for (let i = 0; i < window.selected.count; i++) {
            let used = $('td[data-index="' + row + '-' + (parseInt(column) + i) + '"]').attr('data-used');
            if (used == "true") {
                color = "red";
            }
        }
    }
    return color;
};

window.choose = function(cellsNumber, id) {
    let now = new Date().getTime() / 1000;
    let dif = now - window.chooseTime;
    if (dif > 1) {
        window.chooseTime = new Date().getTime() / 1000;
        let alreadyUsed = $("#" + id).attr('data-used');
        if (alreadyUsed === "true") {
            $("#" + id).removeClass('broken');
            $("td[data-used='false']").css('background', '#7bc4ff');
            $("#" + id).data('used', 'false');
            window.resetShip(id);
            window.resetSelectedShip();
        } else {
            if (id !== window.selected.id) {
                if (window.selected.id != "") {
                    $("#" + window.selected.id).removeClass('broken');
                    $("td[data-used='false']").css('background', '#7bc4ff');
                    $("#" + window.selected.id).attr('data-used', 'false');
                    window.resetSelectedShip();
                }
                $("#" + id).addClass('broken');
                window.setSelectedShip(cellsNumber, id);
                $("#" + id).attr('data-used', 'true');
            } else {
                $("#" + id).removeClass('broken');
                $("td[data-used='false']").css('background', '#7bc4ff');
                $("#" + id).data('used', 'false');
                window.resetSelectedShip();
            }
        }
    }
};

window.setSelectedShip = function(cellsNumber, id) {
    window.selected.id = id;
    window.selected.count = cellsNumber;
    window.selected.orientation = window.orientationType;
};

window.resetSelectedShip = function() {
    window.selected.id = "";
    window.selected.count = 0;
    window.selected.orientation = window.orientationType;
};

window.setShip = function(formBackend = false) {
    let shipName = window.selected.id.split('-')[0];
    let shipIndex = parseInt(window.selected.id.split('-')[1]);
    for (let i = 0; i < window.prepared.length; i++) {
        window.ships[shipName][shipIndex][i]['index'] = window.prepared[i];
        window.toggleNeighbours(window.prepared[i], 'true');
        $('td[data-index="' + window.prepared[i] + '"]').css('background', '#35a5ff');
        $('td[data-index="' + window.prepared[i] + '"]').html('<i class="fas fa-anchor" style="color: #796046"></i>');
        $('td[data-index="' + window.prepared[i] + '"]').attr('data-used', 'true');
        $('td[data-index="' + window.prepared[i] + '"]').attr('data-ship', window.selected.id);
    }
    window.prepared = [];
    window.resetSelectedShip();
    if (window.isReady() && !formBackend) {
        window.updateShips();
    }
};

window.setAllShips = function() {
    for (const [key, value] of Object.entries(window.ships)) {
        for (let i = 0; i < value.length; i++) {
            window.prepared = [];
            window.selected.id = key + '-' + i;
            $('#' + key + '-' + i).attr('data-used', 'true');
            $('#' + key + '-' + i).addClass('broken');
            for (let j = 0; j < value[i].length; j++) {
                window.prepared.push(value[i][j]['index']);
            }
            window.setShip(true);
        }
    }
};

window.resetShip = function(ship) {
    if (ship && window.gameStarted === false && window.setAndResetLoading === false) {
        window.setAndResetLoading = true;
        let shipName = ship.split('-')[0];
        let shipIndex = parseInt(ship.split('-')[1]);
        for (let i = 0; i < window.ships[shipName][shipIndex].length; i++) {
            window.toggleNeighbours(window.ships[shipName][shipIndex][i]['index'], 'false');
            $('td[data-index="' + window.ships[shipName][shipIndex][i]['index'] + '"]').css('background', '#7bc4ff');
            $('td[data-index="' + window.ships[shipName][shipIndex][i]['index'] + '"]').html('');
            $('td[data-index="' + window.ships[shipName][shipIndex][i]['index'] + '"]').attr('data-used', 'false');
            $('td[data-index="' + window.ships[shipName][shipIndex][i]['index'] + '"]').removeAttr('data-ship');
            window.ships[shipName][shipIndex][i]['index'] = "";
        }
        $("#" + ship).removeClass('broken');
        $("#" + ship).attr('data-used', 'false');
    }
    window.setAndResetLoading = false;
};

window.toggleNeighbours = function(index, block) {
    let row = index.split('-')[0];
    let col = index.split('-')[1];
    let indexes = [
        (parseInt(row) - 1) + '-' + (parseInt(col) - 1),
        (parseInt(row) - 1) + '-' + parseInt(col),
        (parseInt(row) - 1) + '-' + (parseInt(col) + 1),
        (parseInt(row)) + '-' + (parseInt(col) - 1),
        (parseInt(row)) + '-' + parseInt(col),
        (parseInt(row)) + '-' + (parseInt(col) + 1),
        (parseInt(row) + 1) + '-' + (parseInt(col) - 1),
        (parseInt(row) + 1) + '-' + parseInt(col),
        (parseInt(row) + 1) + '-' + (parseInt(col) + 1),
    ];
    for (let i = 0; i < indexes.length; i++) {
        if (indexes[i].split('-')[0] > 0 && indexes[i].split('-')[0] < 11) {
            if (indexes[i].split('-')[1] > 0 && indexes[i].split('-')[1] < 11) {
                $('td[data-index="' + indexes[i] + '"]').attr('data-used', block);
            }
        }
    }
};

window.isReady = function() {
    let ready = '';
    window.allShipsAreReady = [];
    for (const [key, value] of Object.entries(window.ships)) {
        for (let i = 0; i < value.length; i++) {
            for (let j = 0; j < value[i].length; j++) {
                if (value[i][j]['index'] !== "") {
                    ready += "1";
                    window.allShipsAreReady.push(value[i][j]['index']);
                } else {
                    ready += "0";
                }
            }
        }
    }
    return ready.indexOf('0') === -1;
};

window.fire = function(x, y) {
    let checked = $(`[data-opponent='${x}-${y}']`).hasClass('healthyChecked') || $(`[data-opponent='${x}-${y}']`).hasClass('healthy') || $(`[data-opponent='${x}-${y}']`).hasClass('wounded') || $(`[data-opponent='${x}-${y}']`).hasClass('broken');
    if (window.gameStarted && !window.gameFinished && !checked && !window.shoting) {
        window.shoting = true;
        $.ajax({
            type: 'POST',
            url: $('#fire_url').val(),
            dataType: 'JSON',
            data: {
                x_coordinate: x,
                y_coordinate: y,
            },
            success: function (res) {
                if (res.status === 'success') {
                    window.playSound("fire-shot");
                    $("td[data-opponent='" + x + "-" + y + "']").addClass('wounded');
                    $(this).attr('data-clean', 'true');
                    if (res.ship.length > 0) {
                        for (let i = 0; i < res.ship.length; i++) {
                            $("td[data-opponent='" + res.ship[i]['index'] + "']").removeClass('wounded').addClass('broken');
                        }
                    }
                } else if (res.status === 'empty') {
                    window.playSound("fire-nothing");
                    $("td[data-opponent='" + x + "-" + y + "']").addClass('healthy');
                    $(this).attr('data-clean', 'true');
                }
                toastr["info"](res.message, '', {'progressBar': true});
                window.shoting = false;
            },
            error: function (xhr, status, error) {
                let message = 'Oops! Something went wrong';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    message = xhr.responseJSON.error;
                }
                toastr["error"](message, 'Oops!', {'progressBar': true});
                window.shoting = false;
            }
        });
    } else {
        if (window.gameFinished === true) {
            toastr["info"]("The game has finished", 'Hey!', {'progressBar': true});
        } else if(window.shoting === true){
            toastr["error"]("Take your time, I can't keep up with you", 'Hey!', {'progressBar': true});
        } else {
            let doThis = checked ? '' : toastr["info"]("You and/or your opponent are not ready to play", 'Hey!', {'progressBar': true});
        }
    }
};

window.getIndexName = function(index) {
    let letters = ['', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    let indexNumber = parseInt(index.split('-')[0]);
    let letter = letters[indexNumber];
    return letter + '-' + index.split('-')[1];
};

window.makeBrokenOnMyBoard = function(index) {
    let cell = $("td[data-index='" + index + "']")[0];
    let attr = $(cell).attr('data-ship');
    let isUsed = typeof attr !== typeof undefined && attr !== false;
    if (isUsed === true) {
        $("td[data-index='" + index + "']").addClass('broken');
        window.playSound("fire-shot");
    } else {
        $("td[data-index='" + index + "']").addClass('healthy');
        window.playSound("fire-nothing");
    }
};

window.showFires = function(fires, succeeds, board) {
    for (let i = 0; i < fires.length; i++) {
        let cell = $("td[data-" + board + "='" + fires[i] + "']")[0];
        if (succeeds.indexOf(fires[i]) >= 0) {
            $(cell).addClass('broken');
        } else {
            $(cell).addClass('healthy');
        }
    }
};

window.copyLink = function(ev, anchor) {
    ev.preventDefault();
    let $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(anchor).attr('href')).select();
    document.execCommand("copy");
    $temp.remove();
    toastr["success"](`Yep!`, 'Link was copied', {'progressBar': true});
};

window.messageHandler = function(e = null) {
    if (e === null || e.keyCode === 13) {
        let message = $('#messageInput').val();
        if (message && message.length > 0) {
            window.appendMessage(message, 'white');
            window.sendMessage(message);
            $('#messageInput').val('');
        }
    }
};

window.appendMessage = function(message, color) {
    $('#chat-body').append(`<span class="w-100 message" style="color: ${color}">${message}</span>`);
    let div = $('#chat-body')[0];
    div.scrollTop = div.scrollHeight;
    window.localStorage.setItem('messages_' + window.roomId, $('#chat-body').html());
};

window.playSound = function(id) {
    if (window.volume === "on") {
        let audio = new Audio($('#' + id).attr('src'));
        audio.play();
    }
};

window.toggleBoard = function(el) {
    $(el).text($(el).text() === 'Hide my board' ? 'Show my board' : 'Hide my board');
    $('#owner').fadeToggle()
};

window.toggleSounds = function(el) {
    $(el).text($(el).text() === 'Turn off sounds' ? 'Turn on sounds' : 'Turn off sounds');
    window.volume = (window.volume === "on" ? "off" : "on");
};
