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

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::group(['prefix' => 'sea-battle', 'middleware' => 'auth'], function (){
    Route::get('/home', 'RoomController@create')->name('sea-battle.home');

    Route::get('/instructions', function () {
        return view('games/sea-battle/instructions');
    })->name('sea-battle.instructions');

    Route::get('/play', 'RoomController@create')->name('sea-battle.play');

    Route::get('/join/{room}', 'RoomController@join')->name('sea-battle.join');

    Route::get('/room/{room}', 'RoomController@enterTheRoom')->name('sea-battle.enter-the-room');

    Route::get('/get-my-ships/{room}', 'RoomController@getMyShips')->name('sea-battle.get-my-ships');

    Route::put('/update-room-as-owner/{room}', 'RoomController@updateRoomAsOwner')->name('sea-battle.update-room-as-owner');

    Route::put('/update-room-as-opponent/{room}', 'RoomController@updateRoomAsOpponent')->name('sea-battle.update-room-as-opponent');

    Route::post('/fire/{room}', 'RoomController@fire')->name('sea-battle.fire');

    Route::post('/message/{room}', 'RoomController@message')->name('sea-battle.message');
});


