<?php

namespace App\Http\Controllers;

use App\Models\CheckListAudit;
use App\Models\JadwalAmi;
use App\Models\KopSurat;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use App\Models\TanggapanCheckListAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckListAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::whereHas('tugasStandar', function ($query) {
                $query->where('id_user', auth()->user()->id);
            })->latest()->paginate(10)
        ];
        return view('ami.dokumen_checklist.data_standar', $data);
    }

    public function show($id)
    {
        $pertanyaan = PertanyaanStandar::where('id_standar', $id)->latest()->paginate(10);
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
        $checkListAudit = CheckListAudit::where('id_pertanyaan', $id)->get();
        $data = [
            'pertanyaan' => PertanyaanStandar::findOrFail($id),
            'kop_surat' => KopSurat::all(),
            'checkListAudit' => $checkListAudit
        ];
        return view('ami.dokumen_checklist.auditor.checklist_ami_auditor', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $pertanyaan = PertanyaanStandar::findOrFail($id);
        $tanggapanAudit = TanggapanCheckListAudit::where('id_pertanyaan', $id)->first();
        $request->validate([
            "nama_formulir" => "required",
            "tanggal_input_dokChecklist" => "required",
            "kesesuaian" => "required",
            "catatan_khusus" => "required",
            "hasil_observasi" => "required"
        ]);

        DB::transaction(function () use ($request, $pertanyaan, $tanggapanAudit) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            CheckListAudit::create([
                "id_kop_surat" => $request->nama_formulir,
                'tanggal_input_dokChecklist' => $request->tanggal_input_dokChecklist,
                'kesesuaian' => $request->kesesuaian,
                'catatan_khusus' => $request->catatan_khusus,
                'hasil_observasi' => $request->hasil_observasi,
                "id_jadwal" => $jadwal_ami->id,
                'id_pertanyaan' => $pertanyaan->id,
                'id_user' => auth()->user()->id
            ]);
        });
        return redirect('/ami/checklist_audit/' . $pertanyaan->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $checkListAudit = CheckListAudit::findOrFail($id);
        $data = [
            "kop_surat" => KopSurat::all(),
            'checkListAudit' => $checkListAudit
        ];
        return view('ami.dokumen_checklist.auditor.update_checklist_auditor', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $checkListAudit = CheckListAudit::findOrFail($id);
        $request->validate([
            "nama_formulir" => "required",
            "tanggal_input_dokChecklist" => "required",
            "kesesuaian" => "required",
            "catatan_khusus" => "required",
            "hasil_observasi" => "required"
        ]);

        DB::transaction(function () use ($request, $checkListAudit) {
            $checkListAudit->update([
                "id_kop_surat" => $request->nama_formulir,
                'tanggal_input_dokChecklist' => $request->tanggal_input_dokChecklist,
                'kesesuaian' => $request->kesesuaian,
                'catatan_khusus' => $request->catatan_khusus,
                'hasil_observasi' => $request->hasil_observasi,
            ]);
        });

        return redirect('/ami/checklist_audit/' . $checkListAudit->pertanyaanStandar->id_standar)->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckListAudit $checkListAudit)
    {
        //
    }
}
