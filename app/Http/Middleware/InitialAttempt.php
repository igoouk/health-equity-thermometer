<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Result;

class InitialAttempt
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

        $previousResult = Result::where("user_id", session()->get('user-id'))->first();

        if($request->id == 1 && $previousResult != null) {
            return redirect(url('/quiz/2'));
        }


        return $next($request);
    }
}
