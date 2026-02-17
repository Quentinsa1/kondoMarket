<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerApproved
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if (!$user || !$user->vendor) {
            return redirect()->route('seller.login');
        }

        if ($user->vendor->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Votre compte doit être approuvé pour accéder à cette fonctionnalité.');
        }

        return $next($request);
    }
}