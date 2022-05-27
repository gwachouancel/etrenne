<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company','address','country','rib','product_type','user_id'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
