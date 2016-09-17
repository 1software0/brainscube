-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2016 a las 12:56:02
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE `brainscube`;
USE `brainscube`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `brainscube`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `marcas_id` int(10) UNSIGNED NOT NULL,
  `CB` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Nombre` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Des_corta` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `Des_larga` longtext COLLATE utf8_bin,
  `Precio` int(9) UNSIGNED DEFAULT NULL,
  `Idm` int(10) UNSIGNED DEFAULT NULL,
  `link` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id`, `marcas_id`, `CB`, `Nombre`, `Des_corta`, `Des_larga`, `Precio`, `Idm`, `link`) VALUES
(1, 1, '010003067010', 'aolong v2', 'El Moyu Aolong V2 es la versión revisada de la inmensamente popular y exitoso Moyu Aolong. ', 'El Moyu Aolong V2 es la versión revisada de la inmensamente popular y exitoso Moyu Aolong. Las revisiones están destinados a reducir la posibilidad de curvas serpenteantes accidentalmente durante resuelve, que fue ampliamente difundido durante Feliks Zemdegs ''a los posibles 3x3 récord mundial resolver.\r\n\r\nLos cambios se centran principalmente en la esquina de torsión y la estabilidad general del cubo. Las piezas son ahora un poco menos burbujeante en comparación con el Aolong V1, y las ranuras de las piezas de esquina se han hecho más grande. La caja también se ha rediseñado para esta versión.', 30066, 1, 'aolong-v2'),
(30, 1, '6948571882387', 'aofu GT 7x7 cubico', 'El Aofu GT es el nuevo 7x7 de moyu, es cubico y por eso todos lo quieren y así. La verdad es que vale la pena.', 'El Aofu GT es el nuevo 7x7 de moyu, es cubico y por eso todos lo quieren y así. La verdad es que vale la pena.\r\n\r\nThe MoYu Cubic AoFu 7x7 GT is finally available! This hotly-anticipated cube features various improvements over the pillowed version, as well as the cubic form that many 7x7 solvers prefer.', 91884, 1, 'aofu-GT-7x7-cubico'),
(31, 3, '6956325501835', 'pyrminx cristal', 'Fusce nisl massa, lacinia egestas varius id, sagittis eget ex. Proin augue enim, maximus ut ultrices non, dictum id nibh. Vivamus tempus dignissim libero, ut sollicitudin ex faucibus at. Suspendisse euismod semper luctus. Nulla facilisi. Nulla facilisi. Donec eu vehicula arcu.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim pharetra magna. Suspendisse potenti. Mauris semper lacus a sem interdum, pellentesque scelerisque odio malesuada. Sed augue tellus, pretium id pulvinar sit amet, dignissim quis metus. Mauris vitae imperdiet nibh, viverra lacinia ante. Nunc neque felis, blandit at tristique in, elementum sed diam. Sed pretium mi nunc. Donec et sagittis tellus, sed bibendum dui. Phasellus vulputate sodales fringilla. Fusce id turpis ornare, laoreet enim eget, condimentum ex. Duis nisl nisi, vulputate ac euismod at, hendrerit vel est.\r\n\r\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Nullam quis scelerisque tortor, et commodo dui. Nunc laoreet imperdiet vehicula. Suspendisse id arcu sit amet lectus molestie efficitur. Suspendisse nisl leo, dignissim sit amet hendrerit suscipit, laoreet eget justo. Mauris consectetur ullamcorper felis, in eleifend risus volutpat in. Ut sollicitudin suscipit tincidunt. Aliquam facilisis malesuada dui, in luctus arcu tristique ut. Pellentesque cursus malesuada pretium. Aenean tempus tincidunt lacinia. Aliquam aliquet nulla ut lectus tempus, eget laoreet quam pulvinar. Suspendisse blandit sit amet dolor ut dictum. Suspendisse enim nisl, tempus nec accumsan in, interdum eu nisl.\r\n\r\nFusce nisl massa, lacinia egestas varius id, sagittis eget ex. Proin augue enim, maximus ut ultrices non, dictum id nibh. Vivamus tempus dignissim libero, ut sollicitudin ex faucibus at. Suspendisse euismod semper luctus. Nulla facilisi. Nulla facilisi. Donec eu vehicula arcu.', 39933, 3, 'pyrminx-cristal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'NxN'),
(2, 'Dodecaedro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `nombre`) VALUES
(1, 'Negro'),
(2, 'Blanco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `Sesiones_id` int(10) UNSIGNED NOT NULL,
  `Catalogo_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `idU` int(10) UNSIGNED DEFAULT NULL,
  `metodo` int(10) UNSIGNED DEFAULT NULL,
  `idC` int(10) UNSIGNED DEFAULT NULL,
  `idArt` int(10) UNSIGNED DEFAULT NULL,
  `idS` int(10) UNSIGNED DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `estado` int(10) UNSIGNED DEFAULT NULL,
  `track` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `marcas_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `porcentaje_off` int(10) UNSIGNED DEFAULT NULL,
  `idM` int(10) UNSIGNED DEFAULT NULL,
  `idart` int(10) UNSIGNED DEFAULT NULL,
  `idU` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `Catalogo_id` int(10) UNSIGNED NOT NULL,
  `marcas_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(355) COLLATE utf8_bin DEFAULT NULL,
  `width` int(10) UNSIGNED DEFAULT NULL,
  `height` int(10) UNSIGNED DEFAULT NULL,
  `peso` int(10) UNSIGNED DEFAULT NULL,
  `id_art` int(10) UNSIGNED DEFAULT NULL,
  `id_marca` int(10) UNSIGNED DEFAULT NULL,
  `idu` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `Catalogo_id`, `marcas_id`, `Usuarios_id`, `url`, `width`, `height`, `peso`, `id_art`, `id_marca`, `idu`) VALUES
