<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditor;
use App\Models\JadwalAmi;
use App\Models\LayananAkademik;
use App\Models\Level;
use App\Models\ProgramStudi;
use App\Models\Standar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AnggotaAuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $level = Level::where('name', 'Anggota Auditor')->first();
        $data = [
            'akun_auditor' => User::where('level_id', $level->id)->get(),
            'dataProdi' => ProgramStudi::all(),
            'layananAkademik' => LayananAkademik::all()
        ];
        return view('manage_akun.auditor.anggota.anggota_auditor', $data);
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
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            $level = Level::where('name', 'Anggota Auditor')->first();
            $user = User::create([
                'nip' => $request->nip,
                'password' => Hash::make('password'),
                'level_id' => $level->id
            ]);
            $user->akunAuditor()->create([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_unit_kerja' => $request->unit_kerja,
                'id_jadwal' => $jadwal_ami->id
            ]);
        });
        return redirect('/manage_user/anggota_auditor/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunAuditor $akunAuditor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akunAuditor = User::find($id);
        $data = [
            'update_akun_auditor' => $akunAuditor,
            'dataProdi' => ProgramStudi::all(),
            'standar' => Standar::all(),
            'layananAkademik' => LayananAkademik::all()
        ];
        return view('manage_akun.auditor.anggota.update_anggota', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akunAuditor = User::find($id);
        $request->validate([
            "unit_kerja" => "required",
            "email" => "required",
            "nip" => [
                'required', Rule::unique('users')->ignore($akunAuditor)
            ],
            "nama" => "required",
            // "foto_profile" => "required",
            "new_password" => "nullable|confirmed"
        ]);

        DB::transaction(function () use ($request, $akunAuditor) {
            $akunAuditor->update([
                'nip' => $request->nip,
                'password' => Hash::make($request->new_password),
            ]);
            $akunAuditor->akunAuditor()->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_unit_kerja' => $request->unit_kerja,
            ]);
        });
        return redirect('/manage_user/anggota_auditor/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akunAuditor = User::findOrFail($id);
        $akunAuditor->akunAuditor()->delete();
        $akunAuditor->delete();
        return redirect('/manage_user/lead_auditor/')->with('message', 'Data Berhasil Terhapus!');
    }
}
