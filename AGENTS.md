# AGENTS.md - Project Context and Coding Guidelines

## Project Overview
Student Productivity App is a Single Page Application (SPA) designed to help students organize courses, track tasks, write notes, and build study habits.

## Tech Stack
- Frontend: HTML5, CSS3, JavaScript (Vanilla AJAX / jQuery / Single Page Routing), Bootstrap 5.
- Backend: PHP 8.x, FlightPHP REST Framework, PDO for database connection.
- Database: MySQL relational database with 5 interconnected entities.
- Security: JWT tokens for authentication/authorization, password hashing with bcrypt.

## Architecture Guidelines
- Strict separation of concern: Pure PHP REST API in backend, pure HTML/CSS/JS in frontend.
- Database access MUST be handled exclusively via the DAO layer using PDO Prepared Statements.
- Direct database calls outside DAO classes are strictly forbidden.
- Services encapsulate business logic and act as an intermediary between Routes and DAOs.

## Folder Structure Rules
- `backend/dao/`: Class-based Data Access Objects inheriting from `BaseDao.php`.
- `backend/services/`: Application logic layer.
- `backend/routes/`: FlightPHP REST route endpoints.
- `backend/middleware/`: Authentication, authorization, and logging middlewares.
- `frontend/views/`: Dynamic SPA content views (HTML templates).
- `frontend/js/app.js`: Client-side routing and AJAX communication logic.