<?php

namespace sysvale\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApproverMiddleware
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

        if(Auth::user()->type === 'approver') {

            return $next($request);
        }else{

            return redirect("/home");
        }

    }
}
