<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistiques clés
        $stats = [
            'total_vendors'      => Vendor::count(),
            'pending_vendors'    => Vendor::where('status', 'pending_review')->count(),
            'approved_vendors'   => Vendor::where('status', 'approved')->count(),
            'suspended_vendors'  => Vendor::where('status', 'suspended')->count(),
            'total_products'     => Product::count(),
            'active_products'    => Product::where('status', 'active')->count(),
            'inactive_products'  => Product::where('status', 'inactive')->count(),
            'orders_today'       => Order::whereDate('created_at', today())->count(),
            'total_orders'       => Order::count(),
            'total_revenue'      => Order::where('status', 'completed')->sum('total_amount') ?? 0,
            'pending_reports'    => Report::where('status', 'pending')->count(),
        ];

        // Activités récentes
        $recent_vendors = Vendor::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recent_reports = Report::with('reporter')
            ->latest()
            ->take(5)
            ->get();

        $recent_orders = Order::with('vendor')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_vendors', 'recent_reports', 'recent_orders'));
    }
}