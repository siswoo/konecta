DROP DATABASE IF EXISTS konecta;
CREATE DATABASE konecta;
USE konecta;

DROP TABLE IF EXISTS productos;
CREATE TABLE productos (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	referencia VARCHAR(250) NOT NULL,
	precio INT NOT NULL,
	peso INT NOT NULL,
	categoria VARCHAR(250) NOT NULL,
	stock INT NOT NULL,
	fecha_creacion DATE NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE productos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO productos (nombre,referencia,precio,peso,categoria,stock,fecha_creacion) VALUES 
('Monitor','A1',200000,10,'Monitores',10,'2022-10-18'),
('Teclado','A2',20000,2,'Accesorios Pc',20,'2022-10-18'),
('Mouse','A3',10000,1,'Accesorios Pc',30,'2022-10-18');

DROP TABLE IF EXISTS ventas;
CREATE TABLE ventas (
	id INT AUTO_INCREMENT,
	id_productos INT NOT NULL,
	cantidad INT NOT NULL,
	coste INT NOT NULL,
	fecha_creacion DATE NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE ventas CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
