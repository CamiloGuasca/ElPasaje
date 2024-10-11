CREATE DATABASE elpaseje;
USE elpajase;
/*
--------------------------------------------------------
-------------------- Tabla Proveedor -------------------
--------------------------------------------------------*/
CREATE TABLE Proveedor (
  idProveedor INT NOT NULL PRIMARY KEY,
  nombre VARCHAR(45) NULL,
  apellido VARCHAR(45) NULL,
  correo VARCHAR(45) NULL,
  clave VARCHAR(45) NULL
);

/*
--------------------------------------------------------
-------------------- Tabla Cliente ---------------------
--------------------------------------------------------*/
CREATE TABLE Cliente (
  idCliente INT NOT NULL PRIMARY KEY,
  nombre VARCHAR(45) NULL,
  apellido VARCHAR(45) NULL,
  correo VARCHAR(45) NULL,
  clave VARCHAR(45) NULL
);

/*
--------------------------------------------------------
-------------------- Tabla Evento ----------------------
--------------------------------------------------------*/
CREATE TABLE Evento (
  idEvento INT NOT NULL PRIMARY KEY,
  nombre VARCHAR(45) NULL,
  fecha VARCHAR(45) NULL,
  aforo INT NULL,
  descripcion VARCHAR(45) NULL,
  Proveedor_idProveedor INT NOT NULL
);

/*
--------------------------------------------------------
--------------------- Tabla Boleta ---------------------
--------------------------------------------------------*/
CREATE TABLE Boleta (
  idBoleta INT NOT NULL PRIMARY KEY,
  tipo VARCHAR(45) NULL,
  precio DOUBLE NULL,
  cantidad INT NULL,
  Evento_idEvento INT NOT NULL
);

/*
--------------------------------------------------------
------------------ Tabla FacturaVenta ------------------
--------------------------------------------------------*/
CREATE TABLE FacturaVenta (
  idFacturaVenta INT NOT NULL PRIMARY KEY,
  fecha DATETIME NULL,
  total VARCHAR(45) NULL,
  Cliente_idCliente INT NOT NULL
);

/*
--------------------------------------------------------
---------------- Tabla DetFacturaVenta -----------------
--------------------------------------------------------*/
CREATE TABLE DetFacturaVenta (
  idDetFacturaVenta INT NOT NULL PRIMARY KEY,
  Boleta_idBoleta INT NOT NULL,
  FacturaVenta_idFacturaVenta INT NOT NULL
);

/*
--------------------------------------------------------
-------------------- Llaves Foraneas -------------------
--------------------------------------------------------*/

ALTER TABLE Evento 
ADD CONSTRAINT fk_proveedor
FOREIGN KEY (Proveedor_idProveedor) REFERENCES Proveedor (idProveedor);

ALTER TABLE Boleta
ADD CONSTRAINT fk_evento
FOREIGN KEY (Evento_idEvento) REFERENCES Evento (idEvento);

ALTER TABLE DetFacturaVenta
ADD CONSTRAINT fk_Boleta
FOREIGN KEY (Boleta_idBoleta) REFERENCES Boleta (idBoleta);

ALTER TABLE DetFacturaVenta
ADD CONSTRAINT fk_facturaventa
FOREIGN KEY (FacturaVenta_idFacturaVenta) REFERENCES FacturaVenta (idFacturaVenta);

ALTER TABLE FacturaVenta
ADD CONSTRAINT fk_cliente
FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente (idCliente);