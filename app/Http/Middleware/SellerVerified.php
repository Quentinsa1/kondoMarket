<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('seller.login')
                ->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        $user = auth()->user();
        
        if (!$user->vendor) {
            return redirect()->route('vendor.register.form')
                ->with('error', 'Vous devez créer un profil vendeur pour accéder à cette page.');
        }

        $vendor = $user->vendor;
        
        // Vérifier le statut du vendeur
        if ($vendor->status === 'pending') {
            return redirect()->route('vendor.register.success')
                ->with('info', 'Votre compte est en cours de vérification. Vous serez notifié par email une fois approuvé.');
        }

        if ($vendor->status === 'rejected') {
            return redirect()->route('home')
                ->with('error', 'Votre compte vendeur a été rejeté. Contactez le support pour plus d\'informations.');
        }

        if ($vendor->status === 'suspended') {
            return redirect()->route('home')
                ->with('error', 'Votre compte vendeur est suspendu. Raison : ' . ($vendor->suspension_reason ?: 'Non spécifiée'));
        }

        // Vérifier si l'email est vérifié
       /*  if (!$user->hasVerifiedEmail()) {
            return redirect()->route('seller.verify-email')
                ->with('warning', 'Veuillez vérifier votre adresse email avant de continuer.');
        } */

        return $next($request);
    }
}