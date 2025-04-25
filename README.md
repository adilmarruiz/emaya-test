# EMAYA - Backend Developer Test

User management system with authentication, audit logging, and password history control. Developed with Laravel 11 + SQLite + Sanctum.

---

## 🚀 Requirements

- PHP 8.2+
- Composer
- Laravel 11
- SQLite

---

## ⚙️ Installation

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
```

---

# API Endpoints

## Authentication

### Login  
**POST /api/login**  
Authenticates a user and generates an access token.

- **Required parameters:**
  - `email` (string)
  - `password` (string)
- **Returns:** Authentication token

### Logout  
**POST /api/logout**  
Invalidates the current authentication token.

- **Requires:** Authentication token
- **Returns:** Confirmation message

---

## Users

### List Users  
**GET /api/users**  
Retrieves a paginated list of users.

- **Returns:** Paginated user list
- **Optional filters:**
  - `name` (string)
  - `email` (string)

### Get Specific User  
**GET /api/users/{id}**  
Retrieves data for a specific user.

- **Returns:** User data

### Create User  
**POST /api/users**  
Creates a new user.

- **Parameters:**
  - `name` (required, string, max:255)
  - `email` (required, email, unique)
  - `password` (required, string, min:6)
  - `phone_number` (optional, string, max:20)
- **Returns:** Created user

### Update User  
**PUT /api/users/{id}**  
Updates an existing user's data.

- **Parameters:** (same as create)
- **Returns:** Updated user

### Delete User  
**DELETE /api/users/{id}**  
Removes a user from the system.

- **Returns:** Confirmation message

---

## Audit Logs

### List Logs  
**GET /api/audit-logs**  
Retrieves system audit logs.

- **Requires:** Authentication token
- **Returns:** Paginated log list
- **Optional filters:**
  - `user_id` (integer): Filter by user ID

**Log Entry Structure:**
- User ID
- HTTP Method
- Full URL
- IP Address
- User Agent
- Payload (excluding sensitive data)