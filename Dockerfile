FROM php:8.1-apache

# Activer le module rewrite
RUN a2enmod rewrite

# Forcer Apache à utiliser mpm_prefork (compatible avec PHP)
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier ton projet
COPY . /var/www/html/

# Droits pour Apache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
