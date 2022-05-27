<?php

namespace App\Http\Controllers\Auth;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $user = auth()->user();

        if(!Setting::where('slug','platform')->first()->data && $user->role != 'admin' ){

            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', __('admin/setting.platform_restricted'));
        }

        if( $user->status != 'active' ){

            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Compte Inactif ou inexistant. Veuillez contacter votre administrateur');
        }

        $request->session()->regenerate();

        /*$role = 'supplier';
        if( auth()->user()->role != 'supplier') $role = 'admin';*/

        $route = route(auth()->user()->role.'.dashboard');

        return redirect()->intended($route);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', __('auth.logedOut'));
    }

    public function contact(Request $request){

        \Mail::raw($request->message, function($message){
            $message->to(env('ORA_MAIL'));
        });

        return redirect()->back()->with('success', 'Message envoyé a OraGroup');
    }
}
