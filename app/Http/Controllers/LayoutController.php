<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use App\Models\AkunAuditor;
use App\Models\AkunJurusan;
use App\Models\JadwalAmi;
use App\Models\KepalaP4mp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $p4mpCount = KepalaP4mp::count();
        $auditorCount = AkunAuditor::count();
        $auditeeCount = AkunAuditee::count();
        $jurusanCount = AkunJurusan::count();
        $jadwalAmi = JadwalAmi::where('jadwal_mulai', '<=', $now)
            ->where('jadwal_selesai', '>=', $now)
            ->whereYear('created_at', date('Y'))
            ->first();

        return view('dashboard', compact('p4mpCount', 'auditorCount', 'auditeeCount', 'jurusanCount', 'jadwalAmi'));
    }
}
