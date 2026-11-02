# Student Productivity App

A single-page web application designed for students to track tasks, courses, notes, and daily study habits.

## Entities & Relationships
1. **Users** (1:N with Courses, Tasks, Notes, Habits) - Stores student and admin credentials.
2. **Courses** (1:N with Tasks, Notes) - Academic subjects/classes.
3. **Tasks** (N:1 with Users & Courses) - Assignments, exams, and homework with deadlines and status.
4. **Notes** (N:1 with Users & Courses) - Lecture notes and revision materials.
5. **Habits** (N:1 with Users) - Daily study habits and target hours.

## Roles & Test Accounts
- **Admin:** `admin@ibu.edu.ba` / `admin123`
- **Student:** `student@ibu.edu.ba` / `student123`

## External API Integration Plan
OpenWeatherMap API / Quote API integrated into the Dashboard to display weather conditions or daily motivation quotes for study planning.

## Local Setup Instructions
1. Clone the repository:
   ```bash
   git clone <repository_url>