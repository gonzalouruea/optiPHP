-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 16, 2025 at 01:58 PM
-- Server version: 8.0.41
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viajes`
--

-- --------------------------------------------------------

--
-- Table structure for table `transfer_hotel`
--

CREATE TABLE `transfer_hotel` (
  `id_hotel` int NOT NULL,
  `id_zona` int DEFAULT NULL,
  `Comision` int NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_hotel`
--

INSERT INTO `transfer_hotel` (`id_hotel`, `id_zona`, `Comision`, `Usuario`, `password`) VALUES
(1, 1, 4, 'Hilton', '$2y$10$DiWD6AxMZ4M3os9MVHe7SuXFr3Z6lXj6PQ5oh3wH9awzBufLPTK1e');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_precios`
--

CREATE TABLE `transfer_precios` (
  `id_precios` int NOT NULL,
  `id_vehiculo` int NOT NULL,
  `id_hotel` int NOT NULL,
  `Precio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_reservas`
--

CREATE TABLE `transfer_reservas` (
  `id_reserva` int NOT NULL,
  `localizador` varchar(100) NOT NULL,
  `id_hotel` int DEFAULT NULL COMMENT 'Es el hotel que realiza la reserva',
  `id_tipo_reserva` int NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_destino` int DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `numero_vuelo_entrada` varchar(50) NOT NULL,
  `origen_vuelo_entrada` int DEFAULT NULL,
  `hora_vuelo_salida` time DEFAULT NULL,
  `fecha_vuelo_salida` date DEFAULT NULL,
  `num_viajeros` int NOT NULL,
  `id_vehiculo` int NOT NULL,
  `hora_recogida` time DEFAULT NULL,
  `creado_por_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_reservas`
--

