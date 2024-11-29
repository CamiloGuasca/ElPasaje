-- Inserciones para la tabla `Proveedores`
INSERT INTO `Proveedores` (`nombreProv`, `naciProv`, `correoProv`, `claveProv`, `cedulaProv`) VALUES
('Proveedor A', '1980-01-01', 'proveedorA@mail.com', 'clave123', 123456789),
('Proveedor B', '1990-02-15', 'proveedorB@mail.com', 'clave456', 987654321),
('Proveedor C', '1985-03-10', 'proveedorC@mail.com', 'clave789', 112233445),
('Proveedor D', '1975-04-20', 'proveedorD@mail.com', 'clave101', 556677889),
('Proveedor E', '2000-05-30', 'proveedorE@mail.com', 'clave202', 667788990),
('Proveedor F', '1995-06-25', 'proveedorF@mail.com', 'clave303', 998877665),
('Proveedor G', '1983-07-05', 'proveedorG@mail.com', 'clave404', 123987456),
('Proveedor H', '1998-08-19', 'proveedorH@mail.com', 'clave505', 321654987),
('Proveedor I', '1987-09-12', 'proveedorI@mail.com', 'clave606', 765432109),
('Proveedor J', '1993-10-23', 'proveedorJ@mail.com', 'clave707', 345678901);

-- Inserciones para la tabla `Clientes`
INSERT INTO `Clientes` (`nombreCli`, `naciCli`, `correoCli`, `claveCli`, `cedulaCli`) VALUES
('Cliente A', '2005-01-01', 'clienteA@mail.com', 'clave123', '123456789'),
('Cliente B', '2000-02-15', 'clienteB@mail.com', 'clave456', '987654321'),
('Cliente C', '1995-03-10', 'clienteC@mail.com', 'clave789', '112233445'),
('Cliente D', '2010-04-20', 'clienteD@mail.com', 'clave101', '556677889'),
('Cliente E', '1998-05-30', 'clienteE@mail.com', 'clave202', '667788990'),
('Cliente F', '2003-06-25', 'clienteF@mail.com', 'clave303', '998877665'),
('Cliente G', '2007-07-05', 'clienteG@mail.com', 'clave404', '123987456'),
('Cliente H', '1996-08-19', 'clienteH@mail.com', 'clave505', '321654987'),
('Cliente I', '2001-09-12', 'clienteI@mail.com', 'clave606', '765432109'),
('Cliente J', '2008-10-23', 'clienteJ@mail.com', 'clave707', '345678901');

-- Inserciones para la tabla `Ciudades`
INSERT INTO `Ciudades` (`NombreCiu`) VALUES
('Ciudad A'),
('Ciudad B'),
('Ciudad C'),
('Ciudad D'),
('Ciudad E'),
('Ciudad F'),
('Ciudad G'),
('Ciudad H'),
('Ciudad I'),
('Ciudad J');

-- Inserciones para la tabla `Lugares`
INSERT INTO `Lugares` (`capacidadLug`, `direccionLug`, `nombreLug`, `Ciudades_idCiudades`) VALUES
(500, 'Dirección 1', 'Lugar A', 1),
(300, 'Dirección 2', 'Lugar B', 2),
(800, 'Dirección 3', 'Lugar C', 3),
(600, 'Dirección 4', 'Lugar D', 4),
(1000, 'Dirección 5', 'Lugar E', 5),
(400, 'Dirección 6', 'Lugar F', 6),
(750, 'Dirección 7', 'Lugar G', 7),
(900, 'Dirección 8', 'Lugar H', 8),
(550, 'Dirección 9', 'Lugar I', 9),
(650, 'Dirección 10', 'Lugar J', 10);

-- Inserciones para la tabla `Eventos`
INSERT INTO `Eventos` (`nombreEve`, `fechIniEve`, `fechFinEve`, `precioEve`, `idLug`, `dProv`) VALUES
('Evento A', '2024-12-01', '2024-12-03', 100, 1, 1),
('Evento B', '2024-12-05', '2024-12-07', 150, 2, 2),
('Evento C', '2024-12-10', '2024-12-12', 200, 3, 3),
('Evento D', '2024-12-15', '2024-12-17', 250, 4, 4),
('Evento E', '2024-12-20', '2024-12-22', 300, 5, 5),
('Evento F', '2024-12-25', '2024-12-27', 350, 6, 6),
('Evento G', '2024-12-30', '2025-01-01', 400, 7, 7),
('Evento H', '2025-01-05', '2025-01-07', 450, 8, 8),
('Evento I', '2025-01-10', '2025-01-12', 500, 9, 9),
('Evento J', '2025-01-15', '2025-01-17', 550, 10, 10);

