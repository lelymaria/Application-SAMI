<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //FOLDER MENU->DOKUMENTASI
    public function dokAmiAll()
    {
        return view('ami.dokumentasi_ami.dokumentasi_ami');
    }
    public function dokRtmAll()
    {
        return view('ami.dokumentasi_rtm.dokumentasi_rtm');
    }

    //FOLDER VIEWS
    public function pedomanAll()
    {
        return view('pedoman_ami');
    }
    public function historiAll()
    {
        return view('ami.histori.histori_ami');
    }

    // FOLDER P4MP->AMI
    public function monitoringP4mp()
    {
        return view('ami.monitoring.monitoring_ami');
    }
    public function laporanP4mp()
    {
        return view('ami.laporan_hasil_ami.laporan_hasil_ami');
    }
    public function verifikasiP4mp()
    {
        return view('ami.draft_temuan.verifikasi_tindakan_koreksi');
    }

    // FOLDER AUDITOR->AMI
    public function checklistAmi()
    {
        return view('ami.dokumen_checklist.checklist_ami_auditor');
    }
    public function drafttemuanAmi()
    {
        return view('ami.draft_temuan.uraian_ketidaksesuaian');
    }
    public function laporanHasilAmi()
    {
        return view('ami.laporan_hasil_ami.laporan_hasil_ami');
    }

    // FOLDER AUDITEE->AMI
    public function dataDukung()
    {
        return view('ami.data_dukung.data_dukung');
    }
    public function drafttemuanAuditee()
    {
        return view('ami.draft_temuan.analisa_dan_tindakan_auditee');
    }
    public function hasilChecklistAmi()
    {
        return view('ami.dokumen_checklist.tanggapan_auditee');
    }
    public function ketersediaanDok()
    {
        return view('ami.ketersediaan_dokumen.ketersediaan_dok');
    }
    public function listPertanyaan()
    {
        return view('ami.pertanyaan_standar.list_pertanyaan_standar');
    }
}
