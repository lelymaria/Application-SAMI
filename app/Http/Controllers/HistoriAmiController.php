<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use App\Models\HistoriAmi;
use App\Models\LayananAkademik;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoriAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pelaksanaan_ami' => HistoriAmi::latest()->paginate(10)
        ];
        return view('ami.pelaksanaan_ami.tahun_pelaksanaan', $data);
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
            "tahun_ami" => "required"
        ]);

        $request->merge([
            "status" => 1
        ]);

        DB::transaction(function () use ($request) {
            HistoriAmi::create($request->all());
        });
        return redirect('/ami/jadwal_pelaksanaan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoriAmi $historiAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelaksanaan_ami = HistoriAmi::findOrFail($id);
        $data = [
            "update_pelaksanaan" => $pelaksanaan_ami
        ];
        return view('ami.pelaksanaan_ami.update_pelaksanaan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelaksanaan_ami = HistoriAmi::findOrFail($id);
        $request->validate([
            "tahun_ami" => "required"
        ]);

        DB::transaction(function () use ($request, $pelaksanaan_ami) {
            $pelaksanaan_ami->update($request->all());
        });
        return redirect('/ami/jadwal_pelaksanaan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelaksanaan_ami = HistoriAmi::findOrFail($id);
        DB::transaction(function () use ($pelaksanaan_ami) {
            $pelaksanaan_ami->delete();
        });
        return redirect('/ami/jadwal_pelaksanaan')->with('message', 'Data Berhasil Terhapus!');
    }

    public function historiAmi()
    {
        $data = [
            'pelaksanaan_ami' => HistoriAmi::where('status', 0)->get()
        ];
        return view('ami.histori.histori_ami', $data);
    }

    public function historiAmiData($id) {
        $data = [
            'akun_auditee' => AkunAuditee::whereHas('jadwal.historiAmi', function ($query) use ($id) {
                $query->where('id', $id);
            })->latest()->paginate(10),
        ];
        return view('ami.histori.histori_data', $data);
    }

    public function menuAuditee($id) {
        $data = [
            'data_dukung' => Data
        ];
        return view('ami.histori.menu_auditee', $data);
    }
}
