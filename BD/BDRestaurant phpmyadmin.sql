-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2021 a las 08:08:36
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdrestaurant`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `codCaja` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`codCaja`, `nombre`) VALUES
(1, 'Caja A'),
(2, 'Caja B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `codCategoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codCategoria`, `nombre`, `estado`) VALUES
(1, 'Carnes', 1),
(2, 'Entradas', 1),
(3, 'Pescados', 1),
(4, 'Postres', 1),
(5, 'Bebidas Alcohólicas', 1),
(6, 'Ensaladas', 1),
(7, 'Frituras', 1),
(8, 'Pizzas', 1),
(9, 'Bebidas Heladas', 1),
(10, 'Criolla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `DNI` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`DNI`, `nombres`, `apellidos`, `direccion`, `telefono`, `correo`) VALUES
(12341234, 'Diego Ernesto', 'Vigo Briones', NULL, NULL, NULL),
(24425856, 'Martin Alejandro', 'Maslucán Rojas', NULL, NULL, NULL),
(33445566, 'Luz Clarita', 'Vizcarra Cornejo', NULL, NULL, NULL),
(65418987, 'Becky Angela', 'Diaz Valdez', NULL, NULL, NULL),
(71208489, 'Yohny Miguel', 'Gonzales Alaña', 'San Isidro Calle cristal 362 Interior A5', '944437008', 'degolego2000@gmail.com'),
(72208489, 'Juan Julio', 'Briones Ordoñez', NULL, NULL, NULL),
(79643453, 'Erik Juan', 'Rodriguez Valdivia', NULL, NULL, NULL),
(87976453, 'Gustavo Adrian', 'Cerati Clark', NULL, NULL, NULL),
(722615489, 'Winny Valeria', 'Zavaleta Cortez', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `codDetalleOrden` int(11) NOT NULL,
  `codOrden` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `codProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_orden`
--

INSERT INTO `detalle_orden` (`codDetalleOrden`, `codOrden`, `cantidad`, `precio`, `codProducto`) VALUES
(39, 41, 3, 4, 3),
(40, 41, 2, 8, 1),
(41, 41, 1, 7, 9),
(42, 42, 1, 7, 12),
(43, 42, 1, 8, 8),
(44, 43, 2, 15, 7),
(45, 43, 2, 7, 9),
(46, 43, 2, 4, 5),
(47, 44, 1, 8, 8),
(48, 44, 1, 6, 6),
(49, 44, 1, 7, 12),
(50, 45, 1, 18, 4),
(51, 45, 1, 8, 8),
(52, 46, 1, 8, 8),
(53, 46, 1, 7, 12),
(54, 47, 1, 4, 5),
(55, 47, 3, 7, 18),
(56, 48, 1, 18, 4),
(57, 48, 1, 15, 10),
(58, 49, 2, 4, 3),
(59, 49, 1, 18, 4),
(60, 50, 1, 2, 16),
(61, 50, 1, 3, 20),
(62, 50, 1, 8, 14),
(63, 50, 1, 8, 15),
(64, 51, 1, 4, 3),
(65, 52, 1, 8, 8),
(66, 53, 1, 7, 8),
(67, 53, 1, 4, 3),
(68, 53, 1, 6, 13),
(69, 53, 1, 7, 12),
(70, 53, 1, 6, 6),
(71, 54, 1, 7, 8),
(72, 55, 3, 7, 8),
(73, 56, 1, 15, 10),
(74, 57, 1, 7, 9),
(75, 58, 1, 15, 7),
(83, 59, 1, 4, 3),
(84, 59, 3, 7, 12),
(85, 59, 2, 18, 4),
(86, 60, 1, 4, 3),
(87, 60, 1, 7, 9),
(88, 60, 3, 8, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `codEmpleado` int(11) NOT NULL,
  `codTipoEmpleado` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `fechaContrato` date DEFAULT NULL,
  `fechaFinContrato` date DEFAULT NULL,
  `activo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`codEmpleado`, `codTipoEmpleado`, `nombres`, `apellidos`, `telefono`, `fechaContrato`, `fechaFinContrato`, `activo`, `idUsuario`) VALUES
