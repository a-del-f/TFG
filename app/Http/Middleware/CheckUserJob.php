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
    public function handle(Request $request, Closure $next, ...$jobs): Response
    {
        $userRoles = auth()->check() ? auth()->user()->jobs->pluck('name')->toArray() : [];

        $allowed = false;
        foreach ($jobs as $job) {
            if (in_array($job, $userRoles)) {
                $allowed = true;
                break;
            }
        }

        if (!$allowed) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
