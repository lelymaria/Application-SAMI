<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\UndanganRtm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UndanganRtmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'undanganRtm' => UndanganRtm::all()
        ];
        return view('ami.dokumentasi_rtm.undangan.undangan_rtm', $data);
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
            "file_undangan" => "required|mimes:doc,docx,pdf",
        ]);

        if ($request->hasFile('file_undangan')) {
            $fileUndangan = $request->file('file_undangan');
            $filename = $fileUndangan->getClientOriginalName();
            $jadwal_ami = JadwalAmi::where('status', 1)->first();

            if ($request->file_nama) {
                $filename = $request->file_nama;
            }

            $filePath = $fileUndangan->storeAs("file_undangan", $filename);
            $request->merge([
                "file_undangan_rtm" => $filePath,
                "id_jadwal" => $jadwal_ami->id
            ]);

            if ($request->file_nama == "") {
                $request->merge([
                    "file_nama" => $filename
                ]);
            }
        }

        DB::transaction(function () use ($request) {
            UndanganRtm::create($request->all());
        });
        return redirect('/dokumentasiRtm/undangan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UndanganRtm $undanganRtm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $undanganRtm = UndanganRtm::findOrFail($id);
        $data = [
            "update_undangan_rtm" => $undanganRtm,
        ];
        return view('ami.dokumentasi_rtm.undangan.update_undangan_rtm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $undanganRtm = UndanganRtm::findOrFail($id);
        $request->validate([
            "file_undangan" => "required|mimes:doc,docx,pdf",
        ]);

        if ($request->hasFile('file_undangan')) {
            $fileUndangan = $request->file('file_undangan');
            $filename = $fileUndangan->getClientOriginalName();

            if ($request->file_nama) {
                $filename = $request->file_nama;
            }

            $filePath = $fileUndangan->storeAs("file_undangan", $filename);
            $request->merge([
                "file_undangan_rtm" => $filePath
            ]);
        }

        DB::transaction(function () use ($request, $undanganRtm) {
            $undanganRtm->update($request->all());
        });
        return redirect('/dokumentasiRtm/undangan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $undanganRtm = UndanganRtm::findOrFail($id);
        $undanganRtm->delete();
        return redirect('/dokumentasiRtm/undangan/')->with('message', 'Data Berhasil Terhapus!');
    }
}
