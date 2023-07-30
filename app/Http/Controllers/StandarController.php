<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\KopSurat;
use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::latest()->paginate(10),
            'kop_surat' => KopSurat::all()
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
            "nama_formulir" => "required"
        ]);

        $request->merge([
            "id_jadwal" => $jadwal_ami->id,
            "id_kop_surat" => $request->nama_formulir
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
            "update_standar" => $standar,
            "kop_surat" => KopSurat::all()
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
            "nama_standar" => "required",
            "nama_formulir" => "required"
        ]);

        $request->merge([
            "id_kop_surat" => $request->nama_formulir
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
        $standar->tugasStandar()->delete();
        $standar->delete();
        return redirect('/ami/standar')->with('message', 'Data Berhasil Terhapus!');
    }

    public function ketersediaanDokumen($id)
    {
        $standar = Standar::findOrFail($id);
        $template = new \PhpOffice\PhpWord\TemplateProcessor('./ketersediaan_dokumen/ketersediaan_dokumen.docx');
        $template->setValues([
            "nama_formulir" => $standar->kopSurat->nama_formulir,
            "no_dokumen" => $standar->kopSurat->no_dokumen,
            "no_revisi" => $standar->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->kopSurat->tanggal_berlaku,
            "halaman" => $standar->kopSurat->halaman,
            "no_audit" => $standar->pertanyaanStandar->ketersediaanDokumen->no_audit,
            "tanggal_input_dokKetersediaan" => $standar->pertanyaanStandar->ketersediaanDokumen->tanggal_input_dokKetersediaan,
            "akun_auditor" => $standar->tugasStandar->user->akunAuditor->nama,
            "nip" => $standar->tugasStandar->user->nip,
            "nama_standar" => $standar->nama_standar,
            "list_pertanyaan_standar" => $standar->pertanyaanStandar->list_pertanyaan_standar,
            "nama_dokumen" => $standar->pertanyaanStandar->ketersediaanDokumen->nama_dokumen,
            "ketersediaan_ya" => $standar->pertanyaanStandar->ketersediaanDokumen->ketersediaan_dokumen,
            "ketersediaan_tidak" => $standar->pertanyaanStandar->ketersediaanDokumen->ketersediaan_dokumen,
            "pic" => $standar->pertanyaanStandar->ketersediaanDokumen->pic
        ]);
        $template->saveAs('arsip/dok_ketersediaan/ketersediaan.docx');
        return "OK";
        // dd($standar->pertanyaanStandar->ketersediaanDokumen);
        // dd([
        // ]);
    }

    public function checklistAudit($id)
    {
        $standar = Standar::findOrFail($id);
        $template = new \PhpOffice\PhpWord\TemplateProcessor('./checklist_ami/dokumen_checklist.docx');
        $template->setValues([
            "nama_formulir" => $standar->kopSurat->nama_formulir,
            "nama_standar" => $standar->nama_standar,
            "no_dokumen" => $standar->kopSurat->no_dokumen,
            "no_revisi" => $standar->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->kopSurat->tanggal_berlaku,
            "halaman" => $standar->kopSurat->halaman,
            "unit_kerja" => $standar->pertanyaanStandar->cheklistAudit->unit_kerja,
            "tanggal_input_dokChecklist" => $standar->pertanyaanStandar->cheklistAudit->tanggal_input_dokChecklist,
            "akun_auditor" => $standar->tugasStandar->user->akunAuditor->nama,
            "nip" => $standar->tugasStandar->user->nip,
            "list_pertanyaan_standar" => $standar->pertanyaanStandar->list_pertanyaan_standar,
            "hasil_observasi" => $standar->pertanyaanStandar->cheklistAudit->hasil_observasi,
            "kesesuaian_ya" => $standar->pertanyaanStandar->cheklistAudit->kesesuaian,
            "kesesuaian_tidak" => $standar->pertanyaanStandar->cheklistAudit->kesesuaian,
            "catatan_khusus," => $standar->pertanyaanStandar->cheklistAudit->catatan_khusus,
            "tanggapan_auditee" => $standar->pertanyaanStandar->cheklistAudit->tanggapan_auditee
        ]);
        $template->saveAs('arsip/dok_checklist/checklist.docx');
        return "OK";
        // dd($standar->pertanyaanStandar->ketersediaanDokumen);
        // dd([
        // ]);
    }

    public function dokDraftTemuan($id)
    {
        $standar = Standar::findOrFail($id);
        $template = new \PhpOffice\PhpWord\TemplateProcessor('./draft_temuan_ami/draft_temuan_ami.docx');
        $template->setValues([
            "nama_formulir" => $standar->kopSurat->nama_formulir,
            "no_dokumen" => $standar->kopSurat->no_dokumen,
            "no_revisi" => $standar->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->kopSurat->tanggal_berlaku,
            "halaman" => $standar->kopSurat->halaman,
            "nama_standar" => $standar->nama_standar,
            "lead_auditor" => $standar->tugasStandar->user->akunAuditor->nama,
            "anggota_audior" => $standar->tugasStandar->user->akunAuditor->nama,
            "akun_auditee" => $standar->tugasStandar->user->akunAuditee->nama,
            // "unit_kerja" => ?,
            "checklist_uraia_c" => $standar->uraianTemuanAmi->checklist_uraian,
            "checklist_uraia_o" => $standar->uraianTemuanAmi->checklist_uraian,
            "tanggal_pelaksanaan" => $standar->uraianTemuanAmi->tanggal_pelaksanaan,
            "tanggal_penyelesaian" => $standar->analisaTindakanAmi->tanggal_penyelesaian,
            "analisa_masalah" => $standar->analisaTindakanAmi->analisa_masalah,
            "tindakan_koreksi" => $standar->analisaTindakanAmi->tindakan_koreksi,
            "verifikasi_kp4mp" => $standar->verifikasiKp4mp->verifikasi_kp4mp,
            "tanggal_verifikasi" => $standar->verifikasiKp4mp->tanggal_verifikasi
        ]);
        $template->saveAs('arsip/dok_temuan/temuan.docx');
        return "OK";
        // dd($standar->pertanyaanStandar->ketersediaanDokumen);
        // dd([
        // ]);
    }
}
