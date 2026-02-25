# ==============================
# 1️⃣ Stage Node (Build Frontend)
# ==============================
FROM node:20 AS node-builder

WORKDIR /app

# Copy hanya file yang diperlukan dulu (agar cache optimal)
COPY package*.json ./
RUN npm install

# Copy seluruh source
COPY . .

# Build Vite
RUN npm run build


# ==============================
# 2️⃣ Stage PHP (Production)
# ==============================
FROM php:8.4-cli

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy source code
COPY . .

# Copy hasil build frontend dari stage node
COPY --from=node-builder /app/public/build /var/www/public/build

# Install dependency Laravel (tanpa dev)
RUN composer install --no-dev --optimize-autoloader

# Permission (optional tapi sering dibutuhkan)
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000