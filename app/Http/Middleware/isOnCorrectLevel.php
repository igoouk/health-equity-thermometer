<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isOnCorrectLevel
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
        $level = $request->level;
        if (session()->get('current-level') != null) { 
            if (session()->get('current-level') != $level) {
                $level = session()->get('current-level');
                return redirect('/quiz/'.$level);
                
            }
        }else{
            session(['current-level' => 1]);
            return redirect('/quiz/1');
            
            
            
        }
        return $next($request);
    }
}
