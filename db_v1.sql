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
  `estado` varchar(30) NOT NULL,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




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



create table profesiones (
  id INT NOT NULL AUTO_INCREMENT,
  profesion VARCHAR(50) NOT NULL,
  estado INT NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

INSERT INTO profesiones (profesion) VALUES ('Peluquería'), ('Manicuría'), ('Barbería'), ('Pies'), ('Tratamiento Corporal'), ('Depilación');

CREATE TABLE servicios (
  id INT NOT NULL AUTO_INCREMENT,
  id_profesion INT NOT NULL,
  servicio VARCHAR(150) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_id_profesion
  FOREIGN KEY (id_profesion)
  REFERENCES profesiones (id)
)ENGINE=INNODB;


CREATE TABLE publicaciones (
  id INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  descripcion VARCHAR(255),
  imagen VARCHAR(255),
  zona VARCHAR(40),
  estado VARCHAR(20),
  me_gusta INT NOT NULL,
  comentarios INT NOT NULL,
  descuento DECIMAL(5,2),
  vigencia_dias INT NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_id_usuario
  FOREIGN KEY (id_usuario)
  REFERENCES usuarios (id)
)ENGINE=INNODB;

CREATE TABLE comentarios (
  id INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  id_publicacion INT NOT NULL,
  comentario VARCHAR(40) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_coment_usuario
  FOREIGN KEY (id_usuario)
  REFERENCES usuarios (id),
  CONSTRAINT fk_coment_pub
  FOREIGN KEY (id_publicacion)
  REFERENCES  publicaciones (id)
)ENGINE=INNODB;

CREATE TABLE perfiles (
  id INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  imagen_usuario VARCHAR(255),
  imagen_comercial VARCHAR(255),
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_perfil_usuario
  FOREIGN KEY (id_usuario)
  REFERENCES usuarios (id)
)ENGINE=INNODB;


CREATE TABLE reservas (
  id INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  id_profesional INT NOT NULL,
  id_publicacion INT NOT NULL,
  servicio VARCHAR(200) NOT NULL,
  estado VARCHAR(40) NOT NULL,
  motivo VARCHAR(200) NOT NULL,
  fecha DATETIME,
  hora DATETIME,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_reserva_usuario
  FOREIGN KEY (id_usuario)
  REFERENCES usuarios (id),
  CONSTRAINT fk_reserva_profesional
  FOREIGN KEY (id_usuario)
  REFERENCES usuarios (id),
  CONSTRAINT fk_reserva_public
  FOREIGN KEY (id_publicacion)
  REFERENCES publicaciones (id)
)ENGINE=INNODB;


CREATE TABLE sidebar (
  id INT NOT NULL AUTO_INCREMENT,
  user_rol_id INT NOT NULL,
  menu_item_url VARCHAR(250) NOT NULL,
  menu_item_text VARCHAR(150) NOT NULL,
  menu_item_icon VARCHAR(40) NOT NULL,
  menu_item_status VARCHAR(50) NOT NULL,
  menu_item_order INT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_rol_id_sidebar
  FOREIGN KEY (user_rol_id)
  REFERENCES roles (id)
)ENGINE=INNODB;




CREATE TABLE reservas_estados (
  id INT NOT NULL AUTO_INCREMENT,
  estado VARCHAR(40) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;


CREATE TABLE reservas_motivos (
  id INT NOT NULL AUTO_INCREMENT,
  motivo VARCHAR(200) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;



INSERT INTO reservas_estados (estado) VALUES ('pendiente'), ('confirmado'), ('cancelado'), ('finalizado');
INSERT INTO reservas_motivos (motivo) VALUES ('Motivos personales'), ('Horario no disponible'), ('No laborable');