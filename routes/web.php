<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/submit', [LoginController::class, 'store']);

Route::group(['middleware' => ['session']], function () {
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/about', [HomeController::class, 'about']);
    Route::get('/post', [HomeController::class, 'create']);
    Route::get('/dept', [DepartmentController::class, 'index']);
    Route::post('/dept/submit', [DepartmentController::class, 'store']);
    Route::post('/post/submit', [HomeController::class, 'store']);
    Route::get('/data', [HomeController::class, 'show']);
    Route::get('/data/edit/{id}', [HomeController::class, 'edit']);
    Route::patch('/post/update', [HomeController::class, 'update']);
    Route::get('/data/delete/{id}', [HomeController::class, 'destroy']);
});
