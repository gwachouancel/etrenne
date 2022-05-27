<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CommonController extends Controller
{
    /**
     * Setting shipping document
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accounts(Request $request)
    {   

        $users = User::whereIn('role', ['admin','user'])
        ->whereIn('status', ['active','inactive'])
        ->where('id', '<>', 1)
        ->orderby('created_at','desc')->paginate(15);
        
        $suppliers = User::where('role', 'supplier')
        ->whereIn('status', ['active','inactive'])
        ->orderby('created_at','desc')->paginate(15);

        return view('admin.accounts')->with(compact('suppliers','users'));
    }

}
