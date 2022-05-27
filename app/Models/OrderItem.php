<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderitems';

    protected $fillable = ['order_id', 'supplier_id','ref_catalog','ref_product','product_name','type','page','quantity','price','user_id','filiale_id','status','currency'];

    public function getPriceAttribute(){
        $currency = Setting::where('slug', 'currency')->first()->data;
        $price = $this->attributes['price'];

        if( $currency == $this->currency)return $price;
        if(in_array($currency,['XAF','XOF']) && in_array($this->currency,['XAF','XOF']))return $price;

        if($currency == 'EUR' && in_array($this->currency,['XAF','XOF'])){
            return $price / 655;
        }else{
            return $price * 655;
        }
    }

    public function Order() {
        return $this->belongsTo(Order::class);
    }

    public function Bat() {
        return $this->belongsTo(Bat::class, 'ref_product', 'ref_product');
    }

    public function Supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function getTitleAttribute(){
        return $this->product_name.' - '.$this->order->filiale->name.' - '.$this->ref_catalog.' - '.$this->type;
    }

    public function getCostAttribute(){
        return $this->quantity * $this->price;
    }
    
    public function getRawCostAttribute(){
        return $this->quantity * $this->price;
    }
}
