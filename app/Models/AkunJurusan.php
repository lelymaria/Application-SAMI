<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunJurusan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'akun_jurusan';
    protected $fillable = ['id_jurusan', 'email', 'nip', 'nama', 'id_jadwal'];

    public function user() {
        return $this->hasOne(User::class,  'id', 'id_user');
    }

    public function dataJurusan() {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
