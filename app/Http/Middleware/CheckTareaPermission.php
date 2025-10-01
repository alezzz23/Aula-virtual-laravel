<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTareaPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->enviar_tareas || auth()->user()->isProfesor() || auth()->user()->isAdmin()) {
            return $next($request);
        }
        
        abort(403, 'No tienes permiso para enviar tareas.');
    }
}

