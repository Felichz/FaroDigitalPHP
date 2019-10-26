-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2018 a las 04:31:56
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pv2`
--

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `edad`, `nacimiento`, `antiguedad`, `descuento`, `direccion`, `celular`, `email`) VALUES
(1, 'Félix', 'Andersson', 19, '1999-09-11 00:00:00', 10, 10, 'La Serena', '092227356', 'felix-fx@hotmail.com'),
(1000, 'Nombre 1000', 'Apellido 1000', 50, '0000-00-00 00:00:00', 14, 9, 'Direccion 1000', '997721000', 'email1000@cursophp2018.com'),
(1001, 'Nombre 1001', 'Apellido 1001', 48, '0000-00-00 00:00:00', 2, 0, 'Direccion 1001', '997721001', 'email1001@cursophp2018.com'),
(1002, 'Nombre 1002', 'Apellido 1002', 38, '0000-00-00 00:00:00', 18, 2, 'Direccion 1002', '997721002', 'email1002@cursophp2018.com'),
(1003, 'Nombre 1003', 'Apellido 1003', 36, '0000-00-00 00:00:00', 1, 15, 'Direccion 1003', '997721003', 'email1003@cursophp2018.com'),
(1004, 'Nombre 1004', 'Apellido 1004', 45, '0000-00-00 00:00:00', 18, 10, 'Direccion 1004', '997721004', 'email1004@cursophp2018.com'),
(1005, 'Nombre 1005', 'Apellido 1005', 46, '0000-00-00 00:00:00', 22, 4, 'Direccion 1005', '997721005', 'email1005@cursophp2018.com'),
(1006, 'Nombre 1006', 'Apellido 1006', 29, '0000-00-00 00:00:00', 15, 9, 'Direccion 1006', '997721006', 'email1006@cursophp2018.com'),
(1007, 'Nombre 1007', 'Apellido 1007', 41, '0000-00-00 00:00:00', 10, 13, 'Direccion 1007', '997721007', 'email1007@cursophp2018.com'),
(1008, 'Nombre 1008', 'Apellido 1008', 37, '0000-00-00 00:00:00', 30, 4, 'Direccion 1008', '997721008', 'email1008@cursophp2018.com'),
(1009, 'Nombre 1009', 'Apellido 1009', 34, '0000-00-00 00:00:00', 15, 10, 'Direccion 1009', '997721009', 'email1009@cursophp2018.com'),
(1010, 'Nombre 1010', 'Apellido 1010', 32, '0000-00-00 00:00:00', 15, 14, 'Direccion 1010', '997721010', 'email1010@cursophp2018.com'),
(1011, 'Nombre 1011', 'Apellido 1011', 33, '0000-00-00 00:00:00', 19, 15, 'Direccion 1011', '997721011', 'email1011@cursophp2018.com'),
(1012, 'Nombre 1012', 'Apellido 1012', 31, '0000-00-00 00:00:00', 20, 14, 'Direccion 1012', '997721012', 'email1012@cursophp2018.com'),
(1013, 'Nombre 1013', 'Apellido 1013', 39, '0000-00-00 00:00:00', 2, 10, 'Direccion 1013', '997721013', 'email1013@cursophp2018.com'),
(1014, 'Nombre 1014', 'Apellido 1014', 46, '0000-00-00 00:00:00', 12, 3, 'Direccion 1014', '997721014', 'email1014@cursophp2018.com'),
(1015, 'Nombre 1015', 'Apellido 1015', 36, '0000-00-00 00:00:00', 11, 8, 'Direccion 1015', '997721015', 'email1015@cursophp2018.com'),
(1016, 'Nombre 1016', 'Apellido 1016', 42, '0000-00-00 00:00:00', 6, 7, 'Direccion 1016', '997721016', 'email1016@cursophp2018.com'),
(1017, 'Nombre 1017', 'Apellido 1017', 35, '0000-00-00 00:00:00', 18, 6, 'Direccion 1017', '997721017', 'email1017@cursophp2018.com'),
(1018, 'Nombre 1018', 'Apellido 1018', 34, '0000-00-00 00:00:00', 13, 3, 'Direccion 1018', '997721018', 'email1018@cursophp2018.com'),
(1019, 'Nombre 1019', 'Apellido 1019', 39, '0000-00-00 00:00:00', 14, 6, 'Direccion 1019', '997721019', 'email1019@cursophp2018.com'),
(1020, 'Nombre 1020', 'Apellido 1020', 49, '0000-00-00 00:00:00', 18, 5, 'Direccion 1020', '997721020', 'email1020@cursophp2018.com'),
(1021, 'Nombre 1021', 'Apellido 1021', 49, '0000-00-00 00:00:00', 22, 4, 'Direccion 1021', '997721021', 'email1021@cursophp2018.com'),
(1022, 'Nombre 1022', 'Apellido 1022', 40, '0000-00-00 00:00:00', 13, 0, 'Direccion 1022', '997721022', 'email1022@cursophp2018.com'),
(1023, 'Nombre 1023', 'Apellido 1023', 44, '0000-00-00 00:00:00', 9, 12, 'Direccion 1023', '997721023', 'email1023@cursophp2018.com'),
(1024, 'Nombre 1024', 'Apellido 1024', 47, '0000-00-00 00:00:00', 11, 6, 'Direccion 1024', '997721024', 'email1024@cursophp2018.com'),
(1025, 'Nombre 1025', 'Apellido 1025', 33, '0000-00-00 00:00:00', 19, 7, 'Direccion 1025', '997721025', 'email1025@cursophp2018.com'),
(1026, 'Nombre 1026', 'Apellido 1026', 50, '0000-00-00 00:00:00', 20, 5, 'Direccion 1026', '997721026', 'email1026@cursophp2018.com'),
(1027, 'Nombre 1027', 'Apellido 1027', 39, '0000-00-00 00:00:00', 24, 7, 'Direccion 1027', '997721027', 'email1027@cursophp2018.com'),
(1028, 'Nombre 1028', 'Apellido 1028', 38, '0000-00-00 00:00:00', 18, 1, 'Direccion 1028', '997721028', 'email1028@cursophp2018.com'),
(1029, 'Nombre 1029', 'Apellido 1029', 37, '0000-00-00 00:00:00', 29, 5, 'Direccion 1029', '997721029', 'email1029@cursophp2018.com');

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `id_cliente`, `fecha_venta`, `descuento`, `iva`, `monto`, `id_documento`) VALUES
(35, 1005, '2018-10-24 11:55:29', 504.28, 1473.94, 8173.66, '1540392929_1005'),
(36, 1, '2018-10-24 11:57:01', 31518.7, 131748, 730602, '1540393022_1'),
(41, 1017, '2018-10-24 17:52:31', 11789.5, 49280.3, 273282, '1540414351_1017'),
(42, 1, '2018-10-24 20:54:47', 2312250, 9665190, 53597900, '1540425287_1'),
(43, 1002, '2018-10-24 21:39:21', 266771, 1115100, 6183740, '1540427962_1002'),
(45, 1008, '2018-10-24 22:43:11', 1937.67, 5663.53, 31406.9, '1540431792_1008');

--
-- Volcado de datos para la tabla `documento_detalle`
--

INSERT INTO `documento_detalle` (`id`, `id_documento`, `id_producto`, `nombre`, `descripcion`, `importe`, `cantidad`, `monto`) VALUES
(28, '1540392929_1005', 1014, 'Nombre 1014', 'descripcion xXxxX xXxxxX 1014', 7204, 1, 7204),
(29, '1540393022_1', 1009, 'Nombre 1009', 'descripcion xXxxX xXxxxX 1009', 13064, 15, 195960),
(30, '1540393022_1', 1007, 'Nombre 1007', 'descripcion xXxxX xXxxxX 1007', 9235, 6, 55410),
(31, '1540393022_1', 1023, 'Nombre 1023', 'descripcion xXxxX xXxxxX 1023', 19236, 9, 173124),
(32, '1540393022_1', 1024, 'Nombre 1024', 'descripcion xXxxX xXxxxX 1024', 5439, 11, 59829),
(33, '1540393022_1', 1022, 'Nombre 1022', 'descripcion xXxxX xXxxxX 1022', 5451, 6, 32706),
(34, '1540393022_1', 1021, 'Nombre 1021', 'descripcion xXxxX xXxxxX 1021', 8096, 14, 113344),
(42, '1540414351_1017', 1025, 'Nombre 1025', 'descripcion xXxxX xXxxxX 1025', 16831, 11, 185141),
(43, '1540414351_1017', 1019, 'Nombre 1019', 'descripcion xXxxX xXxxxX 1019', 10130, 5, 50650),
(44, '1540425287_1', 1002, 'Nombre 1002', 'descripcion xXxxX xXxxxX 1002', 4268, 126, 537768),
(45, '1540425287_1', 1020, 'Nombre 1020', 'descripcion xXxxX xXxxxX 1020', 1714, 456, 781584),
(46, '1540425287_1', 1008, 'Nombre 1008', 'descripcion xXxxX xXxxxX 1008', 9837, 4567, 44925600),
(47, '1540427962_1002', 1004, 'Nombre 1004', 'descripcion xXxxX xXxxxX 1004', 3143, 45, 141435),
(48, '1540427962_1002', 1017, 'Nombre 1017', 'descripcion xXxxX xXxxxX 1017', 4556, 842, 3836150),
(49, '1540427962_1002', 1001, 'Nombre 1001', 'descripcion xXxxX xXxxxX 1001', 4352, 312, 1357820),
(50, '1540431792_1008', 1001, 'Nombre 1001', 'descripcion xXxxX xXxxxX 1001', 4352, 1, 4352),
(51, '1540431792_1008', 1017, 'Nombre 1017', 'descripcion xXxxX xXxxxX 1017', 4556, 1, 4556),
(52, '1540431792_1008', 1017, 'Nombre 1017', 'descripcion xXxxX xXxxxX 1017', 4556, 1, 4556),
(53, '1540431792_1008', 1001, 'Nombre 1001', 'descripcion xXxxX xXxxxX 1001', 4352, 1, 4352),
(54, '1540431792_1008', 1014, 'Nombre 1014', 'descripcion xXxxX xXxxxX 1014', 7204, 1, 7204),
(55, '1540431792_1008', 1027, 'Nombre 1027', 'descripcion xXxxX xXxxxX 1027', 2661, 1, 2661);

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `importe`, `stock`) VALUES
(1000, 'Nombre 1000', 'descripcion xXxxX xXxxxX 1000', 2832, 1000),
(1001, 'Nombre 1001', 'descripcion xXxxX xXxxxX 1001', 4352, 686),
(1002, 'Nombre 1002', 'descripcion xXxxX xXxxxX 1002', 4268, 1000),
(1003, 'Nombre 1003', 'descripcion xXxxX xXxxxX 1003', 1910, 1000),
(1004, 'Nombre 1004', 'descripcion xXxxX xXxxxX 1004', 3143, 955),
(1005, 'Nombre 1005', 'descripcion xXxxX xXxxxX 1005', 15611, 1000),
(1006, 'Nombre 1006', 'descripcion xXxxX xXxxxX 1006', 5989, 1000),
(1007, 'Nombre 1007', 'descripcion xXxxX xXxxxX 1007', 9235, 1000),
(1008, 'Nombre 1008', 'descripcion xXxxX xXxxxX 1008', 9837, 1000),
(1009, 'Nombre 1009', 'descripcion xXxxX xXxxxX 1009', 13064, 1000),
(1010, 'Nombre 1010', 'descripcion xXxxX xXxxxX 1010', 2217, 1000),
(1011, 'Nombre 1011', 'descripcion xXxxX xXxxxX 1011', 9880, 1000),
(1012, 'Nombre 1012', 'descripcion xXxxX xXxxxX 1012', 18163, 1000),
(1013, 'Nombre 1013', 'descripcion xXxxX xXxxxX 1013', 10963, 1000),
(1014, 'Nombre 1014', 'descripcion xXxxX xXxxxX 1014', 7204, 999),
(1015, 'Nombre 1015', 'descripcion xXxxX xXxxxX 1015', 18095, 1000),
(1016, 'Nombre 1016', 'descripcion xXxxX xXxxxX 1016', 4372, 1000),
(1017, 'Nombre 1017', 'descripcion xXxxX xXxxxX 1017', 4556, 156),
(1018, 'Nombre 1018', 'descripcion xXxxX xXxxxX 1018', 16199, 1000),
(1019, 'Nombre 1019', 'descripcion xXxxX xXxxxX 1019', 10130, 1000),
(1020, 'Nombre 1020', 'descripcion xXxxX xXxxxX 1020', 1714, 1000),
(1021, 'Nombre 1021', 'descripcion xXxxX xXxxxX 1021', 8096, 1000),
(1022, 'Nombre 1022', 'descripcion xXxxX xXxxxX 1022', 5451, 1000),
(1023, 'Nombre 1023', 'descripcion xXxxX xXxxxX 1023', 19236, 1000),
(1024, 'Nombre 1024', 'descripcion xXxxX xXxxxX 1024', 5439, 1000),
(1025, 'Nombre 1025', 'descripcion xXxxX xXxxxX 1025', 16831, 1000),
(1026, 'Nombre 1026', 'descripcion xXxxX xXxxxX 1026', 8211, 1000),
(1027, 'Nombre 1027', 'descripcion xXxxX xXxxxX 1027', 2661, 999),
(1028, 'Nombre 1028', 'descripcion xXxxX xXxxxX 1028', 10797, 1000),
(1029, 'Nombre 1029', 'descripcion xXxxX xXxxxX 1029', 7010, 1000),
(1030, 'Nombre 1030', 'descripcion xXxxX xXxxxX 1030', 10963, 1000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
