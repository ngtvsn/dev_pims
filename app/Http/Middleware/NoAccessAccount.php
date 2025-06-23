<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoAccessAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if( is_null(Auth::user()->status_type_id) )
        {
            return redirect('pages/no-access');
        }
        elseif(Auth::user()->status_type_id == 2 )
        {
            return redirect('pages/inactive-account');
        }else{
            return $next($request);
        }
        
    }
}
