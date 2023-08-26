<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\NotulensiAmi;
use App\Models\UndanganAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotulensiAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $notulensiAmi = NotulensiAmi::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->where('id_undangan', $id)->latest()->paginate(10);
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
            "file_notulensi_ami" => 'required|mimes:doc,docx,pdf|file|max:3072'
        ]);

        $undanganAmi = UndanganAmi::findOrFail($id);

        DB::transaction(function () use ($request, $undanganAmi) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }
            $fileNotulensiAmi = $request->file('file_notulensi_ami');
            $extensionOriginal = $fileNotulensiAmi->getClientOriginalExtension();
            NotulensiAmi::create([
                'file_nama' => 'Notulensi Ami ' . $undanganAmi->file_nama,
                'file_notulensi_ami' => $fileNotulensiAmi->storeAs(
                    'file_notulensi_ami',
                    $undanganAmi->file_nama . '.' . $extensionOriginal
                ),
                'id_undangan' => $undanganAmi->id,
                'id_jadwal' => $jadwal_ami->id
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
            "file_notulensi_ami" => "required|mimes:doc,docx,pdf|file|max:3072",
        ]);

        DB::transaction(function () use ($request, $notulensi_ami) {
            $fileNotulensiAmi = $request->file('file_notulensi_ami');
            $extensionOriginal = $fileNotulensiAmi->getClientOriginalExtension();
            $notulensi_ami->update([
                'file_nama' => 'Notulensi Ami ' . $notulensi_ami->undanganAmi->file_nama,
                'file_notulensi_ami' => $fileNotulensiAmi->storeAs(
                    'file_notulensi_ami',
                    $notulensi_ami->undanganAmi->file_nama . '.' . $extensionOriginal
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
        DB::transaction(function () use ($notulensi_ami){
            Storage::delete($notulensi_ami->file_notulensi_ami);
            $notulensi_ami->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
