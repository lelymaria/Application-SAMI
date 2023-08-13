<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnalisadanTindakanTemuanAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'analisa_tindakan_temuan_ami';
    protected $fillable = ['id_jadwal', 'id_standar', 'id_user', 'tanggal_penyelesaian', 'analisa_masalah', 'tindakan_koreksi'];

    public function jadwal()
    {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function standar()
    {
        return $this->hasOne(Standar::class, 'id', 'id_standar');
    }

    public function user() {
        return $this->hasOne(User::class, 'id_user', 'id');
    }
}
