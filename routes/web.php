<?php

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
Route::group(['prefix' => '/', 'middleware' => ['auth']], function (){
    Route::get('/', 'MainController@index')->name('main');

    Route::get('/users/ajax/get', 'UserController@indexAjax')->name('users.indexAjax');
    Route::resource('/users', 'UserController');

    Route::resource('/channels', 'ChannelController');

    Route::resource('/advertisings', 'AdvertisingController');
    Route::get('/advertisings/ajax/get', 'AdvertisingController@indexAjax')->name('advertisings.indexAjax');

    Route::resource('/stats', 'StatsController');
    Route::get('/stats/ajax/get', 'StatsController@indexAjax')->name('stats.indexAjax');

    Route::resource('/main_channels', 'MainChannelController');
    Route::get('/main_channels/ajax/get', 'MainChannelController@indexAjax')->name('main_channels.indexAjax');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
