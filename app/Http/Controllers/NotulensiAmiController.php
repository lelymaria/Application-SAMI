<?php

namespace App\Http\Controllers;

use App\Models\NotulensiAmi;
use App\Models\UndanganAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotulensiAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $notulensiAmi = NotulensiAmi::where('id_undangan', $id)->get();
        $data = [
            'undanganAmi' => UndanganAmi::findOrFail($id),
            'notulensiAmi' => $notulensiAmi
        ];
        return view('ami.dokumentasi_ami.notulensi.notulensi_ami', $data);
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
    public function store(Request $request, $id)
    {
        $request->validate([
            "file_notulensi_ami" => 'required|mimes:doc,docx,pdf'
        ]);

        $undanganAmi = UndanganAmi::findOrFail($id);

        DB::transaction(function () use ($request, $undanganAmi) {
            $fileNotulensiAmi = $request->file('file_notulensi_ami');
            $extensionOriginal = $fileNotulensiAmi->getClientOriginalExtension();
            NotulensiAmi::create([
                'file_nama' => 'Notulensi Ami ' . $undanganAmi->file_nama,
                'file_notulensi_ami' => $fileNotulensiAmi->storeAs(
                    'file_notulensi_ami',
                    $undanganAmi->file_nama . '.' . $extensionOriginal
                ),
                'id_undangan' => $undanganAmi->id,
            ]);
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NotulensiAmi $notulensiAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notulensiAmi = NotulensiAmi::find($id);
        $data = [
            "update_notulensi_ami" => $notulensiAmi
        ];

        return view('ami.dokumentasi_ami.notulensi.update_notulensi_ami', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notulensi_ami = NotulensiAmi::findOrFail($id);
        $request->validate([
            "file_notulensi_ami" => "required|mimes:doc,docx,pdf",
        ]);

        DB::transaction(function () use ($request, $notulensi_ami) {
            $fileNotulensiAmi = $request->file('file_notulensi_ami');
            $extensionOriginal = $fileNotulensiAmi->getClientOriginalExtension();
            $notulensi_ami->update([
                'file_notulensi_ami' => $fileNotulensiAmi->storeAs(
                    'notulensi_ami',
                    $undanganAmi->file_nama . '.' . $extensionOriginal
                ),
            ]);
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notulensi_ami = NotulensiAmi::findOrFail($id);
        $notulensi_ami->delete();
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
