FROM php:8.4-cli

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Install ekstensi PHP yang dibutuhkan Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project
COPY . .

# Install Laravel dependency
RUN composer install

# Laravel jalan di 0.0.0.0 biar bisa diakses dari host
CMD php artisan serve --host=0.0.0.0 --port=8808

EXPOSE 8808