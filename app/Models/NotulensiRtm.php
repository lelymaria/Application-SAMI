<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotulensiRtm extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'notulensi_rtm';
    protected $fillable = ['id_undangan', 'file_notulensi_rtm', 'file_nama', 'id_jadwal'];

    public function undanganRtm() {
        return $this->belongsTo(UndanganRtm::class, 'id_undangan', 'id');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
