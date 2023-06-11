<?php

namespace App\Http\Controllers;

use App\Models\UndanganAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UndanganAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'undanganAmi' => UndanganAmi::all()
        ];
        return view('ami.dokumentasi_ami.undangan.undangan_ami', $data);
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

            if ($request->file_nama) {
                $filename = $request->file_nama;
            }

            $filePath = $fileUndangan->storeAs("file_undangan", $filename);
            $request->merge([
                "file_undangan_ami" => $filePath
            ]);

            if ($request->file_nama == "") {
                $request->merge([
                    "file_nama" => $filename
                ]);
            }
        }

        DB::transaction(function () use ($request) {
            UndanganAmi::create($request->all());
        });
        return redirect('/dokumentasiAmi/undangan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UndanganAmi $undanganAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $undanganAmi = UndanganAmi::findOrFail($id);
        $data = [
            "update_undangan_ami" => $undanganAmi,
        ];
        return view('ami.dokumentasi_ami.undangan.update_undangan_ami', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $undanganAmi = UndanganAmi::findOrFail($id);
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
                "file_undangan_ami" => $filePath
            ]);
        }

        DB::transaction(function () use ($request, $undanganAmi) {
            $undanganAmi->update($request->all());
        });
        return redirect('/dokumentasiAmi/undangan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $undanganAmi = UndanganAmi::findOrFail($id);
        $undanganAmi->delete();
        return redirect('/dokumentasiAmi/undangan/')->with('message', 'Data Berhasil Terhapus!');
    }
}
