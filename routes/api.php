<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::group([
    'prefix' => 'services'
], function () {
    Route::get('/', 'API\ServicesController@index')->name('services');
    Route::get('/cities', 'API\ServicesController@cityList')->name('services.city');
    Route::get('/types', 'API\ServicesController@typeList')->name('services.type');
    Route::get('/{service}', 'API\ServicesController@show')->name('serviceData');
    Route::post('/{service}', 'API\ServicesController@setSchedule')->name('storeOrder');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::resource('/orders', 'OrderController');
    Route::resource('/schedules', 'ScheduleController');
    Route::resource('/users', 'UserController');
    Route::resource('/types', 'TypeController');

});


Route::post('/order', 'API\OrderController@setOrder')->name('setOrder')->middleware('auth:api');


Route::group([
    'prefix' => 'owner',
    'namespace' => 'API'
], function () {
    Route::resource('/services', 'OwnerServiceController');
});

Route::middleware('auth:api')
    ->group(function () {
        Route::post('/logout', 'API\AuthController@logout');
    }
    );


