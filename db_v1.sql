CREATE DATABASE beauty CHARACTER SET utf8 COLLATE utf8_general_ci;

use beauty;

create table roles (
  id INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO roles (rol) VALUES ('admin');
INSERT INTO roles (rol) VALUES ('usuario');
INSERT INTO roles (rol) VALUES ('usuariop');


CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `num_documento` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre_comercial` varchar(50) NOT NULL,
  `id_profesion` int(11) DEFAULT NULL,
  `id_zona_trabajo` int(11) DEFAULT NULL,
  `modalidad` varchar(50) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `piso` varchar(10) DEFAULT NULL,
  `depto` varchar(10) DEFAULT NULL,
  `barrio` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


create table profesiones (
  id INT NOT NULL AUTO_INCREMENT,
  profesion VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO profesiones (profesion) VALUES ('Peluquería'), ('Manicuría'), ('Barbería'), ('Pies'), ('Masajes'), ('Tratamiento Corporal');


