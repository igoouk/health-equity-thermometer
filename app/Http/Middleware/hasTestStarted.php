<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hasTestStarted
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
        
        if (session()->get('current-level') != null) { 
            $level = session()->get('current-level');
            return redirect('/quiz/'.$level);
        }

        return $next($request);
    }
}
