<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //FOLDER OPERATOR
    public function akunKepalap4mp() {
        return view('operator.manage_akun.akun_kepalap4mp');
    }
    public function akunAuditor() {
        return view('operator.manage_akun.akun_auditor');
    }
    public function akunAuditee() {
        return view('operator.manage_akun.akun_auditee');
    }
    public function akunJurusan() {
        return view('operator.manage_akun.akun_jurusan');
    }
    public function pedomanAmi() {
        return view('operator.ami.pedoman_ami');
    }
    public function standar() {
        return view('operator.ami.standar');
    }
    public function jadwalAmi() {
        return view('operator.ami.jadwal');
    }
    public function pertanyaanStandar() {
        return view('operator.ami.pertanyaan_standar');
    }
    public function historiAmi() {
        return view('operator.ami.histori_ami');
    }
    public function dokAmi() {
        return view('operator.dokumentasi.dokumentasi_ami');
    }
    public function dokRtm() {
        return view('operator.dokumentasi.dokumentasi_rtm');
    }
    public function dataJurusan() {
        return view('operator.data.data_jurusan');
    }
    public function dataProdi() {
        return view('operator.data.data_prodi');
    }

    // UPDATE FOLDER OPERATOR
    public function updateAkunKepalap4mp() {
        return view('operator.manage_akun.update_kepalap4mp');
    }
    public function updateAkunAuditor() {
        return view('operator.manage_akun.update_auditor');
    }
    public function updateAkunAuditee() {
        return view('operator.manage_akun.update_auditee');
    }
    public function UpdateAkunJurusan() {
        return view('operator.manage_akun.update_jurusan');
    }

    //FOLDER AKUN
    public function profile() {
        return view('menu.akun.profile');
    }
    public function editPassword() {
        return view('menu.akun.edit_password');
    }
}

