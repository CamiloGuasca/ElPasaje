-- Insertar datos en Proveedores
INSERT INTO `Proveedores` (`nombreProv`, `naciProv`, `correoProv`, `claveProv`, `cedulaProv`)
VALUES 
('Proveedor1', '1980-05-15', 'prov1@example.com', 'clave123', 12345678),
('Proveedor2', '1975-03-22', 'prov2@example.com', 'clave456', 87654321),
('Proveedor3', '1990-09-10', 'prov3@example.com', 'clave789', 11223344),
('Proveedor4', '1985-12-05', 'prov4@example.com', 'clave101', 55667788),
('Proveedor5', '1992-07-14', 'prov5@example.com', 'clave202', 99887766);

-- Insertar datos en Clientes
INSERT INTO `Clientes` (`nombreCli`, `naciCli`, `correoCli`, `claveCli`, `cedulaCli`)
VALUES
('Cliente1', '1990-07-10', 'cli1@example.com', 'password1', '1234567890'),
('Cliente2', '1988-11-25', 'cli2@example.com', 'password2', '0987654321'),
('Cliente3', '1995-04-18', 'cli3@example.com', 'password3', '1122334455'),
('Cliente4', '1982-09-30', 'cli4@example.com', 'password4', '6677889900'),
('Cliente5', '1998-01-12', 'cli5@example.com', 'password5', '5544332211');

-- Insertar datos en Ciudades
INSERT INTO `Ciudades` (`NombreCiu`)
VALUES 
('Bogotá'),
('Medellín'),
('Cali'),
('Barranquilla'),
('Cartagena');

-- Insertar datos en Lugares
INSERT INTO `Lugares` (`capacidadLug`, `direccionLug`, `nombreLug`, `Ciudades_idCiudades`)
VALUES
(500, 'Av. Principal 123', 'Estadio Central', 1),
(300, 'Calle Secundaria 45', 'Auditorio Regional', 2),
(700, 'Carrera 10 No 25', 'Coliseo Moderno', 3),
(200, 'Calle 50', 'Centro de Convenciones', 4),
(600, 'Avenida 30', 'Parque Cultural', 5);

-- Insertar datos en Eventos
INSERT INTO `Eventos` (`nombreEve`, `fechIniEve`, `fechFinEve`, `precioEve`, `Lugares_idLug`)
VALUES
('Concierto Rock', '2024-12-10', '2024-12-10', 100000, 1),
('Feria de Emprendimiento', '2025-01-15', '2025-01-20', 50000, 2),
('Festival de Jazz', '2025-02-05', '2025-02-08', 80000, 3),
('Taller de Arte', '2025-03-12', '2025-03-13', 20000, 4),
('Congreso de Tecnología', '2025-04-20', '2025-04-22', 150000, 5);

-- Insertar datos en TipoBoleta
INSERT INTO `TipoBoleta` (`nombreTB`, `porcentajeTB`, `Proveedores_idProv`)
VALUES
('General', '10%', 1),
('VIP', '25%', 2),
('Platino', '50%', 3),
('Estudiante', '5%', 4),
('Familiar', '15%', 5);

-- Insertar datos en DetalleEvento
INSERT INTO `DetalleEvento` (`idProv`, `idEve`, `idTB`, `cantidadDE`)
VALUES
(1, 1, 1, 200),
(2, 2, 2, 100),
(3, 3, 3, 50),
(4, 4, 4, 300),
(5, 5, 5, 150);

-- Insertar datos en FacturaVenta
INSERT INTO `FacturaVenta` (`fechaFV`, `horaFV`, `idEve`, `idCli`)
VALUES
('2024-11-28', '14:00:00', 1, 1),
('2024-11-28', '15:30:00', 2, 2),
('2024-11-29', '16:45:00', 3, 3),
('2024-12-01', '10:15:00', 4, 4),
('2024-12-02', '13:30:00', 5, 5);

-- Insertar datos en DetalleFacturaVenta
INSERT INTO `DetalleFacturaVenta` (`idFacturaVenta`, `idTB`, `cantidadDFV`)
VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- Insertar datos en CarritoCompra
INSERT INTO `CarritoCompra` (`Clientes_idCli`, `TipoBoleta_idTB`, `idEve`)
VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- Insertar datos en Administradores
INSERT INTO `Administradores` (`idAdministradores`, `nombreAdm`, `naciAdm`, `correoAdm`, `claveAdm`, `cedulaAdm`)
VALUES
(1, 'Admin1', '1985-02-20', 'admin1@example.com', 'adminpass1', 123123123),
(2, 'Admin2', '1983-06-15', 'admin2@example.com', 'adminpass2', 321321321),
(3, 'Admin3', '1990-01-10', 'admin3@example.com', 'adminpass3', 456456456),
(4, 'Admin4', '1995-09-30', 'admin4@example.com', 'adminpass4', 789789789),
(5, 'Admin5', '1988-07-25', 'admin5@example.com', 'adminpass5', 987987987);

-- Insertar datos en ActLug
INSERT INTO `ActLug` (`dAdministradores`, `idLug`, `fechaAL`)
VALUES
(1, 1, '2024-11-15'),
(2, 2, '2024-11-20'),
(3, 3, '2024-11-22'),
(4, 4, '2024-11-24'),
(5, 5, '2024-11-26');

-- Insertar datos en ActCiu
INSERT INTO `ActCiu` (`idAdministradores`, `idCiudades`, `fechaAC`)
VALUES
(1, 1, '2024-11-10'),
(2, 2, '2024-11-12'),
(3, 3, '2024-11-14'),
(4, 4, '2024-11-16'),
(5, 5, '2024-11-18');
