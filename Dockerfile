FROM richarvey/nginx-php-fpm:1.7.2

COPY . /var/www/html

RUN composer install --optimize-autoloader --no-dev --working-dir=/var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN cd /var/www/html && php artisan key:generate && php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 80

CMD ["/start.sh"]
