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
    date DATE,
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

DELIMITER $$

CREATE EVENT IF NOT EXISTS generate_daily_schedules
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_DATE + INTERVAL 1 DAY
DO
BEGIN
    DECLARE start_time TIME DEFAULT '08:00:00';
    DECLARE end_time TIME DEFAULT '20:00:00';
    DECLARE interval_minutes INT DEFAULT 60;
    DECLARE current_time TIME;
    DECLARE professional_id INT;

    DECLARE professional_cursor CURSOR FOR SELECT id FROM professional;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    SET done = FALSE;
    SET current_time = start_time;

    -- Cursor para iterar por todos os profissionais
    OPEN professional_cursor;

    fetch_loop: LOOP
        FETCH professional_cursor INTO professional_id;
        IF done THEN
            LEAVE fetch_loop;
        END IF;

        WHILE current_time < end_time DO
            INSERT INTO schedules (professional_id, date, time, avaliable, service_id)
            VALUES (professional_id, CURRENT_DATE, current_time, 1, NULL);
            SET current_time = ADDTIME(current_time, MAKETIME(interval_minutes, 0, 0));
        END WHILE;

        -- Resetar horário para o próximo profissional
        SET current_time = start_time;
    END LOOP;

    CLOSE professional_cursor;
END $$

DELIMITER ;



