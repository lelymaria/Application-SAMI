<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TanggapanCheckListAudit extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'tanggapan_check_list_audit';
    protected $fillable = ['id_jadwal', 'id_pertanyaan', 'id_check_list_audit', 'id_user', 'tanggapan_auditee'];

    public function jadwal()
    {
        return $this->hasOne(JadwalAmi::class, 'id', 'id_jadwal');
    }

    public function pertanyaanStandar()
    {
        return $this->hasOne(PertanyaanStandar::class, 'id', 'id_pertanyaan');
    }

    public function checklistAudit()
    {
        return $this->hasOne(CheckListAudit::class, 'id', 'id_check_list_audit');
    }

    public function user() {
        return $this->hasOne(User::class, 'id_user', 'id');
    }
}
