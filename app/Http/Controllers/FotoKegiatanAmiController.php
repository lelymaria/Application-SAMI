<?php

namespace App\Http\Controllers;

use App\Models\FotoKegiatanAmi;
use App\Models\JadwalAmi;
use App\Models\UndanganAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FotoKegiatanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $foto_kegiatan_ami = FotoKegiatanAmi::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->where('id_undangan', $id)->get();
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
            "foto_kegiatan_ami.*" => 'required|image|max:3072',
        ]);

        $undanganAmi = UndanganAmi::findOrFail($id);
        $foto_kegiatan = [];

        DB::transaction(function () use ($request, $undanganAmi, &$foto_kegiatan) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }
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
            "foto_kegiatan_ami" => 'required|image|max:3072',
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
        DB::transaction(function () use ($fotoKegiatanAmi){
            $foto_kegiatan = json_decode($fotoKegiatanAmi->file_foto_kegiatan_ami);
            foreach ($foto_kegiatan as $file) {
                Storage::delete($file);
            }
            $fotoKegiatanAmi->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }

    public function downloadFoto($id)
    {
        $zipArchive = new ZipArchive();

        $fotoKegiatanAmi = FotoKegiatanAmi::findOrFail($id);
        $fotoKegiatanAmi = json_decode($fotoKegiatanAmi->file_foto_kegiatan_ami);

        if ($zipArchive->open(public_path("Foto Kegiatan AMI.zip"), ZipArchive::CREATE) === TRUE) {
            foreach ($fotoKegiatanAmi as $fotoKegiatan) {
                $path = public_path('storage/' . $fotoKegiatan);
                $relativeName = basename($path);
                $zipArchive->addFile($path, $relativeName);
            }

            $zipArchive->close();
        }

        return Response::download(public_path('Foto Kegiatan AMI.zip'));
    }
}
