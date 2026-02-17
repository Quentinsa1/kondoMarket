<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si connecté
        if (!auth()->check()) {
            return redirect()->route('seller.login')
                ->with('error', 'Veuillez vous connecter.');
        }

        $user = auth()->user();

        // Vérifier si profil vendeur existe
        if (!$user->vendor) {
            return redirect()->route('vendor.register.form')
                ->with('info', 'Vous devez créer un profil vendeur.');
        }

        return $next($request);
    }
}
