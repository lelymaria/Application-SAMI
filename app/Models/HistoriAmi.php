<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'histori_ami';
    protected $fillable = ['tahun_ami', 'status'];

    public function jadwal() {
        return $this->hasMany(JadwalAmi::class, 'id_tahun_ami', 'id');
    }
}
