<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{PertanyaanStandar, Standar, TinjauManajemenPeningkatan, JadwalAmi};
use Illuminate\Support\Facades\DB;

class TinjauManajemenPeningkatanController extends Controller
{
    public function index()
    {
        $standar = Standar::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->whereHas('tugasStandar', function ($query) {
            $query->where('id_user', auth()->user()->id);
        });
        $jumlah_yang_sudah_diisi = TinjauManajemenPeningkatan::whereIn('id_standar', $standar->get()->pluck('id'))->where('id_user', auth()->user()->id);
        $data = [
            'standar' => $standar->latest()->paginate(10),
            'jumlah_yang_sudah_diisi' => $jumlah_yang_sudah_diisi,
            'jumlah_yang_belum_diisi' => $standar->count() - $jumlah_yang_sudah_diisi->count()
        ];
        return view('ami.tinjau_manajemen_peningkatan.data_standar', $data);
    }

    public function show($id)
    {
        $pertanyaan = PertanyaanStandar::where('id_standar', $id);
        $jumlah_yang_sudah_diisi = TinjauManajemenPeningkatan::whereIn('id_pertanyaan', $pertanyaan->get()->pluck('id'))->where('id_user', auth()->user()->id);
        $data = [
            'standar' => Standar::findOrFail($id),
            'pertanyaan' => $pertanyaan->latest()->paginate(10),
            'jumlah_yang_sudah_diisi' => $jumlah_yang_sudah_diisi,
            'jumlah_yang_belum_diisi' => $pertanyaan->count() - $jumlah_yang_sudah_diisi->count(),
        ];
        return view('ami.tinjau_manajemen_peningkatan.data_pertanyaan', $data);
    }

    public function create()
    {
        $id_pertanyaan = request('pertanyaan');
        $id_standar = request('standar');
        $tinjauanPengendalian = TinjauManajemenPeningkatan::where('id_pertanyaan', $id_pertanyaan)->get();
        $data = [
            'pertanyaan' => PertanyaanStandar::findOrFail($id_pertanyaan),
            'tinjauan$tinjauanPengendalian' => $tinjauanPengendalian,
            'standar_id' => $id_standar
        ];
        return view('ami.tinjau_manajemen_peningkatan.manajemenData.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pertanyaan = request('pertanyaan');
        $id_standar = request('standar');
        $pertanyaanId = PertanyaanStandar::findOrFail($id_pertanyaan)->id;
        $standarId = Standar::findOrFail($id_standar)->id;

        $request->validate([
            'perubahan_dokumen_standar' => 'required'
        ]);
        DB::transaction(function () use ($request, $standarId, $pertanyaanId) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI Tidak Tersedia!');
            }
            TinjauManajemenPeningkatan::updateOrCreate(
                [
                    "id_jadwal" => $jadwal_ami->id,
                    'id_pertanyaan' => $pertanyaanId,
                    'id_standar' => $standarId,
                    'id_user' => auth()->user()->id,
                ],
                [
                    'perubahan_dokumen_standar' => $request->perubahan_dokumen_standar
                ]
            );
        });
        return redirect('/ami/tinjau_manajemen_peningkatan/' . $standarId)->with('message', 'Data Berhasil Tersimpan!');
    }

    public function edit(string $id)
    {
        $tinjauanPeningkatan = TinjauManajemenPeningkatan::findOrFail($id);
        $data = [
            'tinjauanPeningkatan' => $tinjauanPeningkatan
        ];
        return view('ami.tinjau_manajemen_peningkatan.manajemenData.edit', $data);
    }
}
