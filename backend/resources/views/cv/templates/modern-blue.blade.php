<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV {{ $data['personal_info']['first_name'] ?? '' }} {{ $data['personal_info']['last_name'] ?? '' }}</title>
    
    {{-- 📌 Ouvre la balise style qui contient tout le CSS du CV --}}
    <style>
        /* 📌 RESET CSS : supprime les marges et paddings par défaut du navigateur */
        * {
            margin: 0;           /* 📌 Pas de marge extérieure */
            padding: 0;          /* 📌 Pas de marge intérieure */
            box-sizing: border-box; /* 📌 Les bordures sont incluses dans la largeur */
        }
        
        /* 📌 Style global du corps de la page */
        body {
            font-family: 'Arial', sans-serif; /* 📌 Police utilisée */
            font-size: 11px;                  /* 📌 Taille de police de base */
            line-height: 1.5;                 /* 📌 Espacement entre les lignes */
            color: #333;                      /* 📌 Couleur du texte (gris foncé) */
        }
        
        /* 📌 Container principal qui contient tout le CV */
        .cv-container {
            width: 100%;           /* 📌 Prend toute la largeur disponible */
            display: flex;         /* 📌 Utilise Flexbox pour le layout */
            flex-direction: column; /* 📌 Les enfants sont empilés verticalement */
        }
        
        /* 📌 Section d'en-tête (haut du CV avec photo et nom) */
        .header {
            background-color: #2c3e50; /* 📌 Fond bleu foncé */
            color: white;              /* 📌 Texte en blanc */
            padding: 30px;             /* 📌 Espacement intérieur de 30px */
            display: flex;             /* 📌 Utilise Flexbox */
            align-items: center;       /* 📌 Centre verticalement les éléments */
            gap: 20px;                 /* 📌 Espace de 20px entre les éléments */
        }
        
        /* 📌 Photo de profil (cercle avec initiales ou image) */
        .photo {
            width: 100px;            /* 📌 Largeur de 100px */
            height: 100px;           /* 📌 Hauteur de 100px */
            border-radius: 50%;      /* 📌 Rend le cercle parfait */
            background-color: #3498db; /* 📌 Fond bleu clair */
            display: flex;           /* 📌 Utilise Flexbox */
            align-items: center;     /* 📌 Centre verticalement */
            justify-content: center; /* 📌 Centre horizontalement */
            font-size: 32px;         /* 📌 Taille des initiales */
            font-weight: bold;       /* 📌 Texte en gras */
            flex-shrink: 0;          /* 📌 Empêche la photo de rétrécir */
            overflow: hidden;        /* 📌 Coupe le contenu qui dépasse */
        }
        
        /* 📌 Si c'est une vraie image (balise img) */
        .photo img {
            width: 100%;             /* 📌 Prend toute la largeur */
            height: 100%;            /* 📌 Prend toute la hauteur */
            object-fit: cover;       /* 📌 Remplit le cercle sans déformer */
        }
        
        /* 📌 Section nom et titre dans l'en-tête */
        .header-content {
            flex: 1;                 /* 📌 Prend tout l'espace disponible */
        }
        
        /* 📌 Nom complet (h1) */
        .header-content h1 {
            font-size: 32px;         /* 📌 Grande taille */
            margin-bottom: 5px;      /* 📌 Espace en bas */
            text-transform: uppercase; /* 📌 Tout en majuscules */
        }
        
        /* 📌 Titre professionnel (h2) */
        .header-content h2 {
            font-size: 18px;         /* 📌 Taille moyenne */
            font-weight: normal;     /* 📌 Pas en gras */
            opacity: 0.9;            /* 📌 Légèrement transparent */
        }
        
        /* 📌 Corps du CV (2 colonnes) */
        .body {
            display: flex;           /* 📌 Utilise Flexbox */
            flex: 1;                 /* 📌 Prend tout l'espace restant */
        }
        
        /* 📌 Colonne gauche (sidebar) */
        .sidebar {
            width: 35%;              /* 📌 35% de la largeur */
            background-color: #34495e; /* 📌 Fond gris-bleu */
            color: white;            /* 📌 Texte blanc */
            padding: 20px;           /* 📌 Espacement intérieur */
        }
        
        /* 📌 Colonne droite (contenu principal) */
        .main {
            width: 65%;              /* 📌 65% de la largeur */
            padding: 30px;           /* 📌 Espacement intérieur */
        }
        
        /* 📌 Titre de section dans la sidebar */
        .sidebar h3 {
            font-size: 14px;         /* 📌 Taille */
            text-transform: uppercase; /* 📌 Majuscules */
            margin-bottom: 10px;     /* 📌 Espace en bas */
            border-bottom: 2px solid #3498db; /* 📌 Ligne bleue en bas */
            padding-bottom: 5px;     /* 📌 Espace intérieur en bas */
            margin-top: 20px;        /* 📌 Espace en haut */
        }
        
        /* 📌 Premier titre de la sidebar (pas d'espace en haut) */
        .sidebar h3:first-child {
            margin-top: 0;
        }
        
        /* 📌 Titre de section dans le contenu principal */
        .main h3 {
            font-size: 18px;         /* 📌 Taille plus grande */
            color: #2c3e50;          /* 📌 Couleur bleu foncé */
            margin-bottom: 15px;     /* 📌 Espace en bas */
            border-bottom: 2px solid #3498db; /* 📌 Ligne bleue */
            padding-bottom: 5px;     /* 📌 Espace intérieur */
            margin-top: 20px;        /* 📌 Espace en haut */
        }
        
        /* 📌 Premier titre du main (pas d'espace en haut) */
        .main h3:first-child {
            margin-top: 0;
        }
        
        /* 📌 Élément de contact (email, téléphone, etc.) */
        .contact-item {
            margin-bottom: 8px;      /* 📌 Espace entre chaque contact */
            font-size: 11px;         /* 📌 Taille */
            word-break: break-word;  /* 📌 Coupe les mots trop longs */
        }
        
        /* 📌 Liste à puces */
        ul {
            list-style-position: inside; /* 📌 Puces à l'intérieur */
            padding-left: 0;         /* 📌 Pas de padding */
        }
        
        /* 📌 Élément de liste */
        li {
            margin-bottom: 5px;      /* 📌 Espace entre chaque élément */
            font-size: 11px;         /* 📌 Taille */
        }
        
        /* 📌 Section "À propos" */
        .about {
            margin-bottom: 20px;     /* 📌 Espace en bas */
            text-align: justify;     /* 📌 Texte justifié */
            font-size: 11px;         /* 📌 Taille */
            line-height: 1.6;        /* 📌 Espacement des lignes */
        }
        
        /* 📌 Élément d'expérience ou formation */
        .experience-item {
            margin-bottom: 15px;     /* 📌 Espace entre chaque expérience */
        }
        
        /* 📌 Titre de l'expérience (poste ou diplôme) */
        .experience-item strong {
            display: block;          /* 📌 Affiche en bloc */
            font-size: 12px;         /* 📌 Taille */
            margin-bottom: 3px;      /* 📌 Espace en bas */
        }
        
        /* 📌 Dates de l'expérience */
        .experience-item .dates {
            font-size: 10px;         /* 📌 Petite taille */
            color: #7f8c8d;          /* 📌 Couleur grise */
            font-style: italic;      /* 📌 Italique */
            margin-bottom: 5px;      /* 📌 Espace en bas */
        }
        
        /* 📌 Description de l'expérience */
        .experience-item .description {
            font-size: 11px;         /* 📌 Taille */
            text-align: justify;     /* 📌 Texte justifié */
        }
    </style>
