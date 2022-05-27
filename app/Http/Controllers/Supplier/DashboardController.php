<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Bat;
use App\Models\Catalog;
use App\Models\Document;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $supplier_id = auth()->user()->supplier->id;

        $batCompleted = Bat::where('status','approuved')
        ->whereHas('order',function($q) use($supplier_id){
            return $q->where('supplier_id', $supplier_id);
        })->count();

        $batPending = Bat::whereHas('order',function($q) use($supplier_id){
            return $q->where('supplier_id', $supplier_id);
        })->where('status','pending')->count();

        $batCount = Bat::whereHas('order',function($q) use($supplier_id){
            return $q->where('supplier_id', $supplier_id);
        })->count();

        $cmds = Order::whereHas('items',function($q) use($supplier_id){
            return $q->where('supplier_id', $supplier_id);
        })->get()->count();

        $orders = Order::whereHas('items',function($q) use($supplier_id){
            return $q->where('supplier_id',$supplier_id);
        })->orderBy('created_at','desc')->paginate(5);

        $catalogs = Catalog::orderBy('created_at','desc')
        ->where('supplier_id', $supplier_id)->paginate(5);
        
        $documents = Document::where('user_id', $supplier_id)
        ->whereIn('type',['expedition','bill'])->paginate(5);

        return view('supplier.dashboard')->with( compact('orders','catalogs','batCompleted','batCount','batPending','cmds','documents') );
    }
}