# Laravel için temel Dockerfile
FROM php:8.3-fpm

# Sistem paketlerini ve bağımlılıkları yükle
RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        git \
        unzip \
        curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Composer yükle
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Proje dosyalarını kopyala
COPY . /var/www
WORKDIR /var/www

# Vendor klasörünü oluştur
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Storage ve bootstrap/cache klasörlerine yazma izni ver
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
