<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Config; 
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

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
            // Verifica conexión a MySQL
            DB::connection('mysql')->getPdo();
        } catch (\Exception $e) {
            Log::warning('MySQL no disponible. Cambiando a SQLite.');
            Config::set('database.default', 'sqlite');
        }

        return $next($request);
    }
}
