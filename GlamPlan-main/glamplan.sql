
CREATE DATABASE glamplan;
USE glamplan;
CREATE TABLE client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
	user VARCHAR(50) NOT NULL ,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL ,
    phone VARCHAR(15),
    birth DATE,
    address VARCHAR(255),
    district VARCHAR(100)
);
select*from client;
CREATE TABLE professional (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    user VARCHAR(50) NOT NULL ,
    password VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL ,
    email VARCHAR(100),
    phone VARCHAR(15),
    expertise VARCHAR(100)
);
CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    duration VARCHAR(50),
    value DECIMAL(10, 2) NOT NULL
);
CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(100) NOT NULL,
    user_type ENUM('client', 'professional') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


select * from professional;
select * from client;
