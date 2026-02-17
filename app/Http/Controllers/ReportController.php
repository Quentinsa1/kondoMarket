<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Afficher le formulaire de signalement (GET)
     */
    public function create(Request $request)
    {
        $prefilled = [
            'type' => $request->input('type', 'general'),
            'target_id' => $request->input('target_id'),
            'target_name' => $request->input('target_name'),
        ];
        
        return view('report.create', [
            'prefilled' => $prefilled,
            'pageTitle' => 'Signaler un abus - Kondo Market',
            'metaDescription' => 'Signalez un contenu inapproprié, une fraude ou un comportement abusif sur Kondo Market.',
        ]);
    }
    
    /**
     * Traiter le signalement (POST)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:fraud,spam,inappropriate,counterfeit,harassment,other',
            'target_type' => 'required|in:product,vendor,user,general',
            'target_id' => 'nullable|integer',
            'target_name' => 'nullable|string|max:255',
            'description' => 'required|string|min:20|max:1000',
            'evidence' => 'nullable|string|max:2000',
            'contact_email' => 'nullable|email',
            'urgency' => 'required|in:low,medium,high',
            'consent' => 'required|accepted',
        ]);
        
        // Ici, vous enregistrerez le signalement en base de données
        $reportId = 'RPT-' . date('Ymd') . '-' . rand(1000, 9999);
        
        return redirect()->route('report.thankyou', ['id' => $reportId])
            ->with('success', 'Signalement envoyé avec succès.');
    }
    
    /**
     * Signaler un produit spécifique (POST)
     */
    public function reportProduct(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);
        
        // Traitement du signalement de produit
        // ...
        
        return redirect()->back()
            ->with('success', 'Produit signalé avec succès.');
    }
    
    /**
     * Signaler un vendeur spécifique (POST)
     */
    public function reportVendor(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);
        
        // Traitement du signalement de vendeur
        // ...
        
        return redirect()->back()
            ->with('success', 'Vendeur signalé avec succès.');
    }
    
    /**
     * Signaler un utilisateur (POST)
     */
    public function reportUser(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);
        
        // Traitement du signalement d'utilisateur
        // ...
        
        return redirect()->back()
            ->with('success', 'Utilisateur signalé avec succès.');
    }
    
    /**
     * Page de remerciement (GET)
     */
    public function thankyou($id)
    {
        return view('report.thankyou', [
            'reportId' => $id,
            'pageTitle' => 'Signalement envoyé - Kondo Market',
            'metaDescription' => 'Merci d\'avoir signalé cet abus.',
        ]);
    }
}