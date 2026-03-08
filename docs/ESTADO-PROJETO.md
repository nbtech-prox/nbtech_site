# Estado do Projeto NBTech

## Data
- 2026-03-07

## Fase atual
- Fase 5 em progresso: frontend + painel admin funcional

## Concluído
- Bootstrap Laravel 12 com Vite/Tailwind/Alpine
- Instalação de Laravel Fortify
- Instalação de Spatie Media Library
- Instalação de Spatie Permission
- Migrations de domínio:
  - `projects`
  - `services`
  - `testimonials`
  - `contact_messages`
- Modelos principais com casts, fillable e media collections
- Estrutura de arquitetura criada:
  - `app/Actions`
  - `app/DTOs`
  - `app/Services`
  - `app/Repositories`
  - `app/ViewModels`
- Controllers web e admin com lógica fina
- Rotas públicas e admin configuradas
- Painel `/admin` com dashboard, CRUDs e mensagens
- Páginas públicas: Home, Serviços, Portfólio, Projeto, Sobre e Contacto
- Tema claro/escuro/sistema com persistência em `localStorage`
- Seeders de roles, admin e conteúdo base
- Base de testes de feature adicionada:
  - autenticação admin
  - submissão de contacto
  - CRUD de projetos no admin
- Base de dados de testes dedicada criada: `nbtech_test`
- Login admin configurável por `.env` (`ADMIN_EMAIL`, `ADMIN_PASSWORD`)
- Melhorias de navegação mobile com menu colapsável

## Em falta (próximos passos)
- Revisão visual final mobile-first e ajustes de spacing fino
- Melhorar feedback de validação por campo no admin
- Aumentar cobertura de testes para serviços, testemunhos e permissões
- Hardening para VPS:
  - cache de config/rotas/views
  - workers Redis
  - política de backups

## Decisões técnicas
- MariaDB via driver `mysql` do Laravel
- Redis para cache, sessões e filas
- Área admin protegida por `auth` + role `admin`
- Media Library para capa/galeria/OG image de projetos
- PT-PT em labels e mensagens da interface

## Comandos úteis
- Instalar dependências PHP: `composer install`
- Instalar dependências frontend: `npm install`
- Gerar key: `php artisan key:generate`
- Migrar base de dados: `php artisan migrate`
- Semear dados iniciais: `php artisan db:seed`
- Correr em desenvolvimento (frontend + backend):
  - `php artisan serve`
  - `npm run dev`
- Build de produção: `npm run build`
- Correr testes: `php artisan test`
- Correr um teste específico: `php artisan test tests/Feature/Admin/AdminProjectCrudTest.php`

## Notas para retoma
- O login do admin usa rotas Fortify com prefixo `/admin`.
- O primeiro utilizador admin é criado por `AdminUserSeeder`.
- O branding usa ativos em `public/branding` (fontes e logo).
