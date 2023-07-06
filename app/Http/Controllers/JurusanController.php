<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::paginate(10);
        return view('data.jurusan.view_jurusan', compact('jurusan'));
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
            "nama_jurusan" => "required",
        ]);

        DB::transaction(function () use ($request) {
            Jurusan::create($request->all());
        });
        return redirect('/data/datajurusan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idJurusan)
    {
        $jurusan = Jurusan::findOrFail($idJurusan);
        $data = [
            "update_jurusan" => $jurusan
        ];
        return view('data.jurusan.update_jurusan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idJurusan)
    {
        $jurusan = Jurusan::findOrFail($idJurusan);
        $request->validate([
            "nama_jurusan" => "required",
        ]);

        DB::transaction(function () use ($request, $jurusan) {
            $jurusan->update($request->all());
        });
        return redirect('/data/datajurusan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idJurusan)
    {
        $jurusan = Jurusan::findOrFail($idJurusan);
        $jurusan->delete();
        return redirect('/data/datajurusan')->with('message', 'Data Berhasil Terhapus!');
    }
}
