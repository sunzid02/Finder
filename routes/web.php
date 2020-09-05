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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/like/{userId}', 'ActivityController@like')->name('activity.like');
    Route::get('/dislike/{userId}', 'ActivityController@dislike')->name('activity.dislike');
    Route::get('users/map', 'ActivityController@map')->name('activity.map');

});

/*{{--                            <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo 23.718176; ?>,<?php echo 90.386604; ?>&output=embed"></iframe>--}}*/
