<?php

namespace App\Http\Controllers;

use App\Models\KepalaP4mp;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KepalaP4mpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'kepala_p4mp' => KepalaP4mp::all()
        ];
        return view('manage_akun.p4mp.akun_kepalap4mp', $data);
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
            "periode_jabatan" => "required",
            "email" => "required",
            "nip" => "required|unique:users,nip",
            "nama" => "required",
            // "foto_profile" => "required",
        ]);

        DB::transaction(function () use ($request) {
            $level = Level::where('name', 'Ketua P4MP')->first();
            $user = User::create([
                'nip' => $request->nip,
                'password' => Hash::make('password'),
                'level_id' => $level->id
            ]);
            $user->kepalaP4mp()->create([
                'periode_jabatan' => $request->periode_jabatan,
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
            ]);
        });
        return redirect('/manage_user/kepalaP4mp')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KepalaP4mp $kepalaP4mp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idKepalaP4mp)
    {
        $kepalaP4mp = KepalaP4mp::where('id_user', $idKepalaP4mp)->first();
        $data = [
            'update_akun_kepalaP4mp' => $kepalaP4mp
        ];
        return view('manage_akun.p4mp.update_kepalap4mp', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idKepalaP4mp)
    {
        $kepalaP4mp = KepalaP4mp::where('id_user', $idKepalaP4mp)->first();
        $request->validate([
            "periode_jabatan" => "required",
            "email" => "required",
            "nip" => "required|unique:users,nip",
            "nama" => "required",
            // "foto_profile" => "required",
            // "new_password" => "required",
            // "confirmations_password" => "required",
        ]);

        DB::transaction(function () use ($request, $kepalaP4mp) {
            $user = User::findOrFail($kepalaP4mp);
            $level = Level::where('name', 'Ketua P4MP')->first();
            $user->update([
                'nip' => $request->nip,
                'password' => 'required|min:8|confirmed',
                'level_id' => $level->id
            ]);
            $user->kepalaP4mp()->update([
                'periode_jabatan' => $request->periode_jabatan,
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
            ]);
        });
        return redirect('/manage_user/kepalaP4mp/' . $kepalaP4mp->idKepalaP4mp)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idKepalaP4mp)
    {
        $kepalaP4mp = KepalaP4mp::findOrFail($idKepalaP4mp);
        $kepalaP4mp->delete();
        return redirect('/manage_user/kepalaP4mp/')->with('message', 'Data Berhasil Terhapus!');
    }
}
