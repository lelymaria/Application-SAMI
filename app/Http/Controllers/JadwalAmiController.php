<?php

namespace App\Http\Controllers;

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
            'jadwal_ami' => JadwalAmi::all()
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
            "status" => "required",
            "tahun_ami" => "required",
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
            "update_jadwal" => $jadwalAmi
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
            "status" => "required",
            "tahun_ami" => "required",
        ]);

        DB::transaction(function () use ($request, $jadwalAmi) {
            $jadwalAmi->update($request->all());
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
}
