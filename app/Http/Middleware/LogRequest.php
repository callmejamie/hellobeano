<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class LogRequest
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
        //Log::info('test: ' . print_r($request, true));
        
        return $next($request);
    }
}
