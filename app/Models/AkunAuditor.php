<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunAuditor extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'akun_auditor';
    protected $fillable = ['id_prodi', 'email', 'nip', 'nama', 'foto_profile', 'id_jadwal'];

    public function user() {
        return $this->hasOne(User::class,  'id', 'id_user');
    }

    public function dataProdi() {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
