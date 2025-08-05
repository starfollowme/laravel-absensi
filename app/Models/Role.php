<?php

// 1. Model Role
// File: app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_name',
        'role_description'
    ];

    // Relasi dengan User melalui UserRoleMapping
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role_mapping', 'role_id', 'nip');
    }

    // Relasi dengan UserRoleMapping
    public function userRoleMappings()
    {
        return $this->hasMany(UserRoleMapping::class, 'role_id', 'role_id');
    }
}