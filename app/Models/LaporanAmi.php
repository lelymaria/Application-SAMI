<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'laporan_ami';
    protected $fillable = ['file_nama', 'file_laporan_ami', 'id_jadwal', 'id_user'];

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function tugasStandar() {
        return $this->hasOne(TugasStandar::class, 'id_standar', 'id');
    }
}
