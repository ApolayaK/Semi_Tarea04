CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE libros(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
	nombre 		VARCHAR(200) 	NOT NULL,
	imagen		VARCHAR(200)	NOT NULL
)ENGINE = INNODB;

INSERT INTO libros (nombre, imagen) VALUES
	('Conociendo el Perú', 'libro1.jpg'),
	('Matemáticas avanzadas', 'libro2.jpg');

CREATE TABLE personas (
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
    dni				CHAR(8) NOT NULL,
    apellidos 		VARCHAR(40) NOT NULL,
    nombres			VARCHAR(40) NOT NULL,
    telefono		CHAR(9) 	NULL,
    iddistrito		INT 		NOT NULL,
    direccion		VARCHAR(100) NULL,
    CONSTRAINT uk_dni UNIQUE (dni),
    CONSTRAINT fk_iddistrito FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito)
)ENGINE = INNODB;

-- Agregar 2 personas