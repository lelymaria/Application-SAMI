<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use App\Models\AkunAuditor;
use App\Models\AkunJurusan;
use App\Models\AkunOperator;
use App\Models\KepalaP4mp;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        if (auth()->user()->levelRole->name == "Ketua P4MP") {
            $profile = KepalaP4mp::where('id_user', auth()->user()->id)->first();
        } else if (auth()->user()->levelRole->name == "Lead Auditor") {
            $profile = AkunAuditor::where('id_user', auth()->user()->id)->first();
        } else if (auth()->user()->levelRole->name == "Anggota Auditor") {
            $profile = AkunAuditor::where('id_user', auth()->user()->id)->first();
        } else if (auth()->user()->levelRole->name == "Auditee") {
            $profile = AkunAuditee::where('id_user', auth()->user()->id)->first();
        } else if (auth()->user()->levelRole->name == "Jurusan") {
            $profile = AkunJurusan::where('id_user', auth()->user()->id)->first();
        } else if (auth()->user()->levelRole->name == "Operator") {
            $profile = AkunOperator::where('id_user', auth()->user()->id)->first();
        } else {
            $profile = User::where('id_user', auth()->user()->id)->first();
        }

        $data = [
            "profile" => $profile,
        ];
        return view('manage_akun.setting_akun.profile.profile', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        // Update email
        $user->nip = $request->input('nip');
        $user->save();


        if (auth()->user()->levelRole->name == "Ketua P4MP") {
            $profile = KepalaP4mp::where('id_user', $user->id)->first();

            // Update Email dan nama KepalaP4mp
            $profile->email = $request->input('email');
            $profile->nama = $request->input('nama');
            $profile->save();
        } elseif (auth()->user()->levelRole->name == "Lead Auditor") {
            $profile = AkunAuditor::where('id_user', $user->id)->first();

            // Update Email dan nama Auditor
            $profile->email = $request->input('email');
            $profile->nama = $request->input('nama');
            $profile->save();
        } elseif (auth()->user()->levelRole->name == "Anggota Auditor") {
            $profile = AkunAuditor::where('id_user', $user->id)->first();

            // Update Email dan nama Auditee
            $profile->email = $request->input('email');
            $profile->nama = $request->input('nama');
            $profile->save();
        } elseif (auth()->user()->levelRole->name == "Auditee") {
            $profile = AkunAuditee::where('id_user', $user->id)->first();

            // Update Email dan nama Jurusan
            $profile->email = $request->input('email');
            $profile->nama = $request->input('nama');
            $profile->save();
        } elseif (auth()->user()->levelRole->name == "Jurusan") {
            $profile = AkunJurusan::where('id_user', $user->id)->first();

            // Update Email dan nama Operator
            $profile->email = $request->input('email');
            $profile->nama = $request->input('nama');
            $profile->save();
        } elseif (auth()->user()->levelRole->name == "Operator") {
            $profile = AkunOperator::where('id_user', $user->id)->first();

            // Update Email dan nama Operator
            $profile->email = $request->input('email');
            $profile->nama = $request->input('nama');
            $profile->save();
        }

        return back()->with('message', 'Profile Berhasil di Ubah');
    }
}
