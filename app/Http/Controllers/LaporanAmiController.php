<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\LaporanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'laporanAmi' => LaporanAmi::all()
        ];
        return view('ami.laporan_hasil_ami.laporan_hasil_ami', $data);
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
        $request->validate([
            "upload_laporan" => "required|mimes:doc,docx,pdf|file|max:3072",
        ]);

        if ($request->hasFile('upload_laporan')) {
            $fileLaporan = $request->file('upload_laporan');
            $filename = $fileLaporan->getClientOriginalName();
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            if ($request->file_nama) {
                $filename = $request->file_nama;
            }

            $filePath = $fileLaporan->storeAs("upload_laporan", $filename);

            $request->merge([
                "file_laporan_ami" => $filePath,
                "id_jadwal" => $jadwal_ami->id
            ]);

            if ($request->file_nama == "") {
                $request->merge([
                    "file_nama" => $filename
                ]);
            }
        }

        DB::transaction(function () use ($request) {
            LaporanAmi::create($request->all());
        });


        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanAmi $laporanAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporanAmi = LaporanAmi::findOrFail($id);
        $data = [
            "update_laporan_ami" => $laporanAmi,
        ];
        return view('ami.laporan_hasil_ami.update_laporan_ami', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $laporanAmi = LaporanAmi::findOrFail($id);
        $request->validate([
            "upload_laporan" => "required|mimes:doc,docx,pdf|file|max:3072",
        ]);

        if ($request->hasFile('upload_laporan')) {
            $fileLaporan = $request->file('upload_laporan');
            $filename = $fileLaporan->getClientOriginalName();

            if ($request->file_nama) {
                $filename = $request->file_nama;
            }

            $filePath = $fileLaporan->storeAs("upload_laporan", $filename);
            $request->merge([
                "file_laporan_ami" => $filePath,
                "file_nama" => $filename
            ]);
        }

        DB::transaction(function () use ($request, $laporanAmi) {
            $laporanAmi->update($request->all());
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanAmi $laporanAmi)
    {
        //
    }
}
