
DROP DATABASE IF EXISTS lamp_project;
CREATE DATABASE lamp_project CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE lamp_project;

DROP USER IF EXISTS 'lamp_user'@'localhost';
CREATE USER 'lamp_user'@'localhost' IDENTIFIED BY 'lamp1234';
GRANT SELECT, INSERT, UPDATE, DELETE ON lamp_project.* TO 'lamp_user'@'localhost';
FLUSH PRIVILEGES;


CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    email      VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username, password, email) VALUES
('admin',    '$2y$12$g6CuKz1RE9O7OUudV68Ig.tNg0lB9sIgnJamIy8V2FXIMFevo1K9K', 'admin@test.com'),
('usuario1', '$2y$12$g6CuKz1RE9O7OUudV68Ig.tNg0lB9sIgnJamIy8V2FXIMFevo1K9K', 'user1@test.com'),
('usuario2', '$2y$12$g6CuKz1RE9O7OUudV68Ig.tNg0lB9sIgnJamIy8V2FXIMFevo1K9K', 'user2@test.com');


SELECT id, username, email, created_at FROM users;
