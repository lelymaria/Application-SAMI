<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use App\Models\UraianTemuanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UraianTemuanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::latest()->paginate(10)
        ];
        return view('ami.draft_temuan.data_standar', $data);
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $uraianKetidaksesuaian = UraianTemuanAmi::where('id_standar', $id)->get();
        $data = [
            'standar' => Standar::findOrFail($id),
            'uraianKetidaksesuaian' => $uraianKetidaksesuaian
        ];
        return view('ami.draft_temuan.uraian_ketidaksesuaian.uraian_ketidaksesuaian', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $standar = Standar::findOrFail($id);
        $request->validate([
            "tanggal_pelaksanaan" => "required",
            "checklist_uraian" => "required",
            "uraian_ketidaksesuaian" => "required"
        ]);

        DB::transaction(function () use ($request, $standar) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            UraianTemuanAmi::create([
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'checklist_uraian' => $request->checklist_uraian,
                'uraian_ketidaksesuaian' => $request->uraian_ketidaksesuaian,
                "id_jadwal" => $jadwal_ami->id,
                'id_standar' => $standar->id
            ]);
        });
        return redirect('/ami/uraian_ami/' . $standar->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $uraianKetidaksesuaian = UraianTemuanAmi::findOrFail($id);
        $data = [
            'uraianKetidaksesuaian' => $uraianKetidaksesuaian
        ];
        return view('ami.draft_temuan.uraian_ketidaksesuaian.update_uraian', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $uraianKetidaksesuaian = UraianTemuanAmi::findOrFail($id);
        $request->validate([
            "tanggal_pelaksanaan" => "required",
            "checklist_uraian" => "required",
            "uraian_ketidaksesuaian" => "required"
        ]);

        DB::transaction(function () use ($request, $uraianKetidaksesuaian) {
            $uraianKetidaksesuaian->update([
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'checklist_uraian' => $request->checklist_uraian,
                'uraian_ketidaksesuaian' => $request->uraian_ketidaksesuaian
            ]);
        });

        return redirect('/ami/uraian_ami/')->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UraianTemuanAmi $uraianKetidaksesuaian)
    {
        //
    }
}
