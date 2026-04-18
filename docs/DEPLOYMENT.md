# Deploy VPS (Nginx + PHP-FPM + Redis)

## Requisitos
- PHP 8.4+
- PostgreSQL 16+
- Nginx
- Redis Server
- Node.js 20+

## Passos base
1. `composer install --no-dev --optimize-autoloader`
2. `npm ci && npm run build`
3. `php artisan migrate --force`
4. `php artisan db:seed --force`
5. `php artisan config:cache && php artisan route:cache && php artisan view:cache`

## Variáveis recomendadas para produção
```dotenv
APP_ENV=production
APP_DEBUG=false

SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
CACHE_STORE=redis
REDIS_CLIENT=predis
```

## Worker de filas
```bash
php artisan queue:work --queue=default --sleep=1 --tries=3
```

Configurar com Supervisor ou systemd para processo persistente.

## Exemplo Nginx (bloco server)
```nginx
server {
    listen 80;
    server_name nbtech.pt www.nbtech.pt;
    root /var/www/nbtech/public;
    index index.php;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
    }

    location ~ /\. {
        deny all;
    }
}
```
