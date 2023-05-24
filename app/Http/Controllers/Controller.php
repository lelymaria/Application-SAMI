<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //FOLDER OPERATOR
    public function akunKepalap4mp()
    {
        return view('operator.manage_akun.akun_kepalap4mp');
    }
    public function akunAuditor()
    {
        return view('operator.manage_akun.akun_auditor');
    }
    public function akunAuditee()
    {
        return view('operator.manage_akun.akun_auditee');
    }
    public function akunJurusan()
    {
        return view('operator.manage_akun.akun_jurusan');
    }
    public function pertanyaanStandar()
    {
        return view('operator.ami.pertanyaan_standar');
    }
    public function historiAmi()
    {
        return view('operator.ami.histori_ami');
    }
    public function dokAmi()
    {
        return view('operator.dokumentasi.dokumentasi_ami');
    }
    public function dokRtm()
    {
        return view('operator.dokumentasi.dokumentasi_rtm');
    }

    // UPDATE FOLDER OPERATOR
    public function updateAkunKepalap4mp()
    {
        return view('operator.manage_akun.update_kepalap4mp');
    }
    public function updateAkunAuditor()
    {
        return view('operator.manage_akun.update_auditor');
    }
    public function updateAkunAuditee()
    {
        return view('operator.manage_akun.update_auditee');
    }
    public function UpdateAkunJurusan()
    {
        return view('operator.manage_akun.update_jurusan');
    }

    //FOLDER MENU->AKUN
    public function profile()
    {
        return view('menu.akun.profile');
    }
    public function editPassword()
    {
        return view('menu.akun.edit_password');
    }
    //FOLDER MENU->DOKUMENTASI
    public function dokAmiAll()
    {
        return view('menu.dokumentasi.dokumentasi_ami');
    }
    public function dokRtmAll()
    {
        return view('menu.dokumentasi.dokumentasi_rtm');
    }

    //FOLDER VIEWS
    public function pedomanAll()
    {
        return view('pedoman_ami');
    }
    public function historiAll()
    {
        return view('histori_ami');
    }

    // FOLDER P4MP->AMI
    public function monitoringP4mp()
    {
        return view('p4mp.ami.monitoring_ami');
    }
    public function laporanP4mp()
    {
        return view('p4mp.ami.laporan_hasil_ami');
    }
    public function verifikasiP4mp()
    {
        return view('p4mp.ami.verifikasi_tindakan_koreksi');
    }

    // FOLDER AUDITOR->AMI
    public function checklistAmi()
    {
        return view('auditor.ami.checklist_ami');
    }
    public function drafttemuanAmi()
    {
        return view('auditor.ami.draft_temuan_ami');
    }
    public function laporanHasilAmi()
    {
        return view('auditor.ami.laporan_hasil_ami');
    }

    // FOLDER AUDITEE->AMI
    public function dataDukung()
    {
        return view('auditee.ami.data_dukung');
    }
    public function drafttemuanAuditee()
    {
        return view('auditee.ami.draft_temuan_ami');
    }
    public function hasilChecklistAmi()
    {
        return view('auditee.ami.hasil_checklist_ami');
    }
    public function ketersediaanDok()
    {
        return view('auditee.ami.ketersediaan_dok');
    }
}
