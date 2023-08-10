<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdatePasswordController extends Controller
{
    public function userEditPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8',
        ]);

        DB::transaction(function () use ($request, $user) {
            return $user->update(['password' => Hash::make($request->new_password)]);
        });

        return back()->with('message', 'Password Berhasil diUbah');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('manage_akun.setting_akun.edit_password.edit_password');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail(__('Password saat ini salah.'));
                }
            }],
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail(auth()->user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect('/password/edit')->with('message', 'Password Salah');
        }
        DB::transaction(function () use ($request, $user) {
            $user->update(['password' => Hash::make($request->password)]);
        });
        return back()->with('message', 'Password Berhasil diUbah');
    }
}
