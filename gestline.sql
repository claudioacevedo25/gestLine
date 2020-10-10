-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2020 a las 16:41:59
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
-- Base de datos: `gestline`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaBill` (IN `mes` INT, IN `anx` INT)  BEGIN
 SELECT f.id, f.fecha, concat_ws(' , ',u.nombre, u.apellido) as 'Nombre', SUM(d.importe) as 'Total'
 FROM facturas f JOIN users u on f.id_user = u.id
 JOIN detalles d on d.id_factura=f.id
 where f.estado = 1 and MONTH(f.fecha) = mes and YEAR(f.fecha)= anx
GROUP BY f.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaBill_NOW` ()  BEGIN
 SELECT f.id, f.fecha, concat_ws(' , ',u.nombre, u.apellido) as 'Nombre', SUM(d.importe) as 'Total'
 FROM facturas f JOIN users u on f.id_user = u.id
 JOIN detalles d on d.id_factura=f.id
 where f.estado = 1 and f.fecha = CURDATE()
GROUP BY f.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaBill_PorANX` ()  BEGIN
 SELECT f.id, f.fecha, concat_ws(' , ',u.nombre, u.apellido) as 'Nombre', SUM(d.importe) as 'Total'
 FROM facturas f JOIN users u on f.id_user = u.id
 JOIN detalles d on d.id_factura=f.id
 where f.estado = 1 and YEAR(f.fecha) = YEAR(CURDATE()) 
GROUP BY f.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaBill_PorFecha` (IN `fecha` DATE)  BEGIN
 SELECT f.id, f.fecha, concat_ws(' , ',u.nombre, u.apellido) as 'Nombre', SUM(d.importe) as 'Total'
 FROM facturas f JOIN users u on f.id_user = u.id
 JOIN detalles d on d.id_factura=f.id
 where f.estado = 1 and f.fecha = fecha
GROUP BY f.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detalleFactura` (IN `id` INT)  BEGIN
SELECT f.id,d.id_articulo,a.nombre,a.observaciones ,d.precio_unitario,d.cantidad,d.importe FROM facturas f JOIN detalles d on d.id_factura=f.id JOIN articulos a on a.id = d.id_articulo where f.estado = 1 and f.id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizarFactura` ()  BEGIN
	SET @id_factura = ( SELECT MAX(id) FROM facturas);

UPDATE facturas f
set f.estado = 1
WHERE f.id = @id_factura;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregarDetalleFactura` (IN `id_articulo` INT, IN `qty` INT)  BEGIN
SET @id_factura = ( SELECT MAX(id) FROM facturas); 
SET @p_u = (SELECT a.precio_venta from articulos a WHERE a.id = id_articulo);
SET @imp = (@p_u*qty);
INSERT INTO detalles (id_articulo, id_factura, precio_unitario, importe, cantidad ) VALUES (id_articulo, @id_factura, @p_u,@imp, qty);
UPDATE articulos SET stock = stock-qty 
WHERE id = id_articulo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertarFactura` (IN `id` INT)  BEGIN 
 INSERT INTO facturas (id_user) VALUES (id);
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_costo` double(8,2) NOT NULL,
  `rentabilidad` int(11) DEFAULT NULL,
  `precio_venta` double(8,2) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_proveedor` int(255) NOT NULL,
  `id_categoria` int(255) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `precio_costo`, `rentabilidad`, `precio_venta`, `stock`, `qty`, `img`, `observaciones`, `id_proveedor`, `id_categoria`, `estado`, `created_at`, `updated_at`) VALUES
