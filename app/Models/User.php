<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'password',
        'level_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function levelRole() {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function kepalaP4mp() {
        return $this->hasOne(KepalaP4mp::class, 'id_user', 'id');
    }

    public function akunOperator() {
        return $this->hasOne(AkunOperator::class, 'id_user', 'id');
    }

    public function akunJurusan() {
        return $this->hasOne(AkunJurusan::class, 'id_user', 'id');
    }

    public function akunAuditee() {
        return $this->hasOne(AkunAuditee::class, 'id_user', 'id');
    }

    public function akunAuditor() {
        return $this->hasOne(AkunAuditor::class, 'id_user', 'id');
    }

    public function tugasStandar() {
        return $this->hasMany(TugasStandar::class, 'id_user', 'id');
    }
}
