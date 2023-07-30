<?php

namespace App\Http\Controllers;

use App\Models\LayananAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'layanan' => LayananAkademik::latest()->paginate(10)
        ];
        return view('data.layanan_akademik.layanan_akademik', $data);
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
            "nama_layanan" => "required",
        ]);

        DB::transaction(function () use ($request) {
            LayananAkademik::create($request->all());
        });
        return redirect('/data/layanan_akademik')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LayananAkademik $layananAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanan = LayananAkademik::findOrFail($id);
        $data = [
            "update_layanan" => $layanan
        ];
        return view('data.layanan_akademik.update_layanan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $layanan = LayananAkademik::findOrFail($id);
        $request->validate([
            "nama_layanan" => "required",
        ]);

        DB::transaction(function () use ($request, $layanan) {
            $layanan->update($request->all());
        });
        return redirect('/data/layanan_akademik')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = LayananAkademik::findOrFail($id);
        DB::transaction(function () use ($layanan) {
            $layanan->delete();
            $layanan->akunAuditee()->delete();
            $layanan->akunAuditor()->delete();
        });
        return redirect('/data/layanan_akademik')->with('message', 'Data Berhasil Terhapus!');
    }
}
