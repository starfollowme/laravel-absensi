<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'nama_user',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi dengan Role melalui UserRoleMapping
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role_mapping', 'nip', 'role_id');
    }

    // Relasi dengan UserRoleMapping
    public function userRoleMappings()
    {
        return $this->hasMany(UserRoleMapping::class, 'nip', 'nip');
    }

    // Relasi dengan Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nip', 'nip');
    }

    // Helper method untuk check role
    public function hasRole($roleName)
    {
        return $this->roles()->where('role_name', $roleName)->exists();
    }

    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('role_name', $roles)->exists();
    }

    // Helper method untuk check permission mencatat absensi
    public function canRecordAbsensi()
    {
        return $this->hasAnyRole(['Admin', 'Guru Matapelajaran', 'Walikelas', 'Kesiswaan']);
    }
}
