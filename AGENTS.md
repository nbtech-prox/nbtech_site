# AGENTS.md
Guide for coding agents working in this repository.

## Repo Snapshot
- Laravel 12 + PHP 8.2+
- Blade + Tailwind CSS v4 + Alpine.js + Vite
- PHPUnit 11 via `php artisan test` / `./vendor/bin/phpunit`
- Formatting via Laravel Pint
- App structure: controllers -> form requests -> DTOs -> services/actions -> repositories -> models

## Rule Sources
- No `.cursor/rules/` directory found
- No `.cursorrules` file found
- No `.github/copilot-instructions.md` file found
- Use this file as the canonical agent guide for the repo

## Important Paths
- `app/`
- `routes/web.php`
- `resources/views/`
- `resources/js/app.js`
- `tests/Feature/`
- `tests/Unit/`
- `phpunit.xml`

## Build / Run Commands

### Setup
```bash
composer setup
```

### Manual setup
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
```

### Full dev stack
```bash
composer dev
```

This starts Laravel serve, queue listener, Pail, and Vite.

### Frontend only
```bash
npm run dev
npm run build
```

### Backend only
```bash
php artisan serve
```

## Lint / Format Commands

### PHP
```bash
./vendor/bin/pint --test
./vendor/bin/pint
./vendor/bin/pint --dirty
```

### JS / Blade
- No ESLint configured
- No Prettier configured
- No Blade formatter configured
- Match surrounding style; do not add new tooling unless asked

## Test Commands

### Full suite
```bash
composer test
php artisan test
```

### Single test file
```bash
php artisan test tests/Feature/Admin/AdminProjectCrudTest.php
./vendor/bin/phpunit tests/Feature/Admin/AdminProjectCrudTest.php
```

### Single test method
```bash
./vendor/bin/phpunit tests/Feature/Admin/AdminProjectCrudTest.php --filter test_admin_can_create_update_and_delete_project
php artisan test --filter=test_admin_can_create_update_and_delete_project
```

### Useful variants
```bash
./vendor/bin/phpunit --testsuite Feature
./vendor/bin/phpunit --testsuite Unit
php artisan test --parallel
php artisan test --profile
```

## Test Environment Notes
- `phpunit.xml` uses PostgreSQL and expects `nbtech_test`
- Many tests use `RefreshDatabase`
- Ensure the test DB exists before running DB-backed tests
- Do not copy secrets from `.env` or test config into docs, commits, or logs

## Architecture Rules

### Controllers
- Keep controllers thin and HTTP-focused
- Prefer method injection for dependencies
- Return typed responses like `View` and `RedirectResponse`
- Use `view(...)`, `redirect()->route(...)`, `back()->with(...)`
- Prefer named routes over hard-coded URLs
- For non-trivial writes, turn `$request->validated()` into a DTO first

### Form Requests
- Put validation in `FormRequest` classes
- Use `StoreXRequest` / `UpdateXRequest`
- Use `prepareForValidation()` only for light normalization
- Keep `authorize()` simple unless request-specific auth is needed

### DTOs
- DTOs live in `app/DTOs`
- Use constructor property promotion with `public readonly`
- Standard mapping API is `fromArray()` / `toArray()`
- Normalize mixed payloads inside DTOs, not controllers

### Services / Actions / Repositories
- Repositories own query composition and simple persistence helpers
- Services own business logic and side effects
- Actions are for focused one-operation workflows
- Prefer constructor injection with `private readonly` promoted properties
- Return domain objects when possible, not loose arrays

### Models
- Keep `$fillable` explicit
- Use `casts(): array` where the repo already does
- Put reusable filters in local scopes like `published()` and `featured()`
- Keep route key overrides on the model, e.g. slug binding
- Keep media-library behavior in models/services, not controllers

## PHP Style Guidelines
- Follow Laravel Pint defaults
- Use 4 spaces, no tabs
- One class per file, PSR-4 namespaces
- Import classes at the top; avoid long fully qualified names inline
- Remove unused imports
- Add return types unless the framework contract makes that awkward
- Use explicit nullable and scalar types where possible
- Use named arguments when optional same-shape arguments make calls unclear
- Use short closures or arrow functions for simple collection transforms
- Add docblocks only when they clarify shaped arrays, mixed payloads, or framework-heavy signatures

## Naming Conventions
- Classes: `StudlyCase`
- Methods and variables: `camelCase`
- Request and DB fields: `snake_case`
- Routes: dotted names like `admin.projects.index`
- DTO methods: `fromArray()` and `toArray()`
- Test methods: descriptive, usually `test_...`
- Reusable Blade fragments may be underscore-prefixed, e.g. `_form.blade.php`

## Blade / Frontend Guidelines
- Use route helpers everywhere: `route('...')`
- Preserve the Tailwind utility-heavy style already in place
- Prefer `@class(...)` for conditional classes
- Use `@error(...)` and `old(...)` consistently in forms
- Reuse partials for large form sections
- Keep Alpine behavior lightweight and close to the view unless widely reused
- Preserve accessibility details already in use: labels, `aria-invalid`, alt text, explicit button text

## JavaScript Guidelines
- Use ES modules with imports at the top
- Match current style: single quotes and semicolons
- Use `camelCase` identifiers
- Write DOM code defensively with early returns when elements are missing or disabled
- Keep Alpine component names descriptive, e.g. `themeSwitcher`
- Do not introduce heavier frontend frameworks unless asked

## Error Handling
- Validate first; avoid ad hoc controller validation
- Catch exceptions narrowly and only with a clear recovery path
- Do not swallow exceptions silently
- Preserve the repo's flash-message pattern: redirect with session `status`
- Keep destructive actions explicit and aligned with existing confirm flows
- Do not normalize bad input in ways that hide validation errors

## Test Style
- Prefer feature tests for route/controller/admin CRUD flows
- Use `RefreshDatabase` for DB-backed tests
- Use factories plus explicit role setup in tests
- Use route helpers instead of raw URIs
- Assert redirects, flash state, and DB changes
- Keep each test focused on one user-visible behavior

## Practical Agent Guidance
- After PHP edits, run `./vendor/bin/pint --test` when reasonable
- Run the narrowest relevant test file or filtered test method before broad suites
- Preserve the existing Laravel layering instead of moving logic into controllers
- Keep Portuguese labels/content intact unless the task is explicitly copy-focused
- Do not add dependencies, lint tools, or new architectural patterns unless asked
