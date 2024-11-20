<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Config; 
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DatabaseFallback
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            DB::connection('mysql')->getPdo();
        } catch (\Exception $e) {
            Config::set('database.default', 'sqlite');
        }

        return $next($request);
    }
}
