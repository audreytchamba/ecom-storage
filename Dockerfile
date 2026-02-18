# Dockerfile for PHP + Apache
# Uses official PHP Apache image and enables PDO MySQL

FROM php:8.1-apache

# Install extensions and utilities
RUN apt-get update && apt-get install -y --no-install-recommends \
    libonig-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module for the router
RUN a2enmod rewrite

# Copy application into webroot
COPY . /var/www/html/

# Ensure correct ownership
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (default Apache)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
