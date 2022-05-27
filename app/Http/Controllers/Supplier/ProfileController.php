<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //

    public function profile(Request $request)
    {
        $user = auth()->user();
        if( $request->isMethod('get') ){
            return view('supplier.profile')->with( ['user' => $user]);
        }

        $this->validate($request, [
                'name' => 'required',
                'lastname' => 'required',
                'company' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]
        );

        $params = $request->except('password');

        if( $request->get('password') ){
                $this->validate($request, [
                    'password' => 'min:12|confirmed',
                    'password_confirmation' => 'min:12|required_with:password|same:password'
                ]
            );
            $params['password'] = Hash::make( $request->get('password') );
        }
        
        $user->update($params);
        $supplier = $user->Supplier;
        $supplier->update($params);

        return redirect()->back()->with('success', __('common.updated'));
    }

}