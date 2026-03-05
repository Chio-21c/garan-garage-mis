CREATE DATABASE garan_garage;
USE garan_garage;

-- Users for login
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Admin','Staff','Captain') DEFAULT 'Staff'
);

-- Owners
CREATE TABLE owners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    address VARCHAR(200)
);

-- Vehicles linked to owners
CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner_id INT NOT NULL,
    vehicle_model VARCHAR(100) NOT NULL,
    license_plate VARCHAR(50) UNIQUE NOT NULL,
    service_date DATE NOT NULL,
    status ENUM('Pending','In Service','Completed') DEFAULT 'Pending',
    FOREIGN KEY (owner_id) REFERENCES owners(id)
);

-- Staff
CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role ENUM('Mechanic','Supervisor','Receptionist','Cleaner','Manager') NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100)
);

-- Job Cards
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    staff_id INT NOT NULL,
    job_description TEXT NOT NULL,
    job_date DATE NOT NULL,
    status ENUM('Assigned','In Progress','Completed') DEFAULT 'Assigned',
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
    FOREIGN KEY (staff_id) REFERENCES staff(id)
);
