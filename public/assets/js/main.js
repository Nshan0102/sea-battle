let orientation = "right";
let prepared = [];
let selected = {
    id: "",
    count: 0,
    orientation: ""
};
let ships = {
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
let allShipsAreReady = [];
let gameStarted = false;
let setAndResetLoading = false;
let chooseTime = new Date().getTime() / 1000;

$(window).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".orientation").on('click', function () {
        $(".orientation").removeClass('btn-primary');
        $(this).addClass('btn-primary');
        orientation = $(this).data('orientation');
    });

    let ownerCells = 'td[data-index!=""]';

    $(ownerCells).on('mouseover', function () {
        prepared = [];
        $("td[data-used='false']").css('background', '#7bc4ff');
        if (selected.count > 0) {
            let index = $(this).data('index');
            if (index != undefined) {
                let row = index.split("-")[0];
                let column = index.split("-")[1];
                let goesOutside = checkIfGoesOutside(parseInt(row), parseInt(column));
                let cellsUsed = checkIfCellsUsed(parseInt(row), parseInt(column));
                let color = goesOutside === cellsUsed ? goesOutside : "red";
                showInsertPlace(parseInt(row), parseInt(column), color);
            }
        }
    });

    $(ownerCells).on('click', function () {
        if (prepared.length > 0) {
            setShip();
        } else {
            if ($(this).attr('data-used') === 'true' && !gameStarted) {
                resetShip($(this).data('ship'));
            }
        }
    });

    $('td[data-opponent!=""]').on('click', function () {
        let clean = $(this).attr('data-clean');
        if (typeof clean !== typeof undefined && clean !== false && clean !== "true") {
            let coordinates = $(this).attr('data-opponent').split('-');
            fire(coordinates[0], coordinates[1]);
        }
    });

    $('td[data-opponent!=""]').contextmenu(function (event) {
        let opponent = $(this).attr('data-opponent');
        if (typeof opponent !== typeof undefined && opponent !== false && opponent !== "") {
            event.preventDefault();
            $(this).toggleClass('healthyChecked');
        }
    });
});

function showInsertPlace(row, column, color) {
    let preparedTemp = [];
    if (orientation === "down") {
        for (let j = 0; j < selected.count; j++) {
            let index = (parseInt(row) + j) + '-' + column;
            let used = $('td[data-index="' + index + '"]').attr('data-used');
            if (used == "false") {
                $('td[data-index="' + index + '"]').css('background', color);
            }
            preparedTemp.push(index);
        }
    } else if (orientation === "right") {
        for (let j = 0; j < selected.count; j++) {
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
            prepared.push(preparedTemp[i])
        }
    }
}

function checkIfGoesOutside(row, column) {
    let color = "#35a5ff";
    if (orientation === "down" && (parseInt(row) + selected.count - 1) > 10) {
        color = "red";
    } else if (orientation === "right" && (parseInt(column) + selected.count - 1) > 10) {
        color = "red";
    }
    return color;
}

function checkIfCellsUsed(row, column) {
    let color = "#35a5ff";
    if (orientation === "down") {
        for (let i = 0; i < selected.count; i++) {
            let used = $('td[data-index="' + (parseInt(row) + i) + '-' + column + '"]').attr('data-used');
            if (used == "true") {
                color = "red";
            }
        }
    } else if (orientation === "right") {
        for (let i = 0; i < selected.count; i++) {
            let used = $('td[data-index="' + row + '-' + (parseInt(column) + i) + '"]').attr('data-used');
            if (used == "true") {
                color = "red";
            }
        }
    }
    return color;
}

function choose(cellsNumber, id) {
    let now = new Date().getTime() / 1000;
    let dif = now - chooseTime;
    if (dif > 1) {
        chooseTime = new Date().getTime() / 1000;
        let alreadyUsed = $("#" + id).attr('data-used');
        if (alreadyUsed === "true") {
            $("#" + id).removeClass('broken');
            $("td[data-used='false']").css('background', '#7bc4ff');
            $("#" + id).data('used', 'false');
            resetShip(id);
            resetSelectedShip();
        } else {
            if (id !== selected.id) {
                if (selected.id != "") {
                    $("#" + selected.id).removeClass('broken');
                    $("td[data-used='false']").css('background', '#7bc4ff');
                    $("#" + selected.id).attr('data-used', 'false');
                    resetSelectedShip();
                }
                $("#" + id).addClass('broken');
                setSelectedShip(cellsNumber, id);
                $("#" + id).attr('data-used', 'true');
            } else {
                $("#" + id).removeClass('broken');
                $("td[data-used='false']").css('background', '#7bc4ff');
                $("#" + id).data('used', 'false');
                resetSelectedShip();
            }
        }
    }
}

function setSelectedShip(cellsNumber, id) {
    selected.id = id;
    selected.count = cellsNumber;
    selected.orientation = orientation;
}