(2, 'GALLETAS NEVARES BOQUITAS DE LIMON X 45 GR.', 14.00, 35, 18.90, 10, 5, 'O6pVb2OPfAnR2WrTg1stdHMjsUcr5qSY7PbE2Sos.jpeg', 'GALLETAS NEVARES BOQUITAS DE LIMON X 45 GR.', 4, 13, 1, NULL, NULL),
(3, 'CEREAL KELLOGGS ZUCARITAS X 220 GR.', 131.00, 30, 170.30, 20, 1, 'l4WpdLITqz978mcm8KksIHBChNWsdBiuP81pLYvH.jpeg', 'CEREAL KELLOGGS ZUCARITAS X 220 GR.', 4, 13, 1, NULL, NULL),
(4, 'CEREAL KELLOGGS CORN FLAKES X 160 GR.', 106.00, 30, 137.80, 20, 2, 'm2wiMiTAbwepqqy8vNF3wIJjHbU0kYQTEGnXplH8.jpeg', 'CEREAL KELLOGGS CORN FLAKES X 160 GR.', 4, 13, 1, NULL, NULL),
(5, 'CEREAL NESQUIK INTEGRAL X 230 GR.', 190.00, 36, 258.40, 10, 1, '2guQGG6750U89QJTFxzabzvpBqvqC86h5fP3qKTJ.jpeg', 'CEREAL NESQUIK INTEGRAL X 230 GR.', 4, 13, 1, NULL, NULL),
(6, 'ACEITE DE GIRASOL CAÑUELAS X 1.5 LT.', 157.00, 29, 202.53, 50, 0, 'PpNUrv622ekHDcl4icwYoAvTmV3V20uZ0hlZFYol.jpeg', 'ACEITE DE GIRASOL CAÑUELAS X 1.5 LT.', 4, 13, 1, NULL, NULL),
(7, 'ACEITE DE OLIVA COCINERO COMUN X 250 ML.', 156.00, 35, 210.60, 30, 1, 'FpaOenDZBBKhtyRWD47aW1mKPHpJbFXFFmgQjOgT.jpeg', 'ACEITE DE OLIVA COCINERO COMUN X 250 ML.', 4, 13, 1, NULL, NULL),
(8, 'JABON EN POLVO ALA MATIC CLASICO X 400 GR.', 112.00, 40, 156.80, 20, 3, 'e03UNatkRfGV8lvJoRK7hQ3IhTSSIp5ZP38Pvh5R.jpeg', 'JABON EN POLVO ALA MATIC CLASICO X 400 GR.', 5, 15, 1, NULL, NULL),
(9, 'CERVEZA IMPERIAL AMBER LAGER LATA X 473 CC. PACK X 6 UN.', 450.00, 15, 517.50, 15, 1, 'MJcJlNIKVEMxtqfzowCN4gyPxLljcsK80o3nO1rv.jpeg', 'CERVEZA IMPERIAL AMBER LAGER LATA X 473 CC. PACK X 6 UN.', 6, 14, 1, NULL, NULL),
(10, 'YOGUR SANCOR YOGS BEBIBLE ENTERO DURAZNO SACHET X 900 GR.', 79.00, 20, 94.80, 13, 1, '7NEP9Nl1bCNTJ3EDyLucsuCWYUWoWAs1qEtc380a.jpeg', 'YOGUR SANCOR YOGS BEBIBLE ENTERO DURAZNO SACHET X 900 GR.', 7, 16, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_cart`
--

CREATE TABLE `articulo_cart` (
  `id` int(255) NOT NULL,
  `articulo_id` int(255) NOT NULL,
  `cart_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulo_cart`
--

INSERT INTO `articulo_cart` (`id`, `articulo_id`, `cart_id`, `created_at`, `updated_at`) VALUES
(1, 9, 2, NULL, NULL),
(2, 8, 2, NULL, NULL),
(3, 10, 3, NULL, NULL),
(4, 7, 3, NULL, NULL),
(5, 3, 4, NULL, NULL),
(6, 9, 4, NULL, NULL),
(7, 5, 5, NULL, NULL),
(8, 3, 5, NULL, NULL),
(9, 2, 6, NULL, NULL),
(10, 8, 6, NULL, NULL),
(11, 4, 6, NULL, NULL),
(12, 9, 6, NULL, NULL),
(13, 7, 7, NULL, NULL),
(14, 5, 7, NULL, NULL),
(15, 2, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carts`
--

CREATE TABLE `carts` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carts`
--

INSERT INTO `carts` (`id`, `id_user`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, '2020-10-01 08:42:30', '2020-10-01 08:42:30'),
(2, 2, NULL, '2020-10-01 08:48:06', '2020-10-01 08:48:06'),
(3, 2, NULL, '2020-10-01 08:48:39', '2020-10-01 08:48:39'),
(4, 2, NULL, '2020-10-01 09:15:38', '2020-10-01 09:15:38'),
(5, 2, NULL, '2020-10-01 18:53:32', '2020-10-01 18:53:32'),
(6, 2, NULL, '2020-10-02 04:35:22', '2020-10-02 04:35:22'),
(7, 2, NULL, '2020-10-02 05:13:34', '2020-10-02 05:13:34'),
(8, 2, NULL, '2020-10-07 16:23:58', '2020-10-07 16:23:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `detalle`, `created_at`, `updated_at`) VALUES
(13, 'ALMACEN', '2020-10-01 04:59:27', '2020-10-01 04:59:27'),
(14, 'BEBIDAS', '2020-10-01 04:59:27', '2020-10-01 04:59:27'),
(15, 'LIMPIEZA', '2020-10-01 05:00:14', '2020-10-01 05:00:14'),
(16, 'LACTEOS', '2020-10-01 05:00:14', '2020-10-01 05:00:14'),
(17, 'DESCARTABLES', '2020-10-01 05:00:14', '2020-10-01 05:00:14'),
(18, 'FIAMBRERIA', '2020-10-01 05:00:14', '2020-10-01 05:00:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id` int(255) NOT NULL,
  `id_factura` int(255) NOT NULL,
  `id_articulo` int(255) NOT NULL,
  `precio_unitario` double(8,2) NOT NULL,
  `importe` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id`, `id_factura`, `id_articulo`, `precio_unitario`, `importe`, `cantidad`, `created_at`, `updated_at`) VALUES
(22, 10, 2, 18.90, 37.8, 2, '2020-10-02 01:58:13', NULL),
(23, 10, 8, 156.80, 470.4, 3, '2020-10-02 01:58:13', NULL),
(24, 10, 4, 137.80, 275.6, 2, '2020-10-02 01:58:13', NULL),
(25, 10, 9, 517.50, 517.5, 1, '2020-10-02 01:58:13', NULL),
(26, 11, 7, 210.60, 210.6, 1, '2020-10-02 02:13:46', NULL),
(27, 11, 5, 258.40, 258.4, 1, '2020-10-02 02:13:46', NULL),
(28, 12, 2, 18.90, 94.5, 5, '2020-10-07 13:28:58', NULL),
(29, 13, 5, 123.00, 123, 1, '2020-09-21 16:05:21', NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `facturadoporanx`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `facturadoporanx` (
`Anx` int(4)
,`Importe` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `facturadopormes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `facturadopormes` (
`Mes` varchar(9)
,`Total` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(255) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `id_user` int(255) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `fecha`, `id_user`, `estado`, `created_at`, `updated_at`) VALUES
(10, '2020-10-01', 2, 1, NULL, NULL),
(11, '2020-10-01', 2, 1, NULL, NULL),
(12, '2020-10-07', 2, 1, NULL, NULL),
(13, '2020-09-21', 2, 1, '2020-09-21 16:03:51', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_09_30_154114_create_rubros_table', 1),
(4, '2019_09_30_155458_create_categorias_table', 1),
(5, '2020_10_02_153201_create_sucursales_table', 1),
(6, '2020_10_02_164431_create_proveedores_table', 1),
(7, '2020_10_04_000000_create_users_table', 1),
(8, '2020_10_04_155549_create_facturas_table', 1),
(9, '2020_10_04_155827_create_carts_table', 1),
(10, '2020_10_05_160054_create_cart_item_table', 1),
(11, '2020_10_05_163333_create_detalles_table', 1),
(12, '2020_10_06_165841_create_articulos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(255) NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `id_rubro` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `direccion`, `telefono`, `email`, `estado`, `id_rubro`, `created_at`, `updated_at`) VALUES
(1, 'PEPSICO', 'Av. Antartida s/n', 153326548, 'pepsico@pepsico.com', 1, 2, NULL, NULL),
(2, 'COCA COLA', 'Rementier 1546', 12345897, 'cocacola@coca.com', 1, 2, NULL, NULL),
(3, 'ARCOR', 'Ruta 55 km 55', 235156487, 'arcor@admin.com', 1, 3, NULL, NULL),
(4, 'LAVMAX', 'Los Chipres 152', 12345587, 'max@max.com', 1, 1, NULL, NULL),
(5, 'CLEANALL', 'Las Magnolias 456', 156457896, 'magnolias@cleanall.com', 1, 1, NULL, NULL),
(6, 'QUILMES', 'Cienagas', 23564578, 'quilmes@quilmes.com', 1, 2, NULL, NULL),
(7, 'LACPRODAN', 'Av. Las Malvinas km 56', 154568978, 'lacprodan@admin.com', 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `registroclientesmes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `registroclientesmes` (
`Mes` varchar(9)
,`Total` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(255) NOT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `detalle`, `created_at`, `updated_at`) VALUES
(1, 'MULTIRUBRO', NULL, NULL),
(2, 'BEBIDAS', NULL, NULL),
(3, 'GOLOSINAS', NULL, NULL),
(4, 'BAZAR', NULL, NULL),
(5, 'ALMACEN', NULL, NULL),
(6, 'LACTEOS', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `stockmenor_veinte`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `stockmenor_veinte` (
`Id` int(255)
,`Nombre` varchar(255)
,`Stock` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(255) NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `razon_social`, `direccion`, `telefono`, `email`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'GestMax', 'Colon 1500', 4666569, 'gestmax@gestline.com', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `topcinco`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `topcinco` (
`id_articulo` int(255)
,`Nombre` varchar(255)
,`Cantidad` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `top_clientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `top_clientes` (
`Id` int(255)
,`Nombre` varchar(512)
,`Cantidad_facturas` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ultimafactura`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ultimafactura` (
`ID` int(255)
,`Nombre` varchar(512)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CLIENT_ROLE',
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `id_sucursal` int(255) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `dni`, `direccion`, `email`, `email_verified_at`, `password`, `foto`, `fecha_nacimiento`, `role`, `estado`, `id_sucursal`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maxi', 'Acevedo', 32107572, 'Buchard', 'claudioacevedo25@gmail.com', NULL, '$2y$10$MsOMK34d6Jsi8monmPuG8Om9yNHfut7IxG/u6hV87KFgIxAK.eoX6', 'm3Wl2Kfkrh9eHxw8UMF0R6rxL0tuWToxQwi5o2dp.jpeg', '1986-12-23', 'ADMIN_ROLE', 1, 1, 'Y0Pxu1LKGXbPmicQ9SeHctmCCN3WNngU3jZRlQIDlujrSIybK9TFNiOT75Pv', '2020-10-01 08:06:45', '2020-10-01 08:20:26'),
(2, 'Pedro', 'Capo', NULL, NULL, 'pedrocapo@gmail.com', NULL, '$2y$10$FmFGkmmUJd6YkdDnQDCKmuMQ1tAXs2edvsg79NglBZpb2Lu0mzBAy', NULL, NULL, 'CLIENT_ROLE', 1, NULL, 'MFvnbDH7ymiQrPRJFeoMRRnYsxDS4bNghF5qxs5gAjtcr9YDBxHY8ZltIwaR', '2020-10-01 08:41:43', '2020-10-01 08:41:43');

-- --------------------------------------------------------

--
-- Estructura para la vista `facturadoporanx`
--
DROP TABLE IF EXISTS `facturadoporanx`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `facturadoporanx`  AS  select year(`f`.`fecha`) AS `Anx`,truncate(sum(`d`.`importe`),2) AS `Importe` from ((`facturas` `f` join `detalles` `d` on(`f`.`id` = `d`.`id_factura`)) join `users` `u` on(`u`.`id` = `f`.`id_user`)) group by year(`f`.`fecha`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `facturadopormes`
--
DROP TABLE IF EXISTS `facturadopormes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `facturadopormes`  AS  select monthname(`f`.`fecha`) AS `Mes`,truncate(sum(`d`.`importe`),2) AS `Total` from ((`facturas` `f` join `detalles` `d` on(`f`.`id` = `d`.`id_factura`)) join `users` `u` on(`u`.`id` = `f`.`id_user`)) group by monthname(`f`.`fecha`) order by 1 desc ;

-- --------------------------------------------------------

--
-- Estructura para la vista `registroclientesmes`
--
DROP TABLE IF EXISTS `registroclientesmes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `registroclientesmes`  AS  select monthname(`u`.`created_at`) AS `Mes`,count(`u`.`id`) AS `Total` from `users` `u` where `u`.`estado` = 1 and `u`.`role`  not like 'ADMIN_ROLE' and `u`.`role`  not like 'EMPLOYEE_ROLE' group by monthname(`u`.`created_at`) order by monthname(`u`.`created_at`) desc ;

-- --------------------------------------------------------

--
-- Estructura para la vista `stockmenor_veinte`
--
DROP TABLE IF EXISTS `stockmenor_veinte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stockmenor_veinte`  AS  select `a`.`id` AS `Id`,`a`.`nombre` AS `Nombre`,`a`.`stock` AS `Stock` from `articulos` `a` where `a`.`stock` < 20 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `topcinco`
--
DROP TABLE IF EXISTS `topcinco`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `topcinco`  AS  select `d`.`id_articulo` AS `id_articulo`,`a`.`observaciones` AS `Nombre`,sum(`d`.`cantidad`) AS `Cantidad` from ((`detalles` `d` join `facturas` `f` on(`d`.`id_factura` = `f`.`id`)) join `articulos` `a` on(`d`.`id_articulo` = `a`.`id`)) where `f`.`estado` = 1 group by `d`.`id_articulo`,`a`.`observaciones` order by 3 desc limit 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `top_clientes`
--
DROP TABLE IF EXISTS `top_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top_clientes`  AS  select `u`.`id` AS `Id`,concat_ws(', ',`u`.`nombre`,`u`.`apellido`) AS `Nombre`,count(`f`.`id`) AS `Cantidad_facturas` from (`facturas` `f` join `users` `u` on(`f`.`id_user` = `u`.`id`)) where `f`.`estado` = 1 group by 1,2 having count(`f`.`id`) > 1 order by 3 desc ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ultimafactura`
--
DROP TABLE IF EXISTS `ultimafactura`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ultimafactura`  AS  select max(`f`.`id`) AS `ID`,concat_ws(', ',`u`.`nombre`,`u`.`apellido`) AS `Nombre` from (`facturas` `f` join `users` `u` on(`f`.`id_user` = `u`.`id`)) group by 2 limit 1 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_articuloxcategoria` (`id_categoria`),
  ADD KEY `fk_id_articuloxproveedor` (`id_proveedor`);

--
-- Indices de la tabla `articulo_cart`
--
ALTER TABLE `articulo_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articuloxcartart` (`articulo_id`),
  ADD KEY `fk_cartxcartart` (`cart_id`);

--
-- Indices de la tabla `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_usersxcart` (`id_user`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_facturaxdetalle` (`id_factura`),
  ADD KEY `fk_id_articuloxdetalle` (`id_articulo`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_rubro` (`id_rubro`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_id_sucursales` (`id_sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `articulo_cart`
--
ALTER TABLE `articulo_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_id_articuloxproveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulo_cart`
--
ALTER TABLE `articulo_cart`
  ADD CONSTRAINT `fk_cartxcartart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_id_usersxcart` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `fk_id_articuloxdetalle` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `fk_id_rubro` FOREIGN KEY (`id_rubro`) REFERENCES `rubros` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_sucursales` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
