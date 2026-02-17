<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSellerApproved
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            return redirect()->route('seller.dashboard');
        }

        // Compte rejeté
        if ($vendor->status === 'rejected') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Votre compte vendeur a été rejeté.');
        }

        // Compte suspendu
        if ($vendor->status === 'suspended') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Votre compte vendeur est suspendu.');
        }

        // Compte en attente → pas accès aux ventes
        if ($vendor->status === 'pending') {
            return redirect()->route('seller.dashboard')
                ->with('warning', 'Votre compte est en cours de validation.');
        }

        // approved
        return $next($request);
    }
}
