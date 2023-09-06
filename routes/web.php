<?php

use App\Http\Controllers\AkunAuditeeController;
use App\Http\Controllers\AkunJurusanController;
use App\Http\Controllers\AkunOperatorController;
use App\Http\Controllers\AnalisadanTindakanTemuanAmiController;
use App\Http\Controllers\AnggotaAuditorController;
use App\Http\Controllers\LeadAuditorController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CheckListAuditController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DaftarHadirAmiController;
use App\Http\Controllers\DaftarHadirRtmController;
use App\Http\Controllers\DataDukungAuditeeController;
use App\Http\Controllers\FotoKegiatanAmiController;
use App\Http\Controllers\FotoKegiatanRtmController;
use App\Http\Controllers\HistoriAmiController;
use App\Http\Controllers\JadwalAmiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KepalaP4mpController;
use App\Http\Controllers\KetersediaanDokumenController;
use App\Http\Controllers\KopSuratController;
use App\Http\Controllers\LaporanAmiController;
use App\Http\Controllers\LayananAkademikController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\NotulensiAmiController;
use App\Http\Controllers\NotulensiRtmController;
use App\Http\Controllers\PedomanAmiController;
use App\Http\Controllers\PertanyaanStandarController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\StandarController;
use App\Http\Controllers\TanggapanCheckListAuditController;
use App\Http\Controllers\TugasStandarController;
use App\Http\Controllers\UndanganAmiController;
use App\Http\Controllers\UndanganRtmController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\UraianTemuanAmiController;
use App\Http\Controllers\VerifikasiTemuanAmiController;
use App\Models\DataDukungAuditee;
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

