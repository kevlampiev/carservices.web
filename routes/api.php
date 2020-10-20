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
Route::post('/changeLocation', 'API\ServicesController@index')->name('services');
Route::post('/changeLocation/{slug}', 'API\ServicesController@show')->name('serviceData');

Route::middleware('auth:api')
    ->group(function () {
        Route::post('/logout', 'API\AuthController@logout');
    }
    );
