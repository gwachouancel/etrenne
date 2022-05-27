<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MarketPlaceController extends Controller
{
    //
    public function index(){
        $catalogs = Catalog::orderby('created_at', 'DESC')->paginate(20);
        return view('admin.marketplace')->with( compact('catalogs') );
    }

    public function download(Catalog $catalog){
        return \Storage::download($catalog->path, $catalog->ref_catalog . $catalog->name);
    }
}