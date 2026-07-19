# Deploy — NBTech (Hostinger / Dokploy)

## Stack
- Hostinger VPS
- Dokploy (self-hosted PaaS)
- GitHub → auto-deploy on main

## Docker build (Dokploy)
O Dokploy usa o `Dockerfile` na raiz do projecto para construir a imagem.
O Dockerfile é multi-stage:
1. **vendor** — PHP deps (composer --no-dev)
2. **node** — frontend build (npm ci + npm run build)
3. **runtime** — PHP-FPM + Nginx + Supervisor

## Variáveis obrigatórias no Dokploy

| Variável | Exemplo | Descrição |
|----------|---------|-----------|
| `APP_ENV` | `production` | Ambiente |
| `APP_DEBUG` | `false` | Desligar debug |
| `APP_KEY` | `base64:...` | Gerar com `php artisan key:generate` |
| `APP_URL` | `https://nbtech.pt` | URL do site |
| `DB_HOST` | (host BD) | Host PostgreSQL |
| `DB_DATABASE` | `db_nbtech` | Nome BD |
| `DB_USERNAME` | `user_db_nbtech` | Utilizador BD |
| `DB_PASSWORD` | — | Password BD |
| `SESSION_DRIVER` | `redis` | Redis para sessões (prod) |
| `QUEUE_CONNECTION` | `redis` | Redis para filas (prod) |
| `CACHE_STORE` | `redis` | Redis para cache (prod) |
| `REDIS_HOST` | `127.0.0.1` | Host Redis |
| `REDIS_PASSWORD` | — | Password Redis |
| `MAIL_MAILER` | `smtp` | Mail driver (smtp/mailgun/ses) |
| `MAIL_HOST` | `smtp.hostinger.com` | SMTP host |
| `MAIL_PORT` | `465` | SMTP port |
| `MAIL_USERNAME` | `geral@nbtech.pt` | SMTP user |
| `MAIL_PASSWORD` | — | SMTP password |
| `MAIL_ENCRYPTION` | `tls` | SMTP encryption |
| `MAIL_FROM_ADDRESS` | `geral@nbtech.pt` | From address |
| `MAIL_FROM_NAME` | `NBTech` | From name |
| `CONTACT_RECIPIENT_EMAIL` | `info@nbtech.pt` | Notificações contacto |
| `BUDGET_RECIPIENT_EMAIL` | `orcamento@nbtech.pt` | Notificações orçamento |
| `ADMIN_EMAIL` | `admin@nbtech.pt` | Email admin |
| `ADMIN_PASSWORD` | — | Password admin |
| `INVOICE_COMPANY_*` | — | Dados faturação |

## Hardening checklist (pós-deploy)

### 1. Cache em produção
```bash
# Correr dentro do container ou no build
php artisan config:cache
php artisan route:cache
php artisan view:cache
# Já corre automaticamente no Dockerfile
```

### 2. Redis para sessões, cache e filas
No .env de produção (Dokploy):
```
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
CACHE_STORE=redis
```

### 3. Queue worker
O Supervisor dentro do container gere o worker automaticamente.
Se o Dokploy não usar Dockerfile (Nixpacks), configurar externamente:
```bash
# Dokploy → Services → Add command
php artisan queue:work --queue=default --sleep=1 --tries=3 --max-time=3600
```

### 4. Scheduled tasks (cron)
O Dockerfile **não** inclui cron daemon (anti-pattern em containers).
Opções:
- **Dokploy**: usar o scheduler interno (Settings → Cron Jobs)
  ```
  * * * * * cd /app && php artisan schedule:run >> /dev/null 2>&1
  ```
- **Kubernetes**: criar CronJob
- **VPS bare**: systemd timer ou crontab

### 5. CI/CD (GitHub Actions)
O workflow `.github/workflows/ci.yml` corre em push/PR para `main`:
1. **lint** — Pint (PHP CS)
2. **test** — PHPUnit (toda a suite)
3. **build** — assets + cache
4. **deploy** — webhook Dokploy (opcional, precisa de `DOKPLOY_DEPLOY_URL`)

Para activar o auto-deploy no Dokploy:
1. Settings → Deployment → Webhook
2. Copiar URL do webhook
3. Adicionar como secret `DOKPLOY_DEPLOY_URL` no GitHub repo

### 6. Segurança
- `APP_DEBUG=false` em produção
- `BCRYPT_ROUNDS=12` (já definido)
- Headers de segurança no Nginx (já configurados em `deploy/nginx/default.conf`)
- Rate limiting nas rotas públicas (já configurado: `throttle:public-submissions`)
- Two-factor auth disponível via Fortify

### 7. Monitorização
- Logs: `LOG_CHANNEL=stack` com `LOG_LEVEL=error` em produção
- Dokploy: logs do container em tempo real
- Queue: `php artisan queue:monitor` para health check

## Deploy manual (alternativa ao Dokploy)

```bash
# 1. Build
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# 2. Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Migrate
php artisan migrate --force

# 4. Queue worker (systemd)
sudo cp deploy/supervisor/nbtech-worker.service /etc/systemd/system/
sudo systemctl enable --now nbtech-worker
```

## Comandos úteis

```bash
# Testar tudo antes de fazer deploy
composer test

# Verificar lint
./vendor/bin/pint --test

# Limpar cache (se algo correr mal)
php artisan optimize:clear

# Ver workers ativos
php artisan queue:monitor

# Logs em produção (dentro do container Dokploy)
php artisan pail
```
