<?php

namespace App\Http\Controllers;

use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::all()
        ];
        return view('operator.ami.standar', $data);
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
            "nama_standar" => "required",
        ]);

        DB::transaction(function()use ($request){
            Standar::create($request->all());
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Standar $standar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $data = [
            "update_standar" => $standar
        ];
        return view('operator.ami.update_standar', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $request->validate([
            "nama_standar" => "required",
        ]);

        DB::transaction(function()use ($request, $standar){
            $standar->update($request->all());
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $standar->delete();
        return redirect('/ami/standar')->with('message', 'Data Berhasil Terhapus!');
    }
}
