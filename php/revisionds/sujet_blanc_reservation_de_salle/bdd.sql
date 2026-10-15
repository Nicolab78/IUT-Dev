CREATE DATABASE IF NOT EXISTS campus;
USE campus;
CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, login VARCHAR(50) NOT NULL UNIQUE, password CHAR(32) NOT NULL);
CREATE TABLE salles (id INT AUTO_INCREMENT PRIMARY KEY, nom VARCHAR(50) NOT NULL, capacite INT NOT NULL, etage INT NOT NULL);
INSERT INTO users (login, password) VALUES ('admin', MD5('admin'));
INSERT INTO salles (nom, capacite, etage) VALUES ('A101', 30, 1), ('B204', 60, 2), ('Amphi', 250, 0);