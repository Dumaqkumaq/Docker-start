FROM php:8.2-fpm

# Устанавливаем nginx
RUN apt-get update && apt-get install -y nginx

# Копируем файлы приложения
COPY code/ /usr/share/nginx/html/

# Настраиваем права для записи
RUN chmod 666 /usr/share/nginx/html/data.txt 2>/dev/null || \
    (touch /usr/share/nginx/html/data.txt && chmod 666 /usr/share/nginx/html/data.txt)

WORKDIR /usr/share/nginx/html

# Запускаем сервисы
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]