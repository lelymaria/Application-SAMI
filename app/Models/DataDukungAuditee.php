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
    protected $fillable = ['nama_data', 'id_standar'];

    public function standar()
    {
        return $this->hasOne(Standar::class, 'id_standar', 'id');
    }
}
