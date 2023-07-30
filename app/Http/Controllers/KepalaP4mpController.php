<?php

namespace App\Http\Controllers;

use App\Models\JadwalAmi;
use App\Models\KepalaP4mp;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KepalaP4mpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'kepala_p4mp' => KepalaP4mp::latest()->paginate(10)
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
            "email" => "required|email",
            "nip" => "required|unique:users,nip|numeric",
            "nama" => "required",
            // "foto_profile" => "required",
        ]);

        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/manage_user/kepalaP4mp')->with('error', 'Jadwal AMI tidak tersedia!');
        }

        DB::transaction(function () use ($request, $jadwal_ami) {
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
                'id_jadwal' => $jadwal_ami->id
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
    public function edit(string $id)
    {
        $kepalaP4mp = KepalaP4mp::find($id);
        $data = [
            'update_akun_kepalaP4mp' => $kepalaP4mp
        ];
        return view('manage_akun.p4mp.update_kepalap4mp', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kepalaP4mp = KepalaP4mp::find($id);
        $request->validate([
            "periode_jabatan" => "required",
            "email" => "required|email",
            "nip" => [
                'required', Rule::unique('users')->ignore($kepalaP4mp->id_user), "numeric",
            ],
            "nama" => "required",
            // "foto_profile" => "required",
            "new_password" => "nullable|confirmed"
        ]);

        DB::transaction(function () use ($request, $kepalaP4mp) {
            $kepalaP4mp->update([
                'periode_jabatan' => $request->periode_jabatan,
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
            ]);
            $kepalaP4mp->user()->update([
                'nip' => $request->nip,
                'password' => Hash::make($request->new_password),
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kepalaP4mp = KepalaP4mp::findOrFail($id);
        DB::transaction(function () use ($kepalaP4mp) {
            $kepalaP4mp->delete();
            $kepalaP4mp->user()->delete();
        });
        return redirect('/manage_user/kepalaP4mp/')->with('message', 'Data Berhasil Terhapus!');
    }
}
