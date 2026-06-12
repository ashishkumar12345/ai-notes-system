FROM php:8.3-fpm

# Working directory
WORKDIR /var/www

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev

# PHP extensions (MOST IMPORTANT for Laravel + MySQL)
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

# Composer install
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissions (important for Laravel)
RUN chmod -R 775 storage bootstrap/cache

# Expose port (optional for fpm)
EXPOSE 9000

CMD ["php-fpm"]