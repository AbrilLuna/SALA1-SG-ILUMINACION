-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2021 a las 18:57:16
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sg_iluminacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_compra`
--

CREATE TABLE `carrito_compra` (
  `id_Cliente` int(11) NOT NULL,
  `id_Producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito_compra`
--

INSERT INTO `carrito_compra` (`id_Cliente`, `id_Producto`, `cantidad`) VALUES
(3, 13, 7),
(3, 11, 7),
(3, 16, 7),
(3, 18, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_Proveedor` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_Producto` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Folio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_Proveedor`, `id_Usuario`, `id_Producto`, `Total`, `Folio`) VALUES
(1, 1, 2, 850, '1_52 '),
(1, 1, 5, 500, '1_5 '),
(1, 1, 2, 350, '1_2 '),
(2, 1, 16, 2312.5, '1_216 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_Producto` int(11) NOT NULL,
  `fila_id` text NOT NULL,
  `id_Vendedor` int(11) NOT NULL,
  `Nombre` varchar(64) NOT NULL,
  `Precio` float NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Imagen_url` varchar(1024) NOT NULL,
  `Caracteristicas` varchar(1024) NOT NULL,
  `Descuento` int(11) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_Producto`, `fila_id`, `id_Vendedor`, `Nombre`, `Precio`, `Tipo`, `Imagen_url`, `Caracteristicas`, `Descuento`, `Stock`) VALUES
