<?php

namespace App\Http\Controllers;

use App\Models\DaftarHadirRtm;
use App\Models\JadwalAmi;
use App\Models\UndanganRtm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarHadirRtmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $daftar_hadir_rtm = DaftarHadirRtm::where('id_undangan', $id)->latest()->paginate(10);
        $data = [
            'undanganRtm' => UndanganRtm::findOrFail($id),
            'daftar_hadir_rtm' => $daftar_hadir_rtm
        ];
        return view('ami.dokumentasi_rtm.daftar_hadir.daftar_hadir_rtm', $data);
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
            "file_daftar_hadir_rtm" => 'required|mimes:doc,docx,pdf|file|max:3072'
        ]);

        $undanganRtm = UndanganRtm::findOrFail($id);

        DB::transaction(function () use ($request, $undanganRtm) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            $fileDaftarHadirRtm = $request->file('file_daftar_hadir_rtm');
            $extensionOriginal = $fileDaftarHadirRtm->getClientOriginalExtension();
            DaftarHadirRtm::create([
                'file_nama' => 'Daftar Hadir RTM ' . $undanganRtm->file_nama,
                'file_daftar_hadir_rtm' => $fileDaftarHadirRtm->storeAs(
                    'daftar_hadir_rtm',
                    $undanganRtm->file_nama . '.' . $extensionOriginal
                ),
                'id_undangan' => $undanganRtm->id,
                'id_jadwal' => $jadwal_ami->id
            ]);
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarHadirRtm $daftarHadirRtm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daftar_hadir_rtm = DaftarHadirRtm::find($id);
        $data = [
            "update_daftar_hadir_rtm" => $daftar_hadir_rtm
        ];

        return view('ami.dokumentasi_rtm.daftar_hadir.update_daftar_hadir_rtm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $daftar_hadir_rtm = DaftarHadirRtm::findOrFail($id);
        $request->validate([
            "file_daftar_hadir_rtm" => "required|mimes:doc,docx,pdf|file|max:3072",
        ]);

        DB::transaction(function () use ($request, $daftar_hadir_rtm) {
            $fileDaftarHadirRtm = $request->file('file_daftar_hadir_rtm');
            $extensionOriginal = $fileDaftarHadirRtm->getClientOriginalExtension();

            $daftar_hadir_rtm->update([
                'file_nama' => 'Daftar Hadir RTM ' . $daftar_hadir_rtm->undanganRtm->file_nama,
                'file_daftar_hadir_rtm' => $fileDaftarHadirRtm->storeAs(
                    'daftar_hadir_rtm',
                    $daftar_hadir_rtm->undanganRtm->file_nama . '.' . $extensionOriginal
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
        $daftar_hadir_rtm = DaftarHadirRtm::findOrFail($id);
        $daftar_hadir_rtm->delete();
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
