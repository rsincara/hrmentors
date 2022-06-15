<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ITTypesController;
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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/registration', [AuthController::class, 'registration']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

});

Route::group([
    'prefix' => 'it_types'
], function () {
    Route::get('', [ITTypesController::class, 'getITTypes']);
    Route::get('/{id}', [ITTypesController::class, 'getITType']);
});

Route::group([
    'prefix' => 'courses'
], function () {
    Route::get('', [CourseController::class, 'getCourses']);
    Route::get('/{id}', [CourseController::class, 'getCourse']);
});

Route::group([
    'prefix' => 'developers'
], function () {
    Route::get('', [\App\Http\Controllers\UserController::class, 'getDevelopers']);
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'getDeveloper']);
});

Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);
