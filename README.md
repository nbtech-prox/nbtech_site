# NBTech Website & Admin

Site institucional + painel admin da NBTech, construído com Laravel 12 e Vite.

## Stack

- Laravel 12 (PHP 8.3)
- Blade + Tailwind CSS + Vite
- MySQL
- DomPDF para documentos (orçamentos, proforma, fatura/recibo)

## Funcionalidades principais

- Website público (home, serviços, portefólio, sobre, contacto)
- Área admin com gestão de:
  - projetos
  - serviços
  - testemunhos
  - mensagens de contacto
  - orçamentos/faturação (com PDF)
- Testemunhos com moderação:
  - submissão pública
  - estados `pending` / `approved`
  - pontuação de 1 a 5 estrelas
  - website da empresa opcional (link clicável no frontend)

## Setup local

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

## Testes

```bash
php artisan test
```

## Credenciais admin (ambiente local)

Definidas no `.env`:

- `ADMIN_EMAIL`
- `ADMIN_PASSWORD`

## Publicação em múltiplos remotos (GitHub/GitLab/Codeberg)

Exemplo:

```bash
git remote add github   <URL_GITHUB>
git remote add gitlab   <URL_GITLAB>
git remote add codeberg <URL_CODEBERG>

git push github main
git push gitlab main
git push codeberg main
```

## Licença

Projeto privado/proprietário da NBTech, salvo indicação em contrário.
