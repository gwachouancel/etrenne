<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Exports\OrderByFilialeExport;
use App\Exports\OrderBySupplierExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Catalog;
use App\Models\Supplier;
use App\Models\Filiale;
use App\Models\OrderItem;
use App\Models\Comment;
use App\Models\Setting;
use Auth;

class OrderController extends Controller
{
    //
    public function index(){
        // $orders = Order::where("isblocked", false)->orderby("created_at", "DESC")->get();
        $orders = Order::orderby("created_at", "DESC")->get();
        $orderPerFiliales = $orders->map(function($order) {
            return [
                'order_id' => $order->id,
                'filiale_id' => $order->filiale_id,
                'filialename' => $order->filiale->name,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'status' => $order->status,
                'price' => $order->getTotalAmount(),
                'isblocked' => $order->isblocked
            ];
        })->collect();

        $suppliers = OrderItem::select('supplier_id')->distinct('supplier_id')->get();
        $orderPerSupplier = array();
        foreach($suppliers as $supplier){
            $orders = OrderItem::where("supplier_id", $supplier->supplier_id)->get();
            $sum = 0;
            foreach($orders as $order){
                $sum += $order->price * $order->quantity;
            }

            $orderPerSupplier[] = [
                'suppliername' => $supplier->Supplier->company,
                'price' => $sum,
                'supplier_id' => $supplier->supplier_id
            ];
        }

        $output = "";
        $array_status = [
            'production_start' => '<label class="badge badge-warning">' . __('supplier/order.production_start') . '</label>',
            'production_end' => '<label class="badge badge-success">' . __('supplier/order.production_end') . '</label>',
            'to_transit' => '<label class="badge badge-info">' . __('supplier/order.to_transit') . '</labeel>',
            'order_sent' => '<label class="badge badge-warning">' . __('supplier/order.order_sent') . '</label>',
            'boarding' => '<label class="badge badge-info">' . __('supplier/order.boarding') . '</label>'
        ];
        $currency = Setting::getCurrency()->data;
        
        return view('admin.orders')->with( compact('orderPerFiliales', 'orderPerSupplier', 'currency') );
    }

    public function download(Supplier $supplier){
        return Excel::download(new OrderExport($supplier), 'Orders'.$supplier->company.'.xlsx');
    }

    public function downloadPerFiliale(Order $order){
        return Excel::download(new OrderByFilialeExport($order), 'Orders_filiale'.$order->filiale->name.'.xlsx');
    }

    public function display(Supplier $supplier, Request $request){

        $orders = OrderItem::where("supplier_id", $supplier->id)->get();
        $currency = Setting::getCurrency()->data;

        return view('admin.order_detail')->with( compact('orders', 'supplier', 'currency') );
    }

    public function displayByOrder(Order $order, Request $request){
        $orders = OrderItem::where("order_id", $order->id)->get();
        $currency = Setting::getCurrency()->data;
        return view('admin.order_detail')->with( compact('orders', 'currency', 'order') );
    }

    public function supplier(supplier $supplier){
        $orderBySupplier = Order::where("supplier", '=', $supplier->id)->get();
        $firstStatut = ( $o = Order::where("supplier", "=", $supplier->id)->first() ) ? $o->status : "";
        return view('admin.supplier_orders')->with(compact("orderBySupplier", "supplier", "firstStatut"));
    }

    public function supplierDownloadOrder(supplier $supplier){
        return (new OrderBySupplierExport($supplier->id))->download('SupplierOrder.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function filiale(Request $request, Filiale $filiale){
        if($request->isMethod("POST")){
            $order = Order::where("id", $request->order);
            $order->update([
                'isblocked' => ($request->type == 'lock')? true: false
            ]);

            $message=__("supplier/order.order_status_modification_unlock");
            if(!$order->first()->isblocked){
                $message=__('supplier/order.order_status_modification', ['var' => __('supplier/order.'.$request->input("value"))]);
            }
            
            $args = [
                'title' => __('supplier/order.status_change_title'),
                'link' => route('supplier.order.display', $order->first()),
                'body' => $message
            ];
            
            $orderItems=OrderItem::where("order_id", $request->order)->get();

            $suppliers=array();

            foreach($orderItems as $item){
                $suppliers[] = $item->Supplier->User->email;
            }
                     
            \Mail::to($suppliers)->send(new \App\Mail\OrderNotification($args));

            $var = 'débloquée';
            if($request->type == 'lock') $var='bloquée';

            return redirect()->back()->with('success', __('common.order_unblock', ['var'=>$var]));
        }
        $order = Order::where("filiale_id", "=", $filiale->id)->first();
        $orderByFiliale = $order->Items()->get();
        $currency = Setting::getCurrency()->data; 
        $comments = Comment::where('type','order')->where('type_id',$order->id)->orderby('created_at','desc')->paginate(20);

        return view('admin.filiale_orders')->with( compact('orderByFiliale', 'filiale', 'order','currency','comments') );
    }

    public function message(Request $request, Order $order){
        if($request->isMethod('POST')){
            // Triggle the submiting form here
            $this->validate($request, [
                'message' => 'required'
            ]);

            Comment::create([
                'type_id' => $order->id,
                'user_id' => Auth::user()->id,
                'comment' => $request->message,
                'type' => 'order',
            ]);

            return redirect()->back()->with('success', __('common.created'));
        }
    }
}
