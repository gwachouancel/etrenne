<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bat;
use App\Models\Order;
use App\Models\Catalog;
use App\Models\Setting;
use App\Models\Document;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {
        
        $batCompleted = Bat::where('status','approuved')->count();
        $batPending = Bat::where('status','pending')->count();
        $batCount = Bat::count();

        $cmds = Order::get()->count();
        $completed = Order::whereIn('status', ['production_end','to_transit'])->count();
        $confirmed = Order::get()->where('confirmed',true)->count();

        $lastOrder = Order::orderBy('created_at','desc')->paginate(5);
        $lastCatalog = Catalog::orderBy('created_at','desc')->paginate(5);
        $documents = Document::whereIn('type',['expedition','bill'])->paginate(5);

        return view('admin.dashboard')->with( compact('completed','confirmed','cmds','batCompleted','batPending','batCount','documents','lastOrder','lastCatalog') );
    }

}
