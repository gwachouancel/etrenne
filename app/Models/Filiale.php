<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiale extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function order() {
        $filiale_id = $this->id;
        /*return Order::whereHas('items', function($q) use($filiale_id){
            return $q->where('filiale_id', $filiale_id);
        })->get();*/
        return $this->hasMany(Order::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

}
