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


//FOLDER OPERATOR
// (Manage Akun)
Route::get('/akunkepalap4mp', [Controller::class, "akunKepalap4mp"]);
Route::get('/akunauditor', [Controller::class, "akunAuditor"]);
Route::get('/akunauditee', [Controller::class, "akunAuditee"]);
Route::get('/akunjurusan', [Controller::class, "akunJurusan"]);
// (Ami)
Route::get('/pedomanami', [Controller::class, "pedomanAmi"]);
Route::get('/standar', [Controller::class, "standar"]);
Route::get('/jadwalami', [Controller::class, "jadwalAmi"]);
Route::get('/pertanyaanstandar', [Controller::class, "pertanyaanStandar"]);
Route::get('/historiami', [Controller::class, "historiAmi"]);
// (Dokumentasi Ami)
Route::get('/dokumentasiAmi', [Controller::class, "dokAmi"]);
Route::get('/dokumentasiRtm', [Controller::class, "dokRtm"]);

//UPDATE FOLDER OPERATOR
Route::get('/updateakunkepalap4mp', [Controller::class, "updateAkunKepalap4mp"]);
Route::get('/updateakunauditor', [Controller::class, "updateAkunAuditor"]);
Route::get('/updateakunauditee', [Controller::class, "updateAkunAuditee"]);
Route::get('/updateakunjurusan', [Controller::class, "updateAkunJurusan"]);

//FOLDER AKUN
Route::get('/profile', [Controller::class, "profile"]);
Route::get('/editPassword', [Controller::class, "editPassword"]);
