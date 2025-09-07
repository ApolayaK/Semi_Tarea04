-- ==============================
-- CREACIÓN DE LA BASE DE DATOS
-- ==============================
DROP DATABASE IF EXISTS biblioteca;
CREATE DATABASE biblioteca;
USE biblioteca;

-- ==============================
-- TABLAS DE UBICACIÓN
-- ==============================
CREATE TABLE departamentos(
    iddepartamento INT AUTO_INCREMENT PRIMARY KEY,
    departamento   VARCHAR(40) NOT NULL,
    CONSTRAINT uk_departamento_depa UNIQUE (departamento)
) ENGINE=INNODB;

CREATE TABLE provincias(
    idprovincia    INT AUTO_INCREMENT PRIMARY KEY,
    provincia      VARCHAR(40) NOT NULL,
    iddepartamento INT NOT NULL,
    CONSTRAINT fk_iddepartemento_prov FOREIGN KEY (iddepartamento) REFERENCES departamentos(iddepartamento),
    CONSTRAINT uk_provincia_prov UNIQUE (provincia)
) ENGINE=INNODB;

CREATE TABLE distritos(
    iddistrito  INT AUTO_INCREMENT PRIMARY KEY,
    distrito    VARCHAR(40) NOT NULL,
    idprovincia INT NOT NULL,
    CONSTRAINT fk_idprovincia_dist FOREIGN KEY (idprovincia) REFERENCES provincias(idprovincia),
    CONSTRAINT uk_distrito_provincia UNIQUE (distrito, idprovincia)
) ENGINE=INNODB;

-- ==============================
-- TABLAS PERSONAS Y LIBROS (INICIALES)
-- ==============================
CREATE TABLE libros(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    imagen VARCHAR(200) NOT NULL
) ENGINE=INNODB;

INSERT INTO libros (nombre, imagen) VALUES
('Conociendo el Perú', 'libro1.jpg'),
('Matemáticas avanzadas', 'libro2.jpg');

CREATE TABLE personas (
    idpersona  INT AUTO_INCREMENT PRIMARY KEY,
    dni        CHAR(8) NOT NULL,
    apellidos  VARCHAR(40) NOT NULL,
    nombres    VARCHAR(40) NOT NULL,
    telefono   CHAR(9) NULL,
    iddistrito INT NOT NULL,
    direccion  VARCHAR(100) NULL,
    CONSTRAINT uk_dni UNIQUE (dni),
    CONSTRAINT fk_iddistrito FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito)
) ENGINE=INNODB;

-- ==============================
-- NUEVAS TABLAS (MODELO)
-- ==============================

-- Categorías
CREATE TABLE categorias (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    categoria   VARCHAR(100) NOT NULL,
    CONSTRAINT uk_categoria UNIQUE (categoria)
) ENGINE=INNODB;

-- Subcategorías
CREATE TABLE subcategorias (
    idsubcategoria INT AUTO_INCREMENT PRIMARY KEY,
    subcategoria   VARCHAR(100) NOT NULL,
    idcategoria    INT NOT NULL,
    CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria),
    CONSTRAINT uk_subcategoria UNIQUE (subcategoria, idcategoria)
) ENGINE=INNODB;

-- Editoriales
CREATE TABLE editoriales (
    ideditorial   INT AUTO_INCREMENT PRIMARY KEY,
    editorial     VARCHAR(150) NOT NULL,
    nacionalidad  VARCHAR(100) NOT NULL,
    CONSTRAINT uk_editorial UNIQUE (editorial)
) ENGINE=INNODB;

-- Recursos
CREATE TABLE recursos (
    idrecurso      INT AUTO_INCREMENT PRIMARY KEY,
    idsubcategoria INT NOT NULL,
    ideditorial    INT NOT NULL,
    tipo           ENUM('FISICO','DIGITAL') NOT NULL,
    titulo         VARCHAR(200) NOT NULL,
    apublicacion   YEAR NOT NULL,
    isbn           VARCHAR(20) NULL,
    numpaginas     INT NULL,
    rutaportada    VARCHAR(200) NULL,
    rutarecurso    VARCHAR(200) NULL,
    estado         ENUM('BUENO','REGULAR','MALO') NOT NULL DEFAULT 'BUENO',
    creado         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado     TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_subcategoria FOREIGN KEY (idsubcategoria) REFERENCES subcategorias(idsubcategoria),
    CONSTRAINT fk_editorial FOREIGN KEY (ideditorial) REFERENCES editoriales(ideditorial)
) ENGINE=INNODB;

-- ==============================
-- DATOS INICIALES
-- ==============================

-- Categorías
INSERT INTO categorias (categoria) VALUES
('Matemáticas'),
('Comunicación'),
('Computación');

-- Subcategorías
-- Matemáticas
INSERT INTO subcategorias (subcategoria, idcategoria) VALUES
('Razonamiento Lógico Matemático', 1),
('Álgebra', 1),
('Trigonometría', 1);

-- Comunicación
INSERT INTO subcategorias (subcategoria, idcategoria) VALUES
('Razonamiento verbal', 2),
('Composición', 2),
('Redacción', 2);

-- Computación
INSERT INTO subcategorias (subcategoria, idcategoria) VALUES
('Base de datos', 3),
('Sistemas operativos', 3),
('Lenguajes de programación', 3);

-- Editoriales
INSERT INTO editoriales (editorial, nacionalidad) VALUES
('Pearson', 'USA'),
('Santillana', 'España'),
('McGraw-Hill', 'México');

-- ==============================
-- VISTAS
-- ==============================

-- Vista: Listar recursos
CREATE OR REPLACE VIEW v_listar_recursos AS
SELECT 
    r.idrecurso,
    r.titulo,
    r.tipo,
    r.apublicacion,
    r.isbn,
    r.numpaginas,
    r.estado,
    e.editorial,
    e.nacionalidad,
    c.categoria,
    s.subcategoria,
    r.rutaportada,
    r.rutarecurso,
    r.creado,
    r.modificado
FROM recursos r
INNER JOIN editoriales e ON r.ideditorial = e.ideditorial
INNER JOIN subcategorias s ON r.idsubcategoria = s.idsubcategoria
INNER JOIN categorias c ON s.idcategoria = c.idcategoria;
