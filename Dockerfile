# Usa uma imagem oficial do PHP com Apache
FROM php:8.3-apache

EXPOSE 3000

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libonig-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libpng-dev \
    libxml2-dev \
    sendmail \
    git \
    && docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

RUN sed -i 's/80/3000/' /etc/apache2/ports.conf \
    && sed -i 's/80/3000/' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilita exibição de erros em dev
RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/dev.ini
