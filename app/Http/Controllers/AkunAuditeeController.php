<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use App\Models\Level;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunAuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'akun_auditee' => AkunAuditee::all(),
            'dataProdi' => ProgramStudi::all()
        ];
        return view('manage_akun.auditee.akun_auditee', $data);
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
            $level = Level::where('name', 'Auditee')->first();
            $user = User::create([
                'nip' => $request->nip,
                'password' => Hash::make('password'),
                'level_id' => $level->id
            ]);
            $user->akunAuditee()->create([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_prodi' => $request->unit_kerja,
            ]);
        });
        return redirect('/manage_user/akun_auditee/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunAuditee $akunAuditee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akunAuditee = AkunAuditee::find($id);
        $data = [
            'update_akun_auditee' => $akunAuditee,
            'dataProdi' => ProgramStudi::all()
        ];
        return view('manage_akun.auditee.update_auditee', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akunAuditee = AkunAuditee::find($id);
        $request->validate([
            "unit_kerja" => "required",
            "email" => "required",
            "nip" => [
            'required', Rule::unique('users')->ignore($akunAuditee->id_user)
        ],
            "nama" => "required",
            // "foto_profile" => "required",
            // "new_password" => "required",
            // "confirmations_password" => "required",
        ]);

        DB::transaction(function () use ($request, $akunAuditee) {
            $akunAuditee->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_prodi' => $request->unit_kerja,
            ]);
            $akunAuditee->user()->update([
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
            ]);
        });
        return redirect('/manage_user/akun_auditee/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akunAuditee = AkunAuditee::findOrFail($id);
        $akunAuditee->delete();
        return redirect('/manage_user/akun_auditee/')->with('message', 'Data Berhasil Terhapus!');
    }
}