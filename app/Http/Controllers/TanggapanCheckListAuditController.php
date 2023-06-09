<?php

namespace App\Http\Controllers;

use App\Models\CheckListAudit;
use App\Models\JadwalAmi;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use App\Models\TanggapanCheckListAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanggapanCheckListAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::all()
        ];
        return view('ami.dokumen_checklist.data_standar', $data);
    }

    public function show($id)
    {
        $pertanyaan = PertanyaanStandar::where('id_standar', $id)->get();
        $data = [
            'standar' => Standar::findOrFail($id),
            'pertanyaan' => $pertanyaan
        ];
        return view('ami.dokumen_checklist.data_pertanyaan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $tanggapanAudit = TanggapanCheckListAudit::where('id_pertanyaan', $id)->get();
        $data = [
            'pertanyaan' => PertanyaanStandar::findOrFail($id),
            'tanggapanAudit' => $tanggapanAudit
        ];
        return view('ami.dokumen_checklist.auditee.tanggapan_checklist_ami', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $pertanyaan = PertanyaanStandar::findOrFail($id);
        $checklistAudit = CheckListAudit::where('id_pertanyaan', $id)->first();
        $request->validate([
            "tanggapan_auditee" => "required"
        ]);

        DB::transaction(function () use ($request, $pertanyaan, $checklistAudit) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            TanggapanCheckListAudit::create([
                'tanggapan_auditee' => $request->tanggapan_auditee,
                "id_jadwal" => $jadwal_ami->id,
                'id_pertanyaan' => $pertanyaan->id,
                'id_check_list_audit' => $checklistAudit->id
            ]);
        });
        return redirect('/ami/tanggapan_audit/' . $pertanyaan->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tanggapanAudit = TanggapanCheckListAudit::findOrFail($id);
        $data = [
            'tanggapanAudit' => $tanggapanAudit
        ];
        return view('ami.dokumen_checklist.auditee.update_tanggapan_checklist', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tanggapanAudit = TanggapanCheckListAudit::findOrFail($id);
        $request->validate([
            "tanggapan_auditee" => "required"
        ]);

        DB::transaction(function () use ($request, $tanggapanAudit) {
            $tanggapanAudit->update([
                'tanggapan_auditee' => $request->tanggapan_auditee,
            ]);
        });

        return redirect('/ami/tanggapan_audit/' . $tanggapanAudit->pertanyaanStandar->id_standar)->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TanggapanCheckListAudit $tanggapanAudit)
    {
        //
    }
}
