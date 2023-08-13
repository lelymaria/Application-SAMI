<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use App\Models\UraianTemuanAmi;
use App\Models\VerifikasiTemuanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiTemuanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::whereHas('tugasStandar', function ($query) {
                $query->where('id_user', auth()->user()->id);
            })->latest()->paginate(10)
        ];
        return view('ami.draft_temuan.data_standar', $data);
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $verifikasiTemuan = VerifikasiTemuanAmi::where('id_standar', $id)->get();
        $data = [
            'standar' => Standar::findOrFail($id),
            'verifikasiTemuan' => $verifikasiTemuan
        ];
        return view('ami.draft_temuan.verifikasi_tindakan.verifikasi_tindakan_koreksi', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $standar = Standar::findOrFail($id);
        $request->validate([
            "tanggal_verifikasi" => "required",
            "verifikasi_kp4mp" => "required"
        ]);

        DB::transaction(function () use ($request, $standar) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            VerifikasiTemuanAmi::create([
                'tanggal_verifikasi' => $request->tanggal_verifikasi,
                'verifikasi_kp4mp' => $request->verifikasi_kp4mp,
                "id_jadwal" => $jadwal_ami->id,
                'id_standar' => $standar->id,
                'id_user' => auth()->user()->id
            ]);
        });
        return redirect('/ami/verifikasi_ami/' . $standar->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $verifikasiTemuan = VerifikasiTemuanAmi::findOrFail($id);
        $data = [
            'verifikasiTemuan' => $verifikasiTemuan
        ];
        return view('ami.draft_temuan.verifikasi_tindakan.update_verifikasi', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $verifikasiTemuan = VerifikasiTemuanAmi::findOrFail($id);
        $request->validate([
            "tanggal_verifikasi" => "required",
            "verifikasi_kp4mp" => "required"
        ]);

        DB::transaction(function () use ($request, $verifikasiTemuan) {
            $verifikasiTemuan->update([
                'tanggal_verifikasi' => $request->tanggal_verifikasi,
                'verifikasi_kp4mp' => $request->verifikasi_kp4mp,
                'catatan_khusus' => $request->catatan_khusus,
                'hasil_observasi' => $request->hasil_observasi,
            ]);
        });

        return redirect('/ami/verifikasi_ami/')->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VerifikasiTemuanAmi $verifikasiTemuan)
    {
        //
    }
}