-- Inserciones para la tabla `TipoBoleta`
INSERT INTO `TipoBoleta` (`nombreTB`, `porcentajeTB`, `Proveedores_idProv`) VALUES
('Entrada General', '10%', 1),
('Entrada VIP', '15%', 2),
('Entrada Preferencial', '20%', 3),
('Entrada Normal', '25%', 4),
('Entrada Estándar', '30%', 5),
('Entrada Premium', '35%', 6),
('Entrada Exlusiva', '40%', 7),
('Entrada Concierto', '45%', 8),
('Entrada VIP Plus', '50%', 9),
('Entrada Deluxe', '55%', 10);

-- Inserciones para la tabla `DetalleEvento`
INSERT INTO `DetalleEvento` (`idEve`, `idTB`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);

-- Inserciones para la tabla `FacturaVenta`
INSERT INTO `FacturaVenta` (`fechaFV`, `horaFV`, `idEve`, `idCli`) VALUES
('2024-12-01', '10:00', 1, 1),
('2024-12-05', '12:00', 2, 2),
('2024-12-10', '14:00', 3, 3),
('2024-12-15', '16:00', 4, 4),
('2024-12-20', '18:00', 5, 5),
('2024-12-25', '20:00', 6, 6),
('2024-12-30', '22:00', 7, 7),
('2025-01-05', '10:30', 8, 8),
('2025-01-10', '12:30', 9, 9),
('2025-01-15', '14:30', 10, 10);

-- Inserciones para la tabla `DetalleFacturaVenta`
INSERT INTO `DetalleFacturaVenta` (`idFacturaVenta`, `idTB`, `cantidadDFV`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 4),
(4, 4, 5),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8),
(8, 8, 9),
(9, 9, 10),
(10, 10, 11);

-- Inserciones para la tabla `CarritoCompra`
INSERT INTO `CarritoCompra` (`idCli`, `idTB`, `idEve`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

-- Inserciones para la tabla `Administradores`
INSERT INTO `Administradores` (`idAdministradores`, `nombreAdm`, `naciAdm`, `correoAdm`, `claveAdm`, `cedulaAdm`) VALUES
(1, 'Administrador A', '1980-01-01', 'adminA@mail.com', 'admin123', 123456789),
(2, 'Administrador B', '1985-02-15', 'adminB@mail.com', 'admin456', 987654321),
(3, 'Administrador C', '1990-03-10', 'adminC@mail.com', 'admin789', 112233445),
(4, 'Administrador D', '1975-04-20', 'adminD@mail.com', 'admin101', 556677889),
(5, 'Administrador E', '2000-05-30', 'adminE@mail.com', 'admin202', 667788990),
(6, 'Administrador F', '1995-06-25', 'adminF@mail.com', 'admin303', 998877665),
(7, 'Administrador G', '1983-07-05', 'adminG@mail.com', 'admin404', 123987456),
(8, 'Administrador H', '1998-08-19', 'adminH@mail.com', 'admin505', 321654987),
(9, 'Administrador I', '1987-09-12', 'adminI@mail.com', 'admin606', 765432109),
(10, 'Administrador J', '1993-10-23', 'adminJ@mail.com', 'admin707', 345678901);

-- Inserciones para la tabla `ActLug`
INSERT INTO `ActLug` (`dAdministradores`, `idLug`, `fechaAL`) VALUES
(1, 1, '2024-12-01'),
(2, 2, '2024-12-02'),
(3, 3, '2024-12-03'),
(4, 4, '2024-12-04'),
(5, 5, '2024-12-05'),
(6, 6, '2024-12-06'),
(7, 7, '2024-12-07'),
(8, 8, '2024-12-08'),
(9, 9, '2024-12-09'),
(10, 10, '2024-12-10');

-- Inserciones para la tabla `ActCiu`
INSERT INTO `ActCiu` (`idAdministradores`, `idCiudades`, `fechaAC`) VALUES
(1, 1, '2024-12-01'),
(2, 2, '2024-12-02'),
(3, 3, '2024-12-03'),
(4, 4, '2024-12-04'),
(5, 5, '2024-12-05'),
(6, 6, '2024-12-06'),
(7, 7, '2024-12-07'),
(8, 8, '2024-12-08'),
(9, 9, '2024-12-09'),
(10, 10, '2024-12-10');
