## License
   © 2026 Elhabchi Mohammed. All Rights Reserved.

# CVGenius

CVGenius est un projet de création et de gestion de CV et de portfolios. Le code présent dans ce dépôt contient principalement les modèles de données et les migrations Laravel.

## Fonctionnalités représentées dans le code

- Gestion des utilisateurs, des rôles et des offres.
- Création de CV avec modèle, langue, couleurs et visibilité publique.
- Gestion des informations personnelles, expériences, formations, compétences, projets et langues.
- Gestion de portfolios.
- Validation des données d'inscription, de connexion, de profil, de CV et de portfolio.

## Structure

- `app/Models/` : modèles Eloquent et relations entre les données.
- `app/Http/Requests/` : classes de validation des requêtes.
- `database/migrations/` : création des tables de l'application.
- `demo-server.cjs` : serveur Node.js de démonstration qui tente de servir `demo.html` sur `http://127.0.0.1:4173`.

## État du projet

Le dépôt ne contient actuellement ni `composer.json` ni `artisan`. Les dépendances Laravel et la configuration nécessaires pour exécuter l'application ne sont donc pas fournies ici.

Le serveur de démonstration nécessite également un fichier `demo.html` à la racine du projet ; ce fichier n'est pas présent actuellement.
