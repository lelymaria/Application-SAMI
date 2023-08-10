<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunOperator extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'akun_operator';
    protected $fillable = ['email', 'nip', 'nama'];

    public function user() {
        return $this->hasOne(User::class,  'id', 'id_user');
    }
}