(1, 0, 0, 0, 'views/img/slider/1.png', 1920, 1040, 2096435, 0, 0, 1),
(2, 0, 1, 0, 'https://www.cubikon.de/images/gallery/marken/moyu-logo.jpg', 195, 100, 200, 0, 1, 1),
(3, 0, 0, 0, 'views/img/slider/2.png', 0, 0, 0, 0, 0, 1),
(4, 0, 0, 0, 'views/img/slider/3.png', 1920, 1040, 2096435, 0, 0, 1),
(5, 1, 0, 0, 'views/img/products/1.jpg', 480, 606, 128226, 1, 0, 1),
(6, 1, 0, 1, 'views/img/products/2.jpg', 480, 606, 116847, 1, 0, 1),
(7, 30, 0, 1, 'views/img/products/30a.png', 480, 606, 300237, 30, 0, 1),
(8, 30, 0, 1, 'views/img/products/30b.png', 480, 606, 300237, 30, 0, 1),
(9, 31, 0, 1, 'views/img/products/31a.png', 480, 606, 303569, 31, 0, 1),
(10, 31, 0, 1, 'views/img/products/31d.png', 480, 606, 280854, 31, 0, 1),
(11, 31, 0, 1, 'views/img/products/31c.png', 480, 606, 217800, 31, 0, 1),
(12, 31, 0, 1, 'views/img/products/31d.png', 480, 606, 274601, 31, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos`
--

CREATE TABLE `lista_deseos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idu` int(10) UNSIGNED DEFAULT NULL,
  `idp` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lista_deseos`
--

INSERT INTO `lista_deseos` (`id`, `idu`, `idp`) VALUES
(1, 16, 1),
(22, 1, 1),
(23, 1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(140) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'moyu', 'Moyu es una marca china de venta de cubos. Hace principalmente cubos de speed.'),
(2, 'shengshou', 'Es una de las primeras marcas de speed cube, sus cubos son muy economicos.'),
(3, 'Qj', 'Es una marca china una de las mejores para cubos no convencionales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idM` int(10) UNSIGNED NOT NULL,
  `Sesiones_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `idU` int(10) UNSIGNED DEFAULT NULL,
  `Mensaje` char(1) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `leido` tinyint(1) DEFAULT NULL,
  `idS` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_2` int(10) UNSIGNED DEFAULT NULL,
  `text` char(1) COLLATE utf8_bin DEFAULT NULL,
  `seen` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `code` char(1) COLLATE utf8_bin DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `porcentajeoff` int(10) UNSIGNED DEFAULT NULL,
  `idU` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_pago`
--

CREATE TABLE `registro_pago` (
  `id` int(10) UNSIGNED NOT NULL,
  `Compras_Sesiones_id` int(10) UNSIGNED NOT NULL,
  `Compras_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `idU` int(10) UNSIGNED DEFAULT NULL,
  `idC` int(10) UNSIGNED DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `Cantidad` int(10) UNSIGNED DEFAULT NULL,
  `forma_pago` int(10) UNSIGNED DEFAULT NULL,
  `referencia` int(10) UNSIGNED DEFAULT NULL,
  `comentarios` char(1) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `idreview` int(10) UNSIGNED NOT NULL,
  `Sesiones_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `rate` int(10) UNSIGNED DEFAULT NULL,
  `idses` int(10) UNSIGNED DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`idreview`, `Sesiones_id`, `Usuarios_id`, `idusuario`, `comentario`, `date`, `rate`, `idses`, `id`) VALUES
(1, 7, 1, 1, 'buen cubo. muchas gracias.', 1473398764, 5, 7, 1),
(2, 9, 1, 1, 'buen producto.', 1474004524, 5, 9, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `IdUsuario` int(10) UNSIGNED DEFAULT NULL,
  `date` int(34) DEFAULT NULL,
  `deadline` int(34) DEFAULT NULL,
  `TKid` varchar(254) COLLATE utf8_bin NOT NULL,
  `ip` varchar(20) COLLATE utf8_bin NOT NULL,
  `brow` varchar(100) COLLATE utf8_bin NOT NULL,
  `end` int(10) NOT NULL,
  `is_over` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id`, `Usuarios_id`, `IdUsuario`, `date`, `deadline`, `TKid`, `ip`, `brow`, `end`, `is_over`) VALUES
(1, 1, 1, 1468335126, 1469649126, 'cV9qam9lbHhba2s=', '127.0.0.1', 'all', 0, 0),
(2, 16, 16, 1472844648, 1472855448, 'al9ocGZtbWhsan1cZms=', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 1472851117, 1),
(3, 1, 1, 1472839572, 1472850372, 'Y19kcGJqY2pqandcZms=', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0),
(4, 1, 1, 1473110986, 1473121786, 'Z19ramphamFsantcZms=', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0),
(5, 1, 1, 1473118483, 1473129283, 'Zl9samNjZmltanhcZms=', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0),
(6, 1, 1, 1473380373, 1473391173, 'aV9qb2NqbWFlaXhcZms=', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0),
(7, 1, 1, 1473393736, 1473404536, 'al9raGNja2RueGFjZw==', '192.168.1.2', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0),
(8, 1, 1, 1473795457, 1473806257, 'aV9oaGRra2lkanxcZms=', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0),
(9, 1, 1, 1474003094, 1474013894, 'Zl9nbWVmYGp1ZGZj', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Saf', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `idI` int(10) UNSIGNED DEFAULT NULL,
  `desc_2` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `idu` int(10) UNSIGNED DEFAULT NULL,
  `tkid` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `idI`, `desc_2`, `idu`, `tkid`) VALUES
(1, 3, '<div class="layer-1"><h2 class="title5">Promociones</h2></div><div class="layer-2"><h2 class="title6">Cubos 3x3</h2></div><div class="layer-2"><p class="title0">Ahorre hasta 40%</p></div><div class="layer-3"><a class="min1" href="tienda/">Ver ahora</a></div>', 1, 'cV9qam9lbHhba2s='),
(2, 1, '<div class="layer-1"><h2 class="title5">new collection</h2></div><div class="layer-2"><h2 class="title6">Men’s Fashion</h2></div><div class="layer-2"><p class="title0">Save Up To 40% Off</p></div><div class="layer-3"><a class="min1" href="#">Shop Now</a></div>', 1, 'cV9qam9lbHhba2s='),
(3, 4, NULL, 1, 'cV9qam9lbHhba2s=');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `identrada` int(10) UNSIGNED NOT NULL,
  `Catalogo_id` int(10) UNSIGNED NOT NULL,
  `Usuarios_id` int(10) UNSIGNED NOT NULL,
  `Sesiones_id` int(10) UNSIGNED NOT NULL,
  `idart` int(10) UNSIGNED DEFAULT NULL,
  `idusuario` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `idses` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`identrada`, `Catalogo_id`, `Usuarios_id`, `Sesiones_id`, `idart`, `idusuario`, `cantidad`, `date`, `idses`) VALUES
