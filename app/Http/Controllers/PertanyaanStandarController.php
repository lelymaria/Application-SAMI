<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertanyaanStandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::whereHas('jadwal.historiAmi', function ($query) {
                $query->where('status', 1);
            })->latest()->paginate(10)
        ];
        return view('ami.pertanyaan_standar.data_standar', $data);
    }

    public function tampilanPertanyaan($id)
    {
        $pertanyaan = PertanyaanStandar::where('id_standar', $id)->latest()->paginate(10);
        $data = [
            'standar' => Standar::findOrFail($id),
            'pertanyaan' => $pertanyaan
        ];
        return view('ami.pertanyaan_standar.pertanyaan_standar', $data);
    }

    public function tambahPertanyaan($id)
    {
        $data = [
            'standar' => Standar::findOrFail($id)
        ];
        return view('ami.pertanyaan_standar.tambah_pertanyaan_standar', $data);
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
        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/ami/data_standar/')->with('error', 'Jadwal AMI tidak tersedia!');
        }
        $standar = Standar::findOrFail($id);
        $request->validate([
            "list_pertanyaan_standar" => "required",
        ]);

        $request->merge([
            "id_jadwal" => $jadwal_ami->id
        ]);

        DB::transaction(function () use ($request, $standar) {
            $standar->pertanyaanStandar()->create($request->all());
        });
        return redirect('/ami/data_standar/pertanyaan/' . $id)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PertanyaanStandar $pertanyaanStandar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idPertanyaan)
    {
        $pertanyaan = PertanyaanStandar::where('id', $idPertanyaan)->first();
        $data = [
            'update_pertanyaan' => $pertanyaan
        ];
        return view('ami.pertanyaan_standar.update_pertanyaan_standar', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idPertanyaan)
    {
        $pertanyaan = PertanyaanStandar::where('id_standar', $idPertanyaan)->first();
        $request->validate([
            "list_pertanyaan_standar" => "required",
        ]);
        // dd($idPertanyaan);

        DB::transaction(function () use ($request, $pertanyaan) {
            $pertanyaan->update($request->all());
        });
        return redirect('/ami/data_standar/pertanyaan/' . $pertanyaan->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pertanyaan = PertanyaanStandar::findOrFail($id);
        DB::transaction(function () use ($pertanyaan) {
            $pertanyaan->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
