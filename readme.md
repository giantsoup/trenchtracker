# Trench Crusade Campaign Tracker

![Laravel](https://img.shields.io/badge/Laravel-v12.20.0-red?style=flat-square&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3.5.13-green?style=flat-square&logo=vue.js)
![Inertia.js](https://img.shields.io/badge/Inertia.js-2.0.0-purple?style=flat-square&logo=inertiajs)
![TypeScript](https://img.shields.io/badge/TypeScript-5.2.2-blue?style=flat-square&logo=typescript)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.1.1-teal?style=flat-square&logo=tailwindcss)
![SQLite](https://img.shields.io/badge/SQLite-Database-lightgrey?style=flat-square&logo=sqlite)
![Pest](https://img.shields.io/badge/Pest-Testing-orange?style=flat-square&logo=pest)

A comprehensive web application for managing Trench Crusade warbands, tracking campaign progression, post-battle sequences, and maintaining detailed records of your soldiers' journeys through the eternal war between Heaven and Hell.

## About Trench Crusade

**Trench Crusade** is a narrative skirmish wargame set in an alternate 1914 where heretical Templars opened a gate to Hell during the Crusades, unleashing an 800+ year war between Heaven and Hell. Players command warbands of 6-20 models representing various factions in this grimdark setting where WWI-era warfare meets medieval religious horror.

The game features:
- **Alternating Activation:** Players take turns activating individual models
- **Action Success System:** Roll 2D6, needing 7-11 for success, 12+ for critical success
- **Blood & Blessing Markers:** Track wounds, exhaustion, and divine favor
- **Campaign Progression:** Models gain experience, injuries, and promotions between battles
- **Narrative Focus:** Every soldier has a story, from recruitment to martyrdom

This application helps players manage the complex campaign systems that make each warband unique and create memorable narratives across multiple battles.

## Features

### Current Implementation
- **Warband Management:** Create and customize warbands from various factions (Trench Pilgrims, New Antioch, Iron Sultanate, and more)
- **Unit Tracking:** Detailed records for each soldier including stats, equipment, experience, and injuries
- **Equipment System:** Comprehensive armory with weapons, armor, and special equipment for each faction
- **Campaign Progression:** Track experience points, promotions, and battle scars
- **Post-Battle Sequences:** Guided workflows for updating units after engagements

### Planned Features
- **Battle Reports:** Record and share your campaign's most memorable moments
- **Glory Point System:** Track achievements and unlock elite equipment
- **Faction-Specific Rules:** Special abilities and restrictions for each warband type
- **Multi-User Campaigns:** Support for groups running connected campaigns
- **Export/Import:** Share warbands with other players or backup your data

## Tech Stack

This application is built using modern web technologies optimized for developer experience and performance:

- **Backend:** Laravel 12.20.0 with PHP 8.2+
- **Frontend:** Vue.js 3.5.13 with TypeScript 5.2.2
- **Bridge:** Inertia.js 2.0.0 for seamless SPA experience
- **Styling:** TailwindCSS 4.1.1 with custom components
- **Database:** SQLite for simple deployment and portability
- **UI Components:** Reka UI for accessible, customizable interfaces
- **Icons:** Lucide Vue Next for consistent iconography
- **Testing:** Pest PHP for elegant testing workflows
- **Build Tools:** Vite 6.2.0 for lightning-fast development

## Installation & Setup

### Prerequisites
- **PHP 8.2+** with required extensions (PDO, SQLite, etc.)
- **Node.js 18+** with npm
- **Composer** for PHP dependency management

### Quick Start

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/trench-crusade-tracker.git
   cd trench-crusade-tracker
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build frontend assets:**
   ```bash
   npm run build
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   ```

### Development Setup

For active development with hot reloading:

1. **Start the Laravel server:**
   ```bash
   php artisan serve
   ```

2. **In a separate terminal, start the Vite dev server:**
   ```bash
   npm run dev
   ```

3. **Visit:** http://localhost:8000

### Testing

Run the test suite to ensure everything is working correctly:

```bash
# PHP tests with Pest
php artisan test

# Or run Pest directly
./vendor/bin/pest

# TypeScript checking
npm run type-check

# Linting
npm run lint
```
