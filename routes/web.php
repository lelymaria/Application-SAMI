<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', [Controller::class, "welcome"]);
Route::get('/login', [AuthenticationController::class, "index"]);
Route::post('/login', [AuthenticationController::class, "login"]);
Route::get('/dashboard', [LayoutController::class, "index"])->middleware('auth');
Route::get('/logout', [AuthenticationController::class, "logout"])->name("login");

