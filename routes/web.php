<?php

use App\Http\Controllers\AkunAuditeeController;
use App\Http\Controllers\AkunAuditorController;
use App\Http\Controllers\AkunJurusanController;
use App\Http\Controllers\AkunOperatorController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JadwalAmiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KepalaP4mpController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\PedomanAmiController;
use App\Http\Controllers\PertanyaanStandarController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\StandarController;
use App\Http\Controllers\UpdatePasswordController;
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
// UpdatePassword
Route::get('/password/edit', [UpdatePasswordController::class, "edit"]);
Route::put('/password/edit', [UpdatePasswordController::class, "update"]);
// AkunOperator
Route::get('/manage_user/akun_auditee', [AkunOperatorController::class, "index"]);
Route::post('/manage_user/akun_auditee', [AkunOperatorController::class, "store"]);
// Route::get('/manage_user/akun_auditee_edit/{id}', [AkunOperatorController::class, "edit"]);
// Route::post('/manage_user/akun_auditee/{id}', [AkunOperatorController::class, "update"]);
// Route::delete('/manage_user/akun_auditee/{id}', [AkunOperatorController::class, "destroy"]);
// KepalaP4mp
Route::get('/manage_user/kepalaP4mp', [KepalaP4mpController::class, "index"]);
Route::post('/manage_user/kepalaP4mp', [KepalaP4mpController::class, "store"]);
// Route::get('/manage_user/kepalaP4mp_edit/{id}', [KepalaP4mpController::class, "edit"]);
// Route::post('/manage_user/kepalaP4mp/{id}', [KepalaP4mpController::class, "update"]);
// Route::delete('/manage_user/kepalaP4mp/{id}', [KepalaP4mpController::class, "destroy"]);
// AkunJurusan
Route::get('/manage_user/akun_jurusan', [AkunJurusanController::class, "index"]);
Route::post('/manage_user/akun_jurusan', [AkunJurusanController::class, "store"]);
// Route::get('/manage_user/akun_jurusan_edit/{id}', [AkunJurusanController::class, "edit"]);
// Route::post('/manage_user/akun_jurusan/{id}', [AkunJurusanController::class, "update"]);
// Route::delete('/manage_user/akun_jurusan/{id}', [AkunJurusanController::class, "destroy"]);
// AkunAuditor
Route::get('/manage_user/akun_auditor', [AkunAuditorController::class, "index"]);
Route::post('/manage_user/akun_auditor', [AkunAuditorController::class, "store"]);
// Route::get('/manage_user/akun_auditor_edit/{id}', [AkunAuditorController::class, "edit"]);
// Route::post('/manage_user/akun_auditor/{id}', [AkunAuditorController::class, "update"]);
// Route::delete('/manage_user/akun_auditor/{id}', [AkunAuditorController::class, "destroy"]);
// AkunAuditee
Route::get('/manage_user/akun_auditee', [AkunAuditeeController::class, "index"]);
Route::post('/manage_user/akun_auditee', [AkunAuditeeController::class, "store"]);
// Route::get('/manage_user/akun_auditee_edit/{id}', [AkunAuditeeController::class, "edit"]);
// Route::post('/manage_user/akun_auditee/{id}', [AkunAuditeeController::class, "update"]);
// Route::delete('/manage_user/akun_auditee/{id}', [AkunAuditeeController::class, "destroy"]);


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
// PertanyaanStandar
Route::get('/ami/data_standar', [PertanyaanStandarController::class, "index"]);
Route::get('/ami/data_standar/pertanyaan/{id}', [PertanyaanStandarController::class, "tampilanPertanyaan"]);
Route::get('/ami/data_standar/tambah_pertanyaan/{id}', [PertanyaanStandarController::class, "tambahPertanyaan"]);
Route::post('/ami/data_standar/pertanyaan/{id}', [PertanyaanStandarController::class, "store"]);
Route::get('/ami/data_standar/update_pertanyaan/{id}', [PertanyaanStandarController::class, "edit"]);
Route::post('/ami/data_standar/update_pertanyaan/{id}', [PertanyaanStandarController::class, "update"]);

/* ============================================================= */

//FOLDER OPERATOR
// (Ami)
Route::get('/pedomanami', [Controller::class, "pedomanAmi"]);
Route::get('/historiami', [Controller::class, "historiAmi"]);
// (Dokumentasi Ami)
Route::get('/dokumentasiAmi', [Controller::class, "dokAmi"]);
Route::get('/dokumentasiRtm', [Controller::class, "dokRtm"]);


//FOLDER MENU->AKUN
Route::get('/profile', [Controller::class, "profile"]);
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

