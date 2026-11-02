DROP DATABASE IF EXISTS student_productivity;
CREATE DATABASE student_productivity CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_productivity;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    code VARCHAR(20) NOT NULL,
    color VARCHAR(10) DEFAULT '#0d6efd',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    due_date DATE,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE SET NULL
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT,
    title VARCHAR(150) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE SET NULL
);

CREATE TABLE habits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    target_hours INT NOT NULL DEFAULT 1,
    completed_hours INT NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (full_name, email, password, role) VALUES 
('Admin User', 'admin@ibu.edu.ba', '$2y$10$w92yEAnvS6j3K8hN/3G5oOq4qP5a0R8f9K0b2c3d4e5f6g7h8i9j', 'admin'),
('Student User', 'student@ibu.edu.ba', '$2y$10$w92yEAnvS6j3K8hN/3G5oOq4qP5a0R8f9K0b2c3d4e5f6g7h8i9j', 'student');

INSERT INTO courses (user_id, title, code, color) VALUES 
(2, 'Web Programming', 'CS304', '#0d6efd'),
(2, 'Database Systems', 'CS202', '#198754');

INSERT INTO tasks (user_id, course_id, title, description, due_date, status, priority) VALUES 
(2, 1, 'Submit Milestone 1 and 2', 'Finish project structure and DAO layer.', '2026-11-02', 'in_progress', 'high'),
(2, 2, 'Prepare ERD Diagram', 'Draw ERD using dbdiagram.io', '2026-11-01', 'completed', 'medium');

INSERT INTO notes (user_id, course_id, title, content) VALUES 
(2, 1, 'FlightPHP Architecture', 'Routes call Services, Services call DAOs, DAOs query Database via PDO.'),
(2, 2, 'Normal Forms', '1NF, 2NF, 3NF normalization rules summary.');

INSERT INTO habits (user_id, title, target_hours, completed_hours) VALUES 
(2, 'Daily Coding Practice', 2, 1),
(2, 'Reading Documentation', 1, 0);