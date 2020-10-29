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
], function() {
    Route::get('/', 'API\ServicesController@index')->name('services');
    Route::get('/city', 'API\ServicesController@cityList')->name('services.city');
    Route::get('/type', 'API\ServicesController@typeList')->name('services.type');
    Route::get('/{slug}', 'API\ServicesController@show')->name('serviceData');
});

Route::middleware('auth:api')
    ->group(function () {
        Route::post('/logout', 'API\AuthController@logout');
    }
    );

//Route::group([
//    'prefix' => 'admin',
//    'namespace' => 'Admin',
//    'as' => 'admin.',
//    'middleware' => ['auth', 'is_admin']
//], function() {
//    Route::resource('/user', 'UserController', ['except' => ['create', 'store']]);
//});
