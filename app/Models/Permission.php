<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name','status'
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function Menus(){
        return $this->belongsToMany(Menu::class, 'permission_menus', 'permission_id', 'menu_id')->orderBy('menu_id');
    }

    public function getMenusIdsAttribute(){
        $menus = [];

        foreach($this->Menus as $men){
            $menus[] = $men->id;
        }

        return $menus;
    }

    public function getMenusCodesAttribute(){
        $menus = [];

        foreach($this->Menus as $men){
            $menus[] = $men->code;
        }

        return $menus;
    }
}
