<?php

namespace App\Http\Controllers;

use App\Models\AkunJurusan;
use App\Models\Jurusan;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'akun_jurusan' => AkunJurusan::all(),
            'dataJurusan' => Jurusan::all()
        ];
        return view('manage_akun.jurusan.akun_jurusan', $data);
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
            "email" => "required",
            "nip" => "required|unique:users,nip",
            "nama" => "required",
            "unit_kerja" => "required",
            // "foto_profile" => "required",
        ]);

        DB::transaction(function () use ($request) {
            $level = Level::where('name', 'Jurusan')->first();
            $user = User::create([
                'nip' => $request->nip,
                'password' => Hash::make('password'),
                'level_id' => $level->id
            ]);
            $user->akunJurusan()->create([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_jurusan' => $request->unit_kerja,
            ]);
        });
        return redirect('/manage_user/akun_jurusan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunJurusan $akunJurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akunJurusan = AkunJurusan::find($id);
        $data = [
            'update_akun_jurusan' => $akunJurusan,
            'dataJurusan' => Jurusan::all()
        ];
        return view('manage_akun.jurusan.update_jurusan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akunJurusan = AkunJurusan::find($id);
        $request->validate([
            "unit_kerja" => "required",
            "email" => "required",
            "nip" => [
            'required', Rule::unique('users')->ignore($akunJurusan->id_user)
        ],
            "nama" => "required",
            // "foto_profile" => "required",
            // "new_password" => "required",
            // "confirmations_password" => "required",
        ]);

        DB::transaction(function () use ($request, $akunJurusan) {
            $akunJurusan->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_jurusan' => $request->unit_kerja,
            ]);
            $akunJurusan->user()->update([
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
            ]);
        });
        return redirect('/manage_user/akun_jurusan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akunJurusan = AkunJurusan::findOrFail($id);
        $akunJurusan->delete();
        return redirect('/manage_user/akun_jurusan')->with('message', 'Data Berhasil Terhapus!');
    }
}