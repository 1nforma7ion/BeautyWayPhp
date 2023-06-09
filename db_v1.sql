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


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `num_documento` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre_comercial` varchar(150),
  `id_profesion` int(11) ,
  `id_zona_trabajo` int(11) ,
  `modalidad` varchar(50) ,
  `calle` varchar(50) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `piso` varchar(10) ,
  `depto` varchar(10) ,
  `barrio` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenia` varchar(150) NOT NULL,
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

create table zonas (
  id INT NOT NULL AUTO_INCREMENT,
  zona VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO zonas (zona) VALUES ('Zona Norte'), ('Zona Sur'), ('Zona Este'), ('Zona Oeste'), ('Zona centro'), ('Zona Nueva CBA');

create table localidades (
  id INT NOT NULL AUTO_INCREMENT,
  localidad VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;
INSERT INTO localidades (localidad) VALUES ('Córboda');

create table modalidades (
  id INT NOT NULL AUTO_INCREMENT,
  modalidad VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;
INSERT INTO modalidades (modalidad) VALUES ('Domicilio'), ('En Salón');

create table tipo_docs (
  id INT NOT NULL AUTO_INCREMENT,
  value VARCHAR(50) NOT NULL,
  tipo_doc VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;
INSERT INTO tipo_docs (value,tipo_doc) VALUES ('documentoUnico','Documento único'), ('pasaporte','Pasaporte');

create table usuarios_token (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL,
  token VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;