(0, 1, 'ADMIN', 'ADMIN', '123456123', '2020-12-09', '2021-05-07', 1, 1),
(1, 1, 'Felix Joel', 'Gutierrez Uriol', '974364868', '2020-09-08', '2021-06-17', 1, 2),
(2, 1, 'Diego Ernesto', 'Vigo Briones', '297844', '2021-02-01', '2021-06-12', 1, 4),
(3, 2, 'Maricielo', 'Rodriguez', '125123346', '2021-02-01', '2021-06-05', 1, 3),
(6, 2, 'Elastaasd', 'as', '944437008', '2021-02-16', NULL, 1, 9),
(8, 1, 'Juan Julio', 'Vigo Briones', '944437008', '2021-02-16', NULL, 0, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `RUC` varchar(14) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nombreResponsable` varchar(200) NOT NULL,
  `telefonoResponsable` varchar(100) NOT NULL,
  `correoResponsable` varchar(100) NOT NULL,
  `nombreMoneda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`RUC`, `nombre`, `direccion`, `telefono`, `correo`, `nombreResponsable`, `telefonoResponsable`, `correoResponsable`, `nombreMoneda`) VALUES
('75364591256', 'La casa de mi AMÁ', 'Av América Sur 1943, Trujillo, Perú', '125753', 'pedidos@lacasademiama.com', 'Renzo Franco Valladolid', '944437008', 'rf@unitru.edu.pe', 'Sol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_orden`
--

CREATE TABLE `estado_orden` (
  `codEstado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_orden`
--

INSERT INTO `estado_orden` (`codEstado`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Preparando'),
(3, 'Preparada'),
(4, 'Entregada'),
(5, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_pago`
--

CREATE TABLE `medio_pago` (
  `codMedioPago` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medio_pago`
--

INSERT INTO `medio_pago` (`codMedioPago`, `nombre`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `codMesa` int(11) NOT NULL,
  `codSala` int(11) NOT NULL,
  `nroSillas` int(11) NOT NULL,
  `nroEnSala` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`codMesa`, `codSala`, `nroSillas`, `nroEnSala`, `estado`) VALUES
(1, 1, 4, 1, 1),
(2, 1, 4, 2, 1),
(3, 5, 3, 7, 0),
(4, 1, 4, 3, 1),
(5, 1, 4, 4, 1),
(6, 1, 6, 5, 1),
(7, 1, 4, 6, 1),
(8, 2, 4, 1, 1),
(9, 2, 5, 2, 1),
(13, 1, 7, 7, 1),
(14, 1, 2, 8, 1),
(23, 5, 2, 1, 1),
(24, 5, 4, 2, 1),
(25, 5, 5, 3, 1),
(26, 5, 6, 4, 1),
(27, 5, 1, 5, 1),
(28, 5, 2, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `codOrden` int(11) NOT NULL,
  `codMesa` int(11) NOT NULL,
  `DNI` varchar(20) DEFAULT NULL,
  `codEmpleadoMesero` int(11) NOT NULL,
  `codEstado` int(11) NOT NULL,
  `observaciones` varchar(600) DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `codMedioPago` int(11) DEFAULT NULL,
  `codTipoPago` int(11) DEFAULT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `fechaHoraPago` datetime DEFAULT NULL,
  `codTipoCDP` int(11) DEFAULT NULL,
  `codRegistroCaja` int(11) DEFAULT NULL,
  `costoTotal` float DEFAULT NULL,
  `montoPagado` float DEFAULT NULL,
  `cambioDevuelto` float DEFAULT NULL,
  `estadoPago` int(11) NOT NULL,
  `nroCDP` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`codOrden`, `codMesa`, `DNI`, `codEmpleadoMesero`, `codEstado`, `observaciones`, `descuento`, `codMedioPago`, `codTipoPago`, `fechaHoraCreacion`, `fechaHoraPago`, `codTipoCDP`, `codRegistroCaja`, `costoTotal`, `montoPagado`, `cambioDevuelto`, `estadoPago`, `nroCDP`) VALUES
(41, 3, '33445566', 0, 5, 'Con agregado de mayonesa', NULL, 1, 1, '2021-02-16 21:20:11', '2021-02-16 21:50:08', 1, 16, 35, 60, 25, 1, '001-000009'),
(42, 6, '87976453', 0, 5, 'Presa encuentro', NULL, 1, 1, '2021-02-16 21:20:45', '2021-02-16 21:25:39', 1, 16, 15, 20, 5, 1, '001-000005'),
(43, 9, '71208489', 0, 5, 'Ensalada sin tomate', NULL, 1, 1, '2021-02-16 21:21:19', '2021-02-16 21:24:23', 2, 16, 52, 60, 8, 1, '003-000006'),
(44, 9, '87976453', 0, 5, 'yyf', NULL, 1, 1, '2021-02-16 21:21:28', '2021-02-16 21:24:49', 1, 16, 21, NULL, NULL, 1, NULL),
(45, 2, '71208489', 0, 5, 'Vino en copas', NULL, 1, 1, '2021-02-16 21:22:18', '2021-02-16 21:43:43', 1, 16, 26, 30, 4, 1, '001-000008'),
(46, 5, '12341234', 0, 5, 'Sopa con aji', NULL, 1, 1, '2021-02-16 21:22:58', '2021-02-16 21:24:10', 1, 16, 15, 20, 5, 1, '001-000003'),
(47, 7, '33445566', 0, 5, 'Que este bien frito', NULL, 2, 2, '2021-02-16 21:23:25', '2021-02-16 21:25:20', 1, 16, 25, 30, 5, 1, '001-000004'),
(48, 4, '24425856', 0, 5, 'Con mas queso', NULL, 2, 1, '2021-02-16 21:23:57', '2021-02-16 21:36:58', 1, 16, 33, 40, 7, 1, '001-000006'),
(49, 1, '65418987', 0, 5, 'Que sea buena marca de vino', NULL, 2, 2, '2021-02-16 21:24:26', '2021-02-16 21:43:02', 1, 16, 26, 30, 4, 1, '001-000007'),
(50, 8, '65418987', 0, 5, 'Frituras bien fritas', NULL, 1, 1, '2021-02-16 21:24:56', '2021-02-16 21:43:24', 2, 16, 21, 30, 9, 1, '003-000007'),
(51, 2, '12341234', 0, 5, '', NULL, 1, 1, '2021-02-16 21:58:37', '2021-02-16 22:35:07', 1, 16, 4, 8, 4, 1, '001-000011'),
(52, 1, '722615489', 0, 5, '', NULL, 1, 1, '2021-02-16 22:04:45', '2021-02-16 22:25:54', 1, 16, 8, 8, NULL, 1, NULL),
(53, 4, '71208489', 0, 5, '', NULL, 1, 1, '2021-02-16 22:36:46', '2021-02-16 22:38:18', 2, 16, 30, 30, 0, 1, '003-000008'),
(54, 5, '12341234', 0, 5, '', NULL, 1, 1, '2021-02-16 22:38:55', '2021-02-16 22:45:56', 1, 16, 7, 10, 3, 1, '001-000012'),
(55, 3, '79643453', 0, 4, '', NULL, 2, 1, '2021-02-16 22:48:41', '2021-02-16 22:53:50', 2, 16, 7, 10, 3, 1, '003-000009'),
(56, 6, '71208489', 0, 5, '', NULL, 1, 1, '2021-02-16 23:01:53', '2021-02-17 01:52:09', 2, 23, 15, 20, 5, 1, '003-000010'),
(57, 7, NULL, 0, 5, 'Harta sal', NULL, NULL, NULL, '2021-02-16 23:02:29', NULL, NULL, NULL, 7, NULL, NULL, 1, NULL),
(58, 8, '65418987', 0, 5, 'Poca mayonesa', NULL, 1, 1, '2021-02-16 23:03:20', '2021-02-17 01:51:50', 1, 23, 15, 20, 5, 1, '001-000014'),
(59, 9, '12341234', 0, 5, 'xxxx', NULL, 1, 1, '2021-02-16 23:04:00', '2021-02-17 01:51:59', 1, 23, 17, 20, 3, 1, '001-000015'),
(60, 4, '24425856', 0, 5, '', NULL, 1, 1, '2021-02-16 23:05:18', '2021-02-17 00:20:02', 1, 23, 4, 5, 1, 1, '001-000013');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `codParametro` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `serie` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`codParametro`, `nombre`, `serie`, `valor`) VALUES
(1, 'boleta', 1, 16),
(2, 'factura', 3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codProducto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `codCategoria` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `precioActual` float NOT NULL,
  `menuDeHoy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codProducto`, `nombre`, `descripcion`, `codCategoria`, `estado`, `precioActual`, `menuDeHoy`) VALUES
(1, 'Lomito Saltado', 'El lomo saltado es un plato típico de la gastronomía del Perú consistente en carne de res, arroz cocido y papas fritas. Es uno de los platos más consumidos popularmente en el Perú.', 10, 1, 8, 1),
(2, 'Jugo Mixto', 'El jugo surtido es un clásico en las juguerías de los mercados. Estas bebidas, también, forman parte del desayuno convencional de muchos peruanos.', 9, 1, 1.5, 1),
(3, 'Papa a la Huancaína', 'La papa a la huancaína es un plato típico de la ciudad de Huancayo. Se difundió a diferentes regiones del Perú, y es uno de los productos gastronómicos más populares y representativos de este país', 2, 1, 4, 1),
(4, 'Vino Tinto', 'Tipo de vino procedente mayormente de mostos de uvas tintas, con la elaboración pertinente para conseguir la difusión de la materia colorante que contienen los hollejos de la uva.', 5, 1, 18, 1),
(5, 'Pie de Limon', 'Tarta formada por una base de masa quebrada u hojaldre que se rellena con crema de limón.\r\nEsta tarta a menudo se complementa con un merengue, lo que resulta en tarta de limón con merengue.', 4, 1, 4, 1),
(6, 'Ceviche de Conchas negras', 'Uno de los ceviches peruanos más populares dentro de la población de ese país. Además de tener una exquisita apariencia y un particular sabor.', 2, 1, 6, 1),
(7, 'Ensalada Rusa', 'Una mezcla de patata, guisante y zanahoria cocidos, mayonesa y a veces pimiento rojo asado, aceitunas, huevo y/o atún. Generalmente se sirven como primer plato, aunque algunas, como la ensaladilla de huevos se suelen usar como relleno para sándwich.', 6, 1, 15, 1),
(8, 'Porción de Pollo Broaster', '5 piezas de pollo broaster\r\n200g', 7, 1, 7, 1),
(9, 'Toyo Apanado', 'Arroz, Tollo empanizado a punto de milanesa y una pequeña porción de ensalada.', 3, 1, 7, 1),
(10, 'Pizza Americana Familiar', 'Masa de pan artesanal, queso mozzarella , salsa de tomate y pedazos de jamón.', 8, 1, 15, 1),
(11, 'Frito de Alpaca', 'Suele hacerse como filete acompañado de aros de cebolla empanizados o en brochetas con vegetales en forma de estofado.', 1, 1, 10, 1),
(12, 'Sopa de casa', 'Deliciosa sopa con verduras y pollo sancochado.', 2, 1, 7, 1),
(13, 'Ensalada de atún', 'Rica ensalada con papa y porciones de atún.', 2, 1, 6, 1),
(14, 'Chuleta de Cerdo', 'Rica chuleta cerdo acompañada de crocantes papas fritas y arroz blanco.', 1, 1, 8, 1),
(15, 'Gallina Guisada', 'Deliciosa porción de gallina guisada acompañada de papa sancochada, arroz blanco y ensalada.', 1, 1, 8, 1),
(16, 'Chicha morada', 'Exquisita chicha del mejor maíz morado.', 9, 1, 2, 1),
(17, 'Pato Guisado', 'Rico pato guisado acompañado de yuca sancochada y frijoles.', 1, 1, 8, 1),
(18, 'Pescado frito', 'Rica porción de pescado frito acompañado de yuca y frijoles.', 3, 1, 7, 1),
(19, 'Asado de Res', 'Rica porción de asado de res acompañado de puré de papas y arroz blanco.', 1, 1, 7, 1),
(20, 'Jugo de maracuyá', 'Dulce jugo de pulpa de maracuyá.', 9, 1, 3, 1),
(21, 'Cebada', 'Rica agua de cebada, puede incluir hielo.', 9, 1, 2, 1),
(22, 'Arroz con Pollo', 'Delicioso platillo de arroz con espinaca, pollo frito y ensalada.', 10, 1, 7, 1),
(23, 'Cabrito', 'Delicioso platillo de cabrito guisado acompañado de frejoles y arroz.', 1, 1, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_caja`
--

CREATE TABLE `registro_caja` (
  `codRegistroCaja` int(11) NOT NULL,
  `fechaHoraApertura` datetime NOT NULL,
  `fechaHoraCierre` datetime DEFAULT NULL,
  `saldoApertura` float NOT NULL,
  `saldoCierre` float DEFAULT NULL,
  `diferencia` float DEFAULT NULL,
  `codCaja` int(11) NOT NULL,
  `codEmpleadoCajero` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_caja`
--

INSERT INTO `registro_caja` (`codRegistroCaja`, `fechaHoraApertura`, `fechaHoraCierre`, `saldoApertura`, `saldoCierre`, `diferencia`, `codCaja`, `codEmpleadoCajero`, `estado`) VALUES
(16, '2021-02-16 21:18:02', '2021-02-17 00:16:27', 100, 425, 0, 1, 3, 0),
(22, '2021-02-16 23:04:01', NULL, 1000, NULL, NULL, 1, 0, 1),
(23, '2021-02-17 00:19:48', NULL, 100, NULL, NULL, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `codSala` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`codSala`, `nombre`) VALUES
(1, 'PRINCIPAL'),
(2, 'SECUNDARIA'),
(5, 'COMUN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cdp`
--

CREATE TABLE `tipo_cdp` (
  `codTipoCDP` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_cdp`
--

INSERT INTO `tipo_cdp` (`codTipoCDP`, `nombre`) VALUES
(1, 'Boleta'),
(2, 'Factura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `codTipoEmpleado` int(11) NOT NULL,
  `nombrePuesto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`codTipoEmpleado`, `nombrePuesto`) VALUES
(1, 'Cocinero'),
(2, 'Cajero'),
(3, 'Mesero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `codTipoPago` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`codTipoPago`, `nombre`) VALUES
(1, 'Directo'),
(2, 'Cuotas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL),
(2, 'felix', 'fguriol@gmail.com', NULL, '$2y$10$ZSRodpqaRtflaZr9AkuU4.R/9krYnWbUlQ6VgFZer3B4d1FZZY2sy', NULL, NULL, '2021-02-17 08:23:27'),
(3, 'mrodrig', 'adsdsaads@gmail.com', NULL, '$2y$10$/R.cy3l53yS3X0LQakLoBej4rNdmnesygRDPlQK6S76mDr/rpvyGi', NULL, NULL, NULL),
(4, 'vigo', 'dvigo@unitru.edu.pe', NULL, '$2y$10$/R.cy3l53yS3X0LQakLoBej4rNdmnesygRDPlQK6S76mDr/rpvyGi', NULL, NULL, NULL),
(12, 'julio', 'julio@gmail.com', NULL, '$2y$10$/HSNz4j3rdoZDszs8EJ3LuCPyRDZQqgnYZ1df6mbhwAAV9Jh5gFIq', NULL, '2021-02-16 08:01:13', '2021-02-16 08:35:24'),
(13, 'david', 'david@gmail.com', NULL, '$2y$10$rF7kh19tXLbzqalUqHNLSufnizGqGNHwCF4K1hOAMtWwbMGwucsh.', NULL, '2021-02-16 08:40:42', '2021-02-17 08:14:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`codCaja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`codDetalleOrden`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`codEmpleado`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`RUC`);

--
-- Indices de la tabla `estado_orden`
--
ALTER TABLE `estado_orden`
  ADD PRIMARY KEY (`codEstado`);

--
-- Indices de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  ADD PRIMARY KEY (`codMedioPago`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`codMesa`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`codOrden`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`codParametro`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codProducto`);

--
-- Indices de la tabla `registro_caja`
--
ALTER TABLE `registro_caja`
  ADD PRIMARY KEY (`codRegistroCaja`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`codSala`);

--
-- Indices de la tabla `tipo_cdp`
--
ALTER TABLE `tipo_cdp`
  ADD PRIMARY KEY (`codTipoCDP`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`codTipoEmpleado`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`codTipoPago`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `codCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `codDetalleOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `codEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado_orden`
--
ALTER TABLE `estado_orden`
  MODIFY `codEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  MODIFY `codMedioPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `codMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `codOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `codParametro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `registro_caja`
--
ALTER TABLE `registro_caja`
  MODIFY `codRegistroCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `codSala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_cdp`
--
ALTER TABLE `tipo_cdp`
  MODIFY `codTipoCDP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `codTipoEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `codTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
