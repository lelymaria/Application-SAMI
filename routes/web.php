<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JadwalAmiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\PedomanAmiController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\StandarController;
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
// Authentication
Route::get('/', [AuthenticationController::class, "index"]);
Route::post('/login', [AuthenticationController::class, "login"]);
Route::get('/dashboard', [LayoutController::class, "index"])->middleware('auth');
Route::get('/logout', [AuthenticationController::class, "logout"])->name("login");
// JurusanController
Route::get('/data/datajurusan', [JurusanController::class, "index"]);
Route::post('/data/datajurusan', [JurusanController::class, "store"]);
Route::get('/data/datajurusan/{id}', [JurusanController::class, "edit"]);
Route::post('/data/datajurusan/{id}', [JurusanController::class, "update"]);
Route::delete('/data/datajurusan/{id}', [JurusanController::class, "destroy"]);
// ProdiController
Route::get('/data/dataprodi', [ProgramStudiController::class, "index"]);
Route::post('/data/dataprodi', [ProgramStudiController::class, "store"]);
Route::get('/data/dataprodi/{id}', [ProgramStudiController::class, "edit"]);
Route::post('/data/dataprodi/{id}', [ProgramStudiController::class, "update"]);
Route::delete('/data/dataprodi/{id}', [ProgramStudiController::class, "destroy"]);
// StandarController
Route::get('/ami/standar', [StandarController::class, "index"]);
Route::post('/ami/standar', [StandarController::class, "store"]);
Route::get('/ami/standar/{id}', [StandarController::class, "edit"]);
Route::post('/ami/standar/{id}', [StandarController::class, "update"]);
Route::delete('/ami/standar/{id}', [StandarController::class, "destroy"]);
// PedomanAmi
Route::get('/ami/pedomanAmi', [PedomanAmiController::class, "index"]);
Route::post('/ami/pedomanAmi', [PedomanAmiController::class, "store"]);
Route::get('/ami/pedomanAmi/{id}', [PedomanAmiController::class, "edit"]);
Route::post('/ami/pedomanAmi/{id}', [PedomanAmiController::class, "update"]);
// JadwalAmi
Route::get('/ami/jadwalAmi', [JadwalAmiController::class, "index"]);
Route::post('/ami/jadwalAmi', [JadwalAmiController::class, "store"]);
Route::get('/ami/jadwalAmi/{id}', [JadwalAmiController::class, "edit"]);
Route::post('/ami/jadwalAmi/{id}', [JadwalAmiController::class, "update"]);
Route::delete('/ami/jadwalAmi/{id}', [JadwalAmiController::class, "destroy"]);

/* ============================================================= */

//FOLDER OPERATOR
// (Manage Akun)
Route::get('/akunkepalap4mp', [Controller::class, "akunKepalap4mp"]);
Route::get('/akunauditor', [Controller::class, "akunAuditor"]);
Route::get('/akunauditee', [Controller::class, "akunAuditee"]);
Route::get('/akunjurusan', [Controller::class, "akunJurusan"]);
// (Ami)
Route::get('/pedomanami', [Controller::class, "pedomanAmi"]);
Route::get('/pertanyaanstandar', [Controller::class, "pertanyaanStandar"]);
Route::get('/historiami', [Controller::class, "historiAmi"]);
// (Dokumentasi Ami)
Route::get('/dokumentasiAmi', [Controller::class, "dokAmi"]);
Route::get('/dokumentasiRtm', [Controller::class, "dokRtm"]);
//UPDATE->FOLDER OPERATOR
Route::get('/updateakunkepalap4mp', [Controller::class, "updateAkunKepalap4mp"]);
Route::get('/updateakunauditor', [Controller::class, "updateAkunAuditor"]);
Route::get('/updateakunauditee', [Controller::class, "updateAkunAuditee"]);
Route::get('/updateakunjurusan', [Controller::class, "updateAkunJurusan"]);


//FOLDER MENU->AKUN
Route::get('/profile', [Controller::class, "profile"]);
Route::get('/editPassword', [Controller::class, "editPassword"]);
//FOLDER MENU->DOKUMENTASI
Route::get('/dokAMI', [Controller::class, "dokAmiAll"]);
Route::get('/dokRTM', [Controller::class, "dokRtmAll"]);

// FOLDER VIEWS
Route::get('/pedomanAll', [Controller::class, "pedomanAll"]);
Route::get('/historiAll', [Controller::class, "historiAll"]);

// FOLDER P4MP->AMI
Route::get('/laporanamiP4mp', [Controller::class, "laporanP4mp"]);
Route::get('/monitoringamiP4mp', [Controller::class, "monitoringP4mp"]);
Route::get('/verifikasitindakanP4mp', [Controller::class, "verifikasiP4mp"]);

// FOLDER AUDITOR->AMI
Route::get('/checklistAmiAuditor', [Controller::class, "checklistAmi"]);
Route::get('/draftAmiAuditor', [Controller::class, "drafttemuanAmi"]);
Route::get('/laporanAmiAuditor', [Controller::class, "laporanHasilAmi"]);

// FOLDER AUDITEE->AMI
Route::get('/datadukung', [Controller::class, "dataDukung"]);
Route::get('/drafttemuanAuditee', [Controller::class, "drafttemuanAuditee"]);
Route::get('/hasilChecklistAmi', [Controller::class, "hasilChecklistAmi"]);
Route::get('/ketersediaanDok', [Controller::class, "ketersediaanDok"]);
