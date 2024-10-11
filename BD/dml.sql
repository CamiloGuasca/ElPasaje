/*
--------------------------------------------------------
-------------------- Tabla Proveedor -------------------
--------------------------------------------------------*/
INSERT INTO Proveedor (idProveedor, nombre, apellido, correo, clave) 
VALUES (1, 'Carlos', 'Gómez', 'carlosgomez@correo.com', 'clave123');

INSERT INTO Proveedor (idProveedor, nombre, apellido, correo, clave) 
VALUES (2, 'Ana', 'Martínez', 'anamartinez@correo.com', 'pass456');

INSERT INTO Proveedor (idProveedor, nombre, apellido, correo, clave) 
VALUES (3, 'Luis', 'Fernández', 'luisf@correo.com', 'qwerty789');

INSERT INTO Proveedor (idProveedor, nombre, apellido, correo, clave) 
VALUES (4, 'María', 'Pérez', 'mariaperez@correo.com', 'contraseña');

INSERT INTO Proveedor (idProveedor, nombre, apellido, correo, clave) 
VALUES (5, 'José', 'Ruiz', 'joseruiz@correo.com', 'clave2024');

/*
--------------------------------------------------------
-------------------- Tabla Cliente ---------------------
--------------------------------------------------------*/
INSERT INTO Cliente (idCliente, nombre, apellido, correo, clave) 
VALUES (1, 'Julia', 'López', 'julialopez@correo.com', 'abc123');

INSERT INTO Cliente (idCliente, nombre, apellido, correo, clave) 
VALUES (2, 'Miguel', 'Sánchez', 'miguels@correo.com', 'mypass');

INSERT INTO Cliente (idCliente, nombre, apellido, correo, clave) 
VALUES (3, 'Laura', 'Ramírez', 'lauraramirez@correo.com', 'pass321');

INSERT INTO Cliente (idCliente, nombre, apellido, correo, clave) 
VALUES (4, 'Pedro', 'Morales', 'pedrom@correo.com', 'xyz456');

INSERT INTO Cliente (idCliente, nombre, apellido, correo, clave) 
VALUES (5, 'Sofía', 'Torres', 'sofiatorres@correo.com', 'clave789');

/*
--------------------------------------------------------
-------------------- Tabla Evento ----------------------
--------------------------------------------------------*/
INSERT INTO Evento (idEvento, nombre, fecha, aforo, descripcion, Proveedor_idProveedor) 
VALUES (1, 'Concierto Rock', '2024-11-01', 500, 'Concierto de rock en vivo', 1);

INSERT INTO Evento (idEvento, nombre, fecha, aforo, descripcion, Proveedor_idProveedor) 
VALUES (2, 'Feria de Libros', '2024-11-15', 300, 'Venta y exposición de libros', 2);

INSERT INTO Evento (idEvento, nombre, fecha, aforo, descripcion, Proveedor_idProveedor) 
VALUES (3, 'Torneo de Ajedrez', '2024-12-05', 100, 'Competencia internacional de ajedrez', 3);

INSERT INTO Evento (idEvento, nombre, fecha, aforo, descripcion, Proveedor_idProveedor) 
VALUES (4, 'Cine al Aire Libre', '2024-10-20', 200, 'Proyección de películas', 4);

INSERT INTO Evento (idEvento, nombre, fecha, aforo, descripcion, Proveedor_idProveedor) 
VALUES (5, 'Festival Gastronómico', '2024-12-20', 400, 'Feria de comida gourmet', 5);

/*
--------------------------------------------------------
--------------------- Tabla Boleta ---------------------
--------------------------------------------------------*/
INSERT INTO Boleta (idBoleta, tipo, precio, cantidad, Evento_idEvento) 
VALUES (1, 'VIP', 150.00, 50, 1);

INSERT INTO Boleta (idBoleta, tipo, precio, cantidad, Evento_idEvento) 
VALUES (2, 'General', 80.00, 200, 1);

INSERT INTO Boleta (idBoleta, tipo, precio, cantidad, Evento_idEvento) 
VALUES (3, 'Entrada General', 20.00, 150, 2);

INSERT INTO Boleta (idBoleta, tipo, precio, cantidad, Evento_idEvento) 
VALUES (4, 'Premium', 100.00, 75, 3);

INSERT INTO Boleta (idBoleta, tipo, precio, cantidad, Evento_idEvento) 
VALUES (5, 'General', 50.00, 120, 4);

/*
--------------------------------------------------------
------------------ Tabla FacturaVenta ------------------
--------------------------------------------------------*/
INSERT INTO FacturaVenta (idFacturaVenta, fecha, total, Cliente_idCliente) 
VALUES (1, '2024-10-01 14:30:00', '120.00', 1);

INSERT INTO FacturaVenta (idFacturaVenta, fecha, total, Cliente_idCliente) 
VALUES (2, '2024-10-02 15:00:00', '80.00', 2);

INSERT INTO FacturaVenta (idFacturaVenta, fecha, total, Cliente_idCliente) 
VALUES (3, '2024-10-03 16:15:00', '150.00', 3);

INSERT INTO FacturaVenta (idFacturaVenta, fecha, total, Cliente_idCliente) 
VALUES (4, '2024-10-04 17:45:00', '50.00', 4);

INSERT INTO FacturaVenta (idFacturaVenta, fecha, total, Cliente_idCliente) 
VALUES (5, '2024-10-05 18:20:00', '200.00', 5);

/*
--------------------------------------------------------
---------------- Tabla DetFacturaVenta -----------------
--------------------------------------------------------*/
INSERT INTO DetFacturaVenta (idDetFacturaVenta, Boleta_idBoleta, FacturaVenta_idFacturaVenta) 
VALUES (1, 1, 1);

INSERT INTO DetFacturaVenta (idDetFacturaVenta, Boleta_idBoleta, FacturaVenta_idFacturaVenta) 
VALUES (2, 2, 2);

INSERT INTO DetFacturaVenta (idDetFacturaVenta, Boleta_idBoleta, FacturaVenta_idFacturaVenta) 
VALUES (3, 3, 3);

INSERT INTO DetFacturaVenta (idDetFacturaVenta, Boleta_idBoleta, FacturaVenta_idFacturaVenta) 
VALUES (4, 4, 4);

INSERT INTO DetFacturaVenta (idDetFacturaVenta, Boleta_idBoleta, FacturaVenta_idFacturaVenta) 
VALUES (5, 5, 5);
