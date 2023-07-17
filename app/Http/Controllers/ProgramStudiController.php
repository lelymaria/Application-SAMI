<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\Jurusan;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'prodi' => ProgramStudi::latest()->paginate(10),
            'jurusan' => Jurusan::all()
        ];
        return view('data.prodi.view_prodi', $data);
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
            "nama_prodi" => "required",
            "nama_jurusan" => "required",
        ]);

        $request->merge([
            "id_jurusan" => $request->nama_jurusan,
        ]);

        DB::transaction(function () use ($request) {
            ProgramStudi::create($request->all());
        });
        return redirect('/data/dataprodi')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idProdi)
    {
        $prodi = ProgramStudi::findOrFail($idProdi);
        $data = [
            "update_prodi" => $prodi,
            "jurusan" => Jurusan::all()
        ];
        return view('data.prodi.update_prodi', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idProdi)
    {
        $prodi = ProgramStudi::findOrFail($idProdi);
        $request->validate([
            "nama_prodi" => "required",
            "nama_jurusan" => "required",
        ]);

        $request->merge([
            "id_jurusan" => $request->nama_jurusan
        ]);

        DB::transaction(function () use ($request, $prodi) {
            $prodi->update($request->all());
        });
        return redirect('/data/dataprodi')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idProdi)
    {
        $prodi = ProgramStudi::findOrFail($idProdi);
        $prodi->delete();
        return redirect('/data/dataprodi')->with('message', 'Data Berhasil Terhapus!');
    }
}
