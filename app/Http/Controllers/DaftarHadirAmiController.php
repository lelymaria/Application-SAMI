<?php

namespace App\Http\Controllers;

use App\Models\DaftarHadirAmi;
use App\Models\JadwalAmi;
use App\Models\UndanganAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DaftarHadirAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $daftar_hadir_ami = DaftarHadirAmi::where('id_undangan', $id)->get();
        $data = [
            'undanganAmi' => UndanganAmi::findOrFail($id),
            'daftar_hadir_ami' => $daftar_hadir_ami
        ];
        return view('ami.dokumentasi_ami.daftar_hadir.daftar_hadir_ami', $data);
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
            "file_daftar_hadir_ami" => 'required|mimes:doc,docx,pdf'
        ]);

        $undanganAmi = UndanganAmi::findOrFail($id);

        DB::transaction(function () use ($request, $undanganAmi) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            $fileDaftarHadirAmi = $request->file('file_daftar_hadir_ami');
            $extensionOriginal = $fileDaftarHadirAmi->getClientOriginalExtension();
            DaftarHadirAmi::create([
                'file_nama' => 'Daftar Hadir Ami ' . $undanganAmi->file_nama,
                'file_daftar_hadir_ami' => $fileDaftarHadirAmi->storeAs(
                    'daftar_hadir_ami',
                    $undanganAmi->file_nama . '.' . $extensionOriginal
                ),
                'id_undangan' => $undanganAmi->id,
                'id_jadwal' => $jadwal_ami->id
            ]);
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarHadirAmi $daftarHadirAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daftar_hadir_ami = DaftarHadirAmi::find($id);
        $data = [
            "update_daftar_hadir_ami" => $daftar_hadir_ami
        ];

        return view('ami.dokumentasi_ami.daftar_hadir.update_daftar_hadir_ami', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $daftar_hadir_ami = DaftarHadirAmi::findOrFail($id);
        $request->validate([
            "file_daftar_hadir_ami" => "required|mimes:doc,docx,pdf",
        ]);

        DB::transaction(function () use ($request, $daftar_hadir_ami) {
            $fileDaftarHadirAmi = $request->file('file_daftar_hadir_ami');
            $extensionOriginal = $fileDaftarHadirAmi->getClientOriginalExtension();

            $daftar_hadir_ami->update([
                'file_nama' => 'Daftar Hadir Ami ' . $daftar_hadir_ami->undanganAmi->file_nama,
                'file_daftar_hadir_ami' => $fileDaftarHadirAmi->storeAs(
                    'daftar_hadir_ami',
                    $daftar_hadir_ami->undanganAmi->file_nama . '.' . $extensionOriginal
                ),
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daftar_hadir_ami = DaftarHadirAmi::findOrFail($id);
        $daftar_hadir_ami->delete();
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
