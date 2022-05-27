<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;
use App\Models\Filiale;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','mime','category','path','type','status','user_id','filiale_id','type_id'
    ];

    protected $attributes=[
        'type_id'=>0,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function extension(){
        if($this->mime == 'application/pdf') return 'pdf';
        else return 'image';
    }

    public function Setting(){
        return $this->hasOne(Setting::class, 'id', 'type_id');
    }

    public function Filiale(){
        return $this->hasOne(Filiale::class, 'id', 'filiale_id');
    }

    public function getFilialeNameAttribute(){
        return $this->filiale ? $this->filiale->name : '';
    }
}
