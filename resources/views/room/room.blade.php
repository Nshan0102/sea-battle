<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea War</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/677fcbda09.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>
<body>
<div class="container">
    <div class="row d-flex justify-content-between mb-2" style="background: antiquewhite">
        <div class="mb-3">
            <button data-used="false" class="orientation btn btn-primary mr-2" data-orientation="down">
                <i class="fas fa-arrow-down" style="color: black"></i>
            </button>
            <button data-used="false" class="orientation btn btn-outline-primary" data-orientation="right">
                <i class="fas fa-arrow-right" style="color: black"></i>
            </button>
        </div>
        <div class="mb-3">
            <button data-used="false" onclick="choose(1, 'one-0')" id="one-0">
                1
            </button>
            <button data-used="false" onclick="choose(1, 'one-1')" id="one-1">
                1
            </button>
            <button data-used="false" onclick="choose(1, 'one-2')" id="one-2">
                1
            </button>
            <button data-used="false" onclick="choose(1, 'one-3')" id="one-3">
                1
            </button>
        </div>
        <div class="mb-3">
            <button data-used="false" onclick="choose(2, 'two-0')" id="two-0">
                2
            </button>
            <button data-used="false" onclick="choose(2, 'two-1')" id="two-1">
                2
            </button>
            <button data-used="false" onclick="choose(2, 'two-2')" id="two-2">
                2
            </button>
        </div>
        <div class="mb-3">
            <button data-used="false" onclick="choose(3, 'three-0')" id="three-0">
                3
            </button>
            <button data-used="false" onclick="choose(3, 'three-1')" id="three-1">
                3
            </button>
        </div>
        <div class="mb-3">
            <button data-used="false" onclick="choose(4, 'four-0')" id="four-0">
                4
            </button>
        </div>
    </div>
    <div class="row d-flex justify-content-around align-items-center">
        <table id="owner">
            <tr>
                <td data-used="false" data-index=""></td>
                <td data-used="false" data-index="">1</td>
                <td data-used="false" data-index="">2</td>
                <td data-used="false" data-index="">3</td>
                <td data-used="false" data-index="">4</td>
                <td data-used="false" data-index="">5</td>
                <td data-used="false" data-index="">6</td>
                <td data-used="false" data-index="">7</td>
                <td data-used="false" data-index="">8</td>
                <td data-used="false" data-index="">9</td>
                <td data-used="false" data-index="">10</td>
            </tr>
            <tr>
                <td data-used="false" data-index="">A</td>
                <td data-used="false" data-index="1-1"></td>
                <td data-used="false" data-index="1-2"></td>
                <td data-used="false" data-index="1-3"></td>
                <td data-used="false" data-index="1-4"></td>
                <td data-used="false" data-index="1-5"></td>
                <td data-used="false" data-index="1-6"></td>
                <td data-used="false" data-index="1-7"></td>
                <td data-used="false" data-index="1-8"></td>
                <td data-used="false" data-index="1-9"></td>
                <td data-used="false" data-index="1-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">B</td>
                <td data-used="false" data-index="2-1" ></td>
                <td data-used="false" data-index="2-2" ></td>
                <td data-used="false" data-index="2-3" ></td>
                <td data-used="false" data-index="2-4" ></td>
                <td data-used="false" data-index="2-5" ></td>
                <td data-used="false" data-index="2-6" ></td>
                <td data-used="false" data-index="2-7" ></td>
                <td data-used="false" data-index="2-8" ></td>
                <td data-used="false" data-index="2-9" ></td>
                <td data-used="false" data-index="2-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">C</td>
                <td data-used="false" data-index="3-1" ></td>
                <td data-used="false" data-index="3-2" ></td>
                <td data-used="false" data-index="3-3" ></td>
                <td data-used="false" data-index="3-4" ></td>
                <td data-used="false" data-index="3-5" ></td>
                <td data-used="false" data-index="3-6" ></td>
                <td data-used="false" data-index="3-7" ></td>
                <td data-used="false" data-index="3-8" ></td>
                <td data-used="false" data-index="3-9" ></td>
                <td data-used="false" data-index="3-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">D</td>
                <td data-used="false" data-index="4-1" ></td>
                <td data-used="false" data-index="4-2" ></td>
                <td data-used="false" data-index="4-3" ></td>
                <td data-used="false" data-index="4-4" ></td>
                <td data-used="false" data-index="4-5" ></td>
                <td data-used="false" data-index="4-6" ></td>
                <td data-used="false" data-index="4-7" ></td>
                <td data-used="false" data-index="4-8" ></td>
                <td data-used="false" data-index="4-9" ></td>
                <td data-used="false" data-index="4-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">E</td>
                <td data-used="false" data-index="5-1" ></td>
                <td data-used="false" data-index="5-2" ></td>
                <td data-used="false" data-index="5-3" ></td>
                <td data-used="false" data-index="5-4" ></td>
                <td data-used="false" data-index="5-5" ></td>
                <td data-used="false" data-index="5-6" ></td>
                <td data-used="false" data-index="5-7" ></td>
                <td data-used="false" data-index="5-8" ></td>
                <td data-used="false" data-index="5-9" ></td>
                <td data-used="false" data-index="5-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">F</td>
                <td data-used="false" data-index="6-1" ></td>
                <td data-used="false" data-index="6-2" ></td>
                <td data-used="false" data-index="6-3" ></td>
                <td data-used="false" data-index="6-4" ></td>
                <td data-used="false" data-index="6-5" ></td>
                <td data-used="false" data-index="6-6" ></td>
                <td data-used="false" data-index="6-7" ></td>
                <td data-used="false" data-index="6-8" ></td>
                <td data-used="false" data-index="6-9" ></td>
                <td data-used="false" data-index="6-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">G</td>
                <td data-used="false" data-index="7-1" ></td>
                <td data-used="false" data-index="7-2" ></td>
                <td data-used="false" data-index="7-3" ></td>
                <td data-used="false" data-index="7-4" ></td>
                <td data-used="false" data-index="7-5" ></td>
                <td data-used="false" data-index="7-6" ></td>
                <td data-used="false" data-index="7-7" ></td>
                <td data-used="false" data-index="7-8" ></td>
                <td data-used="false" data-index="7-9" ></td>
                <td data-used="false" data-index="7-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">H</td>
                <td data-used="false" data-index="8-1" ></td>
                <td data-used="false" data-index="8-2" ></td>
                <td data-used="false" data-index="8-3" ></td>
                <td data-used="false" data-index="8-4" ></td>
                <td data-used="false" data-index="8-5" ></td>
                <td data-used="false" data-index="8-6" ></td>
                <td data-used="false" data-index="8-7" ></td>
                <td data-used="false" data-index="8-8" ></td>
                <td data-used="false" data-index="8-9" ></td>
                <td data-used="false" data-index="8-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">I</td>
                <td data-used="false" data-index="9-1" ></td>
                <td data-used="false" data-index="9-2" ></td>
                <td data-used="false" data-index="9-3" ></td>
                <td data-used="false" data-index="9-4" ></td>
                <td data-used="false" data-index="9-5" ></td>
                <td data-used="false" data-index="9-6" ></td>
                <td data-used="false" data-index="9-7" ></td>
                <td data-used="false" data-index="9-8" ></td>
                <td data-used="false" data-index="9-9" ></td>
                <td data-used="false" data-index="9-10"></td>
            </tr>
            <tr>
                <td data-used="false" data-index="">J</td>
                <td data-used="false" data-index="10-1" ></td>
                <td data-used="false" data-index="10-2" ></td>
                <td data-used="false" data-index="10-3" ></td>
                <td data-used="false" data-index="10-4" ></td>
                <td data-used="false" data-index="10-5" ></td>
                <td data-used="false" data-index="10-6" ></td>
                <td data-used="false" data-index="10-7" ></td>
                <td data-used="false" data-index="10-8" ></td>
                <td data-used="false" data-index="10-9" ></td>
                <td data-used="false" data-index="10-10"></td>
            </tr>
        </table>
        <table id="opponent">
            <tr>
                <td data-fired="false" data-clean="false" data-opponent=""></td>
                <td data-fired="false" data-clean="false" data-opponent="">1</td>
                <td data-fired="false" data-clean="false" data-opponent="">2</td>
                <td data-fired="false" data-clean="false" data-opponent="">3</td>
                <td data-fired="false" data-clean="false" data-opponent="">4</td>
                <td data-fired="false" data-clean="false" data-opponent="">5</td>
                <td data-fired="false" data-clean="false" data-opponent="">6</td>
                <td data-fired="false" data-clean="false" data-opponent="">7</td>
                <td data-fired="false" data-clean="false" data-opponent="">8</td>
                <td data-fired="false" data-clean="false" data-opponent="">9</td>
                <td data-fired="false" data-clean="false" data-opponent="">10</td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">A</td>
                <td data-fired="false" data-clean="false" data-opponent="1-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="1-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">B</td>
                <td data-fired="false" data-clean="false" data-opponent="2-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="2-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">C</td>
                <td data-fired="false" data-clean="false" data-opponent="3-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="3-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">D</td>
                <td data-fired="false" data-clean="false" data-opponent="4-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="4-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">E</td>
                <td data-fired="false" data-clean="false" data-opponent="5-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="5-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">F</td>
                <td data-fired="false" data-clean="false" data-opponent="6-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="6-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">G</td>
                <td data-fired="false" data-clean="false" data-opponent="7-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="7-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">H</td>
                <td data-fired="false" data-clean="false" data-opponent="8-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="8-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">I</td>
                <td data-fired="false" data-clean="false" data-opponent="9-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="9-10"></td>
            </tr>
            <tr>
                <td data-fired="false" data-clean="false" data-opponent="">J</td>
                <td data-fired="false" data-clean="false" data-opponent="10-1"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-2"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-3"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-4"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-5"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-6"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-7"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-8"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-9"></td>
                <td data-fired="false" data-clean="false" data-opponent="10-10"></td>
            </tr>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
