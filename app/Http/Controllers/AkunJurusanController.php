<?php

namespace App\Http\Controllers;

use App\Models\AkunJurusan;
use Illuminate\Http\Request;

class AkunJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage_akun.jurusan.akun_jurusan');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunJurusan $akunJurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunJurusan $akunJurusan)
    {
        return view('manage_akun.jurusan.update_jurusan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunJurusan $akunJurusan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunJurusan $akunJurusan)
    {
        //
    }
}
