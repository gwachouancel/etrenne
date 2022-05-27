<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filiale;
use App\Models\Supplier;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['supplier','ref_catalog','ref_product','product_name','type','page','quantity','price','user_id','filiale_id','status'];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Filiale() {
        return $this->hasOne(Filiale::class, 'id', 'filiale_id');
    }

    public function Items() {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function Supplier($id){
        $supplier = Supplier::where("id", $id)->first();
        return $supplier?$supplier->company:"";
    }

    public function SupplierAsObject($id){
        return Supplier::where("id", $id)->first();
    }

    public function getType($string){
        return ($string == 'public')? __('supplier/order.order_type_public'): __('supplier/order.order_type_vip');
    }

    public function getTotalAmount(){
        $orders = OrderItem::where("order_id", $this->id)->get();
        $sum = $orders->map(function($o){
            return $o->price * $o->quantity;
        });
        return array_sum($sum->all());
    }
    
    public function getConfirmedAttribute(){
        $query = $this->hasMany(OrderItem::class, 'order_id', 'id');
        
        if($query->count()){
            return $query->whereHas('bat', function($q){
                return $q->where('status','approuved');
            })->count();
        }else {
            return false;
        }
    }

    public function getTypeAttribute(){
        $type = '';
        foreach($this->items->groupBy('category') as $key=>$array){
            $type .= __('common.'.$key).', ';
        }

        return $type;
    }

    public function getPriceAttribute(){
        $price = 0;
        foreach($this->items as $item){
            $price += $item->rawcost;
        }

        return $price;
    }
}
