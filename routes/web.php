<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\superAdmin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\superAdmin\VendorController as AdminVendorController;
use App\Http\Controllers\superAdmin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth','role:super_admin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

Route::resource('admins', \App\Http\Controllers\SuperAdmin\AdminController::class)
    ->except(['show', 'edit', 'update']);
Route::get('admins/{id}/activities', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'activities'])
    ->name('admins.activities');
Route::post('admins/{id}/toggle-status', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'toggleStatus'])
    ->name('admins.toggle-status');

        // Gestion vendeurs
        Route::resource('vendors', AdminVendorController::class)->except(['create','store','edit']);
        Route::post('vendors/{id}/status', [AdminVendorController::class, 'updateStatus'])->name('vendors.status');

        // Gestion produits
        Route::resource('products', AdminProductController::class)->except(['create','store','edit']);
        Route::post('products/{id}/status', [AdminProductController::class, 'updateStatus'])->name('products.status');
    });

// Route d'accueil avec toutes les sections
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/help', [HomeController::class, 'help'])->name('help');

// Routes des catégories
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{categoryId}/subcategories/{subcategoryId}', [CategoryController::class, 'showSubcategory'])
        ->name('categories.subcategory');
});

// Routes des produits avec les sections spécifiques
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/trending', [ProductController::class, 'trending'])->name('products.trending');
    Route::get('/new-arrivals', [ProductController::class, 'newArrivals'])->name('products.new-arrivals');
    Route::get('/recommendations', [ProductController::class, 'recommendations'])->name('products.recommendations');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/category/{categoryId}', [ProductController::class, 'byCategory'])->name('products.by-category');
});

// Routes pour l'inscription avec type de vendeur
Route::get('/register/{type?}', [RegisterController::class, 'showRegistrationForm'])
    ->middleware('guest')
    ->name('register');

// Routes des vendeurs (inscription)
Route::prefix('vendor')->group(function () {
    Route::get('/register', [VendorController::class, 'showRegistrationForm'])->name('vendor.register.form');
    Route::post('/register', [VendorController::class, 'register'])->name('vendor.register');
    Route::get('/register/success', [VendorController::class, 'registrationSuccess'])->name('vendor.register.success');
});

// Routes d'authentification vendeur (public)
Route::prefix('seller')->group(function () {
    Route::get('/login', [VendorController::class, 'showLoginForm'])->name('seller.login');
    Route::post('/login', [VendorController::class, 'login'])->name('seller.login.submit');
    Route::post('/logout', [VendorController::class, 'logout'])->name('seller.logout');
    
    // Mot de passe oublié
    Route::get('/password/reset', [VendorController::class, 'showLinkRequestForm'])->name('seller.password.request');
    Route::post('/password/email', [VendorController::class, 'sendResetLinkEmail'])->name('seller.password.email');
    Route::get('/password/reset/{token}', [VendorController::class, 'showResetForm'])->name('seller.password.reset');
    Route::post('/password/reset', [VendorController::class, 'reset'])->name('seller.password.update');
});

// Routes de vérification de documents (après inscription)
Route::middleware(['auth'])->prefix('vendor')->group(function () {
    Route::get('/verify-documents', [VendorController::class, 'showVerifyDocuments'])->name('vendor.verify-documents');
    Route::post('/upload-documents', [VendorController::class, 'uploadDocuments'])->name('vendor.upload-documents');
});

// Routes du vendeur (nécessite authentification ET vérification)
Route::middleware(['auth', 'seller.verified'])->prefix('seller')->group(function () {
    // Tableau de bord et gestion
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/products', [VendorController::class, 'manageProducts'])->name('seller.products');
    Route::get('/orders', [VendorController::class, 'manageOrders'])->name('seller.orders');
    Route::get('/profile', [VendorController::class, 'editProfile'])->name('seller.profile');
    Route::get('/store-settings', [VendorController::class, 'storeSettings'])->name('seller.store-settings');
    Route::get('/store', [VendorController::class, 'storeSettings'])->name('seller.store');
    
    // Création de boutique (ancienne méthode)
    Route::get('/create-store', [VendorController::class, 'createStore'])->name('seller.create-store');
    Route::post('/create-store', [VendorController::class, 'storeStore'])->name('seller.store-store');
});



