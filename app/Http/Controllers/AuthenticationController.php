<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('nip', $request->nip)->first();

            if (!$user) {
                return back()->with('message', 'NIP is not available!');
            }
            if (!Hash::check($request->password, $user->password)) {
                return back()->with('message', 'Password is wrong!');
            }

            if (Auth::attempt([
                'nip' => $user->nip,
                'password' => $request->password
            ])) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            DB::commit();
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function updateFotoProfile(Request $request) {
        $request->validate([
            "foto_profile_user" => "required|image|max:3072"
        ]);

        if ($request->hasFile('foto_profile_user')) {
            $url_foto_profile = $request->file('foto_profile_user')->store('foto_profile');
            $user_login = Auth::user();

            DB::transaction(function () use ($url_foto_profile, $user_login) {
                $user_login->update([
                    "foto_profile" => 'storage/'.$url_foto_profile,
                ]);
            });
        }

        return back()->with('message', 'Data Berhasil Tersimpan!');
    }
}