INSERT INTO `transfer_reservas` (`id_reserva`, `localizador`, `id_hotel`, `id_tipo_reserva`, `email_cliente`, `fecha_reserva`, `fecha_modificacion`, `id_destino`, `fecha_entrada`, `hora_entrada`, `numero_vuelo_entrada`, `origen_vuelo_entrada`, `hora_vuelo_salida`, `fecha_vuelo_salida`, `num_viajeros`, `id_vehiculo`, `hora_recogida`, `creado_por_admin`) VALUES
(2, 'F0D8BF58', 1, 1, 'particular2@email', '2025-04-16 13:22:21', '2025-04-16 13:22:21', NULL, '2025-04-19', '00:00:00', '321', NULL, NULL, NULL, 2, 5, '00:00:00', 0),
(3, 'FD85485A', 1, 1, 'empresa@gmail.com', '2025-04-16 13:25:44', '2025-04-16 13:25:44', NULL, '2025-04-19', '00:00:00', '21', NULL, NULL, NULL, 2, 5, '00:00:00', 0),
(4, '172CC870', 1, 2, 'empresa@gmail.com', '2025-04-16 13:32:34', '2025-04-16 13:32:34', NULL, NULL, NULL, '', NULL, '16:28:00', '2025-04-19', 2, 5, '16:26:00', 0),
(5, '2145F8AE', 1, 3, 'empresa@gmail.com', '2025-04-16 13:35:16', '2025-04-16 13:36:29', NULL, '2025-04-25', '16:33:00', '21', NULL, '18:33:00', '2025-04-30', 5, 5, '19:39:00', 0),
(6, '27EAB364', 1, 2, 'particular2@email', '2025-04-16 13:37:02', '2025-04-16 13:37:02', NULL, NULL, NULL, '', NULL, '18:39:00', '2025-04-30', 31, 5, '20:42:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_tipo_reserva`
--

CREATE TABLE `transfer_tipo_reserva` (
  `id_tipo_reserva` int NOT NULL,
  `Descripción` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_tipo_reserva`
--

INSERT INTO `transfer_tipo_reserva` (`id_tipo_reserva`, `Descripción`) VALUES
(1, 'Aeropuerto->Hotel'),
(2, 'Hotel->Aeropuerto'),
(3, 'Ida y Vuelta');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_vehiculo`
--

CREATE TABLE `transfer_vehiculo` (
  `id_vehiculo` int NOT NULL,
  `Descripción` varchar(100) NOT NULL,
  `email_conductor` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_vehiculo`
--

INSERT INTO `transfer_vehiculo` (`id_vehiculo`, `Descripción`, `email_conductor`, `password`) VALUES
(5, 'Skoda Fabia', 'ignacio@email', '$2y$10$6jqr0GB2Y5rDPSfSKgyPpOcglbludWPRrPPed8KqQibJ4xkyqs66q');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_viajeros`
--

CREATE TABLE `transfer_viajeros` (
  `id_viajero` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigoPostal` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_viajeros`
--

INSERT INTO `transfer_viajeros` (`id_viajero`, `nombre`, `apellido1`, `apellido2`, `direccion`, `codigoPostal`, `ciudad`, `pais`, `email`, `password`, `rol`) VALUES
(1, 'das', 'das', 'dsa', 'das', 'das', 'dsa', 'das', 'da@gmail.com', '$2y$10$wTRyMhuFe2U.V9yCAU5eE.R0fQHX2QxmeW6j2e6mXt20ezG7jVlZC', 'usuario'),
(2, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', 'admin', 'admin'),
(3, 'particular', 'particular', '1', 'a', 'a', 'a', 'a', 'particular@gmail.com', 'admin', 'usuario'),
(4, 'empresa', 'empresa', 'empresa', 'empresa', 'empresa', 'empresa', 'empresa', 'empresa@gmail.com', '$2y$10$R0mXGbwcVghUDQ9ZBvdON.Rz98FixrTHkra3uLrEn/PIpf9qC/H1e', 'corporativo'),
(6, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$bTgAm6Wl1lLHFKvVSgF/Z.bwlRn4tXWaXVpuXpLAEc5tyqTOBj/fu', 'usuario'),
(7, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@email', '$2y$12$Kb5SnF0i.Hk43/JuKwnt3.OlUVsDehSTQtes74MdIHFgBiO.EAyQS', 'admin'),
(8, 'particular2', 'particular2', 'particular2', 'particular2', 'particular2', 'particular2', 'particular2', 'particular2@email', '$2y$10$DJz1Fjw23pyEQzRqNC2aBOWnZOnU70DuPuAAvzY1F6ceP64p6aBpq', 'usuario');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_zona`
--

CREATE TABLE `transfer_zona` (
  `id_zona` int NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_zona`
--

INSERT INTO `transfer_zona` (`id_zona`, `descripcion`) VALUES
(1, 'Barcelona');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transfer_hotel`
--
ALTER TABLE `transfer_hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `FK_HOTEL_ZONA` (`id_zona`);

--
-- Indexes for table `transfer_precios`
--
ALTER TABLE `transfer_precios`
  ADD KEY `FK_PRECIOS_HOTEL` (`id_hotel`),
  ADD KEY `FK_PRECIOS_VEHICULO` (`id_vehiculo`);

--
-- Indexes for table `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `FK_RESERVAS_DESTINO` (`id_destino`),
  ADD KEY `FK_RESERVAS_HOTEL` (`id_hotel`),
  ADD KEY `FK_RESERVAS_TIPO` (`id_tipo_reserva`),
  ADD KEY `FK_RESERVAS_VEHICULO` (`id_vehiculo`);

--
-- Indexes for table `transfer_tipo_reserva`
--
ALTER TABLE `transfer_tipo_reserva`
  ADD PRIMARY KEY (`id_tipo_reserva`);

--
-- Indexes for table `transfer_vehiculo`
--
ALTER TABLE `transfer_vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- Indexes for table `transfer_viajeros`
--
ALTER TABLE `transfer_viajeros`
  ADD PRIMARY KEY (`id_viajero`);

--
-- Indexes for table `transfer_zona`
--
ALTER TABLE `transfer_zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfer_hotel`
--
ALTER TABLE `transfer_hotel`
  MODIFY `id_hotel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  MODIFY `id_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transfer_tipo_reserva`
--
ALTER TABLE `transfer_tipo_reserva`
  MODIFY `id_tipo_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer_vehiculo`
--
ALTER TABLE `transfer_vehiculo`
  MODIFY `id_vehiculo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transfer_viajeros`
--
ALTER TABLE `transfer_viajeros`
  MODIFY `id_viajero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transfer_zona`
--
ALTER TABLE `transfer_zona`
  MODIFY `id_zona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transfer_hotel`
--
ALTER TABLE `transfer_hotel`
  ADD CONSTRAINT `FK_HOTEL_ZONA` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`);

--
-- Constraints for table `transfer_precios`
--
ALTER TABLE `transfer_precios`
  ADD CONSTRAINT `FK_PRECIOS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_PRECIOS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`);

--
-- Constraints for table `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  ADD CONSTRAINT `FK_RESERVAS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_TIPO` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `transfer_tipo_reserva` (`id_tipo_reserva`),
  ADD CONSTRAINT `FK_RESERVAS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
