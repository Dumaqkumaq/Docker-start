#!/bin/bash

# Создаем необходимые директории с правильными правами
mkdir -p /var/lib/nginx/body /var/lib/nginx/fastcgi /var/lib/nginx/proxy /var/lib/nginx/uwsgi /var/lib/nginx/scgi
chown -R www-data:www-data /var/lib/nginx

# Запускаем PHP-FPM от пользователя www-data
gosu www-data php-fpm -D

# Запускаем nginx от root
nginx -g 'daemon off;'