Route::get('/', [AuthenticationController::class, 'index'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LayoutController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password/edit', [UpdatePasswordController::class, 'update'])->name('password.update');

    Route::group(['prefix' => '/profile'], function () {
        Route::get('/edit', [UpdateProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/edit', [UpdateProfileController::class, 'update'])->name('profile.update');
    });

    Route::prefix('/manage_user')->group(function () {
        Route::put('/edit_password/{id}', [UpdatePasswordController::class, "userEditPassword"]);
        Route::post('/edit_foto_profile', [AuthenticationController::class, "updateFotoProfile"]);
        // Akun Operator
        Route::get('/akun_operator', [AkunOperatorController::class, "index"]);
        Route::post('/akun_operator', [AkunOperatorController::class, "store"]);
        Route::get('/akun_operator_edit/{id}', [AkunOperatorController::class, "edit"]);
        Route::post('/akun_operator/{id}', [AkunOperatorController::class, "update"]);
        Route::delete('/akun_operator/{id}', [AkunOperatorController::class, "destroy"]);
        // KepalaP4mp
        Route::get('/kepalaP4mp', [KepalaP4mpController::class, "index"]);
        Route::post('/kepalaP4mp', [KepalaP4mpController::class, "store"]);
        Route::get('/kepalaP4mp_edit/{id}', [KepalaP4mpController::class, "edit"]);
        Route::post('/kepalaP4mp/{id}', [KepalaP4mpController::class, "update"]);
        Route::delete('/kepalaP4mp/{id}', [KepalaP4mpController::class, "destroy"]);
        // AkunJurusan
        Route::get('/akun_jurusan', [AkunJurusanController::class, "index"]);
        Route::post('/akun_jurusan', [AkunJurusanController::class, "store"]);
        Route::get('/akun_jurusan_edit/{id}', [AkunJurusanController::class, "edit"]);
        Route::post('/akun_jurusan/{id}', [AkunJurusanController::class, "update"]);
        Route::delete('/akun_jurusan/{id}', [AkunJurusanController::class, "destroy"]);
        // AkunLeadAuditor
        Route::get('/lead_auditor', [LeadAuditorController::class, "index"]);
        Route::post('/lead_auditor', [LeadAuditorController::class, "store"]);
        Route::get('/lead_auditor_edit/{id}', [LeadAuditorController::class, "edit"]);
        Route::post('/lead_auditor/{id}', [LeadAuditorController::class, "update"]);
        Route::delete('/lead_auditor/{id}', [LeadAuditorController::class, "destroy"]);
        // AkunAnggotaAuditor
        Route::get('/anggota_auditor', [AnggotaAuditorController::class, "index"]);
        Route::post('/anggota_auditor', [AnggotaAuditorController::class, "store"]);
        Route::get('/anggota_auditor_edit/{id}', [AnggotaAuditorController::class, "edit"]);
        Route::post('/anggota_auditor/{id}', [AnggotaAuditorController::class, "update"]);
        Route::delete('/anggota_auditor/{id}', [AnggotaAuditorController::class, "destroy"]);
        // AkunAuditee
        Route::get('/akun_auditee', [AkunAuditeeController::class, "index"]);
        Route::post('/akun_auditee', [AkunAuditeeController::class, "store"]);
        Route::get('/akun_auditee_edit/{id}', [AkunAuditeeController::class, "edit"]);
        Route::post('/akun_auditee/{id}', [AkunAuditeeController::class, "update"]);
        Route::delete('/akun_auditee/{id}', [AkunAuditeeController::class, "destroy"]);
        // TugasStandar
        Route::post('/', [TugasStandarController::class, "store"]);
        Route::get('/{id}', [TugasStandarController::class, "edit"]);
        Route::post('/{id}', [TugasStandarController::class, "update"]);
        Route::delete('/{id}', [TugasStandarController::class, "destroy"]);
    });

    Route::prefix('/data')->group(function () {
        // JurusanController
        Route::get('/datajurusan', [JurusanController::class, "index"]);
        Route::post('/datajurusan', [JurusanController::class, "store"]);
        Route::get('/datajurusan/{id}', [JurusanController::class, "edit"]);
        Route::post('/datajurusan/{id}', [JurusanController::class, "update"]);
        Route::delete('/datajurusan/{id}', [JurusanController::class, "destroy"]);
        // ProdiController
        Route::get('/dataprodi', [ProgramStudiController::class, "index"]);
        Route::post('/dataprodi', [ProgramStudiController::class, "store"]);
        Route::get('/dataprodi/{id}', [ProgramStudiController::class, "edit"]);
        Route::post('/dataprodi/{id}', [ProgramStudiController::class, "update"]);
        Route::delete('/dataprodi/{id}', [ProgramStudiController::class, "destroy"]);
        // LayananAkademikController
        Route::get('/layanan_akademik', [LayananAkademikController::class, "index"]);
        Route::post('/layanan_akademik', [LayananAkademikController::class, "store"]);
        Route::get('/layanan_akademik/{id}', [LayananAkademikController::class, "edit"]);
        Route::post('/layanan_akademik/{id}', [LayananAkademikController::class, "update"]);
        Route::delete('/layanan_akademik/{id}', [LayananAkademikController::class, "destroy"]);
    });

    Route::prefix('/ami')->group(function () {
        // StandarController
        Route::get('/standar', [StandarController::class, "index"]);
        Route::post('/standar', [StandarController::class, "store"]);
        Route::get('/standar/{id}', [StandarController::class, "edit"]);
        Route::post('/standar/{id}', [StandarController::class, "update"]);
        Route::delete('/standar/{id}', [StandarController::class, "destroy"]);
        // PedomanAmi
        Route::get('/pedomanAmi', [PedomanAmiController::class, "index"]);
        Route::post('/pedomanAmi', [PedomanAmiController::class, "store"]);
        Route::get('/pedomanAmi/{id}', [PedomanAmiController::class, "edit"]);
        Route::post('/pedomanAmi/{id}', [PedomanAmiController::class, "update"]);
        // JadwalAmi
        Route::get('/jadwalAmi', [JadwalAmiController::class, "index"]);
        Route::post('/jadwalAmi', [JadwalAmiController::class, "store"]);
        Route::get('/jadwalAmi/{id}', [JadwalAmiController::class, "edit"]);
        Route::post('/jadwalAmi/{id}', [JadwalAmiController::class, "update"]);
        Route::delete('/jadwalAmi/{id}', [JadwalAmiController::class, "destroy"]);
        // PertanyaanStandar
        Route::get('/data_standar', [PertanyaanStandarController::class, "index"]);
        Route::get('/data_standar/pertanyaan/{id}', [PertanyaanStandarController::class, "tampilanPertanyaan"]);
        Route::get('/data_standar/tambah_pertanyaan/{id}', [PertanyaanStandarController::class, "tambahPertanyaan"]);
        Route::post('/data_standar/pertanyaan/{id}', [PertanyaanStandarController::class, "store"]);
        Route::get('/data_standar/update_pertanyaan/{id}', [PertanyaanStandarController::class, "edit"]);
        Route::post('/data_standar/update_pertanyaan/{id}', [PertanyaanStandarController::class, "update"]);
        Route::delete('/data_standar/pertanyaan/{id}', [PertanyaanStandarController::class, "destroy"]);
        // KopSurat
        Route::get('/kop_surat', [KopSuratController::class, "index"]);
        Route::post('/kop_surat', [KopSuratController::class, "store"]);
        Route::get('/kop_surat/{id}', [KopSuratController::class, "edit"]);
        Route::post('/kop_surat/{id}', [KopSuratController::class, "update"]);
        Route::delete('/kop_surat/{id}', [KopSuratController::class, "destroy"]);
    });

    Route::prefix('/dokumentasiAmi')->group(function () {
        // UndanganAmi
        Route::get('/undangan', [UndanganAmiController::class, "index"]);
        Route::post('/undangan', [UndanganAmiController::class, "store"]);
        Route::get('/undangan/{id}', [UndanganAmiController::class, "edit"]);
        Route::post('/undangan/{id}', [UndanganAmiController::class, "update"]);
        Route::delete('/undangan/{id}', [UndanganAmiController::class, "destroy"]);
        // DaftarHadirAmi
        Route::get('/{id}/daftar_hadir_ami', [DaftarHadirAmiController::class, "index"]);
        Route::post('/{id}/daftar_hadir_ami', [DaftarHadirAmiController::class, "store"]);
        Route::get('/daftar_hadir_ami/{id}', [DaftarHadirAmiController::class, "edit"]);
        Route::post('/daftar_hadir_ami/{id}', [DaftarHadirAmiController::class, "update"]);
        Route::delete('/daftar_hadir_ami/{id}', [DaftarHadirAmiController::class, "destroy"]);
        // FotoKegiatanAmi
        Route::get('/{id}/foto_kegiatan_ami', [FotoKegiatanAmiController::class, "index"]);
        Route::post('/{id}/foto_kegiatan_ami', [FotoKegiatanAmiController::class, "store"]);
        Route::get('/foto_kegiatan_ami/{id}', [FotoKegiatanAmiController::class, "edit"]);
        Route::post('/foto_kegiatan_ami/{id}', [FotoKegiatanAmiController::class, "update"]);
        Route::get('/download_foto_kegiatan_ami/{id}', [FotoKegiatanAmiController::class, "downloadFoto"]);
        Route::delete('/foto_kegiatan_ami/{id}', [FotoKegiatanAmiController::class, "destroy"]);
        // NotulensiAmi
        Route::get('/{id}/notulensi_ami', [NotulensiAmiController::class, "index"]);
        Route::post('/{id}/notulensi_ami', [NotulensiAmiController::class, "store"]);
        Route::get('/notulensi_ami/{id}', [NotulensiAmiController::class, "edit"]);
        Route::post('/notulensi_ami/{id}', [NotulensiAmiController::class, "update"]);
        Route::delete('/notulensi_ami/{id}', [NotulensiAmiController::class, "destroy"]);
    });

    Route::prefix('/dokumentasiRtm')->group(function () {
        // UndanganRtm
        Route::get('/undangan', [UndanganRtmController::class, "index"]);
        Route::post('/undangan', [UndanganRtmController::class, "store"]);
        Route::get('/undangan/{id}', [UndanganRtmController::class, "edit"]);
        Route::post('/undangan/{id}', [UndanganRtmController::class, "update"]);
        Route::delete('/undangan/{id}', [UndanganRtmController::class, "destroy"]);
        // DaftarHadirRtm
        Route::get('/{id}/daftar_hadir_rtm', [DaftarHadirRtmController::class, "index"]);
        Route::post('/{id}/daftar_hadir_rtm', [DaftarHadirRtmController::class, "store"]);
        Route::get('/daftar_hadir_rtm/{id}', [DaftarHadirRtmController::class, "edit"]);
        Route::post('/daftar_hadir_rtm/{id}', [DaftarHadirRtmController::class, "update"]);
        Route::delete('/daftar_hadir_rtm/{id}', [DaftarHadirRtmController::class, "destroy"]);
        // FotoKegiatanRtm
        Route::get('/{id}/foto_kegiatan_rtm', [FotoKegiatanRtmController::class, "index"]);
        Route::post('/{id}/foto_kegiatan_rtm', [FotoKegiatanRtmController::class, "store"]);
        Route::get('/foto_kegiatan_rtm/{id}', [FotoKegiatanRtmController::class, "edit"]);
        Route::post('/foto_kegiatan_rtm/{id}', [FotoKegiatanRtmController::class, "update"]);
        Route::get('/download_foto_kegiatan_rtm/{id}', [FotoKegiatanRtmController::class, "downloadFoto"]);
        Route::delete('/foto_kegiatan_rtm/{id}', [FotoKegiatanRtmController::class, "destroy"]);
        // NotulensiRtm
        Route::get('/{id}/notulensi_rtm', [NotulensiRtmController::class, "index"]);
        Route::post('/{id}/notulensi_rtm', [NotulensiRtmController::class, "store"]);
        Route::get('/notulensi_rtm/{id}', [NotulensiRtmController::class, "edit"]);
        Route::post('/notulensi_rtm/{id}', [NotulensiRtmController::class, "update"]);
        Route::delete('/notulensi_rtm/{id}', [NotulensiRtmController::class, "destroy"]);
    });

    Route::get('/ami/auditee/data_dukung', [DataDukungAuditeeController::class, "index"]);
    Route::get('/ami/auditee/data_dukung/create/{id}', [DataDukungAuditeeController::class, "create"]);
    Route::post('/ami/auditee/data_dukung/create/{id}', [DataDukungAuditeeController::class, "store"]);
    Route::get('/ami/auditee/data_dukung/{id}', [DataDukungAuditeeController::class, "edit"]);
    Route::post('/ami/auditee/data_dukung/{id}', [DataDukungAuditeeController::class, "update"]);
    Route::delete('/ami/auditee/data_dukung/{id}', [DataDukungAuditeeController::class, "destroy"]);
    Route::get('/ami/download_zip_data_dukung/{id}', [DataDukungAuditeeController::class, "downloadZip"]);

    Route::get('/ami/ketersediaan_dokumen', [KetersediaanDokumenController::class, "index"]);
    Route::get('/ami/ketersediaan_dokumen/{id}', [KetersediaanDokumenController::class, "show"]);
    Route::get('/ami/ketersediaan_dokumen/create/{id}', [KetersediaanDokumenController::class, "create"]);
    Route::post('/ami/ketersediaan_dokumen/create/{id}', [KetersediaanDokumenController::class, "store"]);
    Route::get('/ami/ketersediaan_dokumen/update/{id}', [KetersediaanDokumenController::class, "edit"]);
    Route::post('/ami/ketersediaan_dokumen/update/{id}', [KetersediaanDokumenController::class, "update"]);

    Route::get('/ami/checklist_audit', [CheckListAuditController::class, "index"]);
    Route::get('/ami/checklist_audit/{id}', [CheckListAuditController::class, "show"]);
    Route::get('/ami/checklist_audit/create/{id}', [CheckListAuditController::class, "create"]);
    Route::post('/ami/checklist_audit/create/{id}', [CheckListAuditController::class, "store"]);
    Route::get('/ami/checklist_audit/update/{id}', [CheckListAuditController::class, "edit"]);
    Route::post('/ami/checklist_audit/update/{id}', [CheckListAuditController::class, "update"]);

    Route::get('/ami/tanggapan_audit', [TanggapanCheckListAuditController::class, "index"]);
    Route::get('/ami/tanggapan_audit/{id}', [TanggapanCheckListAuditController::class, "show"]);
    Route::get('/ami/tanggapan_audit/create/{id}', [TanggapanCheckListAuditController::class, "create"]);
    Route::post('/ami/tanggapan_audit/create/{id}', [TanggapanCheckListAuditController::class, "store"]);
    Route::get('/ami/tanggapan_audit/update/{id}', [TanggapanCheckListAuditController::class, "edit"]);
    Route::post('/ami/tanggapan_audit/update/{id}', [TanggapanCheckListAuditController::class, "update"]);

    Route::get('/ami/uraian_ami', [UraianTemuanAmiController::class, "index"]);
    Route::get('/ami/uraian_ami/create/{id}', [UraianTemuanAmiController::class, "create"]);
    Route::post('/ami/uraian_ami/create/{id}', [UraianTemuanAmiController::class, "store"]);
    Route::get('/ami/uraian_ami/update/{id}', [UraianTemuanAmiController::class, "edit"]);
    Route::post('/ami/uraian_ami/update/{id}', [UraianTemuanAmiController::class, "update"]);

    Route::get('/ami/analisa_tindakan_ami', [AnalisadanTindakanTemuanAmiController::class, "index"]);
    Route::get('/ami/analisa_tindakan_ami/{id}', [AnalisadanTindakanTemuanAmiController::class, "show"]);
    Route::get('/ami/analisa_tindakan_ami/create/{id}', [AnalisadanTindakanTemuanAmiController::class, "create"]);
    Route::post('/ami/analisa_tindakan_ami/create/{id}', [AnalisadanTindakanTemuanAmiController::class, "store"]);
    Route::get('/ami/analisa_tindakan_ami/update/{id}', [AnalisadanTindakanTemuanAmiController::class, "edit"]);
    Route::post('/ami/analisa_tindakan_ami/update/{id}', [AnalisadanTindakanTemuanAmiController::class, "update"]);

    Route::get('/ami/verifikasi_ami', [VerifikasiTemuanAmiController::class, "index"]);
    Route::get('/ami/verifikasi_ami/{id}', [VerifikasiTemuanAmiController::class, "show"]);
    Route::get('/ami/verifikasi_ami/create/{id}', [VerifikasiTemuanAmiController::class, "create"]);
    Route::post('/ami/verifikasi_ami/create/{id}', [VerifikasiTemuanAmiController::class, "store"]);
    Route::get('/ami/verifikasi_ami/update/{id}', [VerifikasiTemuanAmiController::class, "edit"]);
    Route::post('/ami/verifikasi_ami/update/{id}', [VerifikasiTemuanAmiController::class, "update"]);

    Route::get('/ami/laporan_ami', [LaporanAmiController::class, "index"]);
    Route::post('/ami/laporan_ami', [LaporanAmiController::class, "store"]);
    Route::get('/ami/laporan_ami/{id}', [LaporanAmiController::class, "edit"]);
    Route::post('/ami/laporan_ami/{id}', [LaporanAmiController::class, "update"]);

    Route::get('/ami/ketersediaan_dokumen_preview/{id}', [StandarController::class, "ketersediaanDokumen"]);
    Route::get('/ami/checklist_audit_preview/{id}', [StandarController::class, "checklistAudit"]);
    Route::get('/ami/draft_temuan_ami_preview/{id}', [StandarController::class, "dokDraftTemuan"]);
    Route::post('/ami/jadwal_non_aktif', [JadwalAmiController::class, "jadwalNonAktif"]);

    Route::get('/ami/jadwal_pelaksanaan', [HistoriAmiController::class, "index"]);
    Route::post('/ami/jadwal_pelaksanaan', [HistoriAmiController::class, "store"]);
    Route::get('/ami/jadwal_pelaksanaan/{id}', [HistoriAmiController::class, "edit"]);
    Route::post('/ami/jadwal_pelaksanaan/{id}', [HistoriAmiController::class, "update"]);
    Route::delete('/ami/jadwal_pelaksanaan/{id}', [HistoriAmiController::class, "destroy"]);

    Route::get('/ami/historiami', [HistoriAmiController::class, "historiAmi"]);
    Route::get('/ami/historiami/data_auditee/download/data_dukung/{id}', [HistoriAmiController::class, "downloadDataDukungAuditee"]);
    Route::get('/ami/historiami/data_auditee/download/ketersediaan/{id}', [HistoriAmiController::class, "downloadKetersediaan"]);
    Route::get('/ami/historiami/data_auditee/download/checklist/{id}', [HistoriAmiController::class, "downloadChecklist"]);
    Route::get('/ami/historiami/data_auditee/download/draft_temuan/{id}', [HistoriAmiController::class, "downloadDraftTemuan"]);
    Route::get('/ami/historiami/data_auditee/download/laporan/{id}', [HistoriAmiController::class, "downloadLaporanAmi"]);
    Route::get('/ami/historiami/dokumentasi_ami/download/{id}', [HistoriAmiController::class, "downloadDokumentasiAmi"]);
    Route::get('/ami/historiami/dokumentasi_rtm/download/{id}', [HistoriAmiController::class, "downloadDokumentasiRtm"]);
    Route::get('/ami/historiami/data_auditee/{id}', [HistoriAmiController::class, "menuAuditee"]);
    Route::get('/ami/historiami/data_auditee/data_dukung/{id}', [HistoriAmiController::class, "dataDukungAuditee"]);
    Route::get('/ami/historiami/data_auditee/ketersediaan/{id}', [HistoriAmiController::class, "ketersediaan"]);
    Route::get('/ami/historiami/data_auditee/checklist/{id}', [HistoriAmiController::class, "checklist"]);
    Route::get('/ami/historiami/data_auditee/temuan/{id}', [HistoriAmiController::class, "temuan"]);
    Route::get('/ami/historiami/dokumentasi_ami', [HistoriAmiController::class, "dokumentasiAmi"]);
    Route::get('/ami/historiami/dokumentasi_rtm', [HistoriAmiController::class, "dokumentasiRtm"]);
    Route::get('/ami/historiami/{id}', [HistoriAmiController::class, "historiAmiData"]);

    /* ============================================================= */

    //FOLDER OPERATOR
    // (Ami)
    Route::get('/pedomanami', [Controller::class, "pedomanAmi"]);
    Route::get('/historiami', [Controller::class, "historiAmi"]);

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
    Route::get('/drafttemuanAuditee', [Controller::class, "drafttemuanAuditee"]);
    Route::get('/hasilChecklistAmi', [Controller::class, "hasilChecklistAmi"]);
});
