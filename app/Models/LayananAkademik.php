<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LayananAkademik extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'layanan_akademik';
    protected $fillable = ['nama_layanan'];

    public function akunAuditee() {
        return $this->hasOne(AkunAuditee::class, 'id_unit_kerja', 'id');
    }

    public function akunAuditor() {
        return $this->hasMany(AkunAuditor::class, 'id_unit_kerja', 'id');
    }
}
