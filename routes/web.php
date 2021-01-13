<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function (){
    Route::get('/play', 'RoomController@create')->name('play');

    Route::get('/join/{room}', 'RoomController@join')->name('join');

    Route::get('/room/{room}', 'RoomController@enterTheRoom')->name('enter-the-room');

    Route::get('/get-my-ships/{room}', 'RoomController@getMyShips')->name('get-my-ships');

    Route::put('/update-room-as-owner/{room}', 'RoomController@updateRoomAsOwner')->name('update-room-as-owner');

    Route::put('/update-room-as-opponent/{room}', 'RoomController@updateRoomAsOpponent')->name('update-room-as-opponent');

    Route::post('/fire/{room}', 'RoomController@fire')->name('fire');

    Route::post('/message/{room}', 'RoomController@message')->name('message');

    Route::get('/sea-battle-team', 'HomeController@seaBattleTeam')->name('sea-battle-team');
});


