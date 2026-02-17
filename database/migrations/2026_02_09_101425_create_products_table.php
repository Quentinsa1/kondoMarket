<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Relations
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('subcategory_id')->nullable()->constrained()->onDelete('restrict');
            
            // Informations de base
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description');
            
            // Prix et stock
            $table->decimal('price', 12, 2);
            $table->decimal('compare_price', 12, 2)->nullable();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->decimal('wholesale_price', 12, 2)->nullable();
            $table->integer('min_quantity')->default(1);
            $table->integer('stock_quantity')->default(0);
            $table->integer('alert_quantity')->default(5);
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->nullable();
            
            // État et visibilité
            $table->enum('status', ['draft', 'pending', 'active', 'inactive', 'out_of_stock', 'discontinued'])
                  ->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_digital')->default(false);
            $table->boolean('has_variants')->default(false);
            $table->boolean('requires_shipping')->default(true);
            
            // Images
            $table->string('main_image')->nullable();
            $table->json('images')->nullable(); // Pour les images multiples
            
            // Poids et dimensions
            $table->decimal('weight', 8, 2)->nullable(); // en kg
            $table->decimal('length', 8, 2)->nullable(); // en cm
            $table->decimal('width', 8, 2)->nullable(); // en cm
            $table->decimal('height', 8, 2)->nullable(); // en cm
            
            // Livraison
            $table->string('shipping_class')->nullable();
            $table->decimal('shipping_cost', 8, 2)->nullable();
            $table->integer('estimated_delivery')->nullable(); // en jours
            
            // Taxes
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->boolean('tax_included')->default(true);
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            // Caractéristiques
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('condition')->default('new'); // new, used, refurbished
            $table->string('material')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            
            // Garantie
            $table->string('warranty_period')->nullable(); // ex: "2 ans"
            $table->text('warranty_terms')->nullable();
            
            // Spécifications techniques
            $table->json('specifications')->nullable();
            
            // Statistiques
            $table->integer('view_count')->default(0);
            $table->integer('order_count')->default(0);
            $table->integer('review_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            
            // Gestion des stocks
            $table->boolean('manage_stock')->default(true);
            $table->boolean('allow_backorder')->default(false);
            $table->boolean('low_stock_notification')->default(true);
            
            // Dates importantes
            $table->timestamp('published_at')->nullable();
            $table->timestamp('featured_until')->nullable();
            $table->timestamp('sale_start')->nullable();
            $table->timestamp('sale_end')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Index pour les performances
            $table->index(['vendor_id', 'status']);
            $table->index(['category_id', 'subcategory_id']);
            $table->index(['status', 'is_featured', 'is_trending']);
            $table->index(['price', 'status']);
            $table->index('sku');
            $table->index('barcode');
        });
        
        // Table pour les variantes de produits
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->json('attributes'); // ex: {"color": "red", "size": "M"}
            $table->decimal('price', 12, 2);
            $table->decimal('compare_price', 12, 2)->nullable();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->string('image')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['product_id', 'is_active']);
            $table->index('sku');
        });
        
        // Table pour les attributs de produits (couleurs, tailles, etc.)
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ex: "Couleur", "Taille"
            $table->string('slug')->unique();
            $table->string('display_name');
            $table->string('type')->default('select'); // select, checkbox, radio, color, image
            $table->boolean('is_filterable')->default(true);
            $table->boolean('is_visible')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
        
        // Table pour les valeurs d'attributs
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->string('value'); // ex: "Rouge", "M"
            $table->string('color_code')->nullable(); // pour les attributs de type couleur
            $table->string('image')->nullable(); // pour les attributs avec image
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->unique(['attribute_id', 'value']);
        });
        
        // Table pivot pour les attributs de produits
        Schema::create('product_product_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['product_id', 'attribute_id']);
        });
        
        // Table pour les tags de produits
        Schema::create('product_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color')->nullable(); // pour l'affichage
            $table->timestamps();
        });
        
        // Table pivot pour les tags
        Schema::create('product_product_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('product_tags')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['product_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_product_tag');
        Schema::dropIfExists('product_tags');
        Schema::dropIfExists('product_product_attribute');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('products');
    }
};