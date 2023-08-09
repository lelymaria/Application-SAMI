<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Standar extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'standar';
    protected $fillable = ['nama_standar', 'id_jadwal'];

    public function pertanyaanStandar() {
        return $this->hasOne(PertanyaanStandar::class,  "id_standar", "id");
    }

    public function tugasStandar() {
        return $this->hasOne(TugasStandar::class,  "id_standar", "id");
    }

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function dataDukungAuditee() {
        return $this->hasMany(DataDukungAuditee::class, 'id_standar', 'id');
    }

    public function uraianTemuanAmi() {
        return $this->hasOne(uraianTemuanAmi::class, 'id_standar', 'id');
    }

    public function verifikasiKp4mp() {
        return $this->hasOne(VerifikasiTemuanAmi::class, 'id_standar', 'id');
    }

    public function analisaTindakanAmi() {
        return $this->hasOne(AnalisadanTindakanTemuanAmi::class, 'id_standar', 'id');
    }
}
