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
    protected $fillable = ['file_nama', 'file_laporan_ami', 'id_jadwal'];

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