function resetSelectedShip() {
    selected.id = "";
    selected.count = 0;
    selected.orientation = orientation;
}

function setShip(formBackend = false) {
    let shipName = selected.id.split('-')[0];
    let shipIndex = parseInt(selected.id.split('-')[1]);
    for (let i = 0; i < prepared.length; i++) {
        ships[shipName][shipIndex][i]['index'] = prepared[i];
        toggleNeighbours(prepared[i], 'true');
        $('td[data-index="' + prepared[i] + '"]').css('background', '#35a5ff');
        $('td[data-index="' + prepared[i] + '"]').html('<i class="fas fa-anchor" style="color: #796046"></i>');
        $('td[data-index="' + prepared[i] + '"]').attr('data-used', 'true');
        $('td[data-index="' + prepared[i] + '"]').attr('data-ship', selected.id);
    }
    prepared = [];
    resetSelectedShip();
    if (isReady() && !formBackend) {
        updateShips();
    }
}

function setAllShips() {
    for (const [key, value] of Object.entries(ships)) {
        for (let i = 0; i < value.length; i++) {
            prepared = [];
            selected.id = key + '-' + i;
            $('#' + key + '-' + i).attr('data-used', 'true');
            $('#' + key + '-' + i).addClass('broken');
            for (let j = 0; j < value[i].length; j++) {
                prepared.push(value[i][j]['index']);
            }
            setShip(true);
        }
    }
}

function resetShip(ship) {
    if (ship && gameStarted === false && setAndResetLoading === false) {
        setAndResetLoading = true;
        let shipName = ship.split('-')[0];
        let shipIndex = parseInt(ship.split('-')[1]);
        for (let i = 0; i < ships[shipName][shipIndex].length; i++) {
            toggleNeighbours(ships[shipName][shipIndex][i]['index'], 'false');
            $('td[data-index="' + ships[shipName][shipIndex][i]['index'] + '"]').css('background', '#7bc4ff');
            $('td[data-index="' + ships[shipName][shipIndex][i]['index'] + '"]').html('');
            $('td[data-index="' + ships[shipName][shipIndex][i]['index'] + '"]').attr('data-used', 'false');
            $('td[data-index="' + ships[shipName][shipIndex][i]['index'] + '"]').removeAttr('data-ship');
            ships[shipName][shipIndex][i]['index'] = "";
        }
        $("#" + ship).removeClass('broken');
        $("#" + ship).attr('data-used', 'false');
    }
    setAndResetLoading = false;
}

function toggleNeighbours(index, block) {
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
}

function isReady() {
    let ready = '';
    allShipsAreReady = [];
    for (const [key, value] of Object.entries(ships)) {
        for (let i = 0; i < value.length; i++) {
            for (let j = 0; j < value[i].length; j++) {
                if (value[i][j]['index'] !== "") {
                    ready += "1";
                    allShipsAreReady.push(value[i][j]['index']);
                } else {
                    ready += "0";
                }
            }
        }
    }
    return ready.indexOf('0') === -1;
}

function fire(x, y) {
    if (gameStarted) {
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
                    $("td[data-opponent='" + x + "-" + y + "']").addClass('wounded');
                    $(this).attr('data-clean', 'true');
                    if (res.ship.length > 0) {
                        for (let i = 0; i < res.ship.length; i++) {
                            $("td[data-opponent='" + res.ship[i]['index'] + "']").removeClass('wounded').addClass('broken');
                        }
                    }
                } else if (res.status === 'empty') {
                    $("td[data-opponent='" + x + "-" + y + "']").addClass('healthy');
                    $(this).attr('data-clean', 'true');
                }
                toastr["info"](res.message, '', {'progressBar': true});
            },
            error: function (xhr, status, error) {
                let message = 'Oops! Something went wrong';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    message = xhr.responseJSON.error;
                }
                toastr["error"](message, 'Oops!', {'progressBar': true});
            }
        });
    } else {
        toastr["info"]("You and/or your opponent are not ready to play", 'Hey!', {'progressBar': true});
    }
}

function getIndexName(index) {
    let letters = ['', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    let indexNumber = parseInt(index.split('-')[0]);
    let letter = letters[indexNumber];
    return letter + '-' + index.split('-')[1];
}

function makeBrokenOnMyBoard(index) {
    let cell = $("td[data-index='" + index + "']")[0];
    let attr = $(cell).attr('data-ship');
    let isUsed = typeof attr !== typeof undefined && attr !== false;
    if (isUsed === true) {
        $("td[data-index='" + index + "']").addClass('broken');
    } else {
        $("td[data-index='" + index + "']").addClass('healthy');
    }
}

function showFires(fires, succeeds, board) {
    for (let i = 0; i < fires.length; i++) {
        let cell = $("td[data-" + board + "='" + fires[i] + "']")[0];
        if (succeeds.indexOf(fires[i]) >= 0) {
            $(cell).addClass('broken');
        } else {
            $(cell).addClass('healthy');
        }
    }
}
