<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UndanganAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'Undangan_ami';
    protected $fillable = ['file_nama', 'file_undangan_ami'];

    public function fotoKegiatanAmi() {
        return $this->hasMany(FotoKegiatanAmi::class,  'id_undangan', 'id');
    }

    public function daftarHadirAmi() {
        return $this->hasMany(DaftarHadirAmi::class,  'id_undangan', 'id');
    }

    public function notulensiAmi() {
        return $this->hasMany(NotulensiAmi::class,  'id_undangan', 'id');
    }
}
