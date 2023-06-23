<?php

namespace App\Http\Controllers;

use App\Models\DataDukungAuditee;
use App\Models\JadwalAmi;
use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataDukungAuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::all()
        ];
        return view('ami.data_dukung.data_standar', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $dataDukung = DataDukungAuditee::where('id_standar', $id)->get();
        $data = [
            'standar' => Standar::findOrFail($id),
            'dataDukung' => $dataDukung
        ];
        return view('ami.data_dukung.data_dukung', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        $standar = Standar::findOrFail($id);
        $request->validate([
            "nama_data" => "required",
        ]);

        $request->merge([
            "id_standar" => $standar->id,
            "id_jadwal" => $jadwal_ami->id
        ]);

        DB::transaction(function () use ($request, $standar) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            $dataDukung = $request->file('data_dukung_auditee');
            $standar->dataDukungAuditee()->create([
                'nama_data' => $dataDukung->store('data_dukung_auditee'),
                'id_jadwal' => $jadwal_ami->id
            ]);
        });
        return redirect('/ami/auditee/data_dukung/create/' . $id)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataDukungAuditee $dataDukungAuditee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataDukung = DataDukungAuditee::where('id', $id)->first();
        $data = [
            'update_data_dukung' => $dataDukung
        ];
        return view('ami.data_dukung.update_data_dukung', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataDukung = DataDukungAuditee::where('id', $id)->first();
        $request->validate([
            "nama_data" => "required",
        ]);

        DB::transaction(function () use ($request, $dataDukung) {
            $dataDukung = $request->file('file_notulensi_ami');
            $dataDukung->update([
                'nama_data' => $dataDukung->store('data_dukung_auditee')
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataDukung = DataDukungAuditee::findOrFail($id);
        $dataDukung->delete();
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
