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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/', 'HomeController@store')->name('home.store');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/deliveries', 'AdminController@deliveries')->name('admin.deliveries');
    Route::get('/deliveries/{location}/{id}', 'AdminController@updateDelivery')->name('admin.updateDelivery');
    Route::get('/deliveries/{location}/{id}/delete', 'AdminController@deleteDelivery')->name('admin.deleteDelivery');
    Route::get('/users/{user}', 'AdminController@users')->name('admin.users');
});
