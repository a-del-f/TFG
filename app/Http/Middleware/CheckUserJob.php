<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserJob
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$job): Response
    {
        $job_necesarios = explode(',', $job);

        if (! auth()->check() || !in_array(auth()->user()->jobs->name,$job_necesarios) ) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
