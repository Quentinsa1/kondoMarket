@extends('template.template')

@section('title', 'Inscription vendeur - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : INSCRIPTION VENDEUR ===== -->
<section class="create-store-section py-5">
    <div class="container-xxl">
        <!-- Sélecteur de type de vendeur -->
        <div class="seller-type-selector mb-5">
            <div class="text-center mb-4">
                <h1 class="h2">Devenez vendeur sur Kondo Market</h1>
                <p class="text-muted">Choisissez votre profil pour commencer</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <input type="radio" name="seller_type" value="individual" id="individualSeller" class="seller-type-radio" checked>
                    <label for="individualSeller" class="seller-type-card">
                        <div class="seller-type-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="seller-type-info">
                            <h4>Particulier</h4>
                            <p class="text-muted mb-3">Vente occasionnelle ou services</p>
                            <div class="text-start">
                                <p><i class="bi bi-check-circle text-success me-2"></i> Vendez vos articles d'occasion</p>
                                <p><i class="bi bi-check-circle text-success me-2"></i> Proposez vos services</p>
                                <p><i class="bi bi-check-circle text-success me-2"></i> Documents simplifiés</p>
                                <p><i class="bi bi-check-circle text-success me-2"></i> Commission réduite</p>
                            </div>
                        </div>
                        <div class="seller-type-footer mt-3">
                            <span class="badge bg-info">Idéal pour débuter</span>
                        </div>
                    </label>
                </div>
                
                <div class="col-md-5">
                    <input type="radio" name="seller_type" value="company" id="companySeller" class="seller-type-radio">
                    <label for="companySeller" class="seller-type-card">
                        <div class="seller-type-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="seller-type-info">
                            <h4>Entreprise / Commerce</h4>
                            <p class="text-muted mb-3">Boutique, restaurant, services pro</p>
                            <div class="text-start">
                                <p><i class="bi bi-check-circle text-success me-2"></i> Vendez vos produits/services</p>
                                <p><i class="bi bi-check-circle text-success me-2"></i> Outils de gestion avancés</p>
                                <p><i class="bi bi-check-circle text-success me-2"></i> Facturation professionnelle</p>
                                <p><i class="bi bi-check-circle text-success me-2"></i> Comptes multi-utilisateurs</p>
                            </div>
                        </div>
                        <div class="seller-type-footer mt-3">
                            <span class="badge bg-success">Solution professionnelle</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Étapes de progression -->
        <div class="progress-steps mb-5">
            <div class="steps d-flex justify-content-between">
                <div class="step active">
                    <div class="step-circle">1</div>
                    <div class="step-label">Type de vendeur</div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-circle">2</div>
                    <div class="step-label">Informations</div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Vérification</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="store-creation-card">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <i class="bi bi-person-plus"></i> Créer votre compte vendeur
                        </h2>
                        <p class="text-muted mb-0">Remplissez vos informations pour commencer à vendre</p>
                    </div>
                    
                    <div class="card-body">
                        <!-- Messages d'erreur -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <h5>Veuillez corriger les erreurs suivantes :</h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form id="vendorRegistrationForm" action="{{ route('vendor.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Champ caché pour le type de vendeur -->
                            <input type="hidden" name="vendor_type" id="vendorTypeInput" value="individual">
                            
                            <!-- Informations communes -->
                            <div class="mb-4">
                                <h4 class="section-title mb-3">Informations de connexion</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="full_name" class="form-label">
                                            <strong>Nom complet *</strong>
                                        </label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                               id="full_name" name="full_name" 
                                               value="{{ old('full_name') }}" 
                                               placeholder="Votre nom et prénom" required>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">
                                            <strong>Email *</strong>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="votre@email.com" required>
                                        <div class="form-text">Cet email servira pour vos connexions</div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">
                                            <strong>Téléphone *</strong>
                                        </label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" 
                                               value="{{ old('phone') }}" 
                                               placeholder="+33 1 23 45 67 89" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">
                                            <strong>Mot de passe *</strong>
                                        </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" 
                                               placeholder="●●●●●●●●" required>
                                        <div class="form-text">Minimum 8 caractères</div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">
                                            <strong>Confirmez le mot de passe *</strong>
                                        </label>
                                        <input type="password" class="form-control" 
                                               id="password_confirmation" name="password_confirmation" 
                                               placeholder="●●●●●●●●" required>
                                    </div>
                                    
                                    <!-- === PAYS : LISTE COMPLÈTE === -->
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label">
                                            <strong>Pays *</strong>
                                        </label>
                                        <select class="form-select @error('country') is-invalid @enderror" id="country" name="country" required>
                                            <option value="">Sélectionnez un pays</option>
                                            @php
                                                $countries = [
                                                    'AF' => 'Afghanistan', 'ZA' => 'Afrique du Sud', 'AL' => 'Albanie', 'DZ' => 'Algérie',
                                                    'DE' => 'Allemagne', 'AD' => 'Andorre', 'AO' => 'Angola', 'AI' => 'Anguilla',
                                                    'AQ' => 'Antarctique', 'AG' => 'Antigua-et-Barbuda', 'SA' => 'Arabie saoudite',
                                                    'AR' => 'Argentine', 'AM' => 'Arménie', 'AW' => 'Aruba', 'AU' => 'Australie',
                                                    'AT' => 'Autriche', 'AZ' => 'Azerbaïdjan', 'BS' => 'Bahamas', 'BH' => 'Bahreïn',
                                                    'BD' => 'Bangladesh', 'BB' => 'Barbade', 'BY' => 'Biélorussie', 'BE' => 'Belgique',
                                                    'BZ' => 'Belize', 'BJ' => 'Bénin', 'BM' => 'Bermudes', 'BT' => 'Bhoutan',
                                                    'BO' => 'Bolivie', 'BA' => 'Bosnie-Herzégovine', 'BW' => 'Botswana', 'BR' => 'Brésil',
                                                    'BN' => 'Brunéi Darussalam', 'BG' => 'Bulgarie', 'BF' => 'Burkina Faso', 'BI' => 'Burundi',
                                                    'KH' => 'Cambodge', 'CM' => 'Cameroun', 'CA' => 'Canada', 'CV' => 'Cap-Vert',
                                                    'CL' => 'Chili', 'CN' => 'Chine', 'CY' => 'Chypre', 'CO' => 'Colombie',
                                                    'KM' => 'Comores', 'CG' => 'Congo-Brazzaville', 'CD' => 'Congo-Kinshasa', 'KP' => 'Corée du Nord',
                                                    'KR' => 'Corée du Sud', 'CR' => 'Costa Rica', 'CI' => 'Côte d’Ivoire', 'HR' => 'Croatie',
                                                    'CU' => 'Cuba', 'CW' => 'Curaçao', 'DK' => 'Danemark', 'DJ' => 'Djibouti',
                                                    'DM' => 'Dominique', 'EG' => 'Égypte', 'AE' => 'Émirats arabes unis', 'EC' => 'Équateur',
                                                    'ER' => 'Érythrée', 'ES' => 'Espagne', 'EE' => 'Estonie', 'SZ' => 'Eswatini',
                                                    'US' => 'États-Unis', 'ET' => 'Éthiopie', 'FJ' => 'Fidji', 'FI' => 'Finlande',
                                                    'FR' => 'France', 'GA' => 'Gabon', 'GM' => 'Gambie', 'GE' => 'Géorgie',
                                                    'GH' => 'Ghana', 'GI' => 'Gibraltar', 'GR' => 'Grèce', 'GD' => 'Grenade',
                                                    'GL' => 'Groenland', 'GP' => 'Guadeloupe', 'GU' => 'Guam', 'GT' => 'Guatemala',
                                                    'GG' => 'Guernesey', 'GN' => 'Guinée', 'GQ' => 'Guinée équatoriale', 'GW' => 'Guinée-Bissau',
                                                    'GY' => 'Guyana', 'GF' => 'Guyane française', 'HT' => 'Haïti', 'HN' => 'Honduras',
                                                    'HU' => 'Hongrie', 'BV' => 'Île Bouvet', 'CX' => 'Île Christmas', 'IM' => 'Île de Man',
                                                    'NF' => 'Île Norfolk', 'KY' => 'Îles Caïmans', 'CC' => 'Îles Cocos', 'CK' => 'Îles Cook',
                                                    'AX' => 'Îles d\'Åland', 'FO' => 'Îles Féroé', 'HM' => 'Îles Heard-et-MacDonald',
                                                    'FK' => 'Îles Malouines', 'MP' => 'Îles Mariannes du Nord', 'MH' => 'Îles Marshall',
                                                    'PN' => 'Îles Pitcairn', 'SB' => 'Îles Salomon', 'TC' => 'Îles Turques-et-Caïques',
                                                    'VG' => 'Îles Vierges britanniques', 'VI' => 'Îles Vierges des États-Unis', 'IN' => 'Inde',
                                                    'ID' => 'Indonésie', 'IQ' => 'Irak', 'IR' => 'Iran', 'IE' => 'Irlande',
                                                    'IS' => 'Islande', 'IL' => 'Israël', 'IT' => 'Italie', 'JM' => 'Jamaïque',
                                                    'JP' => 'Japon', 'JE' => 'Jersey', 'JO' => 'Jordanie', 'KZ' => 'Kazakhstan',
                                                    'KE' => 'Kenya', 'KG' => 'Kirghizistan', 'KI' => 'Kiribati', 'KW' => 'Koweït',
                                                    'RE' => 'La Réunion', 'LA' => 'Laos', 'LS' => 'Lesotho', 'LV' => 'Lettonie',
                                                    'LB' => 'Liban', 'LR' => 'Liberia', 'LY' => 'Libye', 'LI' => 'Liechtenstein',
                                                    'LT' => 'Lituanie', 'LU' => 'Luxembourg', 'MK' => 'Macédoine du Nord', 'MG' => 'Madagascar',
                                                    'MY' => 'Malaisie', 'MW' => 'Malawi', 'MV' => 'Maldives', 'ML' => 'Mali',
                                                    'MT' => 'Malte', 'MA' => 'Maroc', 'MQ' => 'Martinique', 'MU' => 'Maurice',
                                                    'MR' => 'Mauritanie', 'YT' => 'Mayotte', 'MX' => 'Mexique', 'FM' => 'Micronésie',
                                                    'MD' => 'Moldavie', 'MC' => 'Monaco', 'MN' => 'Mongolie', 'ME' => 'Monténégro',
                                                    'MS' => 'Montserrat', 'MZ' => 'Mozambique', 'MM' => 'Myanmar', 'NA' => 'Namibie',
                                                    'NR' => 'Nauru', 'NP' => 'Népal', 'NI' => 'Nicaragua', 'NE' => 'Niger',
                                                    'NG' => 'Nigéria', 'NU' => 'Niue', 'NO' => 'Norvège', 'NC' => 'Nouvelle-Calédonie',
                                                    'NZ' => 'Nouvelle-Zélande', 'OM' => 'Oman', 'UG' => 'Ouganda', 'UZ' => 'Ouzbékistan',
                                                    'PK' => 'Pakistan', 'PW' => 'Palaos', 'PA' => 'Panama', 'PG' => 'Papouasie-Nouvelle-Guinée',
                                                    'PY' => 'Paraguay', 'NL' => 'Pays-Bas', 'PE' => 'Pérou', 'PH' => 'Philippines',
                                                    'PL' => 'Pologne', 'PF' => 'Polynésie française', 'PR' => 'Porto Rico', 'PT' => 'Portugal',
                                                    'QA' => 'Qatar', 'HK' => 'R.A.S. chinoise de Hong Kong', 'MO' => 'R.A.S. chinoise de Macao',
                                                    'CF' => 'République centrafricaine', 'DO' => 'République dominicaine', 'RO' => 'Roumanie',
                                                    'GB' => 'Royaume-Uni', 'RU' => 'Russie', 'RW' => 'Rwanda', 'EH' => 'Sahara occidental',
                                                    'BL' => 'Saint-Barthélemy', 'KN' => 'Saint-Christophe-et-Niévès', 'SM' => 'Saint-Marin',
                                                    'MF' => 'Saint-Martin', 'SX' => 'Saint-Martin (partie néerlandaise)', 'PM' => 'Saint-Pierre-et-Miquelon',
                                                    'VA' => 'Saint-Siège', 'VC' => 'Saint-Vincent-et-les-Grenadines', 'SH' => 'Sainte-Hélène',
                                                    'LC' => 'Sainte-Lucie', 'SV' => 'Salvador', 'WS' => 'Samoa', 'AS' => 'Samoa américaines',
                                                    'ST' => 'Sao Tomé-et-Principe', 'SN' => 'Sénégal', 'RS' => 'Serbie', 'SC' => 'Seychelles',
                                                    'SL' => 'Sierra Leone', 'SG' => 'Singapour', 'SK' => 'Slovaquie', 'SI' => 'Slovénie',
                                                    'SO' => 'Somalie', 'SD' => 'Soudan', 'SS' => 'Soudan du Sud', 'LK' => 'Sri Lanka',
                                                    'SE' => 'Suède', 'CH' => 'Suisse', 'SR' => 'Suriname', 'SJ' => 'Svalbard et Jan Mayen',
                                                    'SY' => 'Syrie', 'TJ' => 'Tadjikistan', 'TW' => 'Taïwan', 'TZ' => 'Tanzanie',
                                                    'TD' => 'Tchad', 'CZ' => 'Tchéquie', 'TF' => 'Terres australes françaises',
                                                    'IO' => 'Territoire britannique de l\'océan Indien', 'PS' => 'Territoires palestiniens',
                                                    'TH' => 'Thaïlande', 'TL' => 'Timor oriental', 'TG' => 'Togo', 'TK' => 'Tokelau',
                                                    'TO' => 'Tonga', 'TT' => 'Trinité-et-Tobago', 'TN' => 'Tunisie', 'TM' => 'Turkménistan',
                                                    'TR' => 'Turquie', 'TV' => 'Tuvalu', 'UA' => 'Ukraine', 'UY' => 'Uruguay',
                                                    'VU' => 'Vanuatu', 'VE' => 'Venezuela', 'VN' => 'Vietnam', 'WF' => 'Wallis-et-Futuna',
                                                    'YE' => 'Yémen', 'ZM' => 'Zambie', 'ZW' => 'Zimbabwe'
                                                ];
                                            @endphp
                                            @foreach($countries as $code => $name)
                                                <option value="{{ $code }}" {{ old('country') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">
                                            <strong>Ville *</strong>
                                        </label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" 
                                               value="{{ old('city') }}" 
                                               placeholder="Paris" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informations spécifiques pour PARTICULIER -->
                            <div id="individualFields" class="mb-4">
                                <h4 class="section-title mb-3">Informations du vendeur particulier</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="display_name" class="form-label">
                                            <strong>Nom d'affichage *</strong>
                                        </label>
                                        <input type="text" class="form-control @error('display_name') is-invalid @enderror" 
                                               id="display_name" name="display_name" 
                                               value="{{ old('display_name') }}" 
                                               placeholder="Ex: Jean D. ou Artisan Jean">
                                        <div class="form-text">Le nom qui apparaîtra publiquement</div>
                                        @error('display_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="activity_type" class="form-label">
                                            <strong>Type d'activité *</strong>
                                        </label>
                                        <select class="form-select @error('activity_type') is-invalid @enderror" id="activity_type" name="activity_type">
                                            <option value="">Choisissez votre activité</option>
                                            <option value="selling" {{ old('activity_type') == 'selling' ? 'selected' : '' }}>Vente d'articles</option>
                                            <option value="service" {{ old('activity_type') == 'service' ? 'selected' : '' }}>Prestation de service</option>
                                            <option value="both" {{ old('activity_type') == 'both' ? 'selected' : '' }}>Vente et service</option>
                                        </select>
                                        @error('activity_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="individual_description" class="form-label">
                                            <strong>Description courte</strong>
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="individual_description" 
                                                  name="description" rows="3" 
                                                  placeholder="Décrivez en quelques mots ce que vous vendez ou proposez comme services...">{{ old('description') }}</textarea>
                                        <div class="form-text">Maximum 500 caractères</div>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="upload-card">
                                            <label class="form-label">
                                                <strong>Photo de profil (optionnel)</strong>
                                            </label>
                                            <div class="upload-area" id="avatarUpload">
                                                <i class="bi bi-person-circle"></i>
                                                <p>Ajoutez votre photo</p>
                                                <p class="text-muted">ou <span class="text-primary">parcourir</span></p>
                                                <input type="file" id="avatarFile" name="avatar" accept="image/*" hidden>
                                            </div>
                                            <div class="form-text">Format: JPG, PNG, max 2MB</div>
                                        </div>
                                    </div>

                                    <!-- === NOUVEAU CHAMP : PIÈCE D'IDENTITÉ OBLIGATOIRE === -->
                                    <div class="col-md-6 mb-3">
                                        <div class="upload-card">
                                            <label class="form-label">
                                                <strong>Pièce d'identité / Passeport *</strong>
                                            </label>
                                            <div class="upload-area" id="idDocumentUpload">
                                                <i class="bi bi-card-image"></i>
                                                <p>Téléchargez votre pièce d'identité</p>
                                                <p class="text-muted">ou <span class="text-primary">parcourir</span></p>
                                                <input type="file" id="idDocumentFile" name="id_document" accept="image/*,application/pdf" required>
                                            </div>
                                            <div class="form-text">Formats acceptés : JPG, PNG, PDF (max 5 Mo)</div>
                                            @error('id_document')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informations spécifiques pour ENTREPRISE -->
                            <div id="companyFields" class="mb-4" style="display: none;">
                                <h4 class="section-title mb-3">Informations de l'entreprise</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="company_name" class="form-label">
                                            <strong>Nom de l'entreprise *</strong>
                                        </label>
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                               id="company_name" name="company_name" 
                                               value="{{ old('company_name') }}" 
                                               placeholder="Ex: SARL TechWorld">
                                        @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="company_category" class="form-label">
                                            <strong>Catégorie d'entreprise *</strong>
                                        </label>
                                        <select class="form-select @error('company_category') is-invalid @enderror" id="company_category" name="company_category">
                                            <option value="">Sélectionnez une catégorie</option>
                                            <option value="restaurant" {{ old('company_category') == 'restaurant' ? 'selected' : '' }}>Restaurant / Café</option>
                                            <option value="boutique" {{ old('company_category') == 'boutique' ? 'selected' : '' }}>Boutique / Magasin</option>
                                            <option value="service" {{ old('company_category') == 'service' ? 'selected' : '' }}>Services professionnels</option>
                                            <option value="artisan" {{ old('company_category') == 'artisan' ? 'selected' : '' }}>Artisan / Métier</option>
                                            <option value="ecommerce" {{ old('company_category') == 'ecommerce' ? 'selected' : '' }}>E-commerce</option>
                                            <option value="other" {{ old('company_category') == 'other' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('company_category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="company_description" class="form-label">
                                            <strong>Description de l'entreprise</strong>
                                        </label>
                                        <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description" 
                                                  name="company_description" rows="3" 
                                                  placeholder="Présentez votre entreprise, vos produits ou services...">{{ old('company_description') }}</textarea>
                                        @error('company_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">
                                            <strong>Adresse commerciale</strong>
                                        </label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                               id="address" name="address" 
                                               value="{{ old('address') }}" 
                                               placeholder="123 Rue de la République">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- === CHAMP SIRET SUPPRIMÉ === -->
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="upload-card">
                                            <label class="form-label">
                                                <strong>Logo de l'entreprise</strong>
                                            </label>
                                            <div class="upload-area" id="logoUpload">
                                                <i class="bi bi-cloud-upload"></i>
                                                <p>Ajoutez votre logo</p>
                                                <p class="text-muted">ou <span class="text-primary">parcourir</span></p>
                                                <input type="file" id="logoFile" name="logo" accept="image/*" hidden>
                                            </div>
                                            <div class="form-text">Format: JPG, PNG, max 2MB</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="upload-card">
                                            <label class="form-label">
                                                <strong>Image de couverture (optionnel)</strong>
                                            </label>
                                            <div class="upload-area" id="coverUpload">
                                                <i class="bi bi-image"></i>
                                                <p>Ajoutez une image</p>
                                                <p class="text-muted">ou <span class="text-primary">parcourir</span></p>
                                                <input type="file" id="coverFile" name="cover_image" accept="image/*" hidden>
                                            </div>
                                            <div class="form-text">Format: JPG, PNG, max 5MB</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Conditions d'utilisation -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="terms">
                                        J'accepte les <a href="{{ route('terms') }}" class="text-primary" target="_blank">Conditions Générales d'Utilisation</a> et la <a href="{{ route('privacy') }}" class="text-primary" target="_blank">Politique de Confidentialité</a> *
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="newsletter">
                                        Je souhaite recevoir des conseils et offres spéciales par email
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg" id="submitButton">
                                    <i class="bi bi-check-circle"></i> S'inscrire comme vendeur
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Aperçu du profil -->
                <div class="preview-card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-eye"></i> Aperçu de votre profil
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="vendor-preview">
                            <div class="preview-avatar text-center mb-3" id="previewAvatar">
                                <div class="avatar-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            </div>
                            <div class="preview-info text-center">
                                <h4 id="previewName">{{ old('full_name', 'Nom du vendeur') }}</h4>
                                <div class="vendor-type-badge mb-2" id="previewVendorType">
                                    <span class="badge bg-info">Particulier</span>
                                </div>
                                <p id="previewDescription" class="text-muted small">
                                    {{ old('description', old('company_description', 'Description apparaîtra ici...')) }}
                                </p>
                                <div class="preview-stats mt-3">
                                    <div class="stat">
                                        <i class="bi bi-geo-alt"></i>
                                        <span id="previewLocation">
                                            {{ old('city', 'Ville') }}, 
                                            @php
                                                $countryName = $countries[old('country')] ?? 'Pays';
                                            @endphp
                                            {{ $countryName }}
                                        </span>
                                    </div>
                                    <div class="stat">
                                        <i class="bi bi-shield-check"></i>
                                        <span id="previewStatus">En attente de vérification</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Avantages -->
                <div class="benefits-card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-star"></i> Avantages Kondo Market
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="benefits-list">
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Large audience :</strong> Des milliers d'acheteurs actifs
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Paiement sécurisé :</strong> Transactions protégées
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Support dédié :</strong> Assistance 6j/7
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Outils simples :</strong> Gestion facile de vos ventes
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Prochaines étapes -->
                <div class="next-steps-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-list-check"></i> Après l'inscription
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="step-item mb-3">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Vérification du compte</strong>
                                <p class="small mb-0">Notre équipe valide votre inscription sous 48h</p>
                            </div>
                        </div>
                        <div class="step-item mb-3">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Configuration de votre espace</strong>
                                <p class="small mb-0">Personnalisez votre profil et vos paramètres</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Ajout de vos premiers produits/services</strong>
                                <p class="small mb-0">Commencez à vendre sur la plateforme</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .seller-type-selector .card {
        border: 2px solid var(--light-color);
        border-radius: var(--border-radius);
        overflow: hidden;
    }
    
    .seller-type-radio {
        display: none;
    }
    
    .seller-type-card {
        display: block;
        padding: 30px;
        background-color: white;
        border: 2px solid var(--gray-light);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        height: 100%;
        text-align: center;
    }
    
    .seller-type-radio:checked + .seller-type-card {
        border-color: var(--primary-color);
        background-color: rgba(47, 143, 131, 0.05);
        box-shadow: 0 4px 20px rgba(47, 143, 131, 0.15);
    }
    
    .seller-type-icon {
        width: 80px;
        height: 80px;
        background-color: var(--light-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--primary-color);
        font-size: 32px;
        transition: var(--transition);
    }
    
    .seller-type-radio:checked + .seller-type-card .seller-type-icon {
        background-color: var(--primary-color);
        color: white;
        transform: scale(1.05);
    }
    
    .seller-type-info h4 {
        color: var(--secondary-color);
        margin-bottom: 10px;
    }
    
    .seller-type-footer {
        padding-top: 15px;
        border-top: 1px solid var(--gray-light);
    }
    
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        background-color: var(--light-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 48px;
        color: var(--primary-color);
    }
    
    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .benefits-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
    }
    
    .benefits-list li i {
        margin-right: 10px;
        margin-top: 3px;
        flex-shrink: 0;
    }
    
    .step-item {
        display: flex;
        align-items: flex-start;
    }
    
    .step-number {
        width: 30px;
        height: 30px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .step-content {
        flex: 1;
    }
    
    .upload-area {
        border: 2px dashed var(--gray-light);
        border-radius: var(--border-radius);
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background-color: white;
    }
    
    .upload-area:hover {
        border-color: var(--primary-color);
        background-color: rgba(47, 143, 131, 0.05);
    }
    
    .upload-area i {
        font-size: 48px;
        color: var(--primary-color);
        margin-bottom: 10px;
    }
    
    .progress-steps .steps {
        position: relative;
    }
    
    .step {
        text-align: center;
        position: relative;
        z-index: 2;
    }
    
    .step-circle {
        width: 40px;
        height: 40px;
        border: 2px solid var(--gray-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        background-color: white;
        font-weight: bold;
        color: var(--gray);
        transition: var(--transition);
    }
    
    .step.active .step-circle {
        border-color: var(--primary-color);
        background-color: var(--primary-color);
        color: white;
    }
    
    .step-line {
        flex: 1;
        height: 2px;
        background-color: var(--gray-light);
        margin-top: 20px;
        position: relative;
        z-index: 1;
    }
    
    .step-label {
        font-size: 0.9rem;
        color: var(--gray);
    }
    
    .step.active .step-label {
        color: var(--primary-color);
        font-weight: 600;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélecteur de type de vendeur
    const vendorTypeRadios = document.querySelectorAll('.seller-type-radio');
    const vendorTypeInput = document.getElementById('vendorTypeInput');
    const individualFields = document.getElementById('individualFields');
    const companyFields = document.getElementById('companyFields');
    const previewVendorType = document.getElementById('previewVendorType');
    
    vendorTypeRadios.forEach(radio => {
    radio.addEventListener('change', function() {
        const vendorType = this.value;
        vendorTypeInput.value = vendorType;

        const idDocumentInput = document.getElementById('idDocumentFile');

        if (vendorType === 'individual') {
            individualFields.style.display = 'block';
            companyFields.style.display = 'none';

            idDocumentInput.setAttribute('required', 'required');

            previewVendorType.innerHTML = '<span class="badge bg-info">Particulier</span>';
        } else {
            individualFields.style.display = 'none';
            companyFields.style.display = 'block';

            idDocumentInput.removeAttribute('required');

            previewVendorType.innerHTML = '<span class="badge bg-success">Entreprise</span>';
        }

        updatePreviewDescription();
        updateProgressSteps(2);
    });
});
    
    // Mise à jour de l'aperçu en temps réel
    const fullNameInput = document.getElementById('full_name');
    const cityInput = document.getElementById('city');
    const countrySelect = document.getElementById('country');
    const displayNameInput = document.getElementById('display_name');
    const descriptionInput = document.getElementById('individual_description');
    const companyNameInput = document.getElementById('company_name');
    const companyDescriptionInput = document.getElementById('company_description');
    
    function updatePreviewName() {
        const name = fullNameInput.value || 'Nom du vendeur';
        document.getElementById('previewName').textContent = name;
    }
    
    function updatePreviewLocation() {
        const city = cityInput.value || 'Ville';
        const country = countrySelect.options[countrySelect.selectedIndex]?.text || 'Pays';
        document.getElementById('previewLocation').textContent = city + ', ' + country;
    }
    
   function updatePreviewDescription() {
    const vendorType = vendorTypeInput.value;

    if (vendorType === 'individual') {
        const desc = descriptionInput.value || 'Description apparaîtra ici...';
        document.getElementById('previewDescription').textContent = desc;
    } else {
        const desc = companyDescriptionInput.value || 'Description apparaîtra ici...';
        document.getElementById('previewDescription').textContent = desc;
    }
}
if (vendorType === 'individual') {
    individualFields.style.display = 'block';
    companyFields.style.display = 'none';

    idDocumentInput.setAttribute('required', 'required');

    previewVendorType.innerHTML = '<span class="badge bg-info">Particulier</span>';
} else {
    individualFields.style.display = 'none';
    companyFields.style.display = 'block';

    idDocumentInput.removeAttribute('required');

    previewVendorType.innerHTML = '<span class="badge bg-success">Entreprise</span>';
}            document.getElementById('previewDescription').textContent = desc;
        } else {
            const desc = companyDescriptionInput.value || 'Description apparaîtra ici...';
            document.getElementById('previewDescription').textContent = desc;
        }
    }
    
    fullNameInput.addEventListener('input', updatePreviewName);
    cityInput.addEventListener('input', updatePreviewLocation);
    countrySelect.addEventListener('change', updatePreviewLocation);
    descriptionInput.addEventListener('input', updatePreviewDescription);
    companyDescriptionInput.addEventListener('input', updatePreviewDescription);
    
    // Gestion des uploads d'images
    function setupFileUpload(uploadAreaId, fileInputId, previewCallback) {
        const uploadArea = document.getElementById(uploadAreaId);
        const fileInput = document.getElementById(fileInputId);
        
        if (!uploadArea || !fileInput) return;
        
        uploadArea.addEventListener('click', () => fileInput.click());
        
        fileInput.addEventListener('change', function(e) {
            if (e.target.files[0]) {
                const file = e.target.files[0];
                // Validation de la taille (avec gestion spéciale pour les PDF ou images > 5Mo)
                let maxSize = 2 * 1024 * 1024; // 2MB par défaut
                if (fileInputId.includes('cover')) maxSize = 5 * 1024 * 1024;
                if (fileInputId.includes('idDocument')) maxSize = 5 * 1024 * 1024;
                
                if (file.size > maxSize) {
                    alert(`Le fichier est trop volumineux. Maximum ${maxSize / (1024*1024)}MB.`);
                    return;
                }
                
                // Validation du type pour la pièce d'identité (images + PDF)
                if (fileInputId.includes('idDocument')) {
                    const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format de fichier non supporté. Utilisez JPG, PNG ou PDF.');
                        return;
                    }
                } else {
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format de fichier non supporté. Utilisez JPG, PNG ou GIF.');
                        return;
                    }
                }
                
                if (previewCallback) previewCallback(file);
            }
        });
        
        // Drag & drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'var(--accent-color)';
            uploadArea.style.backgroundColor = 'rgba(245, 158, 66, 0.05)';
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = 'var(--gray-light)';
            uploadArea.style.backgroundColor = 'white';
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'var(--gray-light)';
            uploadArea.style.backgroundColor = 'white';
            
            if (e.dataTransfer.files[0]) {
                const file = e.dataTransfer.files[0];
                fileInput.files = e.dataTransfer.files;
                
                // Déclencher l'événement change
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            }
        });
    }
    
    // Preview pour avatar
    setupFileUpload('avatarUpload', 'avatarFile', function(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewAvatar').innerHTML = `
                <img src="${e.target.result}" alt="Avatar" 
                     style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
            `;
        };
        reader.readAsDataURL(file);
    });
    
    // Preview pour logo
    setupFileUpload('logoUpload', 'logoFile', function(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewAvatar').innerHTML = `
                <img src="${e.target.result}" alt="Logo" 
                     style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
            `;
        };
        reader.readAsDataURL(file);
    });
    
    // Upload pour pièce d'identité (sans preview, juste validation)
    setupFileUpload('idDocumentUpload', 'idDocumentFile', function(file) {
        // Optionnel : afficher un message de confirmation
        const uploadArea = document.getElementById('idDocumentUpload');
        uploadArea.innerHTML = `
            <i class="bi bi-check-circle-fill text-success"></i>
            <p>Fichier sélectionné : ${file.name}</p>
            <p class="text-muted small">Cliquez pour modifier</p>
        `;
    });
    
    // Mise à jour des étapes de progression
    function updateProgressSteps(activeStep) {
        const steps = document.querySelectorAll('.step');
        steps.forEach((step, index) => {
            if (index + 1 < activeStep) {
                step.classList.add('completed');
                step.classList.remove('active');
            } else if (index + 1 === activeStep) {
                step.classList.add('active');
                step.classList.remove('completed');
            } else {
                step.classList.remove('active', 'completed');
            }
        });
    }
    
    // Initialisation
    if (vendorTypeRadios.length > 0) {
        document.querySelector('.seller-type-radio:checked').dispatchEvent(new Event('change'));
    }
    
    // Initialiser les valeurs de l'aperçu
    updatePreviewName();
    updatePreviewLocation();
    updatePreviewDescription();
});
</script>
@endsection