# Backend Engineer (Laravel/PHP) Technical Assignment  
**RAJ Consulting**

**Live API Base URL:**  
👉 https://backend-engineer-technical-task.onrender.com

---

## 📌 Project Overview

This repository contains my submission for the **Backend Engineer (Laravel/PHP) Internship Technical Assignment** at **RAJ Consulting**.

The project is an **API-only backend system** built with **Laravel**, **Laravel Passport**, and **PostgreSQL**, focusing on backend fundamentals, clean architecture, token-based authentication, and a fully custom **Role-Based Access Control (RBAC)** system.

All RBAC logic was implemented **from scratch**, without third-party authorization packages, in line with the task requirements.

---

## 🧱 Technology Stack

- Laravel  
- Laravel Passport  
- PostgreSQL (Render Managed Database)  
- Docker  
- Render (Deployment Platform)  

---

## 🔐 Authentication (Laravel Passport)

Authentication is implemented using **Laravel Passport** with personal access tokens.

### Available Endpoints

| Method | Endpoint | Description |
|------|---------|------------|
| POST | `/api/v1/register` | Register a new user |
| POST | `/api/v1/login` | Authenticate and receive access token |
| POST | `/api/v1/logout` | Revoke current access token |

All protected endpoints require a valid **Bearer token**.

---

## 🧩 Custom RBAC Implementation (No Packages)

RBAC was implemented manually to demonstrate a clear understanding of authorization fundamentals.

### Database Structure

```
users
roles
permissions
role_user        (user ↔ role)
role_permission  (role ↔ permission)
```

---

### Roles & Access Levels

| Role | Access |
|----|-------|
| Super Admin | Full system access |
| Admin | Full user management access |
| Basic User | Read-only access |

---

### Permissions

- read  
- write  
- view_users  
- create_users  
- edit_users  
- delete_users  

---

## 👥 User Management (RBAC Enforced)

| Method | Endpoint | Required Permission |
|------|---------|--------------------|
| GET | `/api/v1/users` | view_users |
| GET | `/api/v1/users/{id}` | view_users |
| POST | `/api/v1/users` | create_users |
| PUT | `/api/v1/users/{id}` | edit_users |
| DELETE | `/api/v1/users/{id}` | delete_users |

---

## 🌐 External API Integration

```
GET /api/v1/external/users
```

---

## 🐳 Deployment & Docker Setup

The application is containerized using Docker and deployed on **Render**.  
All setup steps (migrations, Passport key generation, permission fixes) are handled automatically at container startup using a startup script.

---

## 🧪 Test Login Credentials (Seeded Users)

### Super Admin
```
Email: johndoe@yahoo.com
Password: password
```

### Admin
```
rafaela91@example.com
kuvalis.tabitha@example.org
Password: password
```

### Basic User
```
trevor.hoppe@example.org
littel.walton@example.net
Password: password
```

---

## 👨‍💻 Author

Backend Engineer (Laravel/PHP) Internship Technical Assignment  
**RAJ Consulting**
