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

// Calendar

Route::get('/calendar', 'App\Http\Controllers\CalendarController@index'); // Show all log from calendar
Route::get('/calendar/notAvailable', 'App\Http\Controllers\CalendarController@notAvailableDays'); // Show all log from disabled days
Route::post('/calendar', 'App\Http\Controllers\CalendarController@store'); // Add new log to calendar
Route::put('/calendar/{id}', 'App\Http\Controllers\CalendarController@update'); // Update new log
Route::delete('/calendar/{id}', 'App\Http\Controllers\CalendarController@destroy'); // Delete a log

// User

Route::get('/reservations/{user?}/{initialDate?}/{endDate?}', 'App\Http\Controllers\UserController@getReservations');
Route::post('/pushReservation/{userId}', 'App\Http\Controllers\UserController@pushReservation');