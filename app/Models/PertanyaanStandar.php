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
    protected $fillable = ['list_pertanyaan_standar'];
}
