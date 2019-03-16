<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Auth;

class Unauthorized

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
        if(!auth()->guest()){
            if ($request->user() && $request->user()->type == 'admin')
            {
                return redirect()->route('home-admin');
            }
            else if($request->user() && $request->user()->type == 'pegawai'){
                return redirect()->route('home-pegawai');
            }
        }

        return $next($request);
    }
}
