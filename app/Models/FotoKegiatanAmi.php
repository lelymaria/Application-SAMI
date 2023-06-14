<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoKegiatanAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'foto_kegiatan_ami';
    protected $fillable = ['id_undangan', 'caption_foto_kegiatan_ami', 'file_foto_kegiatan_ami'];

    public function undanganAmi() {
        return $this->belongsTo(User::class,  'id', 'id_undangan');
    }
}
