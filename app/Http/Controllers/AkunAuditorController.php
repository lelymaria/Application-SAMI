<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditor;
use Illuminate\Http\Request;

class AkunAuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage_akun.auditor.akun_auditor');
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
    public function show(AkunAuditor $akunAuditor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunAuditor $akunAuditor)
    {
        return view('manage_akun.auditor.update_auditor');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunAuditor $akunAuditor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunAuditor $akunAuditor)
    {
        //
    }
}
