<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\KetersediaanDokumen;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KetersediaanDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::all()
        ];
        return view('ami.ketersediaan_dokumen.data_standar', $data);
    }

    public function show($id)
    {
        $pertanyaan = PertanyaanStandar::where('id_standar', $id)->get();
        $data = [
            'standar' => Standar::findOrFail($id),
            'pertanyaan' => $pertanyaan
        ];
        return view('ami.ketersediaan_dokumen.data_pertanyaan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $ketersediaan = KetersediaanDokumen::where('id_pertanyaan', $id)->get();
        $data = [
            'pertanyaan' => PertanyaanStandar::findOrFail($id),
            'ketersediaan' => $ketersediaan
        ];
        return view('ami.ketersediaan_dokumen.ketersediaan_dok', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $pertanyaan = PertanyaanStandar::findOrFail($id);
        $request->validate([
            "nama_dokumen" => "required",
            "ketersediaan_dokumen" => "required",
            "pic" => "required",
            "catatan" => "required"
        ]);

        DB::transaction(function () use ($request, $pertanyaan) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();


            KetersediaanDokumen::create([
                'nama_dokumen' => $request->nama_dokumen,
                'ketersediaan_dokumen' => $request->ketersediaan_dokumen,
                'pic' => $request->pic,
                'catatan' => $request->catatan,
                "id_jadwal" => $jadwal_ami->id,
                'id_pertanyaan' => $pertanyaan->id
            ]);
        });
        return redirect('/ami/ketersediaan_dokumen/' . $pertanyaan->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ketersediaan = KetersediaanDokumen::findOrFail($id);
        $data = [
            'ketersediaan' => $ketersediaan
        ];
        return view('ami.ketersediaan_dokumen.update_ketersediaan_dokumen', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ketersediaan = KetersediaanDokumen::findOrFail($id);
        $request->validate([
            "nama_dokumen" => "required",
            "ketersediaan_dokumen" => "required",
            "pic" => "required",
            "catatan" => "required"
        ]);

        DB::transaction(function () use ($request, $ketersediaan) {
            $ketersediaan->update([
                'nama_dokumen' => $request->nama_dokumen,
                'ketersediaan_dokumen' => $request->ketersediaan_dokumen,
                'pic' => $request->pic,
                'catatan' => $request->catatan
            ]);
        });

        return redirect('/ami/ketersediaan_dokumen/' . $ketersediaan->pertanyaanStandar->id_standar)->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $ketersediaan = KetersediaanDokumen::findOrFail($id);
        // $ketersediaan->delete();
        // return redirect('/ami/ketersediaan_dokumen/create/' . $id)->with('message', 'Data Berhasil Dihapus!');
    }
}
