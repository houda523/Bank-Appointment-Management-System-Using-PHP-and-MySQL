CREATE DATABASE IF NOT EXISTS bank_appointments_demo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bank_appointments_demo;
CREATE TABLE IF NOT EXISTS appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(120) NOT NULL,
  customer_email VARCHAR(190) NOT NULL,
  appointment_date DATETIME NOT NULL,
  purpose VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
