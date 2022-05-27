<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filiale;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'data',
        'subsidary'
    ];

    public function getFiliale($id){
        $filiale = Filiale::where('id', $id);
        return $filiale->exists() ? $filiale->first()->name : "";
    }

    public function getCurrency(){
        return Setting::where('slug', '=', 'currency')->first();
    }
}
