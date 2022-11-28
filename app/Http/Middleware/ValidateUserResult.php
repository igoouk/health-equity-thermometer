<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Result;

class ValidateUserResult
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

        $requestedResult = Result::where("id", $request->route("resultID"))->first();

        if($requestedResult->user_id  != session()->get('user-id')) {
            return redirect(url('/no-access'));
        }


        return $next($request);
    }
}
