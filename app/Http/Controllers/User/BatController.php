<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bat;
use App\Models\Filiale;
use App\Models\Supplier;
use App\Models\Document;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class BatController extends Controller
{
    //

    public function index(Request $request)
    {
        $suppliers = Supplier::all();
        $filiale_id = auth()->user()->filiale_id;
        $supplier_id = $request->get('supplier');

        if( $supplier_id && $request->isMethod('post')  ){
            $bats = Bat::wherehas('order',function($q) use($supplier_id){
                return $q->where('supplier_id',$supplier_id);
            })->paginate(15);
        }else{
            $bats = Bat::paginate(15);
        }
        
        $supplier = Supplier::find($supplier_id) ?? new Supplier();
        return view('admin.bat')->with( compact('bats', 'suppliers','supplier') );
    }

}
