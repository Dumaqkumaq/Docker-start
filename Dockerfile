FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    wget \
    librdkafka-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring sockets \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Скачиваем конкретную версию Composer
RUN wget https://github.com/composer/composer/releases/download/2.5.8/composer.phar -O /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

COPY composer.json /var/www/html/

RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

COPY ./code /var/www/html

CMD ["php-fpm"]