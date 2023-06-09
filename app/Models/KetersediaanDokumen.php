<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KetersediaanDokumen extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'ketersediaan_dokumen';
    protected $fillable = ['id_jadwal', 'id_pertanyaan', 'nama_dokumen', 'ketersediaan_dokumen', 'pic', 'catatan'];

    public function jadwal()
    {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function pertanyaanStandar()
    {
        return $this->hasOne(PertanyaanStandar::class, 'id', 'id_pertanyaan');
    }
}
