<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <--- To jest kluczowe!

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Czy użytkownik jest w ogóle zalogowany?
        if (!Auth::check()) {
            abort(403, 'Musisz być zalogowany.');
        }

        // 2. Czy zalogowany użytkownik ma uprawnienia admina?
        // Edytor może tutaj podkreślać "is_admin", ale to zadziała.
        if (Auth::user()->is_admin != 1) {
            abort(403, 'Brak dostępu. Tylko dla Administratora.');
        }

        return $next($request);
    }
}