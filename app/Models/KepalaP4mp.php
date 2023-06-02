<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KepalaP4mp extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'kepala_p4mp';
    protected $fillable = ['periode_jabatan', 'email', 'nip', 'nama', 'foto_profile'];

    public function user() {
        return $this->hasOne(User::class,  'id', 'id_user');
    }
}
