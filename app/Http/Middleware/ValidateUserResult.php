<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Http\Controllers\ResultController;

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
        if (request()->getRequestUri() == "/previous-results") {
            $requestedResult = ResultController::getPreviousResults();
    
                if(count($requestedResult) == 0) {
                    return redirect(url('/no-access'));
                }
        }else{
            if ($request->route("resultID") != null) {
                $requestedResult = Result::where("id", $request->route("resultID"))->first();
    
                if($requestedResult == null || $requestedResult->user_id  != session()->get('user-id')) {
                    return redirect(url('/no-access'));
                }
            }
        }
        
        


        return $next($request);
    }
}
