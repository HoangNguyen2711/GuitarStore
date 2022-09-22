<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Role extends SpatieRole
{
    use HasFactory;
    protected $fillable = [
        'name',
        'display_name',
        'group',
        'guard_name'
    ];


}
