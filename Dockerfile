FROM php:8.4-fpm-alpine

# Update package index and install dependencies
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    postgresql-dev \
    libzip-dev \
    libxml2-dev \
    curl-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    && rm -rf /var/cache/apk/*

# Configure and install PHP extensions individually
RUN docker-php-ext-configure gd --with-freetype --with-jpeg || { echo "gd configure failed"; exit 1; }
RUN docker-php-ext-install pdo_pgsql || { echo "pdo_pgsql install failed"; exit 1; }
RUN docker-php-ext-install pgsql || { echo "pgsql install failed"; exit 1; }
RUN docker-php-ext-install mbstring || { echo "mbstring install failed"; exit 1; }
RUN docker-php-ext-install bcmath || { echo "bcmath install failed"; exit 1; }
RUN docker-php-ext-install xml || { echo "xml install failed"; exit 1; }
RUN docker-php-ext-install zip || { echo "zip install failed"; exit 1; }
RUN docker-php-ext-install curl || { echo "curl install failed"; exit 1; }
RUN docker-php-ext-install gd || { echo "gd install failed"; exit 1; }
RUN docker-php-ext-install exif || { echo "exif install failed"; exit 1; }
RUN docker-php-ext-install pcntl || { echo "pcntl install failed"; exit 1; }

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.7.7

# Set up Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Set up Supervisor configuration
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

COPY . .

# Install Composer dependencies
RUN php -d memory_limit=-1 /usr/local/bin/composer install --optimize-autoloader --no-dev

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]