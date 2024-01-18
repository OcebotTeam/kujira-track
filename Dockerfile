# Use an official PHP 8.1 with Apache image as the base
FROM php:8.1-apache

# Install necessary packages
RUN apt-get update && apt-get install -y \
    git \ 
    curl \
    vim \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Configure PHP modules
RUN docker-php-ext-install pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Set Apache web root to the project's public directory
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Copy our application to the container's working directory
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Run necessary commands to install PHP dependencies and execute our project
RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/var

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start the Apache server in the foreground
CMD ["apache2-foreground"]
