<?php

namespace App\Http\Controllers;

use App\Models\FotoKegiatanAmi;
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
            "foto_kegiatan_ami" => 'required',
        ]);

        $undanganAmi = UndanganAmi::findOrFail($id);

        DB::transaction(function () use ($request, $undanganAmi) {
            foreach ($request->file('foto_kegiatan_ami') as $value) {
                FotoKegiatanAmi::create([
                    "caption_foto_kegiatan_ami" => $request->caption_foto_kegiatan_ami,
                    "file_foto_kegiatan_ami" => $value->store('foto_kegiatan_ami'),
                    "id_undangan" => $undanganAmi->id
                ]);
            }
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FotoKegiatanAmi $fotoKegiatanAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FotoKegiatanAmi $fotoKegiatanAmi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FotoKegiatanAmi $fotoKegiatanAmi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FotoKegiatanAmi $fotoKegiatanAmi)
    {
        //
    }
}
