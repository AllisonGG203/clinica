<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MoonshineUser extends Authenticatable
{
    protected $table = 'moonshine_users';

    protected $fillable = [
        'name', 'email', 'password', 'moonshine_user_role_id'
    ];

    public function role()
    {
        return $this->belongsTo(MoonshineUserRole::class, 'moonshine_user_role_id');
    }
}
