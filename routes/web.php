<?php

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
    return redirect()->route('home');
});


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/like/{userId}', 'ActivityController@like')->name('activity.like');
    Route::get('/dislike/{userId}', 'ActivityController@dislike')->name('activity.dislike');
    Route::get('users/map', 'ActivityController@map')->name('activity.map');

});



