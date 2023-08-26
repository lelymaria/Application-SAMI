<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\PedomanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

class PedomanAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pedoman_ami' => PedomanAmi::whereHas('jadwal.historiAmi', function ($query) {
                $query->where('status', 1);
            })->get()
        ];
        return view('ami.pedoman.pedoman_ami', $data);
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
            "deskripsi" => "required",
            "file_pedoman" => "required|mimes:doc,docx,pdf|file|max:3072",
        ]);

        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/ami/pedomanAmi/')->with('error', 'Jadwal AMI tidak tersedia!');
        }

        $request->merge([
            "file_pedoman_ami" => $request->file('file_pedoman')->store('file_pedoman'),
            "id_jadwal" => $jadwal_ami->id
        ]);
        DB::transaction(function () use ($request) {
            PedomanAmi::create($request->all());
        });
        return redirect('/ami/pedomanAmi/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PedomanAmi $pedomanAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idPedomanAmi)
    {
        $pedomanAmi = PedomanAmi::findOrFail($idPedomanAmi);
        $data = [
            "update_pedoman" => $pedomanAmi,
        ];
        return view('ami.pedoman.update_pedoman_ami', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idPedomanAmi)
    {
        $pedomanAmi = PedomanAmi::findOrFail($idPedomanAmi);
        $request->validate([
            "deskripsi" => "required",
            "file_pedoman" => "mimes:doc,docx,pdf|file|max:3072"
        ]);

        if ($request->hasFile('file_pedoman')) {
            $request->merge([
                "file_pedoman_ami" => $request->file('file_pedoman')->store('file_pedoman'),
            ]);
        }

        DB::transaction(function () use ($request, $pedomanAmi) {
            $pedomanAmi->update($request->all());
        });
        return redirect('/ami/pedomanAmi/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedomanAmi $pedomanAmi)
    {
        //
    }
}
