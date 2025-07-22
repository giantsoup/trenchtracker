# Trench Crusade Campaign Tracker - Development Guidelines

## Build & Configuration Instructions

### Development Environment Setup

This project uses a modern Laravel + Vue.js + Inertia.js stack with specific configuration requirements:

#### Prerequisites
- **PHP 8.4+** (note: requires PHP 8.4, not 8.2+ as mentioned in readme)
- **Node.js 18+** with npm
- **Composer** for PHP dependency management

#### Quick Development Setup
```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup (uses SQLite by default)
php artisan migrate
php artisan db:seed

# Start development servers (recommended approach)
composer run dev
```

#### Development Server Options

**Option 1: Integrated Development (Recommended)**
```bash
composer run dev
```
This runs a concurrent setup with:
- Laravel server (`php artisan serve`)
- Queue worker (`php artisan queue:listen --tries=1`)
- Log monitoring (`php artisan pail --timeout=0`)
- Vite dev server (`npm run dev`)

**Option 2: SSR Development**
```bash
composer run dev:ssr
```
Includes server-side rendering support with Inertia.js SSR.

**Option 3: Manual Setup**
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

#### Build Configuration Details

- **Vite Configuration**: Entry point at `resources/js/app.ts` with SSR support via `resources/js/ssr.ts`
- **TailwindCSS**: Version 4.1.1 with Vite plugin integration
- **Database**: SQLite by default (configured in `.env.example`)
- **Queue**: Database driver for development
- **Cache**: Database driver for development

## Testing Information

### Testing Framework: Pest PHP

This project uses **Pest PHP** (not PHPUnit) for testing with Laravel integration.

#### Running Tests

```bash
# Run all tests via Laravel
php artisan test

# Run tests directly with Pest
./vendor/bin/pest

# Run specific test file
./vendor/bin/pest tests/Feature/ExampleTest.php

# Run with coverage (if configured)
./vendor/bin/pest --coverage
```

#### Test Configuration

- **Test Database**: SQLite in-memory (`:memory:`) for fast execution
- **RefreshDatabase**: Enabled for Feature tests in `tests/Pest.php`
- **Test Environment**: Configured in `phpunit.xml` with array drivers for cache, mail, session

#### Writing Tests

**Basic Test Structure:**
```php
<?php

use App\Models\User;

it('can create a user', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
    expect($user->id)->toBeInt();
});

it('demonstrates HTTP testing', function () {
    $response = $this->get('/');
    
    $response->assertStatus(200);
});
```

**Key Testing Patterns:**
- Use `it()` function for test definitions
- Use `expect()` for assertions (Pest's expectation API)
- Custom expectations available (e.g., `toBeOne()` defined in `tests/Pest.php`)
- Laravel testing methods available via `$this` (e.g., `$this->get()`, `$this->post()`)
- Model factories available for data generation

#### Adding New Tests

1. Create test files in `tests/Feature/` or `tests/Unit/`
2. Use descriptive test names with `it('should do something', function() {})`
3. Feature tests automatically use `RefreshDatabase` trait
4. Use factories for model creation: `User::factory()->create()`

## Code Style & Development Practices

### PHP Code Style (Laravel Pint)

- **Standard**: PSR-12 (default Laravel Pint configuration)
- **Formatting**: Run `./vendor/bin/pint` to format PHP code
- **Integration**: Available via `composer run` scripts

### Frontend Code Style

#### ESLint Configuration
- **Base**: Vue.js essential rules with TypeScript support
- **Disabled Rules**:
  - `vue/multi-word-component-names`: Off (allows single-word components)
  - `@typescript-eslint/no-explicit-any`: Off (allows `any` type)
- **Ignored Paths**: `vendor/`, `node_modules/`, `public/`, `bootstrap/ssr/`, `tailwind.config.js`, `resources/js/components/ui/*`

#### Prettier Configuration
```json
{
    "semi": true,
    "singleQuote": true,
    "printWidth": 150,
    "tabWidth": 4,
    "plugins": ["prettier-plugin-organize-imports", "prettier-plugin-tailwindcss"],
    "tailwindFunctions": ["clsx", "cn"]
}
```

**Key Settings:**
- 150 character line width (wider than standard)
- 4-space indentation (2 spaces for YAML files)
- Single quotes preferred
- Automatic import organization
- TailwindCSS class sorting with `clsx` and `cn` function support

#### Formatting Commands
```bash
# Format frontend code
npm run format

# Check formatting
npm run format:check

# Lint and fix
npm run lint
```

### Project-Specific Patterns

#### Model Conventions
- Use modern PHP docblock types: `list<string>`, `array<string, string>`
- Prefer `casts()` method over `$casts` property
- Extensive use of query scopes for domain filtering (e.g., `scopeActive`, `scopeForFaction`)
- Custom accessors for computed properties (e.g., `getDisplayNameAttribute`)
- Business logic methods with descriptive names (e.g., `canBeTakenByWarband`, `isUnique`)
- Use `SoftDeletes` trait where logical deletion is needed

#### Frontend Patterns
- **Component Library**: Reka UI for accessible components
- **Styling**: TailwindCSS with utility-first approach
- **Icons**: Lucide Vue Next for consistent iconography
- **State Management**: VueUse for composition utilities
- **Routing**: Ziggy for Laravel route generation in frontend

#### File Organization
- **Ignored by Prettier**: UI components (`resources/js/components/ui/*`), Ziggy routes, mail views
- **Auto-generated**: Ziggy route file, UI components (don't manually edit)

### Development Workflow

1. **Code Changes**: Make changes to PHP/Vue files
2. **PHP Formatting**: Run `./vendor/bin/pint` for PHP code
3. **Frontend Formatting**: Run `npm run format` for JS/Vue/TS files
4. **Testing**: Run `php artisan test` or `./vendor/bin/pest`
5. **Linting**: Run `npm run lint` to check frontend code
6. **Type Checking**: Run `npm run type-check` for TypeScript validation

### Environment-Specific Notes

- **Development**: Uses concurrent processes for optimal DX (server, queue, logs, vite)
- **Testing**: In-memory SQLite for fast test execution
- **Production**: Build assets with `npm run build` or `npm run build:ssr` for SSR

### Debugging & Development Tools

- **Laravel Pail**: Real-time log monitoring (`php artisan pail`)
- **Queue Monitoring**: Automatic queue worker in dev mode
- **Hot Reloading**: Vite provides instant updates for frontend changes
- **Database**: SQLite browser/tools for local database inspection
