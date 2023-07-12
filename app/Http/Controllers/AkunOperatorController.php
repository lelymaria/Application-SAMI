<?php

namespace App\Http\Controllers;

use App\Models\AkunOperator;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'akun_operator' => AkunOperator::all()
        ];
        return view('manage_akun.operator.akun_operator', $data);
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
            "nip" => "required|unique:users,nip|numeric|max:20",
            "nama" => "required",
            // "foto_profile" => "required",
        ]);

        DB::transaction(function () use ($request) {
            $level = Level::where('name', 'Operator')->first();
            $user = User::create([
                'nip' => $request->nip,
                'password' => Hash::make('password'),
                'level_id' => $level->id
            ]);
            $user->akunOperator()->create([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
            ]);
        });
        return redirect('/manage_user/akun_operator')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunOperator $akunOperator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akunOperator = AkunOperator::find($id);
        $data = [
            'update_akun_operator' => $akunOperator
        ];
        return view('manage_akun.operator.update_operator', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akunOperator = akunOperator::find($id);
        $request->validate([
            "email" => "required|email",
            "nip" => [
                "max:20",
                "numeric",
                'required',
                Rule::unique('users')->ignore($akunOperator->id_user),
            ],
            "nama" => "required",
            // "foto_profile" => "required",
            "new_password" => "nullable|confirmed"
        ]);

        DB::transaction(function () use ($request, $akunOperator) {
            $akunOperator->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'foto_profile' => Hash::make('foto_profile'),
            ]);
            $akunOperator->user()->update([
                'nip' => $request->nip,
                'password' => Hash::make($request->new_password),
            ]);
        });
        return redirect('/manage_user/akun_operator/')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akunOperator = AkunOperator::findOrFail($id);
        $akunOperator->delete();
        $akunOperator->user()->delete();
        return redirect('/manage_user/akun_operator/')->with('message', 'Data Berhasil Terhapus!');
    }
}
