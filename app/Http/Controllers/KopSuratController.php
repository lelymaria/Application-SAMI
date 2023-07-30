<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\KopSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KopSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'kop_surat' => KopSurat::latest()->paginate(10)
        ];
        return view('ami.kop_surat.kop_surat', $data);
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
            return back()->with('error', 'Jadwal AMI tidak tersedia!');
        }

        $request->validate([
            "nama_formulir" => "required",
            "no_dokumen" => "required",
            "no_revisi" => "required",
            "tanggal_berlaku" => "required",
            "halaman" => "required",
        ]);

        $request->merge([
            "id_jadwal" => $jadwal_ami->id
        ]);
        DB::transaction(function () use ($request) {
            KopSurat::create($request->all());
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KopSurat $kopSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kop_surat = KopSurat::findOrFail($id);
        $data = [
            "update_kop_surat" => $kop_surat
        ];
        return view('ami.kop_surat.update_kop_surat', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kop_surat = KopSurat::findOrFail($id);
        $request->validate([
            "nama_formulir" => "required",
            "no_dokumen" => "required",
            "no_revisi" => "required",
            "tanggal_berlaku" => "required",
            "halaman" => "required"
        ]);

        DB::transaction(function () use ($request, $kop_surat) {
            $kop_surat->update($request->all());
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kop_surat = KopSurat::findOrFail($id);
        DB::transaction(function () use ($kop_surat){
            $kop_surat->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
