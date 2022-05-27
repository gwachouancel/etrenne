<?php

namespace App\Http\Middleware;

use Closure;

class Availaibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !\App\Models\Setting::where('slug', 'platform')->first()->data ){
            return redirect()->route('403');
        }

        return $next($request);
    }
}
