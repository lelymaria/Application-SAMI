<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\KopSurat;
use App\Models\Standar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::latest()->paginate(10)
        ];
        return view('ami.standar.standar', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/ami/standar')->with('error', 'jadwal ami tidak tersedia!');
        }

        $request->validate([
            "nama_standar" => "required",
        ]);

        $request->merge([
            "id_jadwal" => $jadwal_ami->id
        ]);

        DB::transaction(function () use ($request) {
            return Standar::create($request->all());
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Standar $standar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $data = [
            "update_standar" => $standar
        ];
        return view('ami.standar.update_standar', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $request->validate([
            "nama_standar" => "required"
        ]);

        DB::transaction(function () use ($request, $standar) {
            $standar->update($request->all());
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        DB::transaction(function () use ($standar) {
            $standar->pertanyaanStandar()->delete();
            $standar->tugasStandar()->delete();
            $standar->dataDukungAuditee()->delete();
            $standar->uraianTemuanAmi()->delete();
            $standar->verifikasiKp4mp()->delete();
            $standar->analisaTindakanAmi()->delete();
            $standar->delete();
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Terhapus!');
    }

    public function ketersediaanDokumen($id)
    {
        $standar = Standar::findOrFail($id);
        $template = new \PhpOffice\PhpWord\TemplateProcessor('./ketersediaan_dokumen/ketersediaan_dokumen.docx');
        $template->setValues([
            "nama_formulir" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->nama_formulir,
            "no_dokumen" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->no_dokumen,
            "no_revisi" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->tanggal_berlaku,
            "halaman" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->halaman,
            "no_audit" => $standar->pertanyaanStandar->ketersediaanDokumen->no_audit,
            "tanggal_input_dokKetersediaan" => Carbon::parse($standar->pertanyaanStandar->ketersediaanDokumen->tanggal_input_dokKetersediaan)->toDateString(),
            "akun_auditor" => $standar->tugasStandar->user->akunAuditor->nama,
            "nip" => $standar->tugasStandar->user->nip,
            "nama_standar" => $standar->nama_standar,
            "list_pertanyaan_standar" => strip_tags($standar->pertanyaanStandar->list_pertanyaan_standar),
            "nama_dokumen" => $standar->pertanyaanStandar->ketersediaanDokumen->nama_dokumen,
            "ketersediaan_ya" => $standar->pertanyaanStandar->ketersediaanDokumen->ketersediaan_dokumen != 'ya' ? '' : 'ya',
            "ketersediaan_tidak" => $standar->pertanyaanStandar->ketersediaanDokumen->ketersediaan_dokumen != 'tidak' ? '' : 'tidak',
            "pic" => $standar->pertanyaanStandar->ketersediaanDokumen->pic
        ]);

        $template->saveAs('arsip/dok_ketersediaan/' . date('d-m-Y') . ' Ketersediaan Dokumen Auditee.docx');
        return Response::download(public_path("arsip/dok_ketersediaan/" . date('d-m-Y') . " Ketersediaan Dokumen Auditee.docx"));
    }

    public function checklistAudit($id)
    {
        $standar = Standar::findOrFail($id);
        $template = new \PhpOffice\PhpWord\TemplateProcessor('./checklist_ami/dokumen_checklist.docx');
        $template->setValues([
            "nama_formulir" => $standar->pertanyaanStandar->checklistAudit->kopSurat->nama_formulir,
            "nama_standar" => $standar->pertanyaanStandar->checklistAudit->kopSurat->nama_standar,
            "no_dokumen" => $standar->pertanyaanStandar->checklistAudit->kopSurat->no_dokumen,
            "no_revisi" => $standar->pertanyaanStandar->checklistAudit->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->pertanyaanStandar->checklistAudit->kopSurat->tanggal_berlaku,
            "halaman" => $standar->pertanyaanStandar->checklistAudit->kopSurat->halaman,
            "unit_kerja" => $standar->pertanyaanStandar->cheklistAudit->unit_kerja,
            "tanggal_input_dokChecklist" => Carbon::parse($standar->pertanyaanStandar->cheklistAudit->tanggal_input_dokChecklist)->toDateString(),
            "akun_auditor" => $standar->tugasStandar->user->akunAuditor->nama,
            "nip" => $standar->tugasStandar->user->nip,
            "list_pertanyaan_standar" => strip_tags($standar->pertanyaanStandar->list_pertanyaan_standar),
            "hasil_observasi" => $standar->pertanyaanStandar->cheklistAudit->hasil_observasi,
            "kesesuaian_ya" => $standar->pertanyaanStandar->cheklistAudit->kesesuaian != 'ya' ? '' : 'ya',
            "kesesuaian_tidak" => $standar->pertanyaanStandar->cheklistAudit->kesesuaian != 'tidak' ? '' : 'tidak',
            "catatan_khusus," => $standar->pertanyaanStandar->cheklistAudit->catatan_khusus,
            "tanggapan_auditee" => $standar->pertanyaanStandar->cheklistAudit->tanggapan_auditee
        ]);

        $template->saveAs('arsip/dok_checklist/' . date('d-m-Y') . ' Check List Audit.docx');
        return Response::download(public_path("arsip/dok_checklist/" . date('d-m-Y') . " Check List Audit.docx"));
    }

    public function dokDraftTemuan($id)
    {
        $standar = Standar::findOrFail($id);
        $template = new \PhpOffice\PhpWord\TemplateProcessor('./draft_temuan_ami/draft_temuan_ami.docx');
        $template->setValues([
            "nama_formulir" => $standar->uraianTemuanAmi->kopSurat->nama_formulir,
            "no_dokumen" => $standar->uraianTemuanAmi->kopSurat->no_dokumen,
            "no_revisi" => $standar->uraianTemuanAmi->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->uraianTemuanAmi->kopSurat->tanggal_berlaku,
            "halaman" => $standar->uraianTemuanAmi->kopSurat->halaman,
            "nama_standar" => $standar->nama_standar,
            "lead_auditor" => $standar->tugasStandar->user->akunAuditor->nama, //?
            "anggota_audior" => $standar->tugasStandar->user->akunAuditor->nama, //?
            // "akun_auditee" => $standar->tugasStandar->user->akunAuditee->nama, //?
            // "unit_kerja" => ?,
            "checklist_uraia_c" => $standar->uraianTemuanAmi->checklist_uraian, //?
            "checklist_uraia_o" => $standar->uraianTemuanAmi->checklist_uraian, //?
            "tanggal_pelaksanaan" => Carbon::parse($standar->uraianTemuanAmi->tanggal_pelaksanaan)->toDateString(),
            "tanggal_penyelesaian" => Carbon::parse($standar->analisaTindakanAmi->tanggal_penyelesaian)->toDateString(),
            "analisa_masalah" => $standar->analisaTindakanAmi->analisa_masalah,
            "tindakan_koreksi" => $standar->analisaTindakanAmi->tindakan_koreksi,
            "verifikasi_kp4mp" => $standar->verifikasiKp4mp->verifikasi_kp4mp,
            "tanggal_verifikasi" => Carbon::parse($standar->verifikasiKp4mp->tanggal_verifikasi)->toDateString()
        ]);

        $template->saveAs('arsip/dok_temuan/' . date('d-m-Y') . ' Temuan Audit Mutu Internal.docx');
        return Response::download(public_path("arsip/dok_temuan/" . date('d-m-Y') . " Temuan Audit Mutu Internal.docx"));
    }
}
