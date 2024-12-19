CREATE DATABASE IF NOT EXISTS my_database;

USE my_database;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    password VARCHAR(100)
);

INSERT INTO users (name, password) VALUES ('user1', 'password1');
INSERT INTO users (name, password) VALUES ('user2', 'password2');
INSERT INTO users (name, password) VALUES ('user3', 'password3');
