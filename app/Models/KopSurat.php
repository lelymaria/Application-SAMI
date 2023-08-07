<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KopSurat extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'kop_surat';
    protected $fillable = ['id_jadwal', 'nama_formulir', 'no_dokumen', 'no_revisi', 'tanggal_berlaku', 'halaman'];

    public function jadwal() {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function checklist() {
        return $this->hasOne(CheckListAudit::class, 'id', 'id_kop_surat');
    }

    public function ketersediaan() {
        return $this->hasOne(KetersediaanDokumen::class, 'id', 'id_kop_surat');
    }

    public function uraian() {
        return $this->hasOne(UraianTemuanAmi::class, 'id', 'id_kop_surat');
    }
}
