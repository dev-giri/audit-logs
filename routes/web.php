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

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
    Route::get('register', 'Auth\RegisterController@register');
    Route::post('register', 'Auth\RegisterController@store')->name('register');
    
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::post('login', 'Auth\LoginController@authenticate');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});
/* Route Authentication Pages */

/* Route User Pages */
Route::group(['middleware' => ['userauth','auth:web']], function () {
    Route::get('/', 'DashboardController@home')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@home')->name('dashboard');

});
/* Route User Pages */

/* Route Admin Pages */
Route::group(['prefix' => 'admin','middleware' => ['adminauth','auth:web']], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin');
    Route::post('/edit-audit', 'Admin\DashboardController@edit_audit')->name('edit_audit');
    Route::post('/delete-audit', 'Admin\DashboardController@delete_audit')->name('delete_audit');

});
/* Route Admin Pages */