// Routes de recherche
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Routes du panier
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Routes du checkout
Route::middleware(['auth'])->prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Routes des pages statiques
Route::get('/about', function () {
    return view('pages.about', [
        'pageTitle' => 'À propos - Kondo Market',
        'metaDescription' => 'Découvrez Kondo Market, la plateforme de commerce en gros pour professionnels.'
    ]);
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact', [
        'pageTitle' => 'Contact - Kondo Market',
        'metaDescription' => 'Contactez notre équipe pour toute question concernant Kondo Market.'
    ]);
})->name('contact');

Route::get('/security', function () {
    return view('pages.security', [
        'pageTitle' => 'Sécurité - Kondo Market',
        'metaDescription' => 'Informations sur la sécurité des transactions et la protection des acheteurs.'
    ]);
})->name('security');

Route::get('/terms', function () {
    return view('pages.terms', [
        'pageTitle' => 'Conditions Générales - Kondo Market',
        'metaDescription' => 'Conditions Générales d\'Utilisation de Kondo Market.'
    ]);
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy', [
        'pageTitle' => 'Politique de Confidentialité - Kondo Market',
        'metaDescription' => 'Politique de Confidentialité de Kondo Market.'
    ]);
})->name('privacy');

// ===== ROUTES POUR SIGNALEMENTS D'ABUS =====
Route::prefix('report-abuse')->group(function () {
    Route::get('/', [ReportController::class, 'create'])->name('report.abuse');
    Route::post('/', [ReportController::class, 'store'])->name('report.abuse.store');
    Route::get('/thankyou/{id}', [ReportController::class, 'thankyou'])->name('report.thankyou');
    Route::post('/product/{id}', [ReportController::class, 'reportProduct'])->name('report.product');
    Route::post('/vendor/{id}', [ReportController::class, 'reportVendor'])->name('report.vendor');
    Route::post('/user/{id}', [ReportController::class, 'reportUser'])->name('report.user');
});



// Routes AJAX pour les fonctionnalités dynamiques
Route::middleware(['auth'])->group(function () {
    Route::post('/ajax/quick-view', [ProductController::class, 'quickView'])->name('ajax.quick-view');
    Route::post('/ajax/contact-seller', [VendorController::class, 'contactSeller'])->name('ajax.contact-seller');
    Route::post('/ajax/save-search', [HomeController::class, 'saveSearch'])->name('ajax.save-search');
});

// Routes de téléchargement
Route::get('/download/catalog/{id}', [ProductController::class, 'downloadCatalog'])->name('download.catalog');
Route::get('/download/price-list/{vendorId}', [VendorController::class, 'downloadPriceList'])->name('download.price-list');

// Routes publiques pour les vendeurs
Route::prefix('vendors')->group(function () {
    Route::get('/{id}', [VendorController::class, 'show'])->name('vendors.show');
    Route::get('/{id}/products', [VendorController::class, 'products'])->name('vendors.products');
});

// Routes pour les produits vendeurs
// ... (autres routes)

// Routes pour les produits vendeurs
Route::middleware(['auth', 'seller.auth', 'seller.approved'])->prefix('seller')->group(function () {
    // Routes produits
    Route::resource('products', \App\Http\Controllers\Seller\ProductController::class)
        ->names([
            'index' => 'seller.products.index',
            'create' => 'seller.products.create',
            'store' => 'seller.products.store',
            'show' => 'seller.products.show',
            'edit' => 'seller.products.edit',
            'update' => 'seller.products.update',
            'destroy' => 'seller.products.destroy',
        ]);
    
    // Routes supplémentaires pour produits
    Route::post('/products/{product}/toggle-status', [\App\Http\Controllers\Seller\ProductController::class, 'toggleStatus'])
        ->name('seller.products.toggle-status');
    
    Route::get('/products/{product}/duplicate', [\App\Http\Controllers\Seller\ProductController::class, 'duplicate'])
        ->name('seller.products.duplicate');
    
    Route::get('/products/export', [\App\Http\Controllers\Seller\ProductController::class, 'export'])
        ->name('seller.products.export');
    
    // Routes AJAX pour les sous-catégories
    Route::get('/categories/{category}/subcategories', function ($categoryId) {
        $subcategories = \App\Models\Subcategory::where('category_id', $categoryId)
            ->active()
            ->ordered()
            ->get(['id', 'name']);
        
        return response()->json($subcategories);
    });
});
Route::get('/verify-email', function () {
    return view('seller.verify-email');
})->name('seller.verify-email');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
