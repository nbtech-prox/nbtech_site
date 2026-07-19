# ============================================================
# NBTech — Production Dockerfile
# Multi-stage build optimised for Dokploy/Nixpacks
# ============================================================

# ---- Stage 1: PHP dependencies ----
FROM php:8.4-fpm-alpine AS vendor

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# ---- Stage 2: Node build ----
FROM node:22-alpine AS node

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY vite.config.js resources/ resources/
RUN npm run build

# ---- Stage 3: Runtime ----
FROM php:8.4-fpm-alpine AS runtime

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-install pdo_pgsql zip

# Nginx config
COPY deploy/nginx/default.conf /etc/nginx/http.d/default.conf

# Supervisor config
COPY deploy/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

# Copy vendor and built assets from previous stages
COPY --from=vendor /app/vendor ./vendor
COPY --from=node /app/public/build ./public/build

# Copy application source
COPY . .

# Runtime config — cached for performance
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Storage permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
