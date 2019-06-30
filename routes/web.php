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
    return view('welcome');
});

//Route::get('vvip', 'Vip\VipController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//门诊等候屏幕
Route::get('doctors/waiting', 'DoctorController@waiting');
Route::get('doctor/{id}', 'DoctorController@doctorShow');
Route::group(['middleware' => 'auth'], function (){
//门诊登记
    Route::get('doctors/create', 'DoctorController@create');
    Route::post('doctors/create', 'DoctorController@store');

    Route::get('doctors/setting', 'DoctorController@setting');
    Route::post('doctors/setting', 'DoctorController@set');
});
Route::get('doctors/index/{id}', 'DoctorController@index');

Route::get('test', function () {
   event(new \App\Events\Patient(1, 1, '-1','' , 1));
   return 'true';
});
