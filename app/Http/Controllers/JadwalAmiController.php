<?php

namespace App\Http\Controllers;

use App\Models\HistoriAmi;
use App\Models\JadwalAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'jadwal_ami' => JadwalAmi::whereHas('historiAmi', function ($query) {
                $query->where('status', 1);
            })->latest()->paginate(10),
            'pelaksanaan_ami' => HistoriAmi::where('status', 1)->get()
        ];
        return view('ami.jadwal.jadwal', $data);
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
            "nama_jadwal" => "required",
            "jadwal_mulai" => "required",
            "jadwal_selesai" => "required",
            "id_tahun_ami" => "required"
        ]);

        $request->merge([
            "status" => 1
        ]);

        DB::transaction(function () use ($request) {
            JadwalAmi::create($request->all());
        });
        return redirect('/ami/jadwalAmi')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalAmi $jadwalAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $jadwalAmi)
    {
        $jadwalAmi = JadwalAmi::where('id', $jadwalAmi)->first();
        $data = [
            "update_jadwal" => $jadwalAmi,
            'pelaksanaan_ami' => HistoriAmi::all()
        ];
        return view('ami.jadwal.update_jadwal', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $jadwalAmi)
    {
        $jadwalAmi = JadwalAmi::where('id', $jadwalAmi)->first();
        $request->validate([
            "nama_jadwal" => "required",
            "jadwal_mulai" => "required",
            "jadwal_selesai" => "required",
            "id_tahun_ami" => 'required'
        ]);

        DB::transaction(function () use ($request, $jadwalAmi) {
            $jadwalAmi->update([
                'nama_jadwal' => $request->nama_jadwal,
                'jadwal_mulai' => $request->jadwal_mulai,
                'jadwal_selesai' => $request->jadwal_selesai,
                'id_tahun_ami' => $request->id_tahun_ami
            ]);
        });
        return redirect('/ami/jadwalAmi/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $jadwalAmi)
    {
        $jadwalAmi = JadwalAmi::where('id', $jadwalAmi)->first();
        DB::transaction(function () use ($jadwalAmi) {
            $jadwalAmi->delete();
        });
        return redirect('/ami/jadwalAmi')->with('message', 'Data Berhasil Terhapus!');
    }

    public function jadwalNonAktif(Request $request)
    {
        $histori = HistoriAmi::findOrFail($request->id_tahun_ami);
        DB::transaction(function () use ($request, $histori) {
            $histori->update([
                'status' => 0
            ]);
        });

        return back()->with('message', 'Jadwal AMI Berhasi; di Non-Aktifkan!');
    }
}
