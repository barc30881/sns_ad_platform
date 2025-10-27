FROM richarvey/nginx-php-fpm:3.1.2

# Update package index and enable community repository
RUN echo "http://dl-cdn.alpinelinux.org/alpine/v3.16/community" >> /etc/apk/repositories && \
    apk update && \
    apk add --no-cache \
        postgresql-dev \
        libzip-dev \
        libxml2-dev \
        curl-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_pgsql pgsql mbstring bcmath xml zip curl gd exif pcntl

# Install Composer (stable version)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.2.21

WORKDIR /var/www/html

COPY . .

# Increase memory limit for Composer
RUN php -d memory_limit=-1 /usr/local/bin/composer install --optimize-autoloader --no-dev

RUN chown -R www-data:www-data storage bootstrap/cache

RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 80

CMD ["/start.sh"]