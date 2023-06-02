<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use Illuminate\Http\Request;

class AkunAuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage_akun.auditee.akun_auditee');
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
    public function show(AkunAuditee $akunAuditee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunAuditee $akunAuditee)
    {
        return view('manage_akun.auditee.update_auditee');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunAuditee $akunAuditee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunAuditee $akunAuditee)
    {
        //
    }
}
