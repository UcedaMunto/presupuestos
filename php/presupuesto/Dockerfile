# Usamos la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalamos extensiones necesarias y dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev zlib1g-dev libzip-dev libicu-dev g++ \
    && docker-php-ext-install intl opcache zip pdo pdo_mysql pdo_pgsql

# Instalamos Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Habilitamos mod_rewrite para que Symfony funcione correctamente
RUN a2enmod rewrite

# Establecemos el directorio de trabajo
WORKDIR /var/www/html

# Instalamos el cliente de PostgreSQL (si es necesario)
RUN apt-get update && apt-get install -y postgresql-client

# Copiar solo composer.json y composer.lock para optimizar la caché
COPY / /var/www/html

RUN rm -rf vendor

RUN composer install

# Configuración de permisos
RUN usermod -u 1000 www-data



# Exponemos el puerto 80 (Apache)
EXPOSE 80

# Definimos el comando por defecto (inicia Apache en segundo plano)
CMD ["apache2-foreground"]
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf


