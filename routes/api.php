<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['prefix' => '/v1', 'namespace' => 'Ap1\V1', 'as' => 'api.'], function () {
//     Route::resource('customer', 'Master\CustomerCont',['except' => ['create','edit']]);
// });

// Route::group(['prefix' => '/v1', 'namespace' => 'Ap1\V1', 'as' => 'api.'], function () {
//     Route::resource('driver', 'Master\DriverCont',['except' => ['create','edit']]);
// });

// Route::group(['prefix' => '/v1', 'namespace' => 'Ap1\V1', 'as' => 'api.'], function () {
//     Route::resource('Mobil', 'Master\MobilCont',['except' => ['create','edit']]);
// });

// Route::group(['prefix' => '/v1', 'namespace' => 'Ap1\V1', 'as' => 'api.'], function () {
//     Route::resource('Mobil', 'Master\TipePelangganCont',['except' => ['create','edit']]);
// });

// Route::group(['prefix' => '/v1', 'namespace' => 'Ap1\V1', 'as' => 'api.'], function () {
//     Route::resource('Mobil', 'Master\VendorCont',['except' => ['create','edit']]);
// });