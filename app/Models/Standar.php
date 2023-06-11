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
    protected $fillable = ['nama_standar'];

    public function pertanyaanStandar() {
        return $this->hasOne(PertanyaanStandar::class,  "id_standar", "id");
    }

    public function tugasStandar() {
        return $this->hasOne(TugasStandar::class,  "id_standar", "id");
    }
}
