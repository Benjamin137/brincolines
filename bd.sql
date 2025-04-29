-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS brincolines;
USE brincolines;

-- Tabla BRINCOLINES
CREATE TABLE BRINCOLINES (
    id_brincolin INT AUTO_INCREMENT PRIMARY KEY,
    color_brincolin VARCHAR(80) NOT NULL,
    nombre_brincolin VARCHAR(150) NOT NULL
);

-- Tabla CLIENTES
CREATE TABLE CLIENTES (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombreCompleto_cliente VARCHAR(200) NOT NULL,
    telefono_cliente VARCHAR(12) NOT NULL
);

-- Tabla LUGARES
CREATE TABLE LUGARES (
    id_lugar INT AUTO_INCREMENT PRIMARY KEY,
    direccion_lugar VARCHAR(200) NOT NULL
);

-- Tabla TIPOS_EVENTOS
CREATE TABLE TIPOS_EVENTOS (
    id_tipoEvento INT AUTO_INCREMENT PRIMARY KEY,
    descripcion_tipoEvento VARCHAR(500) NOT NULL
);

-- Tabla EVENTOS
CREATE TABLE EVENTOS (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    folio_evento VARCHAR(50) NOT NULL,
    fecha_inicio_evento DATETIME NOT NULL,
    fecha_fin_evento DATETIME NOT NULL,
    idBrincolin_evento INT NOT NULL,
    idCliente_evento INT NOT NULL,
    idLugar_evento INT NOT NULL,
    idTipoEvento_evento INT NOT NULL,
    FOREIGN KEY (idBrincolin_evento) REFERENCES BRINCOLINES(id_brincolin),
    FOREIGN KEY (idCliente_evento) REFERENCES CLIENTES(id_cliente),
    FOREIGN KEY (idLugar_evento) REFERENCES LUGARES(id_lugar),
    FOREIGN KEY (idTipoEvento_evento) REFERENCES TIPOS_EVENTOS(id_tipoEvento)
);

-- Tabla FOTOS
CREATE TABLE FOTOS (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    url_foto VARCHAR(255) NOT NULL,
    idBrincolin_foto INT NOT NULL,
    FOREIGN KEY (idBrincolin_foto) REFERENCES BRINCOLINES(id_brincolin)
);

-- Tabla PAGOS
CREATE TABLE PAGOS (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    metodo_pago VARCHAR(60) NOT NULL,
    montoTotal_pago FLOAT NOT NULL,
    fecha_pago DATETIME NOT NULL,
    idEvento_pago INT NOT NULL,
    FOREIGN KEY (idEvento_pago) REFERENCES EVENTOS(id_evento)
);