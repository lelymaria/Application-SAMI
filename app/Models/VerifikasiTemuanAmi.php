<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerifikasiTemuanAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'verifikasi_temuan_ami';
    protected $fillable = ['id_jadwal', 'id_standar', 'verifikasi_kp4mp'];

    public function jadwal()
    {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function standar()
    {
        return $this->hasOne(Standar::class, 'id', 'id_standar');
    }
}
