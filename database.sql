-- Create database
CREATE DATABASE IF NOT EXISTS aishatu_best_academy;

-- Use the database
USE aishatu_best_academy;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    class VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT 'default_student.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create teachers table
CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT 'default_teacher.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create management table
CREATE TABLE IF NOT EXISTS management (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT 'default_management.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create results table
CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    maths INT NOT NULL,
    english INT NOT NULL,
    science INT NOT NULL,
    social_studies INT NOT NULL,
    total INT AS (maths + english + science + social_studies) STORED,
    average DECIMAL(5,2) AS (total / 4) STORED,
    term ENUM('1st', '2nd', '3rd') NOT NULL,
    year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- Create fees table
CREATE TABLE IF NOT EXISTS fees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('Paid', 'Unpaid') DEFAULT 'Unpaid',
    term ENUM('1st', '2nd', '3rd') NOT NULL,
    year INT NOT NULL,
    paid_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);
