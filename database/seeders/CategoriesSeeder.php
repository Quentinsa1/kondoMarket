<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Électronique',
                'description' => 'Tous les produits électroniques grand public et professionnels',
                'icon' => 'bi-cpu',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c',
                'product_count' => 124580,
                'order' => 1,
                'subcategories' => [
                    ['name' => 'Téléviseurs', 'product_count' => 23450],
                    ['name' => 'Caméras', 'product_count' => 15670],
                    ['name' => 'Audio', 'product_count' => 34560],
                    ['name' => 'Composants électroniques', 'product_count' => 45670],
                    ['name' => 'Équipements professionnels', 'product_count' => 12340],
                ]
            ],
            [
                'name' => 'Téléphones & accessoires',
                'description' => 'Smartphones, accessoires téléphoniques et équipement réseau',
                'icon' => 'bi-phone',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9',
                'product_count' => 89432,
                'order' => 2,
                'subcategories' => [
                    ['name' => 'Smartphones', 'product_count' => 67890],
                    ['name' => 'Accessoires téléphone', 'product_count' => 45670],
                    ['name' => 'Montres connectées', 'product_count' => 23450],
                    ['name' => 'Équipement réseau', 'product_count' => 12340],
                ]
            ],
            [
                'name' => 'Informatique',
                'description' => 'Ordinateurs, périphériques, logiciels et équipement réseau',
                'icon' => 'bi-laptop',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853',
                'product_count' => 75680,
                'order' => 3,
                'subcategories' => [
                    ['name' => 'Ordinateurs portables', 'product_count' => 34560],
                    ['name' => 'Ordinateurs de bureau', 'product_count' => 23450],
                    ['name' => 'Périphériques', 'product_count' => 45670],
                    ['name' => 'Stockage', 'product_count' => 12340],
                    ['name' => 'Logiciels', 'product_count' => 5670],
                ]
            ],
            [
                'name' => 'Mode homme',
                'description' => 'Vêtements, chaussures et accessoires pour hommes',
                'icon' => 'bi-person',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d',
                'product_count' => 312450,
                'order' => 4,
                'subcategories' => [
                    ['name' => 'Vêtements', 'product_count' => 123450],
                    ['name' => 'Chaussures', 'product_count' => 78900],
                    ['name' => 'Accessoires', 'product_count' => 45670],
                    ['name' => 'Sous-vêtements', 'product_count' => 23450],
                ]
            ],
            [
                'name' => 'Mode femme',
                'description' => 'Vêtements, chaussures et accessoires pour femmes',
                'icon' => 'bi-person-heels',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d',
                'product_count' => 287560,
                'order' => 5,
                'subcategories' => [
                    ['name' => 'Vêtements', 'product_count' => 145670],
                    ['name' => 'Chaussures', 'product_count' => 78900],
                    ['name' => 'Accessoires', 'product_count' => 56780],
                    ['name' => 'Sous-vêtements', 'product_count' => 34560],
                ]
            ],
            [
                'name' => 'Maison & décoration',
                'description' => 'Meubles, décoration, jardin et aménagement intérieur',
                'icon' => 'bi-house',
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc',
                'product_count' => 156780,
                'order' => 6,
                'subcategories' => [
                    ['name' => 'Meubles', 'product_count' => 56780],
                    ['name' => 'Décoration', 'product_count' => 45670],
                    ['name' => 'Cuisine', 'product_count' => 34560],
                    ['name' => 'Jardin', 'product_count' => 23450],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $subcategories = $categoryData['subcategories'] ?? [];
            unset($categoryData['subcategories']);
            
            $categoryData['slug'] = Str::slug($categoryData['name']);
            
            $category = Category::create($categoryData);

            foreach ($subcategories as $subcategoryData) {
                // Générer un slug unique combinant nom de la sous-catégorie et nom de la catégorie
                $slug = Str::slug($subcategoryData['name'] . '-' . $categoryData['slug']);

                Subcategory::create([
                    'category_id' => $category->id,
                    'name' => $subcategoryData['name'],
                    'slug' => $slug,
                    'product_count' => $subcategoryData['product_count'],
                ]);
            }
        }
    }
}
