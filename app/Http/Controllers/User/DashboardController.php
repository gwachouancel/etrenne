<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bat;
use App\Models\Order;
use App\Models\Catalog;
use App\Models\Document;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {
       // $user_id = auth()->id();
       $filiale_id = auth()->user()->filialeid;

        $batCompleted = Bat::where('status','approuved')
        ->whereHas('order', function($query) use($filiale_id){
            return $query->whereHas('order', function($q) use($filiale_id){
                return $q->where('filiale_id', $filiale_id);
            });
        })->count();

        $batPending = Bat::where('status','pending')
        ->whereHas('order', function($query) use($filiale_id){
            return $query->whereHas('order', function($q) use($filiale_id){
                return $q->where('filiale_id', $filiale_id);
            });
        })->count();

        $batCount = Bat::whereHas('order', function($query) use($filiale_id){
            return $query->whereHas('order', function($q) use($filiale_id){
                return $q->where('filiale_id', $filiale_id);
            });
        })->count();

        $cmds = Order::where('filiale_id', $filiale_id)
        ->get()->count();

        $completed = Order::whereIn('status', ['production_end','to_transit'])
        ->where('filiale_id', $filiale_id)
        ->count();

        $confirmed = Order::where('filiale_id', $filiale_id)
        ->get()->where('confirmed',true)->count();

        $lastOrder = Order::where('filiale_id', $filiale_id)
        ->orderBy('created_at','desc')->paginate(5);
        
        $lastCatalog = Catalog::orderBy('created_at','desc')->paginate(5);
        $documents = Document::whereIn('type',['expedition','bill'])->paginate(5);

        return view('admin.dashboard')->with( compact('completed','confirmed','cmds','batCompleted','batPending','batCount','lastOrder','lastCatalog','documents') );
    }

}
