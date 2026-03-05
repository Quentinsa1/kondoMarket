<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $vendors = Vendor::latest()->paginate(10);
        $products = Product::latest()->paginate(10);

        return view('admin.dashboard.index', compact('vendors', 'products'));
    }

    /**
     * Valider un vendeur
     */
    public function approveVendor($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = 'approved';
        $vendor->save();

        return redirect()->back()->with('success', 'Vendeur approuvé avec succès.');
    }

    /**
     * Rejeter un vendeur
     */
    public function rejectVendor($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = 'rejected';
        $vendor->save();

        return redirect()->back()->with('success', 'Vendeur rejeté.');
    }

    /**
     * Valider un produit
     */
    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'approved';
        $product->save();

        return redirect()->back()->with('success', 'Produit approuvé.');
    }

    /**
     * Rejeter un produit
     */
    public function rejectProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'rejected';
        $product->save();

        return redirect()->back()->with('success', 'Produit rejeté.');
    }
}