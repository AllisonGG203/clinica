<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoonshineUserRole extends Model
{
    protected $table = 'moonshine_user_roles';

    protected $fillable = ['name'];
}
