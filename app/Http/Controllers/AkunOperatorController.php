<?php

namespace App\Http\Controllers;

use App\Models\AkunOperator;
use Illuminate\Http\Request;

class AkunOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage_akun.operator.akun_operator');
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
        //
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
    public function edit(AkunOperator $akunOperator)
    {
        return view('manage_akun.operator.update_operator');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunOperator $akunOperator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunOperator $akunOperator)
    {
        //
    }
}
