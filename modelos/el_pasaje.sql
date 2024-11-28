-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 11:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `el_pasaje`
--

-- --------------------------------------------------------

--
-- Table structure for table `actciu`
--

CREATE TABLE `actciu` (
  `idAC` int(11) NOT NULL,
  `idAdministradores` int(11) NOT NULL,
  `idCiudades` int(11) NOT NULL,
  `fechaAC` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actciu`
--

INSERT INTO `actciu` (`idAC`, `idAdministradores`, `idCiudades`, `fechaAC`) VALUES
(1, 1, 1, '2024-11-10'),
(2, 2, 2, '2024-11-12'),
(3, 3, 3, '2024-11-14'),
(4, 4, 4, '2024-11-16'),
(5, 5, 5, '2024-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `actlug`
--

CREATE TABLE `actlug` (
  `idAL` int(11) NOT NULL,
  `dAdministradores` int(11) NOT NULL,
  `idLug` int(11) NOT NULL,
  `fechaAL` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actlug`
--

INSERT INTO `actlug` (`idAL`, `dAdministradores`, `idLug`, `fechaAL`) VALUES
(1, 1, 1, '2024-11-15'),
(2, 2, 2, '2024-11-20'),
(3, 3, 3, '2024-11-22'),
(4, 4, 4, '2024-11-24'),
(5, 5, 5, '2024-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `idAdministradores` int(11) NOT NULL,
  `nombreAdm` varchar(45) NOT NULL,
  `naciAdm` varchar(45) NOT NULL,
  `correoAdm` varchar(45) NOT NULL,
  `claveAdm` varchar(45) NOT NULL,
  `cedulaAdm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`idAdministradores`, `nombreAdm`, `naciAdm`, `correoAdm`, `claveAdm`, `cedulaAdm`) VALUES
(1, 'Admin1', '1985-02-20', 'admin1@example.com', 'adminpass1', 123123123),
(2, 'Admin2', '1983-06-15', 'admin2@example.com', 'adminpass2', 321321321),
(3, 'Admin3', '1990-01-10', 'admin3@example.com', 'adminpass3', 456456456),
(4, 'Admin4', '1995-09-30', 'admin4@example.com', 'adminpass4', 789789789),
(5, 'Admin5', '1988-07-25', 'admin5@example.com', 'adminpass5', 987987987);

-- --------------------------------------------------------

--
-- Table structure for table `carritocompra`
--

CREATE TABLE `carritocompra` (
  `idCC` int(11) NOT NULL,
  `Clientes_idCli` int(11) NOT NULL,
  `TipoBoleta_idTB` int(11) NOT NULL,
  `idEve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carritocompra`
--

INSERT INTO `carritocompra` (`idCC`, `Clientes_idCli`, `TipoBoleta_idTB`, `idEve`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 3),
(4, 4, 4, 4),
(5, 5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudades` int(11) NOT NULL,
  `NombreCiu` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ciudades`
--

INSERT INTO `ciudades` (`idCiudades`, `NombreCiu`) VALUES
(1, 'Bogotá'),
(2, 'Medellín'),
(3, 'Cali'),
(4, 'Barranquilla'),
(5, 'Cartagena');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `idCli` int(11) NOT NULL,
  `nombreCli` varchar(45) NOT NULL,
  `naciCli` varchar(45) DEFAULT NULL,
  `correoCli` varchar(45) DEFAULT NULL,
  `claveCli` varchar(45) DEFAULT NULL,
  `cedulaCli` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`idCli`, `nombreCli`, `naciCli`, `correoCli`, `claveCli`, `cedulaCli`) VALUES
(1, 'Cliente1', '1990-07-10', 'cli1@example.com', 'password1', '1234567890'),
(2, 'Cliente2', '1988-11-25', 'cli2@example.com', 'password2', '0987654321'),
(3, 'Cliente3', '1995-04-18', 'cli3@example.com', 'password3', '1122334455'),
(4, 'Cliente4', '1982-09-30', 'cli4@example.com', 'password4', '6677889900'),
(5, 'Cliente5', '1998-01-12', 'cli5@example.com', 'password5', '5544332211');

-- --------------------------------------------------------

--
-- Table structure for table `detalleevento`
--

CREATE TABLE `detalleevento` (
  `idProv` int(11) NOT NULL,
  `idEve` int(11) NOT NULL,
  `idTB` int(11) NOT NULL,
  `cantidadDE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalleevento`
--

INSERT INTO `detalleevento` (`idProv`, `idEve`, `idTB`, `cantidadDE`) VALUES
(1, 1, 1, 200),
(2, 2, 2, 100),
(3, 3, 3, 50),
(4, 4, 4, 300),
(5, 5, 5, 150);

-- --------------------------------------------------------

--
-- Table structure for table `detallefacturaventa`
--

CREATE TABLE `detallefacturaventa` (
  `idFacturaVenta` int(11) NOT NULL,
  `idTB` int(11) NOT NULL,
  `cantidadDFV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detallefacturaventa`
--

INSERT INTO `detallefacturaventa` (`idFacturaVenta`, `idTB`, `cantidadDFV`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `idEve` int(11) NOT NULL,
  `nombreEve` varchar(45) NOT NULL,
  `fechIniEve` date NOT NULL,
  `fechFinEve` date NOT NULL,
  `precioEve` int(11) NOT NULL,
  `Lugares_idLug` int(11) NOT NULL,
  `imagenEve` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`idEve`, `nombreEve`, `fechIniEve`, `fechFinEve`, `precioEve`, `Lugares_idLug`, `imagenEve`) VALUES
(1, 'Concierto Rock', '2024-12-10', '2024-12-10', 100000, 1, NULL),
(2, 'Feria de Emprendimiento', '2025-01-15', '2025-01-20', 50000, 2, NULL),
(3, 'Festival de Jazz', '2025-02-05', '2025-02-08', 80000, 3, NULL),
(4, 'Taller de Arte', '2025-03-12', '2025-03-13', 20000, 4, NULL),
(5, 'Congreso de Tecnología', '2025-04-20', '2025-04-22', 150000, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facturaventa`
--

CREATE TABLE `facturaventa` (
  `idFacturaVenta` int(11) NOT NULL,
  `fechaFV` date NOT NULL,
  `horaFV` varchar(45) NOT NULL,
  `idEve` int(11) NOT NULL,
  `idCli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturaventa`
--

INSERT INTO `facturaventa` (`idFacturaVenta`, `fechaFV`, `horaFV`, `idEve`, `idCli`) VALUES
(1, '2024-11-28', '14:00:00', 1, 1),
(2, '2024-11-28', '15:30:00', 2, 2),
(3, '2024-11-29', '16:45:00', 3, 3),
(4, '2024-12-01', '10:15:00', 4, 4),
(5, '2024-12-02', '13:30:00', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lugares`
--

CREATE TABLE `lugares` (
  `idLug` int(11) NOT NULL,
  `capacidadLug` int(11) NOT NULL,
  `direccionLug` varchar(45) NOT NULL,
  `nombreLug` varchar(45) NOT NULL,
  `Ciudades_idCiudades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lugares`
--

INSERT INTO `lugares` (`idLug`, `capacidadLug`, `direccionLug`, `nombreLug`, `Ciudades_idCiudades`) VALUES
(1, 500, 'Av. Principal 123', 'Estadio Central', 1),
(2, 300, 'Calle Secundaria 45', 'Auditorio Regional', 2),
(3, 700, 'Carrera 10 No 25', 'Coliseo Moderno', 3),
(4, 200, 'Calle 50', 'Centro de Convenciones', 4),
(5, 600, 'Avenida 30', 'Parque Cultural', 5);

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `idProv` int(11) NOT NULL,
  `nombreProv` varchar(45) NOT NULL,
  `naciProv` date NOT NULL,
  `correoProv` varchar(45) NOT NULL,
  `claveProv` varchar(45) NOT NULL,
  `cedulaProv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`idProv`, `nombreProv`, `naciProv`, `correoProv`, `claveProv`, `cedulaProv`) VALUES
(1, 'Proveedor1', '1980-05-15', 'prov1@example.com', 'clave123', 12345678),
(2, 'Proveedor2', '1975-03-22', 'prov2@example.com', 'clave456', 87654321),
(3, 'Proveedor3', '1990-09-10', 'prov3@example.com', 'clave789', 11223344),
(4, 'Proveedor4', '1985-12-05', 'prov4@example.com', 'clave101', 55667788),
(5, 'Proveedor5', '1992-07-14', 'prov5@example.com', 'clave202', 99887766);

-- --------------------------------------------------------

--
-- Table structure for table `tipoboleta`
--

CREATE TABLE `tipoboleta` (
  `idTB` int(11) NOT NULL,
  `nombreTB` varchar(45) NOT NULL,
  `porcentajeTB` varchar(45) NOT NULL,
  `Proveedores_idProv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipoboleta`
--

INSERT INTO `tipoboleta` (`idTB`, `nombreTB`, `porcentajeTB`, `Proveedores_idProv`) VALUES
(1, 'General', '10%', 1),
(2, 'VIP', '25%', 2),
(3, 'Platino', '50%', 3),
(4, 'Estudiante', '5%', 4),
(5, 'Familiar', '15%', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actciu`
--
ALTER TABLE `actciu`
  ADD PRIMARY KEY (`idAC`),
  ADD KEY `fk_ActCiu_Ciudades1_idx` (`idCiudades`),
  ADD KEY `fk_ActCiu_Administradores1` (`idAdministradores`);

--
-- Indexes for table `actlug`
--
ALTER TABLE `actlug`
  ADD PRIMARY KEY (`idAL`),
  ADD KEY `fk_ActLug_Lugares1_idx` (`idLug`),
  ADD KEY `fk_ActLug_Administradores1` (`dAdministradores`);

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idAdministradores`);

--
-- Indexes for table `carritocompra`
--
ALTER TABLE `carritocompra`
  ADD PRIMARY KEY (`idCC`,`Clientes_idCli`,`TipoBoleta_idTB`,`idEve`),
  ADD KEY `fk_CarritoCompra_Clientes1_idx` (`Clientes_idCli`),
  ADD KEY `fk_CarritoCompra_TipoBoleta1_idx` (`TipoBoleta_idTB`),
  ADD KEY `fk_CarritoCompra_Eventos1_idx` (`idEve`);

--
-- Indexes for table `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudades`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCli`);

--
-- Indexes for table `detalleevento`
--
ALTER TABLE `detalleevento`
  ADD PRIMARY KEY (`idProv`,`idEve`,`idTB`),
  ADD KEY `fk_DetalleEvento_Eventos1_idx` (`idEve`),
  ADD KEY `fk_DetalleEvento_TipoBoleta1_idx` (`idTB`);

--
-- Indexes for table `detallefacturaventa`
--
ALTER TABLE `detallefacturaventa`
  ADD PRIMARY KEY (`idFacturaVenta`,`idTB`),
  ADD KEY `fk_DetalleFacturaVenta_TipoBoleta1_idx` (`idTB`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEve`,`Lugares_idLug`),
  ADD KEY `fk_Eventos_Lugares1_idx` (`Lugares_idLug`);

--
-- Indexes for table `facturaventa`
--
ALTER TABLE `facturaventa`
  ADD PRIMARY KEY (`idFacturaVenta`),
  ADD KEY `fk_FacturaVenta_Eventos1_idx` (`idEve`),
  ADD KEY `fk_FacturaVenta_Clientes1_idx` (`idCli`);

--
-- Indexes for table `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`idLug`,`Ciudades_idCiudades`),
  ADD KEY `fk_Lugares_Ciudades1_idx` (`Ciudades_idCiudades`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProv`);

--
-- Indexes for table `tipoboleta`
--
ALTER TABLE `tipoboleta`
  ADD PRIMARY KEY (`idTB`,`Proveedores_idProv`),
  ADD KEY `fk_TipoBoleta_Proveedores_idx` (`Proveedores_idProv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actciu`
--
ALTER TABLE `actciu`
  MODIFY `idAC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `actlug`
--
ALTER TABLE `actlug`
  MODIFY `idAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carritocompra`
--
ALTER TABLE `carritocompra`
  MODIFY `idCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facturaventa`
--
ALTER TABLE `facturaventa`
  MODIFY `idFacturaVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lugares`
--
ALTER TABLE `lugares`
  MODIFY `idLug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipoboleta`
--
ALTER TABLE `tipoboleta`
  MODIFY `idTB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actciu`
--
ALTER TABLE `actciu`
  ADD CONSTRAINT `fk_ActCiu_Administradores1` FOREIGN KEY (`idAdministradores`) REFERENCES `administradores` (`idAdministradores`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ActCiu_Ciudades1` FOREIGN KEY (`idCiudades`) REFERENCES `ciudades` (`idCiudades`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `actlug`
--
ALTER TABLE `actlug`
  ADD CONSTRAINT `fk_ActLug_Administradores1` FOREIGN KEY (`dAdministradores`) REFERENCES `administradores` (`idAdministradores`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ActLug_Lugares1` FOREIGN KEY (`idLug`) REFERENCES `lugares` (`idLug`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `carritocompra`
--
ALTER TABLE `carritocompra`
  ADD CONSTRAINT `fk_CarritoCompra_Clientes1` FOREIGN KEY (`Clientes_idCli`) REFERENCES `clientes` (`idCli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CarritoCompra_Eventos1` FOREIGN KEY (`idEve`) REFERENCES `eventos` (`idEve`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CarritoCompra_TipoBoleta1` FOREIGN KEY (`TipoBoleta_idTB`) REFERENCES `tipoboleta` (`idTB`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalleevento`
--
ALTER TABLE `detalleevento`
  ADD CONSTRAINT `fk_DetalleEvento_Eventos1` FOREIGN KEY (`idEve`) REFERENCES `eventos` (`idEve`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleEvento_Proveedores1` FOREIGN KEY (`idProv`) REFERENCES `proveedores` (`idProv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleEvento_TipoBoleta1` FOREIGN KEY (`idTB`) REFERENCES `tipoboleta` (`idTB`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detallefacturaventa`
--
ALTER TABLE `detallefacturaventa`
  ADD CONSTRAINT `fk_DetalleFacturaVenta_FacturaVenta1` FOREIGN KEY (`idFacturaVenta`) REFERENCES `facturaventa` (`idFacturaVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleFacturaVenta_TipoBoleta1` FOREIGN KEY (`idTB`) REFERENCES `tipoboleta` (`idTB`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_Eventos_Lugares1` FOREIGN KEY (`Lugares_idLug`) REFERENCES `lugares` (`idLug`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `facturaventa`
--
ALTER TABLE `facturaventa`
  ADD CONSTRAINT `fk_FacturaVenta_Clientes1` FOREIGN KEY (`idCli`) REFERENCES `clientes` (`idCli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FacturaVenta_Eventos1` FOREIGN KEY (`idEve`) REFERENCES `eventos` (`idEve`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lugares`
--
ALTER TABLE `lugares`
  ADD CONSTRAINT `fk_Lugares_Ciudades1` FOREIGN KEY (`Ciudades_idCiudades`) REFERENCES `ciudades` (`idCiudades`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tipoboleta`
--
ALTER TABLE `tipoboleta`
  ADD CONSTRAINT `fk_TipoBoleta_Proveedores` FOREIGN KEY (`Proveedores_idProv`) REFERENCES `proveedores` (`idProv`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
