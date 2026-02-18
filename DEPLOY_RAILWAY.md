# 🚂 Railway.app - Guide de déploiement rapide

**⭐ MEILLEURE OPTION pour votre application PHP + MySQL**

## Pourquoi Railway?

| Feature | Railway | Render | Heroku |
|---------|---------|--------|--------|
| PHP Support | ✅ | ✅ | ❌ |
| MySQL Gratuit | ✅ | ❌ | ❌ |
| Crédits/mois | $5 gratuit | Aucun | Aucun |
| Facilité | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ | ❌ |
| Coût réel | ~$13/mois | ~$30/mois | Payant |

---

## ⚡ Déploiement en 5 minutes

### Étape 1: Créer un compte Railway (2 min)
```
1. Allez sur https://railway.app
2. Cliquez "Start Free"
3. Connectez-vous avec GitHub
4. Autorisez Railway
```

### Étape 2: Créer un projet (1 min)
```
1. Dashboard → "Create New Project"
2. Sélectionnez "Deploy from GitHub repo"
3. Cherchez: audreytchamba/ecom-storage
4. Cliquez "Deploy Now"
```

### Étape 3: Railway détecte automatiquement (30 sec)
```
✅ Détecte le Dockerfile
✅ Configure PHP 8.1 + Apache
✅ Crée l'image Docker
```

### Étape 4: Ajouter MySQL (1 min)
```
1. Dans votre projet, cliquez "+ Add Service"
2. Cherchez "MySQL"
3. Sélectionnez "MySQL"
4. Railway crée la BD automatiquement
```

### Étape 5: Configurer les variables (1 min)
```
Railway génère automatiquement:
- DATABASE_URL (contient tout)
- Ou séparé: DB_HOST, DB_USER, DB_PASS

Ajoutez manuellement:
- APP_DEBUG=false
- APP_ENV=production
- APP_URL=https://[nom-app].railway.app
```

### Étape 6: Voir votre app live! ✅
```
URL générée: https://[yourapp].railway.app
Status: "Deploy Successful"
```

---

## 📊 Coûts Railway

### Plan Gratuit (Crédits)
- **$5 USD par mois** de crédits gratuits
- **Consommation réelle:**
  - PHP (256 MB RAM): ~$5/mois
  - MySQL (1 GB): ~$8/mois
  - Total: ~$13/mois
- **Après crédits:** Vous payez la différence

### Comment réduire les coûts?
1. Utiliser les crédits $5 offerts chaque mois
2. Arrêter l'app quand elle n'est pas utilisée
3. Réduire la RAM (mais affects performance)

---

## 🎯 Variables d'environnement

Railway crée automatiquement une variable spéciale:

```
DATABASE_URL=mysql://root:password@host:3306/ecom_storage
```

**OU vous pouvez utiliser des variables séparées:**

```
DB_HOST=hostname.railway.internal
DB_USER=root
DB_PASS=password
DB_NAME=ecom_storage
```

**À ajouter manuellement:**

```
APP_DEBUG=false
APP_ENV=production
APP_URL=https://[yourapp].railway.app
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
```

---

## 🔧 Configuration avancée

### Connecter un domaine personnalisé

```
1. Settings → "Custom Domain"
2. Entrez votre domaine (ex: ecom.com)
3. Pointez votre DNS vers Railway
4. ✅ HTTPS gratuit inclus!
```

### Voir les logs

```
1. Cliquez votre projet
2. Onglet "Deployments"
3. Cliquez sur le déploiement le plus récent
4. Onglet "Logs" pour erreurs
```

### Restart l'application

```
1. Project Settings
2. "Redeploy"
3. Railway restart tout
```

---

## ✅ Checklist finale

- [ ] Compte Railway créé
- [ ] Dépôt GitHub connecté
- [ ] Projet créé avec Docker détecté
- [ ] MySQL ajouté et créé
- [ ] Variables d'environnement configurées
- [ ] Déploiement successful
- [ ] App accessible via URL
- [ ] (Optionnel) Domaine personnalisé configuré

---

## 📱 Voir votre app en direct

```
1. Railway Dashboard
2. Cliquez votre projet
3. Onglet "Deployments"
4. Status: "Success" ✅
5. URL générée en haut
6. Cliquez le lien → Votre app est LIVE! 🎉
```

---

## 🆘 Si ça ne marche pas

### Erreur: "Build failed"
```
→ Vérifiez les logs
→ Dockerfile peut être incorrect
→ Vérifiez que tous les fichiers sont versionnés
```

### Erreur: "Cannot connect to MySQL"
```
→ Attendez 30 secondes après ajout de MySQL
→ Vérifiez que la variable DATABASE_URL existe
→ Les variables sont case-sensitive!
```

### Erreur: "502 Bad Gateway"
```
→ L'app démarre mais crash immédiatement
→ Vérifiez les logs
→ Vérifiez que le port est correct (80 dans Dockerfile)
```

---

## 💡 Tips & Tricks

1. **Crédits gratuits:** Railway donne $5/mois, c'est suffisant pour démarrer!
2. **Logs en temps réel:** Cliquez "Logs" pour voir les erreurs en direct
3. **Redeploy facile:** GitHub → Push → Auto redeploy sur Railway
4. **Scaling:** Vous pouvez augmenter la RAM avec un clic
5. **Gratuit pendant 7 jours:** Essayez sans payer

---

## 🚀 Commandes utiles

```bash
# Voir le statut du projet
railway status

# Ouvrir le dashboard
railway open

# Logs locaux
railway logs

# Redeploy
railway redeploy
```

---

**Vous êtes prêt! Déployez maintenant sur Railway! 🚂✨**