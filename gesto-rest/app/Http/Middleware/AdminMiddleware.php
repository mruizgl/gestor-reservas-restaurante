<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Middleware propio en el que solo tiene acceso el administrador
     * @author Melissa y Noelia
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acceso no autorizado.');
        }
        return $next($request);
    }
}
