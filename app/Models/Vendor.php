<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_type',
        'status',
        'phone',
        'city',
        'country',
        'display_name',
        'activity_type',
        'company_name',
        'company_category',
        'address',
        'siret',
        'description',
        'avatar_path',
        'logo_path',
        'cover_path',
        'id_document_path',
        'address_proof_path',
        'store_name',
        'store_slug',
        'store_description',
        'store_email',
        'store_phone',
        'store_country',
        'store_city',
        'store_address',
        'store_logo_path',
        'store_banner_path',
        'return_policy',
        'delivery_time',
        'store_created',
        'rating',
        'total_orders',
        'total_revenue',
        'metadata',
        'approved_at',
        'suspended_at',
        'suspension_reason',
    ];

    protected $casts = [
        'store_created' => 'boolean',
        'rating' => 'decimal:2',
        'total_revenue' => 'decimal:2',
        'metadata' => 'array',
        'approved_at' => 'datetime',
        'suspended_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les produits
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relation avec les commandes
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relation avec les catégories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'vendor_categories')
            ->withTimestamps();
    }

    /**
     * Relation avec les avis
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope pour les vendeurs approuvés
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope pour les vendeurs en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les particuliers
     */
    public function scopeIndividuals($query)
    {
        return $query->where('vendor_type', 'individual');
    }

    /**
     * Scope pour les entreprises
     */
    public function scopeCompanies($query)
    {
        return $query->where('vendor_type', 'company');
    }

    /**
     * Vérifier si le vendeur est approuvé
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Vérifier si le vendeur est un particulier
     */
    public function isIndividual(): bool
    {
        return $this->vendor_type === 'individual';
    }

    /**
     * Vérifier si le vendeur est une entreprise
     */
    public function isCompany(): bool
    {
        return $this->vendor_type === 'company';
    }

    /**
     * Obtenir le nom d'affichage
     */
  public function getDisplayNameAttribute(): string
{
    // Entreprise
    if ($this->isCompany() && !empty($this->company_name)) {
        return $this->company_name;
    }

    // Nom personnalisé enregistré en base
    if (!empty($this->attributes['display_name'])) {
        return $this->attributes['display_name'];
    }

    // Nom du user
    return $this->user?->name ?? 'Unknown Vendor';
}



    /**
     * Obtenir l'URL de l'avatar
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar_path) {
            return asset('storage/' . $this->avatar_path);
        }

        return asset('images/default-avatar.png');
    }

    /**
     * Obtenir l'URL du logo
     */
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }

        return asset('images/default-logo.png');
    }

    /**
     * Obtenir l'URL de la bannière
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_path) {
            return asset('storage/' . $this->cover_path);
        }

        return asset('images/default-cover.jpg');
    }

    /**
     * Obtenir l'URL du logo de la boutique
     */
    public function getStoreLogoUrlAttribute(): string
    {
        if ($this->store_logo_path) {
            return asset('storage/' . $this->store_logo_path);
        }

        return $this->logo_url;
    }

    /**
     * Obtenir l'URL de la bannière de la boutique
     */
    public function getStoreBannerUrlAttribute(): string
    {
        if ($this->store_banner_path) {
            return asset('storage/' . $this->store_banner_path);
        }

        return $this->cover_url;
    }

    /**
     * Obtenir l'URL du profil public
     */
    public function getPublicUrlAttribute(): string
    {
        if ($this->store_slug) {
            return route('vendors.show', $this->store_slug);
        }

        return route('vendors.show', $this->id);
    }

    /**
     * Vérifier si le vendeur a un SIRET valide (pour les entreprises)
     */
    public function hasValidSiret(): bool
    {
        if (!$this->isCompany() || !$this->siret) {
            return false;
        }

        // Ici vous pouvez ajouter une logique de validation du SIRET
        return strlen($this->siret) === 14;
    }

    /**
     * Approuver le vendeur
     */
    public function approve(): void
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }

    /**
     * Suspendre le vendeur
     */
    public function suspend(string $reason = null): void
    {
        $this->update([
            'status' => 'suspended',
            'suspended_at' => now(),
            'suspension_reason' => $reason,
        ]);
    }

    /**
     * Réactiver le vendeur
     */
    public function reactivate(): void
    {
        $this->update([
            'status' => 'approved',
            'suspended_at' => null,
            'suspension_reason' => null,
        ]);
    }

    /**
     * Mettre à jour les statistiques
     */
    public function updateStats(): void
    {
        $this->update([
            'total_orders' => $this->orders()->count(),
            'total_revenue' => $this->orders()->sum('total_amount'),
            'rating' => $this->reviews()->avg('rating') ?? 0,
        ]);
    }

    /**
     * Route key personnalisée (pour les URLs)
     */
    public function getRouteKeyName(): string
    {
        return 'store_slug';
    }

    /**
     * Obtenir les produits actifs
     */
    public function activeProducts()
    {
        return $this->products()->where('status', 'active');
    }

    /**
     * Obtenir les produits en attente
     */
    public function pendingProducts()
    {
        return $this->products()->where('status', 'pending');
    }

    /**
     * Obtenir les produits en brouillon
     */
    public function draftProducts()
    {
        return $this->products()->where('status', 'draft');
    }

    /**
     * Obtenir les produits avec stock faible
     */
    public function lowStockProducts()
    {
        return $this->products()
            ->whereColumn('stock_quantity', '<=', 'alert_quantity')
            ->where('manage_stock', true);
    }

    /**
     * Vérifier si le vendeur peut ajouter plus de produits
     */
    public function canAddMoreProducts(): bool
    {
        // Vérifier les limites selon le plan d'abonnement
        $maxProducts = 100; // Par défaut, limitez à 100 produits
        
        return $this->products()->count() < $maxProducts;
    }

    /**
     * Obtenir les meilleurs produits du vendeur
     */
    public function topProducts($limit = 5)
    {
        return $this->products()
            ->where('status', 'active')
            ->orderBy('order_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Obtenir les statistiques mensuelles des ventes
     */
    public function getMonthlySalesStats()
    {
        return $this->orders()
            ->where('status', 'delivered')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();
    }
}