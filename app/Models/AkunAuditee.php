<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunAuditee extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'akun_auditee';
    protected $fillable = ['id_unit_kerja', 'email', 'nip', 'nama', 'id_jadwal'];

    public function user() {
        return $this->hasOne(User::class,  'id', 'id_user');
    }

    public function dataProdi() {
        return $this->belongsTo(ProgramStudi::class, 'id_unit_kerja', 'id');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function layananAkademik() {
        return $this->hasOne(LayananAkademik::class, 'id', 'id_unit_kerja');
    }
}