(1, 1, 1, 1, 1, 1, 5, '2016-08-04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_data`
--

CREATE TABLE `store_data` (
  `id` int(11) NOT NULL,
  `dato` varchar(45) NOT NULL,
  `valor` varchar(500) NOT NULL,
  `tk` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `store_data`
--

INSERT INTO `store_data` (`id`, `dato`, `valor`, `tk`) VALUES
(1, 'phone', '5512 6338', 'cV9qam9lbHhba2s='),
(2, 'work', 'Lunes a Sábado : 9:00-19:00', 'cV9qam9lbHhba2s=');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nombre` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Apellido` varchar(50) COLLATE utf8_bin NOT NULL,
  `user` varchar(30) COLLATE utf8_bin NOT NULL,
  `Correo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Permisos` int(10) UNSIGNED DEFAULT NULL,
  `pass` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `ubicacion` char(2) COLLATE utf8_bin DEFAULT NULL,
  `zc` int(10) UNSIGNED DEFAULT NULL,
  `address` longtext COLLATE utf8_bin,
  `active` tinyint(1) NOT NULL,
  `link` varchar(20) COLLATE utf8_bin NOT NULL,
  `keypass` varchar(20) COLLATE utf8_bin NOT NULL,
  `keypass_tmp` varchar(24) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `Apellido`, `user`, `Correo`, `Permisos`, `pass`, `ubicacion`, `zc`, `address`, `active`, `link`, `keypass`, `keypass_tmp`) VALUES
(1, 's8rRzt4=', 'vcLiyOHT24e8ws/Q0NQ=', '3NPPz+TE4Zg=', '08rRzt7Az8zeoZ3a3sfg3tDT0ZedxNvU', 10, '$2a$10$c7527566f8a6843085337u/nGcEp7JtMrBniGInuo1KH5ElH162l2', 'MX', 3100, '4tS4wJ+av6ni1ObJ6Na/r5/VzrmixbC82ardztqXu6+hrpvO15e7ud27w7ffr+K73bq0uOmv4amj1NbJ6cWzr+KZzsDpr86u6cTewLmjm73Zl7y5oMXWvaGV0Zyg1J/BoK/fpA==', 1, '', '0', ''),
(16, 'xNThyOHK24e/09s=', 's8aM1+HW0cnQ', '3NPPz+TE4Zk=', '08rRzt7Pzd3Q097Wo5Gcp9bOzdDbj8/W3A==', 0, '$2a$10$1fbd7e8087be3d74debdduSOHfPOFeVwPopmKEKH3EXzQgBeMA3ji', '', 14300, '49XOteiasLWjxdK81ruewd/QnrThsLC+oMXSuOnVxLSixcTJ15ibu5/F0rifmZ/JotW8veiql9272rTK59WjvtmWzcDXmLiyo8TiuOe65rOgqrOcusnWwaDE3szZuuXZ3cLRyA==', 1, '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Inventario_FKIndex1` (`marcas_id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`,`Sesiones_id`),
  ADD KEY `Compras_FKIndex1` (`Usuarios_id`),
  ADD KEY `Compras_FKIndex2` (`Sesiones_id`),
  ADD KEY `Compras_FKIndex3` (`Catalogo_id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descuentos_FKIndex1` (`Usuarios_id`),
  ADD KEY `descuentos_FKIndex2` (`marcas_id`),
  ADD KEY `descuentos_FKIndex3` (`Usuarios_id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagenes_FKIndex1` (`Usuarios_id`),
  ADD KEY `imagenes_FKIndex2` (`marcas_id`),
  ADD KEY `imagenes_FKIndex3` (`Catalogo_id`),
  ADD KEY `imagenes_FKIndex4` (`Usuarios_id`);

--
-- Indices de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idM`),
  ADD KEY `Mensajes_FKIndex1` (`Usuarios_id`),
  ADD KEY `Mensajes_FKIndex2` (`Sesiones_id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promociones_FKIndex1` (`Usuarios_id`);

--
-- Indices de la tabla `registro_pago`
--
ALTER TABLE `registro_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registro_pago_FKIndex1` (`Usuarios_id`),
  ADD KEY `registro_pago_FKIndex2` (`Compras_id`,`Compras_Sesiones_id`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idreview`),
  ADD KEY `review_FKIndex1` (`Usuarios_id`),
  ADD KEY `review_FKIndex2` (`Sesiones_id`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Sesiones_FKIndex1` (`Usuarios_id`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`identrada`),
  ADD KEY `Stock_FKIndex1` (`Sesiones_id`),
  ADD KEY `Stock_FKIndex2` (`Usuarios_id`),
  ADD KEY `Stock_FKIndex3` (`Catalogo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `registro_pago`
--
ALTER TABLE `registro_pago`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `idreview` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `identrada` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
