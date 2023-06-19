<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoKegiatanRtm extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'foto_kegiatan_rtm';
    protected $fillable = ['id_undangan', 'caption_foto_kegiatan_rtm', 'file_foto_kegiatan_rtm', 'id_jadwal'];

    public function undanganRtm() {
        return $this->belongsTo(UndanganRtm::class,  'id', 'id_undangan');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
