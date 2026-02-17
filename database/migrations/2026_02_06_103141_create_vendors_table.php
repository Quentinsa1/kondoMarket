<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Type de vendeur
            $table->enum('vendor_type', ['individual', 'company']);
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended', 'pending_review'])->default('pending');
            
            // Informations de base (communes)
            $table->string('phone')->unique();
            $table->string('city');
            $table->string('country', 2);
            
            // Informations pour particuliers
            $table->string('display_name')->nullable();
            $table->enum('activity_type', ['selling', 'service', 'both'])->nullable();
            
            // Informations pour entreprises
            $table->string('company_name')->nullable();
            $table->enum('company_category', ['restaurant', 'boutique', 'service', 'artisan', 'ecommerce', 'other'])->nullable();
            $table->string('address')->nullable();
            $table->string('siret', 14)->nullable();
            
            // Description (utilisé par les deux)
            $table->text('description')->nullable();
            
            // Fichiers
            $table->string('avatar_path')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('cover_path')->nullable();
            $table->string('id_document_path')->nullable();
            $table->string('address_proof_path')->nullable();
            
            // Informations de la boutique (si créée)
            $table->string('store_name')->nullable()->unique();
            $table->string('store_slug')->nullable()->unique();
            $table->text('store_description')->nullable();
            $table->string('store_email')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('store_country', 2)->nullable();
            $table->string('store_city')->nullable();
            $table->text('store_address')->nullable();
            $table->string('store_logo_path')->nullable();
            $table->string('store_banner_path')->nullable();
            $table->enum('return_policy', ['30', '14', 'none'])->nullable();
            $table->enum('delivery_time', ['1-3', '3-7', '7-14', '14-30'])->nullable();
            $table->boolean('store_created')->default(false);
            
            // Statistiques
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_orders')->default(0);
            $table->decimal('total_revenue', 12, 2)->default(0);
            
            // Métadonnées
            $table->json('metadata')->nullable(); // Pour stocker des données supplémentaires
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->text('suspension_reason')->nullable();
            
            $table->timestamps();
            
            // Index pour les recherches
            $table->index(['status', 'vendor_type']);
            $table->index('store_slug');
            $table->index('siret');
        });
        
       
    }

    public function down()
    {
       Schema::dropIfExists('vendors');

    }
};