<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Order;
use Auth;

class OrderUserExport implements FromCollection, WithHeadings
{
    private $_order;
    public function __construct(Order $order){
        $this->_order = $order;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $output = array();
        $orders = Order::where("id", $this->_order->id)->where("filiale_id", Auth::user()->filiale_id)->first()->Items()->get();
        foreach($orders as $order){
            $output[] = [
                $order->ref_catalog,
                $order->ref_product,
                $order->type,
                $order->product_name,
                $order->page,
                $order->quantity,
                $order->price,
                $order->price * $order->quantity
            ];
        }
        return collect($output);
    }

    public function headings(): array
    {
        return [
            __("supplier/order.ref_catalog"), 
            __("supplier/order.ref_product"),
            __("supplier/order.type"), 
            __("supplier/order.product_name"), 
            __("supplier/order.page"), 
            __("supplier/order.quantity"), 
            __("supplier/order.price"), 
            __("supplier/order.total_price")
        ];
    }
}
