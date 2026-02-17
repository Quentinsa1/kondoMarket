<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil
     */
    public function index()
    {

        // Données principales
        $data = [
            // Catégories principales
            'mainCategories' => $this->getMainCategories(),
            
            // Catégories vedettes
            'featuredCategories' => $this->getFeaturedCategories(),
            
            // Produits tendance
            'trendingProducts' => $this->getTrendingProducts(),
            
            // Blocs par catégorie
            'categoryBlocks' => $this->getCategoryBlocks(),
            
            // Meilleurs vendeurs
            'topVendors' => $this->getTopVendors(),
            
            // Offres du jour
            'dailyDeals' => $this->getDailyDeals(),
            
            // Nouveautés
            'newArrivals' => $this->getNewArrivals(),
            
            // Recommandations
            'recommendations' => $this->getRecommendations(),
        ];
        
        return view('home.index', $data);
    }
    
    /**
     * Récupérer les catégories principales
     */
    private function getMainCategories()
    {
        return [
            ['id' => 1, 'name' => 'Électronique', 'icon' => 'bi-cpu'],
            ['id' => 2, 'name' => 'Téléphones & accessoires', 'icon' => 'bi-phone'],
            ['id' => 3, 'name' => 'Informatique', 'icon' => 'bi-laptop'],
            ['id' => 4, 'name' => 'Mode homme', 'icon' => 'bi-person'],
            ['id' => 5, 'name' => 'Mode femme', 'icon' => 'bi-person-heels'],
            ['id' => 6, 'name' => 'Maison & décoration', 'icon' => 'bi-house'],
            ['id' => 7, 'name' => 'Électroménager', 'icon' => 'bi-plug'],
            ['id' => 8, 'name' => 'Beauté & soins', 'icon' => 'bi-droplet'],
            ['id' => 9, 'name' => 'Santé', 'icon' => 'bi-heart-pulse'],
            ['id' => 10, 'name' => 'Alimentation', 'icon' => 'bi-cup-straw'],
            ['id' => 11, 'name' => 'Sports & loisirs', 'icon' => 'bi-bicycle'],
            ['id' => 12, 'name' => 'Automobile & moto', 'icon' => 'bi-car-front'],
            ['id' => 13, 'name' => 'Industrie & BTP', 'icon' => 'bi-tools'],
            ['id' => 14, 'name' => 'Agriculture', 'icon' => 'bi-tree'],
            ['id' => 15, 'name' => 'Fournitures professionnelles', 'icon' => 'bi-briefcase'],
        ];
    }
    public function help(){
        return view('help.index');
    }
    /**
     * Récupérer les catégories vedettes
     */
    private function getFeaturedCategories()
    {
        return [
            [
                'id' => 1,
                'name' => 'Smartphones',
                'count' => '124,580 produits',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 2,
                'name' => 'Ordinateurs portables',
                'count' => '89,432 produits',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 3,
                'name' => 'Téléviseurs',
                'count' => '45,230 produits',
                'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 4,
                'name' => 'Vêtements homme',
                'count' => '312,450 produits',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 5,
                'name' => 'Vêtements femme',
                'count' => '287,560 produits',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
        ];
    }
    
    /**
     * Récupérer les produits tendance
     */
    private function getTrendingProducts()
    {
        return [
            [
                'id' => 1,
                'name' => 'Smartphone Android 128GB Dual SIM',
                'price' => '189,99€',
                'originalPrice' => '229,99€',
                'vendor' => 'TechWorld Ltd.',
                'rating' => 4.5,
                'moq' => '50 pièces',
                'badge' => 'Vente rapide',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 1250
            ],
            [
                'id' => 2,
                'name' => 'Casque Bluetooth Réduction de bruit',
                'price' => '45,50€',
                'originalPrice' => '59,99€',
                'vendor' => 'AudioTech Inc.',
                'rating' => 4.2,
                'moq' => '100 pièces',
                'badge' => 'Nouveau',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 890
            ],
            [
                'id' => 3,
                'name' => 'Montre connectée Fitness Tracker',
                'price' => '32,99€',
                'vendor' => 'FitGear Co.',
                'rating' => 4.7,
                'moq' => '200 pièces',
                'badge' => 'Top vente',
                'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 2340
            ],
            [
                'id' => 4,
                'name' => 'Ordinateur portable Gaming 15.6"',
                'price' => '899,99€',
                'vendor' => 'GameMaster Pro',
                'rating' => 4.8,
                'moq' => '10 pièces',
                'badge' => 'Premium',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 560
            ],
            [
                'id' => 5,
                'name' => 'Enceinte Bluetooth Portable Waterproof',
                'price' => '28,75€',
                'originalPrice' => '34,99€',
                'vendor' => 'SoundWave Ltd.',
                'rating' => 4.3,
                'moq' => '150 pièces',
                'badge' => 'Promo',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 1230
            ],
        ];
    }
    
    /**
     * Récupérer les blocs par catégorie
     */
    private function getCategoryBlocks()
    {
        return [
            [
                'title' => 'Électronique grand public',
                'icon' => 'bi-cpu',
                'subcategories' => ['Smartphones', 'Ordinateurs portables', 'Téléviseurs', 'Audio', 'Caméras', 'Accessoires'],
                'products' => [
                    [
                        'id' => 6,
                        'name' => 'Téléviseur LED 55" 4K UHD Smart TV',
                        'price' => '489,99€',
                        'vendor' => 'VisionPlus Inc.',
                        'rating' => 4.6,
                        'moq' => '20 pièces',
                        'badge' => 'Nouveau',
                        'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'review_count' => 780
                    ],
                    [
                        'id' => 7,
                        'name' => 'Console de jeu portable',
                        'price' => '199,99€',
                        'originalPrice' => '249,99€',
                        'vendor' => 'GameTech Global',
                        'rating' => 4.9,
                        'moq' => '30 pièces',
                        'badge' => 'Vente rapide',
                        'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'review_count' => 1560
                    ],
                ]
            ],
            [
                'title' => 'Mode & accessoires',
                'icon' => 'bi-person-heels',
                'subcategories' => ['Vêtements homme', 'Vêtements femme', 'Chaussures', 'Sacs', 'Bijoux', 'Montres'],
                'products' => [
                    [
                        'id' => 8,
                        'name' => 'Tablette Android 10" 64GB',
                        'price' => '159,99€',
                        'vendor' => 'TabWorld Co.',
                        'rating' => 4.4,
                        'moq' => '50 pièces',
                        'badge' => 'Éco+',
                        'image' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'review_count' => 920
                    ],
                    [
                        'id' => 9,
                        'name' => 'Drone avec caméra 4K GPS',
                        'price' => '299,99€',
                        'vendor' => 'SkyTech Ltd.',
                        'rating' => 4.7,
                        'moq' => '25 pièces',
                        'badge' => 'Nouveau',
                        'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'review_count' => 450
                    ],
                ]
            ],
        ];
    }
    
    /**
     * Récupérer les meilleurs vendeurs
     */
    private function getTopVendors()
    {
        return [
            [
                'id' => 1,
                'name' => 'GlobalTech Suppliers',
                'location' => 'Chine',
                'products' => '12,450 produits',
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 2,
                'name' => 'FashionHub International',
                'location' => 'Turquie',
                'products' => '8,920 produits',
                'rating' => 4.7,
                'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 3,
                'name' => 'HomeLiving Factory',
                'location' => 'Vietnam',
                'products' => '5,670 produits',
                'rating' => 4.6,
                'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 4,
                'name' => 'BeautyEssence Co.',
                'location' => 'Corée du Sud',
                'products' => '3,450 produits',
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 5,
                'name' => 'Industrial Parts Global',
                'location' => 'Allemagne',
                'products' => '23,150 produits',
                'rating' => 4.7,
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
        ];
    }
    
    /**
     * Récupérer les offres du jour
     */
    private function getDailyDeals()
    {
        return [
            [
                'id' => 10,
                'name' => 'Casque VR Réalité virtuelle',
                'price' => '89,99€',
                'originalPrice' => '119,99€',
                'vendor' => 'VRExperience Inc.',
                'rating' => 4.5,
                'moq' => '100 pièces',
                'badge' => 'Promo -25%',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 1340
            ],
            [
                'id' => 11,
                'name' => 'Clavier mécanique RGB Gaming',
                'price' => '65,99€',
                'vendor' => 'KeyMaster Pro',
                'rating' => 4.8,
                'moq' => '80 pièces',
                'badge' => 'Top vente',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 2100
            ],
            [
                'id' => 12,
                'name' => 'Souris gaming sans fil 16000DPI',
                'price' => '42,50€',
                'vendor' => 'MouseTech Co.',
                'rating' => 4.6,
                'moq' => '120 pièces',
                'badge' => 'Nouveau',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 980
            ],
            [
                'id' => 13,
                'name' => 'Disque SSD 1TB NVMe',
                'price' => '78,99€',
                'originalPrice' => '89,99€',
                'vendor' => 'StorageMaster Ltd.',
                'rating' => 4.7,
                'moq' => '200 pièces',
                'badge' => 'Promo -12%',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 1560
            ],
            [
                'id' => 14,
                'name' => 'Power Bank 30000mAh PD 65W',
                'price' => '54,99€',
                'vendor' => 'PowerTech Inc.',
                'rating' => 4.4,
                'moq' => '150 pièces',
                'badge' => 'Vente rapide',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 870
            ],
        ];
    }
    
    /**
     * Récupérer les nouveautés
     */
    private function getNewArrivals()
    {
        return [
            [
                'id' => 15,
                'name' => 'Webcam 4K avec micro intégré',
                'price' => '89,99€',
                'vendor' => 'VideoPro Co.',
                'rating' => 4.6,
                'moq' => '100 pièces',
                'badge' => 'Nouveau',
                'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 340
            ],
            [
                'id' => 16,
                'name' => 'Imprimante multifonction WiFi',
                'price' => '129,99€',
                'originalPrice' => '159,99€',
                'vendor' => 'PrintMaster Ltd.',
                'rating' => 4.3,
                'moq' => '40 pièces',
                'badge' => 'Promo -19%',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 560
            ],
            [
                'id' => 17,
                'name' => 'Smartwatch Écran AMOLED',
                'price' => '149,99€',
                'vendor' => 'WatchTech Ltd.',
                'rating' => 4.7,
                'moq' => '75 pièces',
                'badge' => 'Nouveau',
                'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 230
            ],
            [
                'id' => 18,
                'name' => 'Enceinte Bluetooth 360°',
                'price' => '69,99€',
                'vendor' => 'AudioSphere Inc.',
                'rating' => 4.5,
                'moq' => '60 pièces',
                'badge' => 'Nouveau',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 410
            ],
            [
                'id' => 19,
                'name' => 'Laptop Ultrabook 14"',
                'price' => '749,99€',
                'vendor' => 'UltraTech Corp.',
                'rating' => 4.8,
                'moq' => '15 pièces',
                'badge' => 'Nouveau',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 120
            ],
        ];
    }
    
    /**
     * Récupérer les recommandations
     */
    private function getRecommendations()
    {
        return [
            [
                'id' => 20,
                'name' => 'Tablette Graphique Professionnelle',
                'price' => '299,99€',
                'vendor' => 'DesignPro Tools',
                'rating' => 4.9,
                'moq' => '30 pièces',
                'image' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 890
            ],
            [
                'id' => 21,
                'name' => 'Micro-casque Gaming USB',
                'price' => '59,99€',
                'vendor' => 'GearMaster Co.',
                'rating' => 4.4,
                'moq' => '100 pièces',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 1560
            ],
            [
                'id' => 22,
                'name' => 'Routeur WiFi 6 Mesh',
                'price' => '129,99€',
                'vendor' => 'NetConnect Ltd.',
                'rating' => 4.7,
                'moq' => '50 pièces',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 670
            ],
            [
                'id' => 23,
                'name' => 'Batterie Externe 20000mAh',
                'price' => '39,99€',
                'vendor' => 'PowerPlus Inc.',
                'rating' => 4.5,
                'moq' => '200 pièces',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 2340
            ],
            [
                'id' => 24,
                'name' => 'Caméra de Surveillance WiFi',
                'price' => '79,99€',
                'vendor' => 'SecureHome Tech',
                'rating' => 4.6,
                'moq' => '80 pièces',
                'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'review_count' => 1230
            ],
        ];
    }
}