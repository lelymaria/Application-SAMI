<?php

namespace App\Http\Controllers;

use App\Models\FotoKegiatanAmi;
use App\Models\JadwalAmi;
use App\Models\UndanganAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FotoKegiatanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $foto_kegiatan_ami = FotoKegiatanAmi::where('id_undangan', $id)->get();
        $data = [
            'undanganAmi' => UndanganAmi::findOrFail($id),
            'foto_kegiatan_ami' => $foto_kegiatan_ami
        ];
        return view('ami.dokumentasi_ami.foto_kegiatan.foto_kegiatan_ami', $data);
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
    public function store(Request $request, $id)
    {
        $request->validate([
            "caption_foto_kegiatan_ami" => 'required',
            "foto_kegiatan_ami.*" => 'required|image',
        ]);

        $undanganAmi = UndanganAmi::findOrFail($id);
        $foto_kegiatan = [];

        DB::transaction(function () use ($request, $undanganAmi, &$foto_kegiatan) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            foreach ($request->file('foto_kegiatan_ami') as $value) {
                $filename = str_replace("\\", "/", $value->store('foto_kegiatan_ami'));
                $foto_kegiatan[] = $filename;
            }
            FotoKegiatanAmi::create([
                "caption_foto_kegiatan_ami" => $request->caption_foto_kegiatan_ami,
                "file_foto_kegiatan_ami" => json_encode($foto_kegiatan),
                "id_undangan" => $undanganAmi->id,
                "id_jadwal" => $jadwal_ami->id
            ]);
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fotoKegiatanAmi = FotoKegiatanAmi::find($id);
        $data = [
            "update_foto_kegiatan_ami" => $fotoKegiatanAmi
        ];

        return view('ami.dokumentasi_ami.foto_kegiatan.update_foto_ami', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "caption_foto_kegiatan_ami" => 'required',
            "foto_kegiatan_ami" => 'required',
        ]);

        $fotoKegiatanAmi = FotoKegiatanAmi::findOrFail($id);
        $foto_kegiatan = [];

        DB::transaction(function () use ($request, $fotoKegiatanAmi, &$foto_kegiatan) {
            foreach ($request->file('foto_kegiatan_ami') as $value) {
                $filename = str_replace("\\", "/", $value->store('foto_kegiatan_ami'));
                $foto_kegiatan[] = $filename;
            }
            $fotoKegiatanAmi->update([
                'caption_foto_kegiatan_ami' => $request->caption_foto_kegiatan_ami,
                'file_foto_kegiatan_ami' => json_encode($foto_kegiatan),
            ]);
        });

        return back()->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fotoKegiatanAmi = FotoKegiatanAmi::findOrFail($id);
        $fotoKegiatanAmi->delete();
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
