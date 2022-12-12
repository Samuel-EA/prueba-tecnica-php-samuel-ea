USE test;

CREATE DATABASE docfav;

CREATE TABLE user(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    lastname varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(150) NOT NULL,
    PRIMARY KEY (id)
);
