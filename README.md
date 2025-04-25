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
cd emaya-test
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

POST /api/login
- Parámetros requeridos:
  - email
  - password
- Retorna: Token de autenticación

POST /api/logout
- Requiere: Token de autenticación
- Retorna: Mensaje de confirmación

# List users
GET /api/users
- Returns: Paginated list of users
- Optional filters:
  - name
  - email

# Get specific user
GET /api/users/{id}
- Returns: User data

# Create user
POST /api/users
- Parameters:
  - name (required, string, max:255)
  - email (required, email, unique)
  - password (required, string, min:6)
  - phone_number (optional, string, max:20)
- Returns: Created user

# Update user
PUT /api/users/{id}
- Parameters: (same as create)
- Returns: Updated user

# Delete user
DELETE /api/users/{id}
- Returns: Confirmation message