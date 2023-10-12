<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TinjauManajemenPeningkatan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $table = 'tinjau_manajemen_peningkatans';
    protected $fillable = ['id_standar', 'id_pertanyaan', 'id_jadwal', 'id_user', 'perubahan_dokumen_standar'];

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
