<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\Standar;
use App\Models\TugasStandar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TugasStandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            "standar" => "required",
        ]);

        DB::transaction(function () use ($request) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            TugasStandar::create([
                'id_user' => $request->user,
                'id_standar' => $request->standar,
                'id_jadwal' => $jadwal_ami->id
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TugasStandar $tugasStandar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tugasStandar = TugasStandar::find($id);
        $data = [
            'update_tugas_standar' => $tugasStandar,
            'standar' => Standar::all()
        ];
        return view('manage_akun.auditor.update_tugas_standar', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $standar = TugasStandar::findOrFail($id);
        $request->validate([
            "standar" => "required",
        ]);

        DB::transaction(function () use ($request, $standar) {
            $standar->update([
                "id_standar" => $request->standar
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tugas = TugasStandar::findOrFail($id);
        DB::transaction(function () use ($tugas) {
            $tugas->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
