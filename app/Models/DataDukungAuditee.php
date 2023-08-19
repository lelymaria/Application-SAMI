<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataDukungAuditee extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'data_dukung_auditee';
    protected $fillable = ['nama_file', 'data_file', 'id_user', 'id_standar', 'id_jadwal'];

    public function standar()
    {
        return $this->hasOne(Standar::class, 'id', 'id_standar');
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function user() {
        return $this->hasOne(User::class, 'id_user', 'id');
    }

    public function tugasStandar() {
        return $this->hasOne(TugasStandar::class, 'id_standar', 'id');
    }
}
