# EMAYA - Backend Developer Test

User management system with authentication, audit logging, and password history control. Developed with Laravel 11 + SQLite + Sanctum.

---

## 🚀 Requisitos

- PHP 8.2+
- Composer
- Laravel 11
- SQLite

---

## ⚙️ Instalación

```bash
git clone https://github.com/adilmarruiz/emaya-test
cd emaya-user-management
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

