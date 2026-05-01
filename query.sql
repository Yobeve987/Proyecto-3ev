CREATE DATABASE proyecto;
USE proyecto;
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY, --
    tipoProd ENUM('electronica', 'textil') NOT NULL, --
    nombre VARCHAR(100), --
    precio DECIMAL(10,2), --
    stock INT), --
    marca VARCHAR (50), --
    modelo VARCHAR(50) NULL, --
    garantia VARCHAR(5), --
    talla VARCHAR(30), --
    material VARCHAR(30), --
    genero VARCHAR(30),
    descripcion VARCHAR(200) --
);  