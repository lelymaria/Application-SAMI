<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $casts = [
        'id' => 'string'
    ];
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
}
