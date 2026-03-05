<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // Optionnel : désactiver les contraintes le temps de vider les tables
        // Schema::disableForeignKeyConstraints();
        // Category::truncate();
        // Subcategory::truncate();
        // Schema::enableForeignKeyConstraints();

        $categories = [
            [
                'name' => 'Électronique',
                'description' => 'Produits électroniques grand public, composants et équipements professionnels',
                'icon' => 'bi-cpu',
                'image' => 'https://images.unsplash.com/photo-1550009158-9ebf69173e03',
                'product_count' => 450000,
                'order' => 1,
                'subcategories' => [
                    ['name' => 'Téléviseurs', 'product_count' => 45000],
                    ['name' => 'Smartphones', 'product_count' => 89000],
                    ['name' => 'Accessoires téléphones', 'product_count' => 67000],
                    ['name' => 'Audio & Casques', 'product_count' => 54000],
                    ['name' => 'Caméras & Drônes', 'product_count' => 32000],
                    ['name' => 'Composants électroniques', 'product_count' => 78000],
                    ['name' => 'Équipements réseau', 'product_count' => 29000],
                    ['name' => 'Montres connectées', 'product_count' => 18000],
                    ['name' => 'Gadgets', 'product_count' => 38000],
                ]
            ],
            [
                'name' => 'Informatique & Bureautique',
                'description' => 'Ordinateurs, périphériques, logiciels et fournitures de bureau',
                'icon' => 'bi-laptop',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853',
                'product_count' => 320000,
                'order' => 2,
                'subcategories' => [
                    ['name' => 'Ordinateurs portables', 'product_count' => 68000],
                    ['name' => 'Ordinateurs de bureau', 'product_count' => 34000],
                    ['name' => 'Tablettes', 'product_count' => 22000],
                    ['name' => 'Serveurs & Stockage', 'product_count' => 15000],
                    ['name' => 'Périphériques (souris, clavier...)', 'product_count' => 47000],
                    ['name' => 'Imprimantes & scanners', 'product_count' => 28000],
                    ['name' => 'Fournitures de bureau', 'product_count' => 56000],
                    ['name' => 'Logiciels', 'product_count' => 19000],
                    ['name' => 'Composants PC', 'product_count' => 31000],
                ]
            ],
            [
                'name' => 'Mode & Accessoires',
                'description' => 'Vêtements, chaussures, sacs et accessoires pour hommes, femmes et enfants',
                'icon' => 'bi-handbag',
                'image' => 'https://images.unsplash.com/photo-1445205170230-053b83016050',
                'product_count' => 680000,
                'order' => 3,
                'subcategories' => [
                    ['name' => 'Vêtements homme', 'product_count' => 125000],
                    ['name' => 'Vêtements femme', 'product_count' => 187000],
                    ['name' => 'Vêtements enfant', 'product_count' => 89000],
                    ['name' => 'Chaussures homme', 'product_count' => 64000],
                    ['name' => 'Chaussures femme', 'product_count' => 92000],
                    ['name' => 'Sacs & bagagerie', 'product_count' => 53000],
                    ['name' => 'Montres & bijoux', 'product_count' => 41000],
                    ['name' => 'Accessoires (ceintures, chapeaux...)', 'product_count' => 29000],
                ]
            ],
            [
                'name' => 'Maison & Jardin',
                'description' => 'Meubles, décoration, jardinage, ustensiles de cuisine et articles ménagers',
                'icon' => 'bi-house',
                'image' => 'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6',
                'product_count' => 410000,
                'order' => 4,
                'subcategories' => [
                    ['name' => 'Meubles intérieurs', 'product_count' => 87000],
                    ['name' => 'Décoration', 'product_count' => 69000],
                    ['name' => 'Literie & linge de maison', 'product_count' => 45000],
                    ['name' => 'Cuisine & salle à manger', 'product_count' => 74000],
                    ['name' => 'Jardin & extérieur', 'product_count' => 52000],
                    ['name' => 'Rangement & organisation', 'product_count' => 36000],
                    ['name' => 'Éclairage', 'product_count' => 29000],
                    ['name' => 'Quincaillerie & bricolage', 'product_count' => 28000],
                ]
            ],
            [
                'name' => 'Beauté & Soins personnels',
                'description' => 'Cosmétiques, parfums, soins de la peau, maquillage et équipement de salon',
                'icon' => 'bi-stars',
                'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348',
                'product_count' => 275000,
                'order' => 5,
                'subcategories' => [
                    ['name' => 'Maquillage', 'product_count' => 58000],
                    ['name' => 'Soins de la peau', 'product_count' => 72000],
                    ['name' => 'Parfums & déodorants', 'product_count' => 31000],
                    ['name' => 'Soins capillaires', 'product_count' => 44000],
                    ['name' => 'Hygiène & bain', 'product_count' => 36000],
                    ['name' => 'Appareils de soins (sèche-cheveux, rasoirs...)', 'product_count' => 23000],
                    ['name' => 'Équipement de salon', 'product_count' => 11000],
                ]
            ],
            [
                'name' => 'Sports & Loisirs',
                'description' => 'Équipements sportifs, vêtements de sport, camping, fitness et divertissement',
                'icon' => 'bi-bicycle',
                'image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b',
                'product_count' => 198000,
                'order' => 6,
                'subcategories' => [
                    ['name' => 'Fitness & musculation', 'product_count' => 42000],
                    ['name' => 'Sports d\'équipe', 'product_count' => 31000],
                    ['name' => 'Sports de plein air (camping, randonnée)', 'product_count' => 35000],
                    ['name' => 'Vélos & trottinettes', 'product_count' => 18000],
                    ['name' => 'Sports nautiques', 'product_count' => 14000],
                    ['name' => 'Vêtements de sport', 'product_count' => 39000],
                    ['name' => 'Jeux & divertissement', 'product_count' => 19000],
                ]
            ],
            [
                'name' => 'Alimentation & Boissons',
                'description' => 'Produits alimentaires, boissons, ingrédients et équipements de transformation',
                'icon' => 'bi-cup-straw',
                'image' => 'https://images.unsplash.com/photo-1506617564039-2f3b650b7019',
                'product_count' => 185000,
                'order' => 7,
                'subcategories' => [
                    ['name' => 'Snacks & confiserie', 'product_count' => 34000],
                    ['name' => 'Boissons (alcoolisées et non)', 'product_count' => 42000],
                    ['name' => 'Produits frais', 'product_count' => 29000],
                    ['name' => 'Épicerie', 'product_count' => 31000],
                    ['name' => 'Ingrédients & additifs', 'product_count' => 23000],
                    ['name' => 'Équipement de transformation', 'product_count' => 16000],
                    ['name' => 'Emballage alimentaire', 'product_count' => 10000],
                ]
            ],
            [
                'name' => 'Santé & Médical',
                'description' => 'Équipement médical, soins de santé, fournitures et produits pharmaceutiques',
                'icon' => 'bi-heart-pulse',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef',
                'product_count' => 145000,
                'order' => 8,
                'subcategories' => [
                    ['name' => 'Équipement médical', 'product_count' => 38000],
                    ['name' => 'Mobilier médical', 'product_count' => 15000],
                    ['name' => 'Fournitures médicales jetables', 'product_count' => 29000],
                    ['name' => 'Soins à domicile', 'product_count' => 22000],
                    ['name' => 'Produits pharmaceutiques', 'product_count' => 24000],
                    ['name' => 'Optique', 'product_count' => 17000],
                ]
            ],
            [
                'name' => 'Auto & Moto',
                'description' => 'Pièces détachées, accessoires, entretien et équipement pour véhicules',
                'icon' => 'bi-truck',
                'image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7f0b8c3',
                'product_count' => 210000,
                'order' => 9,
                'subcategories' => [
                    ['name' => 'Pièces auto', 'product_count' => 68000],
                    ['name' => 'Pièces moto', 'product_count' => 31000],
                    ['name' => 'Accessoires intérieurs', 'product_count' => 27000],
                    ['name' => 'Accessoires extérieurs', 'product_count' => 23000],
                    ['name' => 'Pneus & jantes', 'product_count' => 19000],
                    ['name' => 'Outils d\'entretien', 'product_count' => 24000],
                    ['name' => 'Équipement de garage', 'product_count' => 18000],
                ]
            ],
            [
                'name' => 'Agriculture & Élevage',
                'description' => 'Matériel agricole, intrants, semences, animaux et équipement d\'élevage',
                'icon' => 'bi-tree',
                'image' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854',
                'product_count' => 167000,
                'order' => 10,
                'subcategories' => [
                    ['name' => 'Machines agricoles', 'product_count' => 42000],
                    ['name' => 'Engrais & pesticides', 'product_count' => 28000],
                    ['name' => 'Semences & plants', 'product_count' => 19000],
                    ['name' => 'Élevage & alimentation animale', 'product_count' => 34000],
                    ['name' => 'Équipement d\'irrigation', 'product_count' => 16000],
                    ['name' => 'Systèmes de serre', 'product_count' => 12000],
                    ['name' => 'Produits forestiers', 'product_count' => 16000],
                ]
            ],
            [
                'name' => 'Chimie & Matières premières',
                'description' => 'Produits chimiques, matières premières, plastiques, caoutchouc et additifs',
                'icon' => 'bi-droplet',
                'image' => 'https://images.unsplash.com/photo-1581092335871-4c7f1e2a9f6a',
                'product_count' => 98000,
                'order' => 11,
                'subcategories' => [
                    ['name' => 'Chimie organique', 'product_count' => 21000],
                    ['name' => 'Chimie inorganique', 'product_count' => 17000],
                    ['name' => 'Peintures & revêtements', 'product_count' => 14000],
                    ['name' => 'Adhésifs & mastics', 'product_count' => 11000],
                    ['name' => 'Matières plastiques', 'product_count' => 15000],
                    ['name' => 'Caoutchouc', 'product_count' => 9000],
                    ['name' => 'Additifs chimiques', 'product_count' => 11000],
                ]
            ],
            [
                'name' => 'Énergie & Environnement',
                'description' => 'Équipements énergétiques, solutions renouvelables, traitement de l\'eau et gestion des déchets',
                'icon' => 'bi-sun',
                'image' => 'https://images.unsplash.com/photo-1473341304170-971fcc2e5b1e',
                'product_count' => 76000,
                'order' => 12,
                'subcategories' => [
                    ['name' => 'Énergie solaire', 'product_count' => 18000],
                    ['name' => 'Énergie éolienne', 'product_count' => 9000],
                    ['name' => 'Piles & batteries', 'product_count' => 21000],
                    ['name' => 'Équipement de traitement de l\'eau', 'product_count' => 14000],
                    ['name' => 'Gestion des déchets', 'product_count' => 8000],
                    ['name' => 'Éclairage LED', 'product_count' => 6000],
                ]
            ],
            [
                'name' => 'Emballage & Impression',
                'description' => 'Matériaux d\'emballage, machines d\'emballage, services d\'impression et étiquettes',
                'icon' => 'bi-box-seam',
                'image' => 'https://images.unsplash.com/photo-1542626991-cbc4e3c9b5d5',
                'product_count' => 132000,
                'order' => 13,
                'subcategories' => [
                    ['name' => 'Emballages en plastique', 'product_count' => 31000],
                    ['name' => 'Emballages en papier', 'product_count' => 27000],
                    ['name' => 'Bouteilles & contenants', 'product_count' => 19000],
                    ['name' => 'Machines d\'emballage', 'product_count' => 22000],
                    ['name' => 'Impression commerciale', 'product_count' => 18000],
                    ['name' => 'Étiquettes & autocollants', 'product_count' => 15000],
                ]
            ],
            [
                'name' => 'Construction & Immobilier',
                'description' => 'Matériaux de construction, équipements, quincaillerie et services',
                'icon' => 'bi-building',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5',
                'product_count' => 189000,
                'order' => 14,
                'subcategories' => [
                    ['name' => 'Matériaux de construction', 'product_count' => 54000],
                    ['name' => 'Menuiserie & boiseries', 'product_count' => 26000],
                    ['name' => 'Revêtements de sol', 'product_count' => 19000],
                    ['name' => 'Carrelage & pierre', 'product_count' => 17000],
                    ['name' => 'Peinture & décoration murale', 'product_count' => 22000],
                    ['name' => 'Quincaillerie', 'product_count' => 21000],
                    ['name' => 'Équipement de chantier', 'product_count' => 16000],
                    ['name' => 'Préfabriqué & mobilier urbain', 'product_count' => 14000],
                ]
            ],
            [
                'name' => 'Bijoux & Horlogerie',
                'description' => 'Bijoux fantaisie, bijoux précieux, montres, pendentifs et accessoires de luxe',
                'icon' => 'bi-gem',
                'image' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908',
                'product_count' => 97000,
                'order' => 15,
                'subcategories' => [
                    ['name' => 'Bijoux en or', 'product_count' => 18000],
                    ['name' => 'Bijoux en argent', 'product_count' => 21000],
                    ['name' => 'Bijoux fantaisie', 'product_count' => 24000],
                    ['name' => 'Montres', 'product_count' => 17000],
                    ['name' => 'Perles & pierres précieuses', 'product_count' => 9000],
                    ['name' => 'Écrins & présentoirs', 'product_count' => 8000],
                ]
            ],
            [
                'name' => 'Jouets & Jeux',
                'description' => 'Jouets pour enfants, jeux éducatifs, jeux de société et articles de fête',
                'icon' => 'bi-emoji-smile',
                'image' => 'https://images.unsplash.com/photo-1558877385-91a2e7b3b7f1',
                'product_count' => 142000,
                'order' => 16,
                'subcategories' => [
                    ['name' => 'Jouets pour tout-petits', 'product_count' => 27000],
                    ['name' => 'Jeux éducatifs', 'product_count' => 21000],
                    ['name' => 'Poupées & figurines', 'product_count' => 19000],
                    ['name' => 'Jeux de construction', 'product_count' => 16000],
                    ['name' => 'Jeux de société', 'product_count' => 12000],
                    ['name' => 'Véhicules miniatures', 'product_count' => 14000],
                    ['name' => 'Articles de fête & déguisements', 'product_count' => 23000],
                ]
            ],
            [
                'name' => 'Animaux & Fournitures',
                'description' => 'Aliments pour animaux, accessoires, cages, soins vétérinaires et produits d\'élevage',
                'icon' => 'bi-heart',
                'image' => 'https://images.unsplash.com/photo-1450778869180-41d0601e046e',
                'product_count' => 89000,
                'order' => 17,
                'subcategories' => [
                    ['name' => 'Aliments pour chiens', 'product_count' => 19000],
                    ['name' => 'Aliments pour chats', 'product_count' => 16000],
                    ['name' => 'Accessoires pour chiens', 'product_count' => 14000],
                    ['name' => 'Accessoires pour chats', 'product_count' => 11000],
                    ['name' => 'Cages & aquariums', 'product_count' => 12000],
                    ['name' => 'Soins vétérinaires', 'product_count' => 9000],
                    ['name' => 'Élevage & agriculture animale', 'product_count' => 8000],
                ]
            ],
            // NOUVELLES CATÉGORIES AJOUTÉES
            [
                'name' => 'Immobilier',
                'description' => 'Achat, vente et location de biens immobiliers : maisons, appartements, terrains, locaux commerciaux',
                'icon' => 'bi-building',
                'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa',
                'product_count' => 150000,
                'order' => 18,
                'subcategories' => [
                    ['name' => 'Maisons à vendre', 'product_count' => 35000],
                    ['name' => 'Appartements à vendre', 'product_count' => 42000],
                    ['name' => 'Terrains & parcelles', 'product_count' => 18000],
                    ['name' => 'Locaux commerciaux à vendre', 'product_count' => 12000],
                    ['name' => 'Maisons à louer', 'product_count' => 22000],
                    ['name' => 'Appartements à louer', 'product_count' => 28000],
                    ['name' => 'Chambres à louer', 'product_count' => 15000],
                    ['name' => 'Bureaux à louer', 'product_count' => 8000],
                    ['name' => 'Location saisonnière', 'product_count' => 10000],
                ]
            ],
            [
                'name' => 'Services',
                'description' => 'Prestations de services professionnels, nettoyage, réparation, conseil, etc.',
                'icon' => 'bi-briefcase',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978',
                'product_count' => 95000,
                'order' => 19,
                'subcategories' => [
                    ['name' => 'Services informatiques', 'product_count' => 18000],
                    ['name' => 'Nettoyage & entretien', 'product_count' => 14000],
                    ['name' => 'Réparation & maintenance', 'product_count' => 16000],
                    ['name' => 'Conseil & formation', 'product_count' => 11000],
                    ['name' => 'Traduction & rédaction', 'product_count' => 7000],
                    ['name' => 'Photographie & vidéo', 'product_count' => 9000],
                    ['name' => 'Événementiel', 'product_count' => 6000],
                    ['name' => 'Transport & déménagement', 'product_count' => 8000],
                ]
            ],
            [
                'name' => 'Voyage & Tourisme',
                'description' => 'Hébergements, billets, locations de voitures, circuits et activités touristiques',
                'icon' => 'bi-airplane',
                'image' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800',
                'product_count' => 110000,
                'order' => 20,
                'subcategories' => [
                    ['name' => 'Hôtels & hébergements', 'product_count' => 32000],
                    ['name' => 'Billets d\'avion', 'product_count' => 28000],
                    ['name' => 'Location de voitures', 'product_count' => 15000],
                    ['name' => 'Circuits & excursions', 'product_count' => 13000],
                    ['name' => 'Activités & loisirs', 'product_count' => 12000],
                    ['name' => 'Forfaits vacances', 'product_count' => 10000],
                ]
            ],
            [
                'name' => 'Éducation & Formation',
                'description' => 'Cours, formations, livres, matériel éducatif et services de soutien scolaire',
                'icon' => 'bi-book',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b',
                'product_count' => 72000,
                'order' => 21,
                'subcategories' => [
                    ['name' => 'Formations professionnelles', 'product_count' => 18000],
                    ['name' => 'Cours en ligne', 'product_count' => 21000],
                    ['name' => 'Livres & manuels', 'product_count' => 14000],
                    ['name' => 'Soutien scolaire', 'product_count' => 9000],
                    ['name' => 'Matériel éducatif', 'product_count' => 10000],
                ]
            ],
            [
                'name' => 'Emploi & Carrière',
                'description' => 'Offres d\'emploi, recrutement, CV, conseils carrière et services RH',
                'icon' => 'bi-person-badge',
                'image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216',
                'product_count' => 50000,
                'order' => 22,
                'subcategories' => [
                    ['name' => 'Offres d\'emploi', 'product_count' => 20000],
                    ['name' => 'Recrutement & chasse', 'product_count' => 8000],
                    ['name' => 'CV & lettres de motivation', 'product_count' => 7000],
                    ['name' => 'Conseils carrière', 'product_count' => 6000],
                    ['name' => 'Formation continue', 'product_count' => 9000],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $subcategories = $categoryData['subcategories'] ?? [];
            unset($categoryData['subcategories']);
            
            // Générer le slug à partir du nom
            $categoryData['slug'] = Str::slug($categoryData['name']);
            
            // Créer ou mettre à jour la catégorie
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            foreach ($subcategories as $subcategoryData) {
                // Générer un slug unique : sous-catégorie + catégorie
                $slug = Str::slug($subcategoryData['name'] . '-' . $categoryData['slug']);

                // Créer ou mettre à jour la sous-catégorie
                Subcategory::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $category->id,
                        'name' => $subcategoryData['name'],
                        'product_count' => $subcategoryData['product_count'],
                    ]
                );
            }
        }
    }
}