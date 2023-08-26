<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use App\Models\JadwalAmi;
use App\Models\LaporanAmi;
use App\Models\Level;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = LaporanAmi::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->where(function ($query) {
            if (auth()->user()->akunAuditee) {
                $query->where("id_unit_kerja", auth()->user()->akunAuditee->id_unit_kerja);
            }

            if (auth()->user()->akunAuditor) {
                $query->where("id_unit_kerja", auth()->user()->akunAuditor->id_unit_kerja);
            }
        })->get();

        $data = [
            'laporanAmi' => $laporan
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
                "id_jadwal" => $jadwal_ami->id,
                "id_user" => auth()->user()->id,
                "id_unit_kerja" => auth()->user()->akunAuditor->id_unit_kerja
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
