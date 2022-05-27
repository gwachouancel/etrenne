<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Auth;

class OrderBySupplierExport implements FromCollection, WithHeadings
{
    use Exportable;

    private $order;
    public function __construct(Order $order){
        $this->order = $order;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $output = array();
        $orders = Order::where("id", $this->order->id)->first()->Items()->where("supplier_id", Auth::user()->supplier->user_id)->get();
        foreach($orders as $order){
            $output[] = [
                $order->ref_catalog,
                $order->ref_product,
                $order->type,
                $order->product_name,
                $order->page,
                number_format($order->quantity),
                $order->price,
                number_format($order->price * $order->quantity)
            ];
        }
        return collect($output);
        // return Order::all();
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
