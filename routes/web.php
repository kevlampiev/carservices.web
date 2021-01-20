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

Route::get('/', function () {
    return view('index');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
//    'middleware' => ['auth', 'is_admin']
], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('/users', 'UserController');
    Route::post('/services/{service}/type/add', 'ServiceController@addType')->name('service.addType');
    Route::delete('/services/{service}/type/delete', 'ServiceController@deleteType')->name('service.deleteType');
    Route::resource('/services', 'ServiceController');
    Route::resource('/schedules', 'ScheduleController');

    Route::resource('/orders', 'OrderController');
    Route::resource('/types', 'TypeController');

});


//Не трогать!!! Пусть стоит в самом конце. А то vue-router не работает на некоторых страницах
Route::get('/{param?}/{id?}', function () {
    return view('index');
});
