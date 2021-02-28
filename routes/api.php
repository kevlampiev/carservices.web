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
Route::post('/autologin', 'API\AuthController@autoLogin')
    ->middleware('auth:api');

Route::group([
    'prefix' => 'services'
], function () {
    Route::get('/', 'API\ServicesController@index')->name('services');
    Route::get('/cities', 'API\ServicesController@cityList')->name('services.city');
    Route::get('/types', 'API\ServicesController@typeList')->name('services.type');
    Route::get('/{service}', 'API\ServicesController@show')->name('serviceData');
    Route::post('/{service}', 'API\ServicesController@setSchedule')->name('storeOrder');
});

Route::post('/order', 'API\OrderController@setOrder')->name('setOrder')->middleware('auth:api');


Route::get('/owner/services', 'API\OwnerServiceController@index')
    ->middleware(['auth:api','is.owner']);
//Route::post('/owner/services/add','API\OwnerServiceController@store')
//    ->middleware(['auth:api','is.owner']);
Route::put('/owner/services/{id}/edit','API\OwnerServiceController@update')
    ->middleware(['auth:api','is.owner']);


Route::middleware('auth:api')
    ->group(function () {
        Route::post('/logout', 'API\AuthController@logout');
    }
    );


