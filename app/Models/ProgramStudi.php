<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramStudi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'prodi'; 
    protected $fillable = ['nama_prodi', 'id_jurusan'];

    public function jurusan() {
        return $this->hasOne(Jurusan::class, 'id', 'id_jurusan');
    }

    public function akunAuditee() {
        return $this->hasOne(AkunAuditee::class, 'id_prodi', 'id');
    }

    public function akunAuditor() {
        return $this->hasOne(AkunAuditor::class, 'id_prodi', 'id');
    }
}
