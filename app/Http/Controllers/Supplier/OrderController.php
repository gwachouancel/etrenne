<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Support\Facades\Mail;
use App\Exports\OrderExport;
use App\Exports\OrderBySupplierExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Comment;
use App\Models\User;
use App\Models\Setting;
use Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderby("created_at", "DESC")->get();
        $output = "";
        $array_status = [
            'production_start' => '<label class="badge badge-warning">' . __('supplier/order.production_start') . '</label>',
            'production_end' => '<label class="badge badge-success">' . __('supplier/order.production_end') . '</label>',
            'to_transit' => '<label class="badge badge-info">' . __('supplier/order.to_transit') . '</labeel>',
            'order_sent' => '<label class="badge badge-warning">' . __('supplier/order.order_sent') . '</label>',
            'boarding' => '<label class="badge badge-info">' . __('supplier/order.boarding') . '</label>'
        ];
        $currency = Setting::getCurrency()->data;

        foreach($orders as $order){
            
            $items = OrderItem::where("order_id", $order->id)
            ->where("supplier_id", Auth::user()->Supplier->id)->get();

            if(count($items) == 0) continue;

            $status = key_exists($order->status, $array_status) ? $array_status[$order->status] : "";
            
            $total = 0;

            foreach($items as $item){
                $total += $item->price * $item->quantity;
            }

            $output .="<tr>";
            $output .="<td># $order->id</td>";
            $output .="<td><a class='link-green-ora' href='#'>" . $order->Filiale->name ."</a></td>";
            $output .="<td>" . date("d F Y", strtotime($order->created_at)) . "</td>";
            $output .="<td>" . $status ."</td>";
            $output .="<td>" . \App\Library\FormatNumber::setNumberFormat($total) ."</td>";
            $output .="<td>
                <a href=" . route('supplier.order.download', $order) ." title='Telecharger la commande'><i class='mdi mdi-download fa-2x text-info-ora icon-sm'></i> </a>
                    <a href=" . route('supplier.order.display', $order) ." title='Details de la commande'><i class='mdi mdi-eyes fa-2x text-info-ora icon-sm'></i> </a>
                </td>";
            $output .="</tr>";
        }
        return view('supplier.orders')->with( compact('output', 'currency') );
    }

    public function display(Order $order, Request $request){
        $orders = OrderItem::where("order_id", $order->id)->where("supplier_id", Auth::user()->Supplier->id)->get();
        $comments = Comment::where("type_id", $order->id)->where("type", "order")->orderby('created_at','desc')->paginate(20);
        $currency = Setting::getCurrency()->data;

        return view('supplier.order_detail')->with( compact('orders', 'order', 'comments') );
    }

    public function download(Order $order){
        return Excel::download(new OrderBySupplierExport($order), "MesCommandes" . $order->filiale->name . ".xlsx");
    }

    // Get status of a given order
    public function getOrderStatus(Request $request, Order $order){
       
        if($request->isMethod("POST") && Auth::user()->supplier->id == OrderItem::where("order_id", $order->id)->first()->supplier_id){
            
            if($order->isblocked){
                return response()->json(['status' => 'failed', 'data' => __('common.order_blocked')]);
            }
            $status = $request->input('value');

            if($status == 'production_start') {
                $items=OrderItem::select('id')->where("order_id", $order->id)->get();
                foreach($items as $item) {
                    $count=$item->Order()->where("orderitem_id", $item->id)->where('status', '<>', 'approuved')->count();
                    if($count>0){
                        return response()->json(['status' => 'failed', 'data' => 'Tous les BATS doivent être validés']);
                    }
                }
            }
            Order::where("id", $order->id)
            ->update(
                [
                    'status' => $request->input('value')
                ]);

                // Retrouver tous les users admin de la filiale
                $emails = User::where('role', '=', 'admin')->get();

                $filtered = $emails->reject(function($value){
                    if($value->getFilialeIdAttribute() != null)
                    return $value->getFilialeIdAttribute() != $order->filiale_id;
                })->map(function($email){
                    return [
                        'email' => $email->email
                    ];
                });

                $filtered->all();

                $args = [
                    'title' => __('supplier/order.status_change_title'),
                    'fullname' => Auth::user()->name . " ". Auth::user()->lastname,
                    'link' => route('user.order.display', $order),
                    'body' => __('supplier/order.order_status_modification', ['var' => __('supplier/order.'.$request->input("value"))])
                ];
                         
                Mail::to($filtered)->send(new \App\Mail\OrderNotification($args));

                return response()->json(['status' => 'done', 'data' => $order->status]);
        }
    }

    public function message(Request $request, Order $order){
        if($request->isMethod('POST')){

            if($order->isblocked){
                return response()->json(['status' => 'error', 'data' => __('common.order_blocked')]);
            }
            
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