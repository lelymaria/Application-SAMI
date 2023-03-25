<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
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
        return back();
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login');
    }
}
