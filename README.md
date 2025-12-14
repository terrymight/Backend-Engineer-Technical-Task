<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Backend Engineer (Laravel/PHP) Intern – Technical Task

The goal of this project is to build a simple, API-only backend system using Laravel, Laravel Passport, and PostgreSQL. The system should include user authentication, role-based access control (RBAC), and permission-driven operations applied specifically to the users module. Candidates will implement user login, role assignment, permission assignment, and protected CRUD endpoints where access is determined by the user’s assigned permissions. Additionally, the project requires integrating an external public API by creating an endpoint that fetches and returns user data from a third-party service. All responses must follow a standardized JSON structure. This task is designed to assess the candidate’s understanding of backend architecture, authentication, authorization logic, API development, and external API communication. 

### You are required to build an API-only backend project using:

- Laravel
- Laravel Passport
- PostgreSQL
- No UI
- No RBAC plugins/packages (e.g., Spatie, Laratrust → not allowed)


### You are free to design your database tables, relationships, and structures as you believe best fits the RBAC system.

### 1. Authentication (Using Laravel Passport)
 - Implement user authentication with:
 - Registration
 - Login
 - Logout
 - Passport token protection for secured endpoints


### - 2. RBAC (Roles & Permissions) — Applied Only to User Management

You must implement a custom Role-Based Access Control system that restricts access to user-related actions.

### Your design should include:

- Roles
- Permissions
- Assigning permissions to roles
- Assigning roles to users
- Authorization checks (via middleware)

Your RBAC logic must control access to the User CRUD module.

### 3. User CRUD With Role + Permission Enforcement
Implement:
- Create User
- Retrieve Users (list + single)
- Update User
- Delete User

Design permissions for these actions as you see fit.
Only authorized users should be allowed to perform each action.

### 4. External API Integration
Create one endpoint:

GET /external/users

This endpoint must:
Call the public API:
https://jsonplaceholder.typicode.com/users
Retrieve and return the list of users
Follow the required response format
Handle errors gracefully

### 5. Response Format (Required for All Endpoints)
All responses must follow this structure:
{
  "success": true,
  "code": 200,
  "data": {},
  "message": "message"
}


Error format:
{
  "success": false,
  "code": 400,
  "data": {},
  "message": "error message"
}

📂 Deliverables
### 1. GitHub Repository Link (Required)
Must include:
Laravel source code
Migrations
Models
Controllers
Middleware
.env.example
README.md with setup and run instructions
