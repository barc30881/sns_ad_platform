FROM richarvey/nginx-php-fpm:1.7.2
RUN apk add --no-cache postgresql-dev libzip-dev libxml2-dev curl-dev \
    && docker-php-ext-install pdo_pgsql pgsql mbstring bcmath xml zip curl
WORKDIR /var/www/html
COPY . .
RUN composer install --optimize-autoloader --no-dev
RUN chown -R www-data:www-data storage bootstrap/cache
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache
EXPOSE 80
CMD ["/start.sh"]