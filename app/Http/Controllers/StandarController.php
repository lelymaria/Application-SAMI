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
            'standar' => Standar::all(),
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
        // $template = new \PhpOffice\PhpWord\TemplateProcessor('./ketersediaan_dokumen/ketersediaan_dokumen.docx');
        // $template->setValues([
        //     "nama_formulir" => $standar->kopSurat->nama_formulir,
        //     "no_dokumen" => $standar->kopSurat->no_dokumen,
        //     "no_revisi" => $standar->kopSurat->no_revisi,
        //     "tanggal_berlaku" => $standar->kopSurat->tanggal_berlaku,
        //     "halaman" => $standar->kopSurat->halaman,
        //     "akun_auditor" => $standar->kopSurat->nama_formulir,
        //     "nip" => $standar->kopSurat->nama_formulir,
        //     "nama_standar" => $standar->kopSurat->nama_formulir,
        //     "list_pertanyaan_standar" => $standar->kopSurat->nama_formulir,
        //     "nama_dokumen" => $standar->kopSurat->nama_formulir,
        //     "ketersediaan_ya" => $standar->kopSurat->nama_formulir,
        //     "ketersediaan_tidak" => $standar->kopSurat->nama_formulir,
        //     "pic" => $standar->kopSurat->nama_formulir
        // ]);
        // $template->saveAs('arsip/coba.docx');
        // return "OK";
        dd($standar->pertanyaanStandar->ketersediaanDokumen);
        dd([
            "nama_formulir" => $standar->kopSurat->nama_formulir,
            "no_dokumen" => $standar->kopSurat->no_dokumen,
            "no_revisi" => $standar->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->kopSurat->tanggal_berlaku,
            "halaman" => $standar->kopSurat->halaman,
            "akun_auditor" => $standar->tugasStandar->user->akunAuditee->nama,
            "nip" => $standar->tugasStandar->user->nip,
            "nama_standar" => $standar->nama_standar,
            "list_pertanyaan_standar" => $standar->pertanyaanStandar->list_pertanyaan_standar,
            "nama_dokumen" => $standar->pertanyaanStandar->ketersediaanDokumen->nama_dokumen,
            "ketersediaan_ya" => $standar->pertanyaanStandar->ketersediaanDokumen->ketersediaan_dokumen,
            "ketersediaan_tidak" => $standar->pertanyaanStandar->ketersediaanDokumen->ketersediaan_dokumen,
            "pic" => $standar->pertanyaanStandar->ketersediaanDokumen->pic
        ]);
    }

    public function checklistAudit()
    {
    }

    public function draftTemuanAmi()
    {
    }
}
