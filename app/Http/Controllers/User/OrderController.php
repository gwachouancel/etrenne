<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;
use App\Exports\OrderUserExport;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Comment;
use App\Models\Catalog;
use App\Models\OrderItem;
use App\Models\Bat;
use App\Models\Setting;
use App\Models\Document;
use App\Models\User;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->isMethod("POST") && !Order::where("filiale_id", Auth::user()->filiale_id)->first()){
            
            if((time() - strtotime(\App\Models\Setting::where('slug', 'date')->first()->data)) > 0){
                return redirect()->route('user.orders')->with('error', __('common.order_delay'));
            } else {
                Order::create([
                    'status' => 'production_start',
                    'user_id' => Auth::user()->id,
                    'filiale_id' => Auth::user()->filiale_id,
                    'isbloacked' => false
                ]);
            }
        }
        $orders = Order::where("filiale_id", Auth::user()->filiale_id)->orderby('created_at', 'DESC')->first();
        $currency = Setting::getCurrency()->data;
        $suppliers = Supplier::all();
        $filiale = Auth::user()->getFilialeNameAttribute();
        $references = array(); //Catalog::getOnlyReferences();
        $comments = Comment::where("user_id", Auth::user()->id)->orderby("created_at", "DESC")->get();
        return view('user.order')->with( compact('orders', 'filiale', 'suppliers', 'comments', 'references', 'currency') );
    }

    public function new(Request $request){

        if($request->isMethod("POST")){

            // Check an order exists or not
            $order = Order::where("filiale_id", "=", Auth::user()->filiale_id)->first();

            if((time() - strtotime(\App\Models\Setting::where('slug', 'date')->first()->data)) > 0){
                return redirect()->route('user.order.display', $order)->with('error', __('common.order_delay'));
            }

            if($order && $order->isblocked == 1){
                return redirect()->route('user.order.display', $order)->with('error', __('common.order_user_is_blocked'));
            }

            if(!$order){
                $order = Order::create([
                    'status' => 'production_start',
                    'user_id' => Auth::user()->id,
                    'filiale_id' => Auth::user()->getFilialeIdAttribute()
                ]);
            }

            $this->validate($request, [
                'ref_catalog' => 'required',
                'ref_product' => 'required',
                'type' => 'required',
                'product_name' => 'required',
                'page' => 'required|numeric',
                'quantity' => 'required|numeric',
                'price' => 'required',
                'supplier' => 'required|exists:suppliers,id'
            ]);

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'ref_catalog' => $request->ref_catalog,
                'ref_product' => $request->ref_product,
                'type' => $request->type,
                'product_name' => $request->product_name,
                'page' => $request->page,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'supplier_id' => $request->supplier,
                'currency' => Setting::getCurrency()->data
            ]);
            if( !($bat = Bat::where('ref_product', $request->ref_product)->first() )){
                
                Bat::create([
                    'ref_product' => $request->ref_product,
                ]);
            }

            $args = [
                'title' => __('supplier/order.order_notification_title'),
                'fullname' => "",
                'link' => route('supplier.order.display', $orderItem->order_id),
                'body' => __('supplier/order.order_notification')
            ];

            $admin = User::select('email')->where('role', '=', 'admin')->get()->all();
            try{
                Mail::to($admin)->send(new \App\Mail\OrderNotification($args));
            } catch(IException $o) {
                // Laravel::log();
            }
            return redirect()->route('user.order.display', $order)->with('success', __('common.created'));
        }
    }

    public function download(Order $order){
        //$orders = Order::where("ref_catalog", $order->ref_catalog)->where("supplier", Auth::user()->supplier->id)->get();
        return Excel::download(new OrderUserExport($order), 'Commande.xlsx');
    }

    public function display(Order $order, Request $request){
        if($request->isMethod("POST")){
            // Handle the message submission here
            $this->validate($request, [
                'message' => 'required',
            ]);
        }

        // Send 404 error if user requests orders that do not belong to it's filiale
        if($order->filiale_id !== Auth::user()->filiale_id)
            return view('404');

        $suppliers = Supplier::all();
        $filiale = Auth::user()->getFilialeNameAttribute();
        $references = array(); //Catalog::getOnlyReferences();
        $comments = Comment::where("user_id", Auth::user()->id)->orderby("created_at", "DESC")->get();
        $orders = $order->Items()->where("order_id", $order->id)->orderby("created_at", "DESC")->get();
        $comments = Comment::where("type_id", $order->id)->where("type", "=", "order")->orderby("created_at", "DESC")->get();
        $currency = Setting::getCurrency()->data;

        return view('user.order_detail')->with( compact('orders', 'order', 'comments', 'suppliers', 'references', 'currency') );
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

            return redirect()->route('user.order.display', $order)->with('success', __('common.created'));
        }
    }

    public function edit(Request $request, Order $order, OrderItem $orderitem){
        if($request->isMethod('POST')){

            if($order->isblocked == 1){
                return redirect()->route('user.order.display', $order)->with('error', __('common.order_user_is_blocked'));
            }

            $this->validate($request, [
                'ref_catalog' => 'required',
                'ref_product' => 'required',
                'type' => 'required',
                'product_name' => 'required',
                'page' => 'required|numeric',
                'quantity' => 'required|numeric',
                'price' => 'required',
                'supplier_id' => 'required|exists:suppliers,id'
            ]);

            $params = $request->all();
            $params['currency'] = Setting::getCurrency()->data;
            $orderitem->update($params);

            return redirect()->route('user.order.display', $order)->with('success', __('common.created'));
            
        }
        $suppliers = Supplier::all();
        $filiale = Auth::user()->getFilialeNameAttribute();
        $references = Catalog::getOnlyReferences();
        $comments = Comment::where("user_id", Auth::user()->id)->orderby("created_at", "DESC")->get();
        $orders = $order->Items()->where("order_id", $order->id)->orderby("created_at", "DESC")->get();
        $comments = Comment::where("type_id", $order->id)->where("type", "=", "order")->orderby("created_at", "DESC")->get();
        $currency = Setting::getCurrency()->data;
        return view('user.edit_item')->with( compact('orderitem', 'orders', 'order', 'comments', 'references', 'suppliers'));
    }

    public function delete(OrderItem $orderitem){
        if(Order::where('id', $orderitem->order_id)->first()->isblocked == 1){
            return redirect()->route('user.order.display', $order)->with('error', __('common.order_user_is_blocked'));
        }
        
        $orderitem->delete();
        return redirect()->route('user.order.display', $orderitem->order_id)->with('success', __('common.created'));
    }

    public function getCatalogBySupplier(Request $request){
        if($request->isMethod("POST")){
            $this->validate($request, [
                'supplier' => 'required|exists:suppliers,id'
            ]);

            $Catalogs = Catalog::where("supplier_id", $request->supplier)->pluck('ref_catalog', 'id');

            return response()->json($Catalogs);
        }
    }
}
