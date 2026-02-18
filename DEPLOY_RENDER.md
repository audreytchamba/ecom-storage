Déploiement gratuit sur Render (PHP dynamique)

Choix recommandé : Render (plan gratuit) — déploie des applications Docker/PHP directement depuis GitHub.

Étapes rapides :

1) Pré-requis
- Compte GitHub avec le dépôt `audreytchamba/ecom-storage` (déjà présent)
- Compte Render (https://render.com). Le plan gratuit suffit pour des tests.

2) Fichiers ajoutés
- `Dockerfile` : construit une image PHP + Apache et sert votre application.

3) Déployer sur Render
- Connectez-vous sur https://dashboard.render.com
- Cliquez "New" → "Web Service"
- Connectez votre repo GitHub si demandé
- Sélectionnez le repo `audreytchamba/ecom-storage` et branche `main`
- Sous "Environment" choisissez "Docker"
- Pour "Build Command" et "Start Command" laissez vide (Render utilisera le Dockerfile et la commande par défaut)
- Définissez les "Environment Variables" (Settings → Env) pour votre base de données et autres secrets :
  - `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `DB_CHARSET`
  - `APP_ENV` (production), `APP_DEBUG` (false), `APP_URL` (votre URL Render)
- Cliquez "Create Web Service" — Render construira l'image et déploiera automatiquement à chaque push sur `main`.

4) Notes importantes
- Votre fichier `.env` local ne doit PAS être poussé en production. Mettez les mêmes variables via Render web console (Env).
- Assurez-vous d'avoir créé la base de données distante (sur le fournisseur DB) et mis les identifiants dans les variables d'environnement.
- Pour les uploads (`uploads/`), Render offre un système de stockage persistant via "Persistent Disks" sur certains plans payants. Sur le plan gratuit, les fichiers écrits dans le container sont éphémères (perdus après redéploiement). Pour un stockage de fichiers fiable, utilisez un service externe (S3, Backblaze B2, etc.) et adaptez le code.

5) Alternatives gratuites
- Railway / Fly.io peuvent aussi fonctionner (Railway propose des crédits gratuits). Si vous préférez Railway, je peux fournir un `Dockerfile` + instructions.

Si vous voulez, je peux :
- 1) Créer le workflow GitHub Actions pour déclencher un déploiement (si vous préférez FTP/SFTP ou un fournisseur qui n'intègre pas GitHub), ou
- 2) Ajouter un fichier `render.yaml` (Infrastructure as Code) pour rendre la création sur Render entièrement reproductible.

Dites-moi si vous voulez que je crée `render.yaml` ou que j'ajoute un fichier `docker-compose.yml` pour tests locaux.
