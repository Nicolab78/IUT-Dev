CREATE DATABASE student;
USE student;

CREATE TABLE users (
    login VARCHAR(50) PRIMARY KEY,
    password VARCHAR(50) NOT NULL
);

INSERT INTO users (login, password) VALUES
                                        ('admin', MD5('admin')),
                                        ('test',  MD5('test'));