
        // ===== DONNÉES DE LA MARKETPLACE =====
        
        // Catégories principales pour méga-menu
        const mainCategories = [
            { id: 1, name: 'Électronique', icon: 'bi-cpu', subcategories: [
                { name: 'Téléviseurs', subs: ['LED TV', 'OLED TV', 'Smart TV', '4K Ultra HD'] },
                { name: 'Caméras', subs: ['Appareils photo', 'Caméras sport', 'Caméras sécurité', 'Accessoires'] },
                { name: 'Audio', subs: ['Écouteurs', 'Enceintes', 'Systèmes home cinema', 'Amplificateurs'] },
                { name: 'Composants électroniques', subs: ['Semi-conducteurs', 'Capteurs', 'Circuits imprimés', 'Connecteurs'] },
                { name: 'Équipements professionnels', subs: ['Matériel médical', 'Matériel de test', 'Équipement industriel'] }
            ]},
            { id: 2, name: 'Téléphones & accessoires', icon: 'bi-phone', subcategories: [
                { name: 'Smartphones', subs: ['Android', 'iPhone', 'Téléphones basiques', 'Smartphones reconditionnés'] },
                { name: 'Accessoires téléphone', subs: ['Coques', 'Protections écran', 'Chargeurs', 'Batteries externes'] },
                { name: 'Montres connectées', subs: ['Apple Watch', 'Samsung Galaxy Watch', 'Xiaomi', 'Autres marques'] },
                { name: 'Équipement réseau', subs: ['Routeurs', 'Modems', 'Répéteurs WiFi', 'Câbles réseau'] }
            ]},
            { id: 3, name: 'Informatique', icon: 'bi-laptop', subcategories: [
                { name: 'Ordinateurs portables', subs: ['Windows', 'MacBook', 'Chromebook', 'Gaming'] },
                { name: 'Ordinateurs de bureau', subs: ['PC complets', 'Composants PC', 'Moniteurs', 'Accessoires'] },
                { name: 'Périphériques', subs: ['Claviers', 'Souris', 'Webcams', 'Imprimantes'] },
                { name: 'Stockage', subs: ['Disques durs', 'SSD', 'Clés USB', 'Cartes mémoire'] },
                { name: 'Logiciels', subs: ['Systèmes d\'exploitation', 'Logiciels bureautique', 'Antivirus', 'Jeux'] }
            ]},
            { id: 4, name: 'Mode homme', icon: 'bi-person', subcategories: [
                { name: 'Vêtements', subs: ['Chemises', 'T-shirts', 'Pantalons', 'Vestes'] },
                { name: 'Chaussures', subs: ['Baskets', 'Chaussures de ville', 'Sandales', 'Chaussures de sport'] },
                { name: 'Accessoires', subs: ['Montres', 'Ceintures', 'Portefeuilles', 'Lunettes'] },
                { name: 'Sous-vêtements', subs: ['Boxers', 'Chaussettes', 'Sous-vêtements thermiques'] }
            ]},
            { id: 5, name: 'Mode femme', icon: 'bi-person-heels', subcategories: [
                { name: 'Vêtements', subs: ['Robes', 'Tops', 'Jupes', 'Pantalons'] },
                { name: 'Chaussures', subs: ['Talons', 'Ballerines', 'Baskets', 'Sandales'] },
                { name: 'Accessoires', subs: ['Sacs', 'Bijoux', 'Écharpes', 'Chapeaux'] },
                { name: 'Sous-vêtements', subs: ['Soutiens-gorge', 'Culottes', 'Pyjamas'] }
            ]},
            { id: 6, name: 'Maison & décoration', icon: 'bi-house', subcategories: [
                { name: 'Meubles', subs: ['Salon', 'Chambre', 'Cuisine', 'Bureau'] },
                { name: 'Décoration', subs: ['Luminaires', 'Tapis', 'Tableaux', 'Vases'] },
                { name: 'Cuisine', subs: ['Ustensiles', 'Vaisselle', 'Appareils de cuisine', 'Rangements'] },
                { name: 'Jardin', subs: ['Mobilier de jardin', 'Outils de jardinage', 'Décoration extérieure'] }
            ]},
            { id: 7, name: 'Électroménager', icon: 'bi-plug', subcategories: [
                { name: 'Gros électroménager', subs: ['Réfrigérateurs', 'Lave-linge', 'Lave-vaisselle', 'Cuisinières'] },
                { name: 'Petit électroménager', subs: ['Mixeurs', 'Aspirateurs', 'Fers à repasser', 'Bouilloires'] },
                { name: 'Climatisation', subs: ['Climatiseurs', 'Ventilateurs', 'Chauffages', 'Purificateurs d\'air'] }
            ]},
            { id: 8, name: 'Beauté & soins', icon: 'bi-droplet', subcategories: [
                { name: 'Soins de la peau', subs: ['Crèmes', 'Sérums', 'Nettoyants', 'Masques'] },
                { name: 'Maquillage', subs: ['Fonds de teint', 'Rouges à lèvres', 'Mascaras', 'Palettes'] },
                { name: 'Parfums', subs: ['Parfums femmes', 'Parfums hommes', 'Eaux de toilette'] },
                { name: 'Soins cheveux', subs: ['Shampoings', 'Après-shampoings', 'Colorations', 'Accessoires'] }
            ]},
            { id: 9, name: 'Santé', icon: 'bi-heart-pulse', subcategories: [
                { name: 'Médicaments', subs: ['Sans ordonnance', 'Premiers soins', 'Compléments alimentaires'] },
                { name: 'Équipement médical', subs: ['Thermomètres', 'Tensiomètres', 'Stéthoscopes', 'Oxymètres'] },
                { name: 'Soins personnels', subs: ['Brosse à dents électrique', 'Rasoirs', 'Soins bucco-dentaires'] }
            ]},
            { id: 10, name: 'Alimentation', icon: 'bi-cup-straw', subcategories: [
                { name: 'Épicerie', subs: ['Conserves', 'Pâtes & riz', 'Condiments', 'Boissons'] },
                { name: 'Snacks', subs: ['Biscuits', 'Chips', 'Chocolats', 'Bonbons'] },
                { name: 'Aliments santé', subs: ['Bio', 'Sans gluten', 'Végétarien', 'Protéines'] }
            ]},
            { id: 11, name: 'Sports & loisirs', icon: 'bi-bicycle', subcategories: [
                { name: 'Équipement sportif', subs: ['Fitness', 'Yoga', 'Camping', 'Pêche'] },
                { name: 'Vêtements sport', subs: ['Tenues de sport', 'Chaussures de sport', 'Accessoires'] },
                { name: 'Jeux', subs: ['Jeux de société', 'Jeux vidéo', 'Jouets', 'Puzzles'] }
            ]},
            { id: 12, name: 'Automobile & moto', icon: 'bi-car-front', subcategories: [
                { name: 'Pièces auto', subs: ['Moteur', 'Freinage', 'Suspension', 'Échappement'] },
                { name: 'Accessoires auto', subs: ['GPS', 'Caméras de recul', 'Nettoyants', 'Coussins'] },
                { name: 'Entretien', subs: ['Huiles', 'Liquides', 'Outils', 'Batteries'] }
            ]},
            { id: 13, name: 'Industrie & BTP', icon: 'bi-tools', subcategories: [
                { name: 'Machines industrielles', subs: ['Machines-outils', 'Générateurs', 'Compresseurs', 'Pompes'] },
                { name: 'Matériel BTP', subs: ['Outils électriques', 'Outils manuels', 'Équipement de sécurité'] },
                { name: 'Matériaux', subs: ['Acier', 'Bois', 'Ciment', 'Isolation'] }
            ]},
            { id: 14, name: 'Agriculture', icon: 'bi-tree', subcategories: [
                { name: 'Machines agricoles', subs: ['Tracteurs', 'Moissonneuses', 'Pulvérisateurs'] },
                { name: 'Semences & plants', subs: ['Céréales', 'Légumes', 'Fruits', 'Fleurs'] },
                { name: 'Engrais & pesticides', subs: ['Engrais organiques', 'Engrais chimiques', 'Pesticides'] }
            ]},
            { id: 15, name: 'Fournitures professionnelles', icon: 'bi-briefcase', subcategories: [
                { name: 'Bureau', subs: ['Papeterie', 'Mobilier de bureau', 'Organisation'] },
                { name: 'Informatique professionnelle', subs: ['Serveurs', 'Matériel réseau', 'Périphériques'] },
                { name: 'Services', subs: ['Impression', 'Emballage', 'Logistique'] }
            ]}
        ];
        
        // Images pour les catégories vedettes
        const categoryImages = [
            'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Smartphones
            'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Laptops
            'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Televisions
            'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Men's clothing
            'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Women's clothing
            'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Home furniture
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Appliances
            'https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Cosmetics
            'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Toys & games
            'https://images.unsplash.com/photo-1536922246289-88c42f957773?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Sports & fitness
            'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Automotive
            'https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Industrial tools
            'https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Food
            'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Health & wellness
            'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Consumer electronics
            'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Jewelry & accessories
            'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'  // Cameras
        ];
        
        // Données des catégories vedettes avec images
        const featuredCategoriesData = [
            { name: 'Smartphones', count: '124,580 produits', image: categoryImages[0] },
            { name: 'Ordinateurs portables', count: '89,432 produits', image: categoryImages[1] },
            { name: 'Téléviseurs', count: '45,230 produits', image: categoryImages[2] },
            { name: 'Vêtements homme', count: '312,450 produits', image: categoryImages[3] },
            { name: 'Vêtements femme', count: '287,560 produits', image: categoryImages[4] },
            { name: 'Meubles maison', count: '156,780 produits', image: categoryImages[5] },
            { name: 'Électroménager', count: '89,340 produits', image: categoryImages[6] },
            { name: 'Cosmétiques', count: '67,890 produits', image: categoryImages[7] },
            { name: 'Jouets & jeux', count: '45,670 produits', image: categoryImages[8] },
            { name: 'Sports & fitness', count: '34,230 produits', image: categoryImages[9] },
            { name: 'Automobile', count: '89,120 produits', image: categoryImages[10] },
            { name: 'Outils industriels', count: '56,780 produits', image: categoryImages[11] },
            { name: 'Alimentation', count: '123,450 produits', image: categoryImages[12] },
            { name: 'Santé & bien-être', count: '78,900 produits', image: categoryImages[13] },
            { name: 'Électronique grand public', count: '234,560 produits', image: categoryImages[14] },
            { name: 'Bijoux & accessoires', count: '67,890 produits', image: categoryImages[15] }
        ];
        
        // Images pour les produits
        const productImages = [
            'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Smartphone
            'https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Smartwatch
            'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Camera
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Shoes
            'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // LED lights
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Headphones
            'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Drone
            'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Laptop
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Home appliance
            'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Tablet
            'https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Fitness tracker
            'https://images.unsplash.com/photo-1536922246289-88c42f957773?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Sports equipment
            'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // TV
            'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Car parts
            'https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Tools
            'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Health products
            'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'  // Electronics
        ];
        
        // Données des produits
        const productsData = [
            { name: 'Smartphone Android 128GB Dual SIM', price: '189,99€', originalPrice: '229,99€', vendor: 'TechWorld Ltd.', rating: 4.5, moq: '50 pièces', badge: 'Vente rapide', image: productImages[0] },
            { name: 'Casque Bluetooth Réduction de bruit', price: '45,50€', originalPrice: '59,99€', vendor: 'AudioTech Inc.', rating: 4.2, moq: '100 pièces', badge: 'Nouveau', image: productImages[5] },
            { name: 'Montre connectée Fitness Tracker', price: '32,99€', vendor: 'FitGear Co.', rating: 4.7, moq: '200 pièces', badge: 'Top vente', image: productImages[1] },
            { name: 'Ordinateur portable Gaming 15.6"', price: '899,99€', vendor: 'GameMaster Pro', rating: 4.8, moq: '10 pièces', badge: 'Premium', image: productImages[7] },
            { name: 'Enceinte Bluetooth Portable Waterproof', price: '28,75€', originalPrice: '34,99€', vendor: 'SoundWave Ltd.', rating: 4.3, moq: '150 pièces', badge: 'Promo', image: productImages[5] },
            { name: 'Téléviseur LED 55" 4K UHD Smart TV', price: '489,99€', vendor: 'VisionPlus Inc.', rating: 4.6, moq: '20 pièces', badge: 'Nouveau', image: productImages[12] },
            { name: 'Console de jeu portable', price: '199,99€', originalPrice: '249,99€', vendor: 'GameTech Global', rating: 4.9, moq: '30 pièces', badge: 'Vente rapide', image: productImages[8] },
            { name: 'Tablette Android 10" 64GB', price: '159,99€', vendor: 'TabWorld Co.', rating: 4.4, moq: '50 pièces', badge: 'Éco+', image: productImages[9] },
            { name: 'Drone avec caméra 4K GPS', price: '299,99€', vendor: 'SkyTech Ltd.', rating: 4.7, moq: '25 pièces', badge: 'Nouveau', image: productImages[6] },
            { name: 'Casque VR Réalité virtuelle', price: '89,99€', originalPrice: '119,99€', vendor: 'VRExperience Inc.', rating: 4.5, moq: '100 pièces', badge: 'Promo', image: productImages[5] },
            { name: 'Clavier mécanique RGB Gaming', price: '65,99€', vendor: 'KeyMaster Pro', rating: 4.8, moq: '80 pièces', badge: 'Top vente', image: productImages[16] },
            { name: 'Souris gaming sans fil 16000DPI', price: '42,50€', vendor: 'MouseTech Co.', rating: 4.6, moq: '120 pièces', badge: 'Nouveau', image: productImages[16] },
            { name: 'Disque SSD 1TB NVMe', price: '78,99€', originalPrice: '89,99€', vendor: 'StorageMaster Ltd.', rating: 4.7, moq: '200 pièces', badge: 'Promo', image: productImages[16] },
            { name: 'Power Bank 30000mAh PD 65W', price: '54,99€', vendor: 'PowerTech Inc.', rating: 4.4, moq: '150 pièces', badge: 'Vente rapide', image: productImages[0] },
            { name: 'Webcam 4K avec micro intégré', price: '89,99€', vendor: 'VideoPro Co.', rating: 4.6, moq: '100 pièces', badge: 'Nouveau', image: productImages[2] },
            { name: 'Imprimante multifonction WiFi', price: '129,99€', originalPrice: '159,99€', vendor: 'PrintMaster Ltd.', rating: 4.3, moq: '40 pièces', badge: 'Promo', image: productImages[16] }
        ];
        
        // Images pour les vendeurs
        const vendorImages = [
            'https://images.unsplash.com/photo-1560179707-f14e90ef3623?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1536922246289-88c42f957773?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
        ];
        
        // Données des vendeurs
        const vendorsData = [
            { name: 'GlobalTech Suppliers', location: 'Chine', products: '12,450 produits', rating: 4.8, image: vendorImages[0] },
            { name: 'FashionHub International', location: 'Turquie', products: '8,920 produits', rating: 4.7, image: vendorImages[1] },
            { name: 'HomeLiving Factory', location: 'Vietnam', products: '5,670 produits', rating: 4.6, image: vendorImages[2] },
            { name: 'BeautyEssence Co.', location: 'Corée du Sud', products: '3,450 produits', rating: 4.9, image: vendorImages[3] },
            { name: 'Industrial Parts Global', location: 'Allemagne', products: '23,150 produits', rating: 4.7, image: vendorImages[4] },
            { name: 'AutoParts Direct', location: 'Japon', products: '9,870 produits', rating: 4.8, image: vendorImages[5] },
            { name: 'SportGear Manufacturers', location: 'USA', products: '6,540 produits', rating: 4.5, image: vendorImages[6] },
            { name: 'HealthCare Supplies', location: 'Inde', products: '4,320 produits', rating: 4.6, image: vendorImages[7] },
            { name: 'Electronic Components Ltd.', location: 'Taïwan', products: '15,780 produits', rating: 4.9, image: vendorImages[8] },
            { name: 'FoodImport Exporters', location: 'Brésil', products: '2,980 produits', rating: 4.4, image: vendorImages[9] }
        ];
        
        // Données des blocs de catégories
        const categoryBlocksData = [
            { 
                title: 'Électronique grand public', 
                icon: 'bi-cpu',
                subcategories: ['Smartphones', 'Ordinateurs portables', 'Téléviseurs', 'Audio', 'Caméras', 'Accessoires'],
                products: productsData.slice(0, 6)
            },
            { 
                title: 'Mode & accessoires', 
                icon: 'bi-person-heels',
                subcategories: ['Vêtements homme', 'Vêtements femme', 'Chaussures', 'Sacs', 'Bijoux', 'Montres'],
                products: productsData.slice(2, 8)
            },
            { 
                title: 'Maison & électroménager', 
                icon: 'bi-house',
                subcategories: ['Meubles', 'Décoration', 'Luminaires', 'Cuisine', 'Électroménager', 'Jardin'],
                products: productsData.slice(4, 10)
            },
            { 
                title: 'Beauté & santé', 
                icon: 'bi-droplet',
                subcategories: ['Cosmétiques', 'Soins peau', 'Parfums', 'Soins cheveux', 'Santé', 'Équipement médical'],
                products: productsData.slice(6, 12)
            }
        ];
        
        // ===== FONCTIONS UTILITAIRES =====
        
        // Générer les étoiles de notation
        function generateStarRating(rating) {
            let stars = '';
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;
            
            for (let i = 0; i < fullStars; i++) {
                stars += '<i class="bi bi-star-fill"></i>';
            }
            
            if (hasHalfStar) {
                stars += '<i class="bi bi-star-half"></i>';
            }
            
            const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
            for (let i = 0; i < emptyStars; i++) {
                stars += '<i class="bi bi-star"></i>';
            }
            
            return stars;
        }
        
        // Obtenir une image aléatoire pour les vendeurs si aucune n'est spécifiée
        function getRandomVendorImage(index) {
            return vendorImages[index % vendorImages.length];
        }
        
        // ===== INITIALISATION DE L'INTERFACE =====
        
        // Initialiser le méga-menu
        function initializeMegaMenu() {
            const megaCategories = document.getElementById('megaCategories');
            const megaSubcategories = document.getElementById('megaSubcategories');
            const sidebarCategories = document.getElementById('sidebarCategories');
            
            // Vider les conteneurs
            megaCategories.innerHTML = '';
            megaSubcategories.innerHTML = '';
            sidebarCategories.innerHTML = '';
            
            // Remplir les catégories principales
            mainCategories.forEach((category, index) => {
                // Méga-menu catégories
                const categoryItem = document.createElement('div');
                categoryItem.className = 'category-item';
                categoryItem.dataset.id = category.id;
                categoryItem.innerHTML = `
                    <span>${category.name}</span>
                    <i class="bi bi-chevron-right"></i>
                `;
                
                categoryItem.addEventListener('mouseenter', function() {
                    // Activer cette catégorie
                    document.querySelectorAll('.category-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // Afficher les sous-catégories
                    displaySubcategories(category.id);
                });
                
                megaCategories.appendChild(categoryItem);
                
                // Sidebar catégories
                const sidebarItem = document.createElement('a');
                sidebarItem.href = '#';
                sidebarItem.className = 'category-sidebar-item';
                sidebarItem.innerHTML = `
                    <span>${category.name}</span>
                    <i class="bi bi-chevron-right"></i>
                `;
                sidebarCategories.appendChild(sidebarItem);
                
                // Activer la première catégorie par défaut
                if (index === 0) {
                    categoryItem.classList.add('active');
                    displaySubcategories(category.id);
                }
            });
        }
        
        // Afficher les sous-catégories
        function displaySubcategories(categoryId) {
            const megaSubcategories = document.getElementById('megaSubcategories');
            const category = mainCategories.find(cat => cat.id === categoryId);
            
            if (!category) return;
            
            megaSubcategories.innerHTML = '';
            
            category.subcategories.forEach(subcategory => {
                const section = document.createElement('div');
                section.className = 'subcategory-section';
                section.innerHTML = `
                    <h4>${subcategory.name}</h4>
                    <ul class="subcategory-list">
                        ${subcategory.subs.map(sub => `<li><a href="#">${sub}</a></li>`).join('')}
                    </ul>
                `;
                megaSubcategories.appendChild(section);
            });
        }
        
        // Initialiser les catégories vedettes
        function initializeFeaturedCategories() {
            const container = document.getElementById('featuredCategories');
            container.innerHTML = '';
            
            featuredCategoriesData.forEach((category, index) => {
                const card = document.createElement('a');
                card.href = '#';
                card.className = 'category-card';
                card.innerHTML = `
                    <div class="category-image">
                        <img src="${category.image || categoryImages[index % categoryImages.length]}" alt="${category.name}">
                    </div>
                    <div class="category-info">
                        <div class="category-name">${category.name}</div>
                        <div class="category-count">${category.count}</div>
                    </div>
                `;
                container.appendChild(card);
            });
        }
        
        // Générer une carte produit
        function generateProductCard(product, index) {
            const hasOriginalPrice = product.originalPrice;
            
            return `
                <div class="product-card">
                    ${product.badge ? `<div class="product-badge">${product.badge}</div>` : ''}
                    <div class="product-image">
                        <img src="${product.image || productImages[index % productImages.length]}" alt="${product.name}">
                    </div>
                    <div class="product-info">
                        <div class="product-name">${product.name}</div>
                        <div class="product-price">
                            ${product.price}
                            ${hasOriginalPrice ? `<span class="product-original-price">${product.originalPrice}</span>` : ''}
                        </div>
                        <div class="product-moq">MOQ: ${product.moq}</div>
                        <div class="product-vendor">
                            ${product.vendor}
                            <i class="bi bi-patch-check-fill vendor-verified"></i>
                        </div>
                        <div class="product-rating">
                            <div class="rating-stars">
                                ${generateStarRating(product.rating)}
                            </div>
                            <div class="rating-count">(${Math.floor(Math.random() * 2000) + 500})</div>
                        </div>
                        <div class="product-actions">
                            <button class="btn-quick-view"><i class="bi bi-eye"></i> Voir</button>
                            <button class="btn-contact-seller"><i class="bi bi-chat-dots"></i> Contacter</button>
                        </div>
                    </div>
                </div>
            `;
        }
        
        // Initialiser les produits tendance
        function initializeTrendingProducts() {
            const container = document.getElementById('trendingProducts');
            container.innerHTML = '';
            
            productsData.forEach((product, index) => {
                container.innerHTML += generateProductCard(product, index);
            });
        }
        
        // Initialiser les blocs de catégories
        function initializeCategoryBlocks() {
            const container = document.getElementById('categoryBlocks');
            container.innerHTML = '';
            
            categoryBlocksData.forEach(block => {
                const blockElement = document.createElement('div');
                blockElement.className = 'category-block';
                
                // Générer les produits du bloc
                let productsHTML = '';
                block.products.forEach((product, index) => {
                    productsHTML += generateProductCard(product, index);
                });
                
                blockElement.innerHTML = `
                    <div class="category-block-header">
                        <div class="category-block-title">
                            <i class="bi ${block.icon}"></i> ${block.title}
                        </div>
                        <div class="category-block-subcategories">
                            ${block.subcategories.map(sub => `<a href="#" class="subcategory-link">${sub}</a>`).join('')}
                        </div>
                    </div>
                    <div class="category-block-products">
                        ${productsHTML}
                    </div>
                `;
                
                container.appendChild(blockElement);
            });
        }
        
        // Initialiser les meilleurs vendeurs
        function initializeTopVendors() {
            const container = document.getElementById('topVendors');
            container.innerHTML = '';
            
            vendorsData.forEach((vendor, index) => {
                const card = document.createElement('div');
                card.className = 'vendor-card';
                card.innerHTML = `
                    <div class="vendor-logo">
                        <img src="${vendor.image || getRandomVendorImage(index)}" alt="${vendor.name}">
                    </div>
                    <div class="vendor-info">
                        <div class="vendor-name">${vendor.name}</div>
                        <div class="vendor-location">
                            <i class="bi bi-geo-alt"></i> ${vendor.location}
                        </div>
                        <div class="vendor-products">${vendor.products}</div>
                        <div class="vendor-rating">
                            <div class="rating-stars">
                                ${generateStarRating(vendor.rating)}
                            </div>
                            <div class="rating-count">${vendor.rating}/5</div>
                        </div>
                        <button class="btn-visit-store"><i class="bi bi-shop"></i> Voir boutique</button>
                    </div>
                `;
                container.appendChild(card);
            });
        }
        
        // Initialiser les offres du jour
        function initializeDailyDeals() {
            const container = document.getElementById('dailyDeals');
            container.innerHTML = '';
            
            // Prendre les 8 premiers produits avec badge "Promo" ou "Vente rapide"
            const dealProducts = productsData
                .filter(p => p.badge === 'Promo' || p.badge === 'Vente rapide')
                .slice(0, 8);
            
            dealProducts.forEach((product, index) => {
                container.innerHTML += generateProductCard(product, index);
            });
        }
        
        // Initialiser les nouveautés
        function initializeNewArrivals() {
            const container = document.getElementById('newArrivals');
            container.innerHTML = '';
            
            // Prendre 8 produits au hasard
            const shuffledProducts = [...productsData].sort(() => 0.5 - Math.random()).slice(0, 8);
            
            shuffledProducts.forEach((product, index) => {
                container.innerHTML += generateProductCard({...product, badge: 'Nouveau'}, index);
            });
        }
        
        // Initialiser les recommandations
        function initializeRecommendations() {
            const container = document.getElementById('recommendations');
            container.innerHTML = '';
            
            // Prendre 8 produits au hasard
            const shuffledProducts = [...productsData].sort(() => 0.5 - Math.random()).slice(0, 8);
            
            shuffledProducts.forEach((product, index) => {
                container.innerHTML += generateProductCard(product, index);
            });
        }
        
        // Initialiser le compte à rebours
        function initializeCountdown() {
            const hoursElement = document.getElementById('countdown-hours');
            const minutesElement = document.getElementById('countdown-minutes');
            const secondsElement = document.getElementById('countdown-seconds');
            
            // Définir une heure de fin (12 heures dans le futur)
            const endTime = new Date();
            endTime.setHours(endTime.getHours() + 12);
            
            function updateCountdown() {
                const now = new Date();
                const difference = endTime - now;
                
                if (difference <= 0) {
                    // Le compte à rebours est terminé
                    hoursElement.textContent = '00';
                    minutesElement.textContent = '00';
                    secondsElement.textContent = '00';
                    return;
                }
                
                const hours = Math.floor(difference / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);
                
                hoursElement.textContent = hours.toString().padStart(2, '0');
                minutesElement.textContent = minutes.toString().padStart(2, '0');
                secondsElement.textContent = seconds.toString().padStart(2, '0');
            }
            
            // Mettre à jour immédiatement puis toutes les secondes
            updateCountdown();
            setInterval(updateCountdown, 1000);
        }
        
        // ===== GESTION DES ÉVÉNEMENTS =====
        
        // Gérer le méga-menu
        function setupEventListeners() {
            const categoriesBtn = document.getElementById('categoriesBtn');
            const megaMenu = document.getElementById('megaMenu');
            
            // Ouvrir/fermer le méga-menu au survol
            categoriesBtn.addEventListener('mouseenter', () => {
                megaMenu.classList.add('active');
            });
            
            categoriesBtn.addEventListener('mouseleave', (e) => {
                // Vérifier si la souris est passée au méga-menu
                if (!megaMenu.contains(e.relatedTarget)) {
                    megaMenu.classList.remove('active');
                }
            });
            
            megaMenu.addEventListener('mouseleave', (e) => {
                // Vérifier si la souris est passée au bouton catégories
                if (!categoriesBtn.contains(e.relatedTarget)) {
                    megaMenu.classList.remove('active');
                }
            });
            
            // Gérer la recherche
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');
            
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query) {
                    alert(`Recherche de: "${query}"\n(En production, cela redirigerait vers la page de résultats)`);
                    // En production: window.location.href = `/search?q=${encodeURIComponent(query)}`;
                }
            });
            
            // Gérer les suggestions de recherche
            searchInput.addEventListener('input', function() {
                // En production, on ferait une requête AJAX pour les suggestions
                // Pour l'exemple, nous affichons simplement un message
            });
            
            // Gérer les clics sur les produits
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-contact-seller') || e.target.closest('.btn-contact-seller')) {
                    e.preventDefault();
                    alert('Redirection vers la messagerie pour contacter le vendeur');
                    // En production: window.location.href = `/contact-seller/${sellerId}`;
                }
                
                if (e.target.classList.contains('btn-quick-view') || e.target.closest('.btn-quick-view')) {
                    e.preventDefault();
                    alert('Affichage des détails du produit');
                    // En production: ouvrir une modale ou rediriger vers la page produit
                }
                
                if (e.target.classList.contains('btn-visit-store') || e.target.closest('.btn-visit-store')) {
                    e.preventDefault();
                    alert('Redirection vers la boutique du vendeur');
                    // En production: window.location.href = `/vendor/${vendorId}`;
                }
            });
            
            // Gérer les hover sur les cartes
            const productCards = document.querySelectorAll('.product-card, .vendor-card, .category-card');
            productCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        }
        
        // ===== INITIALISATION AU CHARGEMENT =====
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser tous les composants
            initializeMegaMenu();
            initializeFeaturedCategories();
            initializeTrendingProducts();
            initializeCategoryBlocks();
            initializeTopVendors();
            initializeDailyDeals();
            initializeNewArrivals();
            initializeRecommendations();
            initializeCountdown();
            setupEventListeners();
            
            console.log('Kondo Market - Marketplace frontend initialisé avec succès');
            console.log(`${mainCategories.length} catégories principales chargées`);
            console.log(`${productsData.length} produits chargés`);
            console.log(`${vendorsData.length} vendeurs chargés`);
            console.log(`${categoryImages.length} images de catégories disponibles`);
            console.log(`${productImages.length} images de produits disponibles`);
        });
   