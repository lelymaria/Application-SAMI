<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PertanyaanStandar extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'pertanyaan_standar';
    protected $fillable = ['id_standar', 'list_pertanyaan_standar', 'id_jadwal'];

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function ketersediaanDokumen() {
        return $this->hasOne(KetersediaanDokumen::class, 'id_pertanyaan', 'id');
    }

    public function cheklistAudit() {
        return $this->hasOne(CheckListAudit::class, 'id_pertanyaan', 'id');
    }

    public function tanggapanChecklist() {
        return $this->hasOne(TanggapanCheckListAudit::class, 'id_pertanyaan', 'id' );
    }
}
