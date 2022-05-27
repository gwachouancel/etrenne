<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionMenus extends Model
{
    protected $table = 'permission_menus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_id', 'menu_id'
    ];
}
