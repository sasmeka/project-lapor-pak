# ==============================
# 1️⃣ Stage Node (Build Frontend)
# ==============================
FROM node:20 AS node-builder

WORKDIR /app

# Copy package.json dulu (biar cache optimal)
COPY package*.json ./
RUN npm install

# Copy semua file
COPY . .

# Build Vite
RUN npm run build


# ==============================
# 2️⃣ Stage PHP (Production)
# ==============================
FROM php:8.4-cli

# Install dependencies + GD dengan JPEG support
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy source code
COPY . .

# Copy hasil build frontend dari Node stage
COPY --from=node-builder /app/public/build /var/www/public/build

# Install dependency Laravel (tanpa dev)
RUN composer install --no-dev --optimize-autoloader

# Permission penting Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 8000

# Jalankan Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000