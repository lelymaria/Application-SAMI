<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TinjauManajemenPengendalian extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $table = 'tinjau_manajemen_pengendalians';
    protected $fillable = ['id_standar', 'id_pertanyaan', 'id_jadwal', 'id_user', 'rencana_tindaklanjut', 'perubahan_dokumen_standar', 'audit_resiko_status', 'audit_resiko_situation', 'anggaran_status'];

    public function jadwal()
    {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function standar()
    {
        return $this->hasOne(Standar::class, 'id', 'id_standar');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_user', 'id');
    }
}
