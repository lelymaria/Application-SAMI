<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan'];

    public function akunJurusan() {
        return $this->hasOne(AkunJurusan::class, 'id_jurusan', 'id');
    }

    public function prodi() {
        return $this->hasMany(ProgramStudi::class, 'id_jurusan', 'id');
    }
}
