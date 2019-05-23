<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class VoterMiddleware
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
        // dd($request->session()->has('voter'));
        if(!Session::has('voter'))
            // dd(!$request->session()->has('voter'));
            return redirect('/voting/votes');
        return $next($request);
        
    }
}
