# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Désactiver les MPM en conflit et activer mpm_event
RUN a2dismod mpm_prefork mpm_worker && a2enmod mpm_event

# Activer le module rewrite (utile pour les routes dynamiques)
RUN a2enmod rewrite

# Installer les extensions nécessaires (exemple : PDO MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Copier ton projet dans le dossier web
COPY . /var/www/html/

# Donner les bons droits à Apache
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
