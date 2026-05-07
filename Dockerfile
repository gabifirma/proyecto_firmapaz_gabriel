FROM php:8.2-apache

# Instalar dependencias del sistema y Composer
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    git \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    intl \
    zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Configurar Apache para CodeIgniter 4
ENV APACHE_DOCUMENT_ROOT /var/www/html/app

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf
RUN sed -ri -e 's!DocumentRoot "/var/www/html"!DocumentRoot "/var/www/html/app"!g' /etc/apache2/apache2.conf

# Configurar permisos para CodeIgniter
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
