<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\NotulensiRtm;
use App\Models\UndanganRtm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotulensiRtmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $notulensiRtm = NotulensiRtm::where('id_undangan', $id)->latest()->paginate(10);
        $data = [
            'undanganRtm' => UndanganRtm::findOrFail($id),
            'notulensiRtm' => $notulensiRtm
        ];
        return view('ami.dokumentasi_rtm.notulensi.notulensi_rtm', $data);
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
            "file_notulensi_rtm" => 'required|mimes:doc,docx,pdf|file|max:3072'
        ]);

        $undanganRtm = UndanganRtm::findOrFail($id);

        DB::transaction(function () use ($request, $undanganRtm) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            $fileNotulensiRtm = $request->file('file_notulensi_rtm');
            $extensionOriginal = $fileNotulensiRtm->getClientOriginalExtension();
            NotulensiRtm::create([
                'file_nama' => 'Notulensi RTM ' . $undanganRtm->file_nama,
                'file_notulensi_rtm' => $fileNotulensiRtm->storeAs(
                    'file_notulensi_rtm',
                    $undanganRtm->file_nama . '.' . $extensionOriginal
                ),
                'id_undangan' => $undanganRtm->id,
                'id_jadwal' => $jadwal_ami->id
            ]);
        });

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NotulensiRtm $notulensiRtm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notulensiRtm = NotulensiRtm::find($id);
        $data = [
            "update_notulensi_rtm" => $notulensiRtm
        ];

        return view('ami.dokumentasi_rtm.notulensi.update_notulensi_rtm', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notulensi_rtm = NotulensiRtm::findOrFail($id);
        $request->validate([
            "file_notulensi_rtm" => "required|mimes:doc,docx,pdf|file|max:3072",
        ]);

        DB::transaction(function () use ($request, $notulensi_rtm) {
            $fileNotulensiRtm = $request->file('file_notulensi_rtm');
            $extensionOriginal = $fileNotulensiRtm->getClientOriginalExtension();
            $notulensi_rtm->update([
                'file_nama' => 'Notulensi Rtm ' . $notulensi_rtm->undanganRtm->file_nama,
                'file_notulensi_rtm' => $fileNotulensiRtm->storeAs(
                    'file_notulensi_rtm',
                    $notulensi_rtm->undanganRtm->file_nama . '.' . $extensionOriginal
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
        $notulensi_rtm = NotulensiRtm::findOrFail($id);
        DB::transaction(function () use ($notulensi_rtm){
            Storage::delete($notulensi_rtm->file_notulensi_rtm);
            $notulensi_rtm->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }
}
