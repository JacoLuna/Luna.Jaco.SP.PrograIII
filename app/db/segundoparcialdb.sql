-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2023 a las 22:36:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segundoparcialdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajuste`
--

CREATE TABLE `ajuste` (
  `idAjuste` int(11) NOT NULL,
  `idMovimientoAjustado` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ajuste`
--

INSERT INTO `ajuste` (`idAjuste`, `idMovimientoAjustado`, `motivo`) VALUES
(1, 1, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(2, 1, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(3, 1, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(4, 1, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(5, 1, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(6, 28, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(7, 27, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(8, 29, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(9, 30, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(10, 30, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(11, 30, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(12, 30, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES '),
(13, 30, '¿Qué diablos es \"among us\"? Soy una madre preocupada con un niño de 13 años y estoy aquí para buscar ayuda con respecto a mi hijo. La semana pasada, cuando fuimos al supermercado, mi hijo señaló un bote de basura rojo y comenzó a saltar gritando \"¡ESO ES ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `nroCuenta` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `tipoDocumento` varchar(255) NOT NULL,
  `nroDocumento` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipoCuenta` varchar(5) NOT NULL,
  `saldo` int(255) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`nroCuenta`, `nombre`, `apellido`, `tipoDocumento`, `nroDocumento`, `email`, `tipoCuenta`, `saldo`, `activo`) VALUES
(100000, 'franco', 'wachin', 'DNI', 43328819, 'wachin@gmail.com', 'CAU$$', 8600, 1),
(100001, 'carla', 'wachin', 'DNI', 43328818, 'carla@gmail.com', 'CC$', 10000, 0),
(100002, 'melanie', 'perex', 'DNI', 23328819, 'elmasfacha@gmail.com', 'CC$', 0, 0),
(100003, 'valen', 'valls', 'DNI', 31328819, 'valls1234@gmail.com', 'CC$', 0, 0),
(100004, 'juan', 'valls', 'DNI', 31358819, '1234juan@gmail.com', 'CC$', 99996, 1),
(100005, 'charly', 'x', 'DNI', 31358820, 'x@gmail.com', 'CC$', 1000, 0),
(100006, 'valen', 'depiero', 'DNI', 12345678, 'valegay@gmail.com', 'CC$', 100000, 0),
(100007, 'Ana', 'lopez', 'DNI', 98765432, 'lopez@gmail.com', 'CA$', 28000, 1),
(100008, 'Ana', 'lopez', 'DNI', 98765432, 'lopez@gmail.com', 'CA$', 100000, 1),
(100009, 'Ana2', 'lopez2', 'DNI', 98765431, 'lopez@gmail.com', 'CA$', 100000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `idLog` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`idLog`, `descripcion`, `rol`) VALUES
(4, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Retiro', 'operador'),
(5, 'http://localhost:222/Consultas/movimientosCuenta?nroCuenta=100000&tipoMovimiento=Retiro', 'operador'),
(6, 'http://localhost:222/cuentas', 'operador'),
(7, 'http://localhost:222/cuentas', 'operador'),
(8, 'http://localhost:222/cuentas', 'operador'),
(9, 'http://localhost:222/cuentas', 'operador'),
(10, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Retiro', 'operador'),
(11, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Retiro', 'operador'),
(12, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(13, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023-11-26&tipoMovimiento=Deposito', 'operador'),
(14, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(15, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(16, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(17, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(18, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(19, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(20, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(21, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(22, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(23, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(24, 'http://localhost:222/Consultas/totalMovimiento?tipoCuenta=CC$&fecha=2023/11/26&tipoMovimiento=Deposito', 'operador'),
(25, 'http://localhost:222/Consultas/movimientosCuenta?nroCuenta=100000&tipoMovimiento=Retiro', 'operador'),
(26, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(27, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(28, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(29, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(30, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(31, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(32, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(33, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(34, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(35, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(36, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(37, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(38, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(39, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(40, 'http://localhost:222/Movimientos/Retiro', 'cajero'),
(41, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(42, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(43, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(44, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(45, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(46, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(47, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(48, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(49, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(50, 'http://localhost:222/Movimientos/Deposito', 'cajero'),
(51, 'http://localhost:222/Movimientos/Ajuste', 'supervisor'),
(52, 'http://localhost:222/cuentas', 'supervisor'),
(53, 'http://localhost:222/cuentas', 'operador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logtransacciones`
--

CREATE TABLE `logtransacciones` (
  `idLogTransaccion` int(11) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `idOperacion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logtransacciones`
--

INSERT INTO `logtransacciones` (`idLogTransaccion`, `fecha`, `idOperacion`, `idUsuario`) VALUES
(5, 'SatSat/1212/23232323 18:16:44', 84, 0),
(6, 'SatSat/1212/23232323 18:16:58', 85, 0),
(7, 'SatSat/1212/23232323 18:16:59', 86, 0),
(8, 'SatSat/1212/23232323 18:17:00', 87, 0),
(9, 'SatSat/1212/23232323 18:17:00', 88, 0),
(10, 'SatSat/1212/23232323 18:29:12', 13, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `idMovimiento` int(11) NOT NULL,
  `nroCuenta` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipoMovimiento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`idMovimiento`, `nroCuenta`, `monto`, `fecha`, `tipoMovimiento`) VALUES
(1, 100000, 7000, '2023-11-26', 'Deposito'),
(2, 100000, 1500, '2023-11-26', 'Deposito'),
(3, 100000, 100, '2023-11-26', 'Deposito'),
(4, 100000, 100, '2023-11-26', 'Deposito'),
(5, 100000, 100, '2023-11-26', 'Deposito'),
(6, 100000, 100, '2023-11-26', 'Deposito'),
(7, 100000, 100, '2023-11-26', 'Deposito'),
(8, 100000, 100, '2023-11-26', 'Deposito'),
(9, 100000, 100, '2023-11-26', 'Deposito'),
(10, 100000, 100, '2023-11-26', 'Deposito'),
(11, 100000, 100, '2023-11-26', 'Deposito'),
(12, 100000, 100, '2023-11-26', 'Deposito'),
(13, 100000, 100, '2023-11-26', 'Deposito'),
(14, 100000, 100, '2023-11-26', 'Deposito'),
(15, 100000, 1000, '2023-11-24', 'Deposito'),
(16, 100000, 1000, '2023-11-26', 'Deposito'),
(17, 100000, 1000, '2023-11-14', 'Deposito'),
(18, 100000, 1000, '2023-11-24', 'Deposito'),
(19, 100000, 1000, '2023-11-26', 'Deposito'),
(20, 100000, 1000, '2023-11-26', 'Deposito'),
(21, 100000, 1000, '2023-11-26', 'Deposito'),
(22, 100000, 7400, '2023-11-24', 'Retiro'),
(23, 100000, 7400, '2023-11-24', 'Retiro'),
(24, 100000, 7400, '2023-11-25', 'Deposito'),
(25, 100000, 7400, '2023-11-25', 'Retiro'),
(26, 100000, 7400, '2023-11-26', 'Deposito'),
(27, 100000, 7400, '2023-11-26', 'Retiro'),
(28, 100000, 6000, '2023-11-26', 'Retiro'),
(29, 100000, 0, '2023-11-26', 'Deposito'),
(30, 100000, 5000, '2023-11-26', 'Deposito'),
(31, 100004, 1, '2023-11-11', 'Retiro'),
(32, 100004, 1, '2023-11-11', 'Retiro'),
(33, 100004, 1, '2023-11-27', 'Retiro'),
(34, 100004, 1, '2023-11-27', 'Retiro'),
(35, 100007, 10000, '2023-11-27', 'Retiro'),
(36, 100007, 10000, '2023-11-27', 'Retiro'),
(37, 100007, 2000, '2023-11-11', 'Deposito'),
(38, 100007, 2000, '2023-11-11', 'Deposito'),
(39, 100007, 2000, '2023-11-11', 'Deposito'),
(40, 100007, 2000, '2023-11-11', 'Deposito'),
(41, 100007, 2000, '2023-11-11', 'Deposito'),
(42, 100007, 2000, '2023-11-11', 'Deposito'),
(43, 100007, 2000, '2023-11-11', 'Deposito'),
(44, 100007, 2000, '2023-11-11', 'Deposito'),
(45, 100007, 2000, '2023-11-11', 'Deposito'),
(46, 100007, 2000, '2023-11-11', 'Deposito'),
(47, 100007, 2000, '2023-11-11', 'Deposito'),
(48, 100007, 2000, '2023-11-11', 'Deposito'),
(49, 100007, 2000, '2023-11-11', 'Deposito'),
(50, 100007, 2000, '2023-11-11', 'Deposito'),
(51, 100007, 2000, '2023-11-11', 'Deposito'),
(52, 100007, 2000, '2023-11-11', 'Deposito'),
(53, 100007, 2000, '2023-11-11', 'Deposito'),
(54, 100007, 2000, '2023-11-11', 'Deposito'),
(55, 100007, 2000, '2023-11-11', 'Deposito'),
(56, 100007, 2000, '2023-11-11', 'Deposito'),
(57, 100007, 2000, '2023-11-11', 'Deposito'),
(58, 100007, 2000, '2023-11-11', 'Deposito'),
(59, 100007, 2000, '2023-11-11', 'Deposito'),
(60, 100007, 2000, '2023-11-11', 'Deposito'),
(61, 100007, 2000, '2023-11-11', 'Deposito'),
(62, 100007, 2000, '2023-11-11', 'Deposito'),
(63, 100007, 10000, '2023-11-27', 'Retiro'),
(64, 100007, 10000, '2023-11-27', 'Retiro'),
(65, 100007, 10000, '2023-11-27', 'Retiro'),
(66, 100007, 10000, '2023-11-27', 'Retiro'),
(67, 100007, 10000, '2023-11-27', 'Retiro'),
(68, 100007, 10000, '2023-11-27', 'Retiro'),
(69, 100007, 10000, '2023-11-27', 'Retiro'),
(70, 100007, 10000, '2023-11-27', 'Retiro'),
(71, 100007, 10000, '2023-11-27', 'Retiro'),
(72, 100007, 10000, '2023-11-27', 'Retiro'),
(73, 100007, 10000, '2023-11-27', 'Retiro'),
(74, 100007, 10000, '2023-11-27', 'Retiro'),
(75, 100007, 2000, '2023-11-11', 'Deposito'),
(76, 100007, 2000, '2023-11-11', 'Deposito'),
(77, 100007, 2000, '2023-11-11', 'Deposito'),
(78, 100007, 10000, '2023-11-27', 'Retiro'),
(79, 100007, 2000, '2023-11-11', 'Deposito'),
(80, 100007, 2000, '2023-11-11', 'Deposito'),
(81, 100007, 2000, '2023-11-11', 'Deposito'),
(82, 100007, 2000, '2023-11-11', 'Deposito'),
(83, 100007, 2000, '2023-11-11', 'Deposito'),
(84, 100007, 2000, '2023-11-11', 'Deposito'),
(85, 100007, 2000, '2023-11-11', 'Deposito'),
(86, 100007, 2000, '2023-11-11', 'Deposito'),
(87, 100007, 2000, '2023-11-11', 'Deposito'),
(88, 100007, 2000, '2023-11-11', 'Deposito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuaio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuaio`, `nombre`, `email`, `clave`, `rol`) VALUES
(1, 'supervisor', 'supervisor@gmail.com', 'supervisor', 'supervisor'),
(2, 'operador', 'operador@gmail.com', 'operador', 'operador'),
(3, 'cajero', 'cajero@gmail.com', 'cajero', 'cajero');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajuste`
--
ALTER TABLE `ajuste`
  ADD PRIMARY KEY (`idAjuste`),
  ADD KEY `idMovimientoAjustado` (`idMovimientoAjustado`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`nroCuenta`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idLog`);

--
-- Indices de la tabla `logtransacciones`
--
ALTER TABLE `logtransacciones`
  ADD PRIMARY KEY (`idLogTransaccion`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`idMovimiento`),
  ADD KEY `nroCuenta` (`nroCuenta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuaio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajuste`
--
ALTER TABLE `ajuste`
  MODIFY `idAjuste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `nroCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `logtransacciones`
--
ALTER TABLE `logtransacciones`
  MODIFY `idLogTransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `idMovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuaio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ajuste`
--
ALTER TABLE `ajuste`
  ADD CONSTRAINT `ajuste_ibfk_1` FOREIGN KEY (`idMovimientoAjustado`) REFERENCES `movimiento` (`idMovimiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`nroCuenta`) REFERENCES `cuenta` (`nroCuenta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
