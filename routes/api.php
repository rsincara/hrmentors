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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/registration', [\App\Http\Controllers\AuthController::class, 'registration']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('/me', [\App\Http\Controllers\AuthController::class, 'me']);

//    Route::post('/registration', 'AuthController@registration');
//    Route::post('/logout', 'AuthController@logout');
//    Route::post('/refresh', 'AuthController@refresh');
//    Route::post('/me', 'AuthController@me');
});

Route::get('/it_types', [\App\Http\Controllers\ITTypesController::class, 'getITTypes']);
Route::get('/it_types/{id}', [\App\Http\Controllers\ITTypesController::class, 'getITType']);

Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'getCourses']);
Route::get('/courses/{id}', [\App\Http\Controllers\CourseController::class, 'getCourse']);
