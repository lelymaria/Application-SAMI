<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotulensiAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'notulensi_ami';
    protected $fillable = ['id_undangan', 'file_notulensi_ami', 'file_nama'];

    public function undanganAmi() {
        return $this->belongsTo(UndanganAmi::class,  'id', 'id_undangan');
    }
}
