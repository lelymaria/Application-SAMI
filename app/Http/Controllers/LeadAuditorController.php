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

class LeadAuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $level = Level::where('name', 'Lead Auditor')->first();
        $data = [
            'akun_auditor' => User::where('level_id', $level->id)->latest()->paginate(10),
            'dataProdi' => ProgramStudi::all(),
            'layananAkademik' => LayananAkademik::all()
        ];
        return view('manage_akun.auditor.lead.lead_Auditor', $data);
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
            "unit_kerja" => "required|exists:prodi,layanan_akademik,id",
            // "foto_profile" => "required",
        ]);

        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/manage_user/lead_auditor/')->with('error', 'jadwal ami tidak tersedia!');
        }

        DB::transaction(function () use ($request, $jadwal_ami) {
            $level = Level::where('name', 'Lead Auditor')->first();
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
                'id_jadwal' => $jadwal_ami->id,
            ]);
        });
        return redirect('/manage_user/lead_auditor/')->with('message', 'Data Berhasil Tersimpan!');
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
            'standar' => Standar::latest()->paginate(5),
            'layananAkademik' => LayananAkademik::all()
        ];
        return view('manage_akun.auditor.lead.update_lead', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akunAuditor = User::find($id);
        $request->validate([
            "unit_kerja" => "required|exists:prodi,layanan_akademik,id",
            "email" => "required|email",
            "nip" => [
                'required', Rule::unique('users')->ignore($akunAuditor), 'numeric',
            ],
            "nama" => "required",
            // "foto_profile" => "required",
            "new_password" => "nullable|confirmed"
        ]);

        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/manage_user/lead_auditor/')->with('error', 'Jadwal AMI tidak tersedia!');
        }

        DB::transaction(function () use ($request, $akunAuditor, $jadwal_ami) {
            $akunAuditor->update([
                'nip' => $request->nip,
                'password' => Hash::make($request->new_password),
            ]);
            if (!$akunAuditor->akunAuditor) {
                return $akunAuditor->akunAuditor()->create([
                    'email' => $request->email,
                    'nama' => $request->nama,
                    'foto_profile' => Hash::make('foto_profile'),
                    'id_unit_kerja' => $request->unit_kerja,
                    'id_jadwal' => $jadwal_ami->id
                ]);
            }
            return $akunAuditor->akunAuditor()->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
                'id_unit_kerja' => $request->unit_kerja,
            ]);
        });
        return back()->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akunAuditor = User::findOrFail($id);
        DB::transaction(function () use ($akunAuditor) {
            $akunAuditor->akunAuditor()->delete();
            $akunAuditor->delete();
        });
        return redirect('/manage_user/lead_auditor/')->with('message', 'Data Berhasil Terhapus!');
    }
}
