<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;

class CatalogController extends Controller
{
    //
    public function index(Catalog $catalog)
    {
        $catalogs = Catalog::where("user_id", Auth::user()->id)->paginate(20);
        return view('user.catalog')->with( compact('catalogs', 'catalog') );
    }
}
