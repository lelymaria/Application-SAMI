<?php

namespace App\Http\Controllers;

use App\Models\{AkunAuditee, User};
use Illuminate\Http\Request;

class MonitoringAMIP4MPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditee = AkunAuditee::query()
        ->whereHas('jadwal', function($query){
            $query->where('status',1);
        })
        ->latest()->paginate(10);
        $data = [
            'getAuditee' => $auditee
        ];
        return view('ami.monitoringp4mp.monitoring', $data);
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
    public function show(string $id)
    {
        $auditee = AkunAuditee::query()
        ->whereId($id)
        ->first();
        $data = [
            'auditee'=> $auditee
        ];
        return view('ami.monitoringp4mp.menu_auditee', $data);
    }

    public function dataDukungAuditee($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.monitoringp4mp.menu_auditee.data_dukung', $data);
    }

    public function ketersediaanDokumen($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.monitoringp4mp.menu_auditee.ketersediaan_dokumen', $data);
    }

    public function checklistAudit($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.monitoringp4mp.menu_auditee.checklist', $data);
    }

    public function draftTemuan($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.monitoringp4mp.menu_auditee.temuan', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
