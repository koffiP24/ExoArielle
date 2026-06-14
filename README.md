# Système de Gestion - Stock et Négoce

## 📋 Vue d'ensemble

Application web complète pour la gestion des stocks et du commerce de vin, avec:
- **Pages publiques** pour les clients et employés
- **Panneau administrateur** pour la gestion des données
- **Interface moderne** avec animations et design professionnel

## 🚀 Accès à l'application

### Pages publiques (sans authentification)
- **Accueil** : `php/accueil.php`
- **Cépage** : `php/cepage.php`
- **Cuve** : `php/cuve.php`
- **Négociant** : `php/negociant.php`
- **Contrat** : `php/contrat.php`
- **Livraison** : `php/livraison.php`

### Panneau administrateur
**URL** : `admin/login.php`

**Identifiants par défaut** :
- **Nom d'utilisateur** : `admin`
- **Mot de passe** : `admin123`

⚠️ **⚠️ IMPORTANT** : Changez ces identifiants en production!

## 🔧 Fonctionnalités du Dashboard

### 1. **Tableau de Bord**
   - Vue d'ensemble des statistiques
   - Compteur de cépages, cuves, négociants, contrats
   - Accès rapide aux modules

### 2. **Gestion des Cépages**
   - Ajouter/modifier/supprimer des cépages
   - Affichage de la liste avec filtrage
   - Gestion des propriétés (nom, couleur, teneur en sucre, région)

### 3. **Gestion des Cuves**
   - Gérer l'inventaire des cuves
   - Associer une cuve à un cépage
   - Suivre la capacité de stockage

### 4. **Gestion des Négociants**
   - Enregistrer les partenaires commerciaux
   - Stocker les coordonnées de contact
   - Gestion des informations personnelles

### 5. **Gestion des Contrats**
   - Créer et suivre les contrats
   - Dates de signature et d'échéance
   - Quantités et dates de livraison

### 6. **Gestion des Livraisons**
   - Enregistrer les livraisons effectuées
   - Numéro de livraison et date réelle
   - Suivi du statut

## 🎨 Caractéristiques du design

✨ **Animations professionnelles**
- Transitions fluides
- Effets de hover dynamiques
- Animations d'entrée/sortie

📱 **Design Responsive**
- Desktop, tablette et mobile
- Navigation adaptée aux petits écrans
- Layouts flexibles

🔘 **Bouton Scroll-To-Top**
- Apparaît automatiquement en bas de page
- Retour en haut avec animation

🎯 **Interface intuitive**
- Icônes Font Awesome
- Design cohérent
- Navigation claire

## 🗂️ Structure des fichiers

```
projet/
├── php/                    # Pages publiques
│   ├── accueil.php
│   ├── cepage.php
│   ├── cuve.php
│   ├── negociant.php
│   ├── contrat.php
│   ├── livraison.php
│   ├── header.php         # En-tête partagé
│   └── footer.php         # Pied de page partagé
├── admin/                  # Panneau administrateur
│   ├── login.php          # Page de connexion
│   ├── dashboard.php      # Tableau de bord
│   ├── manage-cepage.php
│   ├── manage-cuve.php
│   ├── manage-negociant.php
│   ├── manage-contrat.php
│   ├── manage-livraison.php
│   ├── logout.php
│   └── config.php         # Configuration
├── style/                  # Feuilles de style
│   ├── global.css
│   ├── admin.css
│   ├── cepage.css
│   ├── cuve.css
│   ├── negociant.css
│   ├── contrat.css
│   └── livraison.css
├── image/                  # Images
└── admin/
```

## 💾 Base de données

L'application nécessite une base de données MySQL nommée `bd_viticole` avec les tables:
- `cepage`
- `cuve`
- `negociant`
- `contrat`
- `livraison`

**Connexion** : localhost / root / (pas de mot de passe)

## 🔒 Sécurité

### Recommandations de production:
1. ✅ Changez les identifiants administrateur
2. ✅ Utilisez HTTPS
3. ✅ Implémentez une authentification plus robuste
4. ✅ Validez et échappez les entrées utilisateur
5. ✅ Utilisez des requêtes préparées (prepared statements)
6. ✅ Mettez en place une gestion des sessions sécurisée
