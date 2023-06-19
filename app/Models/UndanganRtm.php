<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UndanganRtm extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'Undangan_rtm';
    protected $fillable = ['file_nama', 'file_undangan_rtm', 'id_jadwal'];

    public function fotoKegiatanRtm() {
        return $this->hasMany(FotoKegiatanRtm::class,  'id_undangan', 'id');
    }

    public function daftarHadirRtm() {
        return $this->hasMany(DaftarHadirRtm::class,  'id_undangan', 'id');
    }

    public function notulensiRtm() {
        return $this->hasMany(NotulensiRtm::class,  'id_undangan', 'id');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
