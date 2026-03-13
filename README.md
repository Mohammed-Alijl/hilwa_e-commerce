<div align="center">

# 🛍️ Hilwa E-Commerce Dashboard

**A full-featured, multi-language e-commerce admin panel built with Laravel 10**

[![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

</div>

---

## 📖 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Docker Setup (Laravel Sail)](#docker-setup-laravel-sail)
- [Configuration](#%EF%B8%8F-configuration)
- [Usage](#-usage)
  - [Admin Dashboard](#admin-dashboard)
  - [Customer Portal](#customer-portal)
- [Module Overview](#-module-overview)
- [Authentication & Authorization](#-authentication--authorization)
- [API](#-api)
- [Internationalization](#-internationalization)
- [Database](#-database)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🌟 Overview

**Hilwa E-Commerce** is a powerful, production-ready e-commerce management platform designed for businesses that need a complete back-office solution. It features a comprehensive admin dashboard to manage every aspect of an online store — from products and categories to delivery zones, drivers, and customer addresses — all with full Arabic and English language support.

Whether you run a single store or a multi-location retail operation, Hilwa gives you the tools to manage it all from one elegant interface.

---

## ✨ Features

### 🏪 Store Management
- Manage multiple store locations with opening/closing times
- Associate stores with cities and delivery zones
- Full multi-language support for store information

### 📦 Product Catalog
- Complete product CRUD with rich details (SKU, pricing, special pricing)
- Stock tracking with quantity and status management
- Product attributes and dynamic variants
- Multiple product images / media gallery
- Product discounts and special offers
- City-level product availability restrictions
- Related products linking

### 🗂️ Category Management
- Hierarchical category tree (parent/child relationships)
- Color-coded categories for easy navigation
- Display order control
- City-category associations
- Multi-language category names

### 👥 Customer Management
- Full customer profile management
- Multiple saved addresses (home, office, etc.)
- Location-aware customer lookup
- Zone-based customer assignment

### 🚗 Driver Management
- Driver profile management and status tracking
- Zone assignment for delivery drivers
- Avatar/profile image support

### 🗺️ Geographic Management
- Countries → States → Cities → Zones hierarchy
- ZIP code management
- Delivery zone configuration per city

### ⏰ Delivery Operations
- Configurable delivery timeslots
- Zone-based delivery management
- Day and schedule management

### 🔐 Security & Access Control
- Role-Based Access Control (RBAC) with Spatie Laravel Permission
- Separate admin and customer authentication guards
- Granular permission management per admin role
- Secure session-based authentication

### �� Multi-Language
- Full Arabic (RTL) and English (LTR) support
- Language-aware routing (`/{locale}/admin`)
- Translatable models via Spatie Translatable
- Dynamic language switching

### 🎨 Modern UI/UX
- Responsive design with Tailwind CSS
- Lightweight interactivity via Alpine.js
- Beautiful alerts and confirmations via SweetAlert2
- Drag-and-drop file uploads via Bootstrap File Input
- AJAX-powered cascading dropdowns (State → City → Zone)

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend Framework** | [Laravel 10](https://laravel.com/) (PHP 8.1+) |
| **Frontend CSS** | [Tailwind CSS 3](https://tailwindcss.com/) |
| **Frontend JS** | [Alpine.js 3](https://alpinejs.dev/) |
| **Build Tool** | [Vite 4](https://vitejs.dev/) |
| **Database** | MySQL 5.7+ |
| **ORM** | Eloquent (Laravel) |
| **Authentication** | Laravel Sanctum + Session Guards |
| **Authorization** | [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) |
| **i18n** | [Spatie Translatable](https://spatie.be/docs/laravel-translatable) + [mcamara/laravel-localization](https://github.com/mcamara/laravel-localization) |
| **Alerts** | [SweetAlert2](https://sweetalert2.github.io/) |
| **File Uploads** | [Kartik Bootstrap File Input](https://plugins.krajee.com/file-input) |
| **HTTP Client** | Guzzle 7 |
| **Testing** | PHPUnit 10 |

---

## 📁 Project Structure

```
hilwa_e-commerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/               # Customer authentication controllers
│   │   │   └── Dashboard/          # Admin dashboard controllers (18+)
│   │   ├── Middleware/             # HTTP middleware
│   │   └── Requests/               # Form validation (24+ request classes)
│   ├── Models/                     # Eloquent models (25+)
│   ├── Repositories/               # Repository pattern (19 repositories)
│   ├── Services/                   # Business logic services
│   ├── Rules/                      # Custom validation rules
│   └── Traits/                     # Reusable traits
├── config/                         # Configuration files (15+)
├── database/
│   ├── migrations/                 # Database migrations (30+)
│   └── seeders/                    # Database seeders (11)
├── lang/
│   ├── en/                         # English translations
│   └── ar/                         # Arabic translations
├── resources/
│   ├── css/                        # Tailwind CSS source
│   ├── js/                         # Alpine.js & Axios
│   └── views/
│       └── dashboard/              # Admin Blade templates (20+ modules)
├── routes/
│   ├── web.php                     # Customer-facing routes
│   ├── api.php                     # API routes
│   ├── admin.php                   # Admin dashboard routes
│   ├── admin_auth.php              # Admin authentication routes
│   └── auth.php                    # Customer authentication routes
├── tests/                          # PHPUnit test suite
├── .env.example                    # Environment variables template
├── composer.json                   # PHP dependencies
├── package.json                    # Node.js dependencies
├── tailwind.config.js              # Tailwind configuration
└── vite.config.js                  # Vite build configuration
```

---

## 🚀 Getting Started

### Prerequisites

Make sure you have the following installed:

- **PHP** 8.1 or higher
- **Composer** 2.x
- **Node.js** 16+ and **npm** 8+
- **MySQL** 5.7 or higher
- **Git**

### Installation

#### 1. Clone the repository

```bash
git clone https://github.com/Mohammed-Alijl/hilwa_e-commerce.git
cd hilwa_e-commerce
```

#### 2. Install PHP dependencies

```bash
composer install
```

#### 3. Set up environment file

```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Configure your database

Open `.env` and update the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hilwa
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

#### 5. Run migrations and seed the database

```bash
php artisan migrate
php artisan db:seed
```

#### 6. Install Node.js dependencies and build assets

```bash
npm install
npm run build
```

> For active development with hot module replacement:
> ```bash
> npm run dev
> ```

#### 7. Create the storage symlink

```bash
php artisan storage:link
```

#### 8. Start the development server

```bash
php artisan serve
```

The application will be available at **http://localhost:8000**

| URL | Description |
|-----|-------------|
| `http://localhost:8000/` | Customer-facing storefront |
| `http://localhost:8000/admin` | Admin dashboard |
| `http://localhost:8000/admin/login` | Admin login page |

---

### Docker Setup (Laravel Sail)

Prefer Docker? Laravel Sail has you covered:

```bash
# Install dependencies using Docker
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

# Copy and configure environment
cp .env.example .env

# Start all services (MySQL, PHP, etc.)
./vendor/bin/sail up -d

# Run migrations and seeders
./vendor/bin/sail artisan migrate --seed
```

---

## ⚙️ Configuration

Key environment variables in `.env`:

```env
# Application
APP_NAME="Hilwa E-Commerce"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hilwa
DB_USERNAME=root
DB_PASSWORD=secret

# Cache & Session
CACHE_DRIVER=file        # Options: file, redis, memcached
SESSION_DRIVER=file      # Options: file, redis, database
QUEUE_CONNECTION=sync    # Options: sync, redis, database

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="noreply@hilwa.com"
MAIL_FROM_NAME="Hilwa E-Commerce"
```

---

## 🖥️ Usage

### Admin Dashboard

Access the admin panel at `/admin` (or `/{locale}/admin` for a specific language).

**Default admin credentials** are set up via the database seeders. After running `php artisan db:seed`, use the credentials defined in `database/seeders/AdminSeeder.php`.

The admin dashboard provides access to:

| Section | Path | Description |
|---------|------|-------------|
| Dashboard | `/admin` | Overview and statistics |
| Products | `/admin/products` | Full product catalog management |
| Categories | `/admin/categories` | Hierarchical category management |
| Attributes | `/admin/attributes` | Product attributes and values |
| Customers | `/admin/customers` | Customer list and profile management |
| Drivers | `/admin/drivers` | Driver management and assignment |
| Stores | `/admin/stores` | Store location management |
| Zones | `/admin/zones` | Delivery zone configuration |
| Cities | `/admin/cities` | City management |
| States | `/admin/states` | State/Province management |
| Timeslots | `/admin/timeslots` | Delivery time slot management |
| Units | `/admin/units` | Unit/Measurement management |
| Admins | `/admin/admins` | Admin user management |
| Roles | `/admin/roles` | Role management |
| Settings | `/admin/settings` | Global application settings |

### Customer Portal

Customers access the platform via the root URL. Features include:

- Account registration and login
- Browse products by category
- Manage saved addresses
- View order history

---

## 📦 Module Overview

### Products Module

The product module is the heart of the system, supporting:

- **Rich product data**: name (EN/AR), description, SKU, barcode
- **Pricing**: regular price, special price, cost price
- **Inventory**: stock quantity, stock status
- **Media**: multiple product images
- **Relations**: categories, attributes, variants, discounts
- **Restrictions**: city-level availability rules

### Geographic Hierarchy

```
Country
  └── State / Province
        └── City
              └── Delivery Zone
                    └── ZIP Code
```

This hierarchy powers store assignments, driver zones, and customer address management.

### RBAC (Roles & Permissions)

The system uses **Spatie Laravel Permission** for fine-grained access control:

```
Super Admin
  └── Has all permissions

Store Manager
  └── Manage products, categories, orders

Support Agent
  └── View customers, manage addresses
```

Permissions and roles can be fully customized from the admin panel.

---

## 🔐 Authentication & Authorization

The platform uses a **dual-guard authentication** system:

| Guard | Model | Login Route | Home Route |
|-------|-------|-------------|------------|
| `web` (Customers) | `App\Models\User` | `/login` | `/` |
| `admin` (Admins) | `App\Models\Admin` | `/admin/login` | `/admin` |

- **API Authentication**: Laravel Sanctum for token-based API access
- **Authorization**: Spatie Laravel Permission with roles and permissions
- **Admin Model** uses the `HasRoles` trait for permission checks

---

## 🔌 API

The application provides a RESTful API protected by Laravel Sanctum.

**Base URL**: `http://localhost:8000/api`

### AJAX Endpoints (used internally by the dashboard)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/state-cities/{stateId}` | Get cities for a given state |
| `GET` | `/city-zones/{cityId}` | Get delivery zones for a city |
| `GET` | `/attribute-values/{attributeId}` | Get values for an attribute |

### Authentication

```bash
# Authenticated API request
GET /api/user
Authorization: Bearer {your-token}
```

---

## 🌐 Internationalization

Hilwa E-Commerce ships with full **English** and **Arabic** (RTL) support.

### Language Routing

Routes are prefixed with the locale:
```
/en/admin        → English dashboard
/ar/admin        → Arabic dashboard (RTL)
```

### Adding Translations

Language files live in `/lang/{locale}/`:

```
lang/
├── en/
│   ├── dashboard.php
│   ├── validation.php
│   └── ...
└── ar/
    ├── dashboard.php
    ├── validation.php
    └── ...
```

### Translatable Models

Models that support multiple languages use **Spatie Translatable**:

```php
// Example: Category model
$category->setTranslation('name', 'en', 'Electronics');
$category->setTranslation('name', 'ar', 'إلكترونيات');

echo $category->getTranslation('name', 'ar'); // إلكترونيات
```

---

## 🗄️ Database

The application uses **MySQL** with **Eloquent ORM**. Key relationships:

```
Products ──────── Categories (Many-to-Many)
Products ──────── Attributes (Many-to-Many with values)
Products ──────── Variants (One-to-Many)
Products ──────── Images (One-to-Many)
Products ──────── Discounts (One-to-Many)

Categories ─────── Parent Category (Self-referencing)

Stores ──────────── Cities (Many-to-Many)
Stores ──────────── Zones (Many-to-Many)

Cities ───────────── Zones (One-to-Many)

Users (Customers) ── Addresses (One-to-Many)
Users (Customers) ── Zone (Many-to-One)

Admins ──────────── Roles (Many-to-Many via Spatie)
Roles ───────────── Permissions (Many-to-Many via Spatie)
```

### Running Migrations

```bash
# Run all pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

---

## 🧪 Testing

The project uses **PHPUnit** for automated testing.

```bash
# Run the full test suite
php artisan test

# Run a specific test file
php artisan test tests/Feature/ExampleTest.php

# Run with code coverage (requires Xdebug)
php artisan test --coverage
```

Test files are located in:
```
tests/
├── Feature/     # Integration and feature tests
└── Unit/        # Unit tests
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. **Fork** the repository
2. **Create** a new branch: `git checkout -b feature/your-feature-name`
3. **Commit** your changes: `git commit -m 'Add some feature'`
4. **Push** to the branch: `git push origin feature/your-feature-name`
5. **Open** a Pull Request

### Code Style

This project uses **Laravel Pint** for code styling:

```bash
./vendor/bin/pint
```

Please ensure your code follows PSR-12 standards and passes all existing tests before submitting a PR.

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">

**Built with ❤️ using Laravel**

[Report Bug](https://github.com/Mohammed-Alijl/hilwa_e-commerce/issues) · [Request Feature](https://github.com/Mohammed-Alijl/hilwa_e-commerce/issues)

</div>