</head>
<body>
    <div class="cv-container">
        <div class="header">
            <div class="photo">
                @if(!empty($data['personal_info']['photo'] ?? null))
                    <img src="{{ $data['personal_info']['photo'] }}" alt="Photo">
                @else
                    {{ strtoupper(substr($data['personal_info']['first_name'] ?? '', 0, 1)) }}
                    {{ strtoupper(substr($data['personal_info']['last_name'] ?? '', 0, 1)) }}
                @endif
            </div>
            <div class="header-content">
                <h1>{{ $data['personal_info']['first_name'] ?? '' }} {{ $data['personal_info']['last_name'] ?? '' }}</h1>
                @if(!empty($data['personal_info']['title'] ?? null))
                    <h2>{{ $data['personal_info']['title'] }}</h2>
                @endif
            </div>
        </div>
        
        {{-- 📌 CORPS DU CV : 2 colonnes --}}
        <div class="body">
            
            {{-- 📌 COLONNE GAUCHE (Sidebar) --}}
            <div class="sidebar">
                
                {{-- 📌 Section CONTACT --}}
                <h3>Contact</h3>
                
                {{-- 📌 Affiche l'email s'il existe --}}
                @if(!empty($data['personal_info']['email'] ?? null))
                    <div class="contact-item">
                        📧 {{ $data['personal_info']['email'] }}
                    </div>
                @endif
                
                {{-- 📌 Affiche le téléphone s'il existe --}}
                @if(!empty($data['personal_info']['phone'] ?? null))
                    <div class="contact-item">
                        📱 {{ $data['personal_info']['phone'] }}
                    </div>
                @endif
                
                {{-- 📌 Affiche l'adresse si elle existe --}}
                @if(!empty($data['personal_info']['address'] ?? null))
                    <div class="contact-item">
                        📍 {{ $data['personal_info']['address'] }}
                    </div>
                @endif
                
                {{-- 📌 Affiche la date de naissance si elle existe --}}
                @if(!empty($data['personal_info']['birth_date'] ?? null))
                    <div class="contact-item">
                        🎂 {{ $data['personal_info']['birth_date'] }}
                    </div>
                @endif
                
                {{-- 📌 Affiche le genre s'il existe --}}
                @if(!empty($data['personal_info']['gender'] ?? null))
                    <div class="contact-item">
                        👤 {{ $data['personal_info']['gender'] }}
                    </div>
                @endif
                
                {{-- 📌 Section COMPÉTENCES (si des compétences existent) --}}
                @if(!empty($data['skills'] ?? null))
                    <h3>Compétences</h3>
                    <ul>
                        {{-- 📌 Boucle sur chaque compétence --}}
                        @foreach($data['skills'] as $skill)
                            <li>{{ $skill['name'] ?? '' }}</li>
                        @endforeach
                    </ul>
                @endif
                
                {{-- 📌 Section LANGUES (si des langues existent) --}}
                {{-- 📌 ATTENTION : les clés sont language_name et language_level --}}
                @if(!empty($data['languages'] ?? null))
                    <h3>Langues</h3>
                    <ul>
                        {{-- 📌 Boucle sur chaque langue --}}
                        @foreach($data['languages'] as $language)
                            <li>{{ $language['language_name'] ?? '' }} - {{ $language['language_level'] ?? '' }}</li>
                        @endforeach
                    </ul>
                @endif
                
                {{-- 📌 Section CENTRES D'INTÉRÊT (si des intérêts existent) --}}
                @if(!empty($data['interests'] ?? null))
                    <h3>Centres d'intérêt</h3>
                    <ul>
                        {{-- 📌 Boucle sur chaque intérêt --}}
                        @foreach($data['interests'] as $interest)
                            <li>{{ $interest['name'] ?? '' }}</li>
                        @endforeach
                    </ul>
                @endif
                
            </div>
            
            {{-- 📌 COLONNE DROITE (Contenu principal) --}}
            <div class="main">
                
                {{-- 📌 Section À PROPOS (si le résumé existe) --}}
                @if(!empty($data['summary'] ?? null))
                    <h3>À propos de moi</h3>
                    <div class="about">
                        {{ $data['summary'] }}
                    </div>
                @endif
                
                {{-- 📌 Section EXPÉRIENCES PROFESSIONNELLES (si des expériences existent) --}}
                @if(!empty($data['experiences'] ?? null))
                    <h3>Expérience Professionnelle</h3>
                    
                    {{-- 📌 Boucle sur chaque expérience --}}
                    @foreach($data['experiences'] as $experience)
                        <div class="experience-item">
                            {{-- 📌 Affiche le poste et l'entreprise --}}
                            <strong>{{ $experience['position'] ?? '' }} - {{ $experience['company'] ?? '' }}</strong>
                            
                            {{-- 📌 Affiche les dates --}}
                            <div class="dates">
                                {{ $experience['start_date'] ?? '' }} - {{ $experience['end_date'] ?? 'Présent' }}
                                {{-- 📌 Affiche la ville si elle existe --}}
                                @if(!empty($experience['city'] ?? null))
                                    | {{ $experience['city'] }}
                                @endif
                            </div>
                            
                            {{-- 📌 Affiche la description si elle existe --}}
                            @if(!empty($experience['description'] ?? null))
                                <div class="description">
                                    {{ $experience['description'] }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
                
                {{-- 📌 Section FORMATION (si des formations existent) --}}
                @if(!empty($data['educations'] ?? null))
                    <h3>Formation</h3>
                    
                    {{-- 📌 Boucle sur chaque formation --}}
                    @foreach($data['educations'] as $education)
                        <div class="experience-item">
                            {{-- 📌 Affiche le diplôme et l'établissement --}}
                            <strong>{{ $education['degree'] ?? '' }} - {{ $education['school'] ?? '' }}</strong>
                            
                            {{-- 📌 Affiche les dates --}}
                            <div class="dates">
                                {{ $education['start_date'] ?? '' }} - {{ $education['end_date'] ?? 'Présent' }}
                                {{-- 📌 Affiche la ville si elle existe --}}
                                @if(!empty($education['city'] ?? null))
                                    | {{ $education['city'] }}
                                @endif
                            </div>
                            
                            {{-- 📌 Affiche la description si elle existe --}}
                            @if(!empty($education['description'] ?? null))
                                <div class="description">
                                    {{ $education['description'] }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
                
            </div>
            
        </div>
        
    </div>

</body>
</html>