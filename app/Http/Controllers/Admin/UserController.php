<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Filiale;
use App\Models\Company;
use App\Models\Direction;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Display a listing of all the available users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status', 'active')
        ->whereIn('role', ['admin','user'])
        ->where('id')
        ->orderby('created_at','desc')->paginate(10);

        return view('admin.accounts')->with( compact('users') );
    }


    /**
     * Add a user in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        if($request->isMethod('GET')){
            $user = new User();
            $user->status = 'active';
            $title = __('admin/setting.add_user');
            $filiales = Filiale::where('status', true)->get();
            $permissions = Permission::where('status', true)->get();
            $directions = Direction::where('status', true)->get();

            return view('admin.user')->with( compact('user', 'title', 'filiales', 'permissions','directions') );
        }

        $this->validate($request, [
                'name' => 'required',
                'lastname' => 'required',
                'role' => 'required|in:admin,user',
                'email' => 'required|email|unique:users,email',
                'filiale_id' => 'required|exists:filiales,id',
                'status' => 'required|in:active,inactive',
                'fonction' => 'required',
                'phone' => 'required|unique:users,phone',
            ]
        );

        $params = $request->all();
        $params['token'] = hash('sha256', Str::random(50));
        $user = User::create($params);

        Company::create([
            'user_id' => $user->id,
            'fonction' => $request->fonction,
            'filiale_id' => $request->filiale_id
        ]);

        $detail = [
            'title' => __('email.set_pwd'),
            'body' => __('email.set_pwd_msg'),
            'link' => route('password.confirm', $user->id),
            'user' => $user->fullname,
        ];
       
        Mail::to($request->email)->send(new \App\Mail\Password($detail));

        return redirect()->route('admin.accounts')->with('success', __('common.created'));
    }

    /**
     * Update a user in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request){

		if($request->isMethod('POST')){
            
            $this->validate($request, [
                    'name' => 'required',
                    'lastname' => 'required',
                    'role' => 'required|in:admin,user',
                    'email' => 'required|email',
                    'filiale_id' => 'required|exists:filiales,id',
                    'status' => 'required|in:active,inactive',
                    'fonction' => 'required',
                    'phone' => 'required',
                ]
            );
            
            $params = $request->all();
            $user->update($params);
            $company = $user->Company;
            $company->update($params);

            return redirect()->route('admin.accounts')->with('success', __('common.updated'));
		}else{
            $title = __('admin/setting.edit_user');
            $filiales = Filiale::where('status', true)->get();
            $permissions = Permission::where('status', true)->get();
            $directions = Direction::where('status', true)->get();

			return view('admin.user')->with( compact('user','title', 'filiales','permissions','directions') );
		}
    }

    /**
     * Remove a user from the viewable list.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(user $user){

        if($user->id == 1){
            return redirect()->route('admin.accounts');
        }
        $user->update(['status' => 'deleted','email'=>$user->email.date('ymdHis')]);

        return redirect()->route('admin.accounts')->with('success', __('common.deleted'));
    }
}
