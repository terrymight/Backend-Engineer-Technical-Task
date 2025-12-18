# Backend Engineer (Laravel/PHP) Technical Assignment  
**RAJ Consulting**

**Live API Base URL:**  
👉 https://backend-engineer-technical-task.onrender.com

---

## 📌 Project Overview

This repository contains my submission for the **Backend Engineer (Laravel/PHP) Internship Technical Assignment** at **RAJ Consulting**.

The project is an **API-only backend system** built with **Laravel**, **Laravel Passport**, and **PostgreSQL**, focusing on:

- Backend fundamentals
- Clean architecture
- Token-based authentication
- **Custom Role-Based Access Control (RBAC)**
- Secure, permission-driven user management
- External API integration
- Consistent and professional API responses

All RBAC logic was implemented **from scratch**, without using third-party authorization packages, as explicitly required.

---

## 🧱 Technology Stack

- **Laravel**
- **Laravel Passport**
- **PostgreSQL (Render Managed Database)**
- **Docker**
- **Render (Deployment Platform)**

---

## 🔐 Authentication (Laravel Passport)

Authentication is implemented using **Laravel Passport** with personal access tokens.

### Available Endpoints

| Method | Endpoint | Description |
|------|---------|------------|
| POST | `/api/v1/register` | Register a new user |
| POST | `/api/v1/login` | Authenticate and receive token |
| POST | `/api/v1/logout` | Revoke current access token |

All protected endpoints require a valid **Bearer token**.

---

## 🧩 Custom RBAC Implementation (No Packages)

### ❗ Important Note

RBAC was implemented **manually**, without packages such as Spatie or Laratrust, to demonstrate a strong understanding of backend authorization principles.

---

### Database Design

The RBAC system uses the following tables:

```
users
roles
permissions
role_user        (user ↔ role)
role_permission  (role ↔ permission)
```

---

### Roles Definition

| Role | Access Level |
|----|-------------|
| Super Admin | Full system access |
| Admin | Full system access |
| Basic User | Read-only access |

---

### Permissions

| Permission |
|-----------|
| read |
| write |
| view_users |
| create_users |
| edit_users |
| delete_users |

---

### Permission Assignment Rules

- **Super Admin** → All permissions
- **Admin** → All permissions
- **Basic User** → Read-only permission (`read`)

---

### Permission Resolution Logic

```php
public function hasPermission(string $permission): bool
{
    return $this->roles()
        ->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })
        ->exists();
}
```

Authorization checks are enforced using **custom middleware** applied to protected routes.

---

## 👥 User Management (RBAC Enforced)

User management endpoints are fully protected by RBAC.

| Method | Endpoint | Required Permission |
|------|---------|--------------------|
| GET | `/api/v1/users` | view_users |
| GET | `/api/v1/users/{id}` | view_users |
| POST | `/api/v1/users` | create_users |
| PUT | `/api/v1/users/{id}` | edit_users |
| DELETE | `/api/v1/users/{id}` | delete_users |

---

## 🌐 External API Integration

### Endpoint

```
GET /api/v1/external/users
```

This endpoint fetches user data from the public API:

```
https://jsonplaceholder.typicode.com/users
```

Errors are handled gracefully, and responses follow the standard API format.

---

## 📦 Standard API Response Format

### Success Response
```json
{
  "success": true,
  "code": 200,
  "data": {},
  "message": "message"
}
```

### Error Response
```json
{
  "success": false,
  "code": 400,
  "data": {},
  "message": "error message"
}
```

---

## 🧪 Testing Credentials (Super Admin)

Use the following credentials to test full system access:

```
Email: superadmin@example.com
Password: password
```

> This account has **Super Admin** privileges and unrestricted access to all protected endpoints.

---

## 🐳 Local Setup (Docker)

### Prerequisites
- Docker
- Docker Compose

---

### Clone the Repository

```bash
git clone https://github.com/<your-username>/<repository-name>.git
cd <repository-name>
```

---

### Environment Configuration

```bash
cp .env.example .env
```

Update the `.env` file with your **Render PostgreSQL** credentials.

---

### Build and Run Containers

```bash
docker compose build
docker compose up -d
```

---

### Run Migrations & Passport Setup

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan passport:install --force
```

---

### Seed Database (RBAC + Users)

```bash
docker compose exec app php artisan db:seed
```

This will:
- Reset RBAC tables
- Create roles and permissions
- Generate 20 users
- Assign exactly one Super Admin

---

## 🗄️ Database

- PostgreSQL hosted on **Render**
- Foreign key constraints enforced
- No credentials committed to source control

---

## 🚀 Deployment

- Docker-based deployment on **Render**
- Managed PostgreSQL database
- Environment variables configured via Render dashboard

**Production Base URL:**  
👉 https://backend-engineer-technical-task.onrender.com

---

## 📮 Postman Collection

A public Postman collection is included and contains:
- Authentication flows
- RBAC-protected user management
- External API endpoint

---

## 📝 Final Notes for Reviewers

- RBAC implemented **without third-party authorization packages**
- Authorization enforced via middleware
- Clean separation of concerns
- Designed to be extensible and production-ready

---

## 👨‍💻 Author

Backend Engineer (Laravel/PHP) Internship Technical Assignment  
**RAJ Consulting**
