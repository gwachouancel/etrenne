<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'orderitem_id', 'ref_product'
    ];

    public function Order() {
        return $this->hasOne(OrderItem::class,'ref_product', 'ref_product');
    }

    public function Document(){
        return $this->hasOne(Document::class,'type_id', 'id')->orderBy('created_at','desc');
    }
}