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

/**
 * 渣打h5兑奖
 */
Route::post('sc/code', 'Vip\VipController@code');
Route::post('sc/order', 'Vip\VipController@order');

//门诊问询移除接口
Route::post('doctors/delete', 'DoctorController@delete');
