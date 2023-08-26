<?php

namespace App\Http\Controllers;

use App\Models\FotoKegiatanRtm;
use App\Models\JadwalAmi;
use App\Models\UndanganRtm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FotoKegiatanRtmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $foto_kegiatan_rtm = FotoKegiatanRtm::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->where('id_undangan', $id)->get();
        $data = [
            'undanganRtm' => UndanganRtm::findOrFail($id),
            'foto_kegiatan_rtm' => $foto_kegiatan_rtm
        ];
        return view('ami.dokumentasi_rtm.foto_kegiatan.foto_kegiatan_rtm', $data);
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
            "caption_foto_kegiatan_rtm" => 'required',
            "foto_kegiatan_rtm.*" => 'required|image|max:3072',
        ]);

        $undanganRtm = UndanganRtm::findOrFail($id);
        $foto_kegiatan = [];

        DB::transaction(function () use ($request, $undanganRtm, &$foto_kegiatan) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }
            foreach ($request->file('foto_kegiatan_rtm') as $value) {
                $filename = str_replace("\\", "/", $value->store('foto_kegiatan_rtm'));
                $foto_kegiatan[] = $filename;
            }
            FotoKegiatanRtm::create([
                "caption_foto_kegiatan_rtm" => $request->caption_foto_kegiatan_rtm,
                "file_foto_kegiatan_rtm" => json_encode($foto_kegiatan),
                "id_undangan" => $undanganRtm->id,
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
        $fotoKegiatanRtm = FotoKegiatanRtm::find($id);
        $data = [
            "update_foto_kegiatan_rtm" => $fotoKegiatanRtm
        ];

        return view('ami.dokumentasi_rtm.foto_kegiatan.update_foto_rtm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "caption_foto_kegiatan_rtm" => 'required',
            "foto_kegiatan_rtm" => 'required|image|max:3072',
        ]);

        $fotoKegiatanRtm = FotoKegiatanRtm::findOrFail($id);
        $foto_kegiatan = [];

        DB::transaction(function () use ($request, $fotoKegiatanRtm, &$foto_kegiatan) {
            foreach ($request->file('foto_kegiatan_rtm') as $value) {
                $filename = str_replace("\\", "/", $value->store('foto_kegiatan_rtm'));
                $foto_kegiatan[] = $filename;
            }
            $fotoKegiatanRtm->update([
                'caption_foto_kegiatan_rtm' => $request->caption_foto_kegiatan_rtm,
                'file_foto_kegiatan_rtm' => json_encode($foto_kegiatan),
            ]);
        });

        return back()->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fotoKegiatanRtm = FotoKegiatanRtm::findOrFail($id);
        DB::transaction(function () use ($fotoKegiatanRtm) {
            $foto_kegiatan = json_decode($fotoKegiatanRtm->file_foto_kegiatan_rtm);
            foreach ($foto_kegiatan as $file) {
                Storage::delete($file);
            }
            $fotoKegiatanRtm->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }

    public function downloadFoto($id)
    {
        $zipArchive = new ZipArchive();

        $fotoKegiatanRtm = FotoKegiatanRtm::findOrFail($id);
        $fotoKegiatanRtm = json_decode($fotoKegiatanRtm->file_foto_kegiatan_rtm);

        if ($zipArchive->open(public_path("Foto Kegiatan RTM.zip"), ZipArchive::CREATE) === TRUE) {
            foreach ($fotoKegiatanRtm as $fotoKegiatan) {
                $path = public_path('storage/' . $fotoKegiatan);
                $relativeName = basename($path);
                $zipArchive->addFile($path, $relativeName);
            }

            $zipArchive->close();
        }

        return Response::download(public_path('Foto Kegiatan RTM.zip'));
    }
}
