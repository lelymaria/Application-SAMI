<?php

namespace App\Http\Controllers;

use App\Models\AnalisadanTindakanTemuanAmi;
use App\Models\JadwalAmi;
use App\Models\PertanyaanStandar;
use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisadanTindakanTemuanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $standar = Standar::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->whereHas('tugasStandar', function ($query) {
            $query->where('id_user', auth()->user()->id);
        });
        $jumlah_yang_sudah_diisi = AnalisadanTindakanTemuanAmi::whereIn('id_standar', $standar->get()->pluck('id'))->where('id_user', auth()->user()->id);
        $data = [
            'standar' => $standar->latest()->paginate(10),
            'jumlah_yang_sudah_diisi' => $jumlah_yang_sudah_diisi,
            'jumlah_yang_belum_diisi' => $standar->count() - $jumlah_yang_sudah_diisi->count()
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
        $analisaTindakan = AnalisadanTindakanTemuanAmi::where('id_standar', $id)->get();
        $data = [
            'standar' => Standar::findOrFail($id),
            'analisaTindakan' => $analisaTindakan
        ];
        return view('ami.draft_temuan.analisa_dan_tindakan.analisa_dan_tindakan_auditee', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $standar = Standar::findOrFail($id);
        $request->validate([
            "tanggal_penyelesaian" => "required",
            "analisa_masalah" => "required",
            "tindakan_koreksi" => "required"
        ]);

        DB::transaction(function () use ($request, $standar) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            AnalisadanTindakanTemuanAmi::create([
                'tanggal_penyelesaian' => $request->tanggal_penyelesaian,
                'analisa_masalah' => $request->analisa_masalah,
                'tindakan_koreksi' => $request->tindakan_koreksi,
                "id_jadwal" => $jadwal_ami->id,
                'id_standar' => $standar->id,
                'id_user' => auth()->user()->id
            ]);
        });
        return redirect('/ami/analisa_tindakan_ami/' . $standar->id_standar)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $analisaTindakan = AnalisadanTindakanTemuanAmi::findOrFail($id);
        $data = [
            'analisaTindakan' => $analisaTindakan
        ];
        return view('ami.draft_temuan.analisa_dan_tindakan.update_analisa_tindakan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $analisaTindakan = AnalisadanTindakanTemuanAmi::findOrFail($id);
        $request->validate([
            "tanggal_penyelesaian" => "required",
            "analisa_masalah" => "required",
            "tindakan_koreksi" => "required"
        ]);

        DB::transaction(function () use ($request, $analisaTindakan) {
            $analisaTindakan->update([
                'tanggal_penyelesaian' => $request->tanggal_penyelesaian,
                'analisa_masalah' => $request->analisa_masalah,
                'tindakan_koreksi' => $request->tindakan_koreksi
            ]);
        });

        return redirect('/ami/analisa_tindakan_ami/')->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnalisadanTindakanTemuanAmi $analisaTindakan)
    {
        //
    }
}
