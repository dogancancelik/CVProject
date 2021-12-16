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

Route::prefix('v1')->group(function(){
    Route::get('/employees','Api\EmployeeController@index');
    Route::get('/employees/{employee}','Api\EmployeeController@show');
    Route::post('/employees','Api\EmployeeController@store');
    Route::post('/employees/{employee}/update','Api\EmployeeController@update');
    Route::delete('/employees/{employee}','Api\EmployeeController@destroy');

    //Route::resource('employees', 'Api\EmployeeController');
});
