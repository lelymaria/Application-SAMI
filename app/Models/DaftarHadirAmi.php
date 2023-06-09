<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarHadirAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'daftar_hadir_ami';
    protected $fillable = ['id_undangan', 'file_daftar_hadir_ami', 'file_nama', 'id_jadwal'];

    public function undanganAmi()
    {
        return $this->belongsTo(UndanganAmi::class,  'id_undangan', 'id');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
