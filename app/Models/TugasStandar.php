<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TugasStandar extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'tugas_standar';
    protected $fillable = ['id_user', 'id_standar', 'id_jadwal'];

    public function user() {
        return $this->hasOne(User::class, "id",  "id_user");
    }

    public function standar() {
        return $this->hasOne(Standar::class, "id", "id_standar");
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }
}
