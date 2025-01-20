FROM php:8.2-fpm

# Instalamos extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev zlib1g-dev libzip-dev libicu-dev g++ \
    && docker-php-ext-install intl opcache zip pdo pdo_mysql

# Instalamos Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Establecemos el directorio de trabajo
WORKDIR /var/www/html

# Configuración de permisos
RUN usermod -u 1000 www-data