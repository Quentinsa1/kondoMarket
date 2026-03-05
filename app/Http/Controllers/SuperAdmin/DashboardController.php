<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Statistiques des cartes ---
        $stats = [
            'users_total' => User::count(),
            'vendors_active' => Vendor::where('status', 'approved')->count(), // ou 'active' selon votre statut
            'products_total' => Product::count(),
            'products_active' => Product::where('status', 'active')->count(),
            //'revenue_total' => Order::where('status', 'completed')->sum('total_amount'), // ou 'paid'
            'vendors_pending' => Vendor::where('status', 'pending_review')->count(),
        ];

        // --- Données pour les graphiques ---
        $currentYear = date('Y');
        
        // Ventes mensuelles (commandes complétées)
       /*  $salesData = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', $currentYear)
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
 */
        // Remplir les 12 mois avec des valeurs par défaut (0)
       /*  $salesMonthly = [];
        for ($m = 1; $m <= 12; $m++) {
            $salesMonthly[] = $salesData[$m] ?? 0;
        }

        // Inscriptions mensuelles (utilisateurs)
        $regData = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $regMonthly = [];
        for ($m = 1; $m <= 12; $m++) {
            $regMonthly[] = $regData[$m] ?? 0;
        } */

        // --- Nouveaux vendeurs (5 derniers) ---
        $recentVendors = Vendor::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($vendor) {
                return (object) [
                    'name' => $vendor->company_name ?? $vendor->display_name ?? $vendor->user->name,
                    'created_at' => $vendor->created_at,
                    'status' => $vendor->status,
                ];
            });

        return view('superadmin.dashboard.index', compact(
            'stats',
            'recentVendors',
            'currentYear'
        ));
    }
}