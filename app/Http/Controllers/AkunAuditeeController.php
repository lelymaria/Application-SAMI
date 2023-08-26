<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
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

class AkunAuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'akun_auditee' => AkunAuditee::whereHas('jadwal.historiAmi', function ($query) {
                $query->where('status', 1);
            })->latest()->paginate(10),
            'dataProdi' => ProgramStudi::all(),
            'layananAkademik' => LayananAkademik::all()
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
            "email" => "required|email",
            "nip" => "required|unique:users,nip|numeric",
            "nama" => "required",
            "unit_kerja" => "required",
        ]);

        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/manage_user/akun_auditee/')->with('error', 'Jadwal AMI tidak tersedia!');
        }

        DB::transaction(function () use ($request, $jadwal_ami) {
            $level = Level::where('name', 'Auditee')->first();
            $user = User::create([
                'nip' => $request->nip,
                'password' => Hash::make('password'),
                'level_id' => $level->id,
                'foto_profile' => asset('images/profile/profile.png'),
            ]);
            $user->akunAuditee()->create([
                'email' => $request->email,
                'nama' => $request->nama,
                'id_unit_kerja' => $request->unit_kerja,
                'id_jadwal' => $jadwal_ami->id
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
            'dataProdi' => ProgramStudi::all(),
            'standar' => Standar::all(),
            'layananAkademik' => LayananAkademik::all()
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
            "email" => "required|email",
            "nip" => [
                'required', Rule::unique('users')->ignore($akunAuditee->id_user), "numeric"
            ],
            "nama" => "required"
        ]);

        DB::transaction(function () use ($request, $akunAuditee) {
            $akunAuditee->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'id_unit_kerja' => $request->unit_kerja,
            ]);
            $akunAuditee->user()->update([
                'nip' => $request->nip
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akunAuditee = AkunAuditee::findOrFail($id);
        DB::transaction(function () use ($akunAuditee) {
            $akunAuditee->forceDelete();
        });
        return redirect('/manage_user/akun_auditee/')->with('message', 'Data Berhasil Terhapus!');
    }
}
