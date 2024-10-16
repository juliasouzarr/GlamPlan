DROP DATABASE IF EXISTS glamplan;
CREATE DATABASE glamplan;
USE glamplan;

CREATE TABLE client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    user VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    birth DATE,
    address VARCHAR(255),
    district VARCHAR(100)
);

CREATE TABLE professional (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    user VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(15),
    expertise VARCHAR(100),
    favorite boolean default 0
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    duration VARCHAR(100) DEFAULT NULL,
    value DECIMAL(10, 2) NOT NULL,
    professional_id INT NOT NULL,
    FOREIGN KEY (professional_id) REFERENCES professional(id) ON DELETE CASCADE
);

CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(100) NOT NULL,
    user_type ENUM('client', 'professional') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professional_id int not null,
    service_id INT,
    date DATE NOT NULL,
    time TIME NOT NULL,
    avaliable BOOLEAN DEFAULT 1,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (professional_id) REFERENCES professional(id) ON DELETE CASCADE
);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT NOT NULL,
    client_id INT NOT NULL,
    client_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (schedule_id) REFERENCES schedules(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE
);

CREATE TABLE favorites (
    client_id INT NOT NULL,
    professional_id INT NOT NULL,
    service_id INT NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE,
    FOREIGN KEY (professional_id) REFERENCES professional(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);




