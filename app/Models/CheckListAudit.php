<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckListAudit extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'check_list_audit';
    protected $fillable = ['id_jadwal', 'id_pertanyaan', 'tanggal_input_dokChecklist', 'kesesuaian', 'catatan_khusus', 'hasil_observasi'];

    public function jadwal()
    {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function pertanyaanStandar()
    {
        return $this->hasOne(PertanyaanStandar::class, 'id', 'id_pertanyaan');
    }

    public function tanggapanChecklist()
    {
        return $this->hasOne(TanggapanCheckListAudit::class, 'id_check_list_audit', 'id');
    }

    public function kopSurat() {
        return $this->belongsTo(KopSurat::class, 'id_kop_surat', 'id');
    }
}