(1, 'sbdjnksj', 1, 'LAMPARA DE TECHO LED 18W ANKAA III BLANCO 3000K TECNOLITE', 188.19, 'exterior', 'https://masluz.vteximg.com.br/arquivos/ids/414794-375-375/interior-plafones-led-12w100-240v3000k-386419-lampara-de-techo-led-12w-ankaa-ii-blanco-3000k-tecnolite87.jpg?v=637063408457070000', 'Garantía:60 Meses.<br>\r\nCondición: Producto Nuevo Sellado.<br>\r\nAcabado: Blanco.<br>\r\nAtenuable: NA.<br>\r\nBase Del Foco: LED ENSAMBLADO.<br>\r\nColor De Luz: 3000 K.<br>\r\nConsumo: 18.3 W.<br>\r\nTecnología: LED.<br>\r\nVoltaje: 100 V ~-240 V ~.<br>\r\nAlto: 23 cm.<br>\r\nAncho: 5 cm.<br>', 0, 120),
(2, 'ssssddaa', 1, 'Lampara de pared', 350, 'Interior', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8LijOMBqQ_8UTGElwn88f8Nlf8QvUdNiAnw&usqp=CAU', 'Lampara de pared <br>LED 2 unidades<br> 16w', 5, 5),
(3, 'ssssddab', 1, 'Ousfot', 300, 'Interior', 'https://m.media-amazon.com/images/I/61AlmAApDnL._AC_SS450_.jpg', 'Lampara con sensor para armario.<br>recargable LED.', 0, 6),
(4, 'ssssddac', 1, 'Lightess Regulable', 410, 'Interior', 'https://image.made-in-china.com/202f0j10nPtRFUdsfIbC/Multi-Color-Retro-Interior-Bedside-Reading-Wall-Lamp.jpg', 'Lampara de pared Led. <br>16w <br>31cm. <br>Luz moderna', 0, 4),
(5, 'ssssddad', 1, 'Paquete de dos lampararas', 500, 'Interior', 'https://www.avanluce.com/wp-content/uploads/2018/04/lampara-de-techo-palma-de-vibia.jpg', 'Lampara de pared LED <br>12W <br>3000K <br>Blanco calido', 10, 7),
(6, 'ssssddae', 1, 'Luces de pared', 280, 'Interior', 'https://m.media-amazon.com/images/I/51PhbW1dohL._AC_SS450_.jpg', 'Luces de pared LED <br>2 piezas <br>iluminacion 6W', 0, 9),
(7, 'ssssddaf', 1, 'Lampara de techo', 400, 'Interior', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWRPQo_JjB29xwPaQq4zXSMsNTDGvCJP07iA&usqp=CAU', 'Lampara LED de techo <br>15W <br>Blanco calido', 0, 15),
(8, 'ssssddag', 1, 'Ketom Aplique Pred', 700, 'Interior', 'https://ae01.alicdn.com/kf/H7b4183b9f5a74c5aac03780bc685e901a/L-mpara-de-pared-de-cristal-moderna-para-dormitorio-mesita-de-noche-sala-de-estar-balc.jpg_q50.jpg', 'LED 15W <br>Moderna de pared <br>3000k', 0, 12),
(9, 'ssssddah', 2, 'Lampara vintage', 475, 'Interior', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF_nFo2oLS6J6m-SIS1bIFWC4sQmIRQpez8Q&usqp=CAU', 'Lampara de pared <br>Vintage Industrial Edison', 0, 18),
(10, 'ssssddai', 2, 'Plafon Techo', 890, 'Interior', 'https://m.media-amazon.com/images/I/617V9O5LCPL._AC_SX466_.jpg', 'Lampara de techo LED Cuadrado 64W', 15, 10),
(11, 'ssssddaj', 1, 'Sebson', 300, 'Exterior', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTAqiZdv6U-iscN-lxsBpiHlI_drAtOQNvSdw&usqp=CAU', 'Lampara con sensor moviemiento 20W', 0, 15),
(12, 'ssssddak', 1, 'Philips myGarden', 1300, 'Exterior', 'https://m.media-amazon.com/images/I/718SEllAveL._AC_SX342_.jpg', 'Lampara de exterior, resistente a la humedad y la interperie', 0, 10),
(13, 'ssssddal', 2, 'Lightess Pared', 500, 'Exterior', 'https://i.pinimg.com/originals/0f/87/b1/0f87b10d58a90d032c470952390c630b.jpg', 'LED 12W Impermeable, Aluminio', 15, 20),
(14, 'ssssddam', 1, 'Lampara exterior', 600, 'Exterior', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCB8gbyNF0Ce-KEGcCZLPo9JZZXhbEkpuw6A&usqp=CAU', 'Luz sensor movimiento 30W', 0, 11),
(15, 'ssssddao', 1, 'Lampara de pared', 760, 'Exterior', 'https://www.consejosparamihuerto.com/wp-content/uploads/2020/03/lamparas-de-pared-de-exterior.jpg', 'Tiene tecnolog?a LED que proporciona una luz neutra de 600 l?menes. Sus dimensiones son 7.6 x 12 x 21.5 cm', 0, 20),
(16, 'ssssddap', 2, 'Luminario', 1100, 'Exterior', 'https://euroelectrica.com.mx/wp-content/uploads/2019/01/TLSO118B-1.jpg', 'Otorga una agradable luz c?lida con 1 foco LED de 10 W, para patios o areas de descanso.', 10, 10),
(17, 'ssssddaq', 1, 'Fotocelda', 850, 'Exterior', 'https://m.media-amazon.com/images/I/81JFpeln+gL._AC_SX679_.jpg', 'Trabaja con una potencia de 40 watts y corriente de 120 volts', 0, 5),
(18, 'ssssddar', 2, 'Lampara Curva', 900, 'Exterior', 'https://cdn.manomano.com/images/images_products/2686875/T/5615431_1.jpg', 'Brinda una luz de 4000 lumenes y 4000 K. Carcasa resistente', 0, 13),
(19, 'ssssddas', 1, 'Mangera Luminosa', 900, 'Exterior', 'https://cdn.homedepot.com.mx/productos/106290/106290-z.jpg', 'Refuerzo de iluminación para letras de señalización <br>Arcos, toldos o adornar objetos.', 0, 8),
(20, 'ssssddat', 1, 'Farol para pared', 449, 'Exterior', 'https://m.media-amazon.com/images/I/71P1iKX+xML._AC_SY500_.jpg', 'Utiliza un foco CFL de 26 watts, para iluminar especias exteriores del hogar', 10, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Apellidos` varchar(120) NOT NULL,
  `Correo` varchar(64) NOT NULL,
  `Contrasena` varchar(24) NOT NULL,
  `Marca` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_Proveedor`, `Nombre`, `Apellidos`, `Correo`, `Contrasena`, `Marca`) VALUES
(1, 'Sofia', 'Juarez', 'sofi.23@outlook.com', '1234S', 'Brilliance'),
(2, 'Pedrito', 'López', 'pedritolopez@correo.com', '1234P', 'Luminita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Apellidos` varchar(120) NOT NULL,
  `Correo` varchar(64) NOT NULL,
  `Contrasena` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `Nombre`, `Apellidos`, `Correo`, `Contrasena`) VALUES
(1, 'Abril', 'Luna', 'fanny_360@live.com.mx', '123456'),
(2, 'Juanito', 'Perez', 'juanito.perez@live.com', '1234J'),
(3, 'Bruno', 'Ramirez', 'bruno.gilram@gmail.com', 'Bruno es chido');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_compra`
--
ALTER TABLE `carrito_compra`
  ADD KEY `id_Cliente` (`id_Cliente`,`id_Producto`),
  ADD KEY `id_Producto` (`id_Producto`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD KEY `id_Cliente` (`id_Usuario`),
  ADD KEY `id_Proveedor` (`id_Proveedor`),
  ADD KEY `id_Producto` (`id_Producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_Producto`),
  ADD KEY `id_Vendedor` (`id_Vendedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_Proveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_compra`
--
ALTER TABLE `carrito_compra`
  ADD CONSTRAINT `carrito_compra_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `usuario` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_compra_ibfk_2` FOREIGN KEY (`id_Producto`) REFERENCES `producto` (`id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_Proveedor`) REFERENCES `proveedor` (`id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_Producto`) REFERENCES `producto` (`id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_Vendedor`) REFERENCES `proveedor` (`id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
