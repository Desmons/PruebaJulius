-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2022 a las 15:09:16
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_fabriciocardozoordoñez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `idAutor` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) NOT NULL,
  `añoDeNacimiento` year(4) DEFAULT NULL,
  `añoDeMuerte` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `apellido`, `telefono`, `correo`, `fechaCreacion`, `fechaActualizacion`) VALUES
(1, 'fabricio', 'cardozo', '3175596291', 'fabricho255@gmail.com', '2022-04-10 07:12:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ediciones`
--

CREATE TABLE `ediciones` (
  `idEdicion` int(11) NOT NULL,
  `edicion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ediciones`
--

INSERT INTO `ediciones` (`idEdicion`, `edicion`) VALUES
(1, 'San Francisco'),
(2, 'usco'),
(3, 'New York');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editores`
--

CREATE TABLE `editores` (
  `idEditor` int(11) NOT NULL,
  `editor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `editores`
--

INSERT INTO `editores` (`idEditor`, `editor`) VALUES
(1, 'San Francisco'),
(2, 'natalia'),
(3, 'fabricio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `nombre`, `email`, `password`, `tipo`, `fechaCreacion`, `fechaActualizacion`) VALUES
(1, 'fabricio', 'fa@gmail.com', '123', 2, '2022-04-09 05:53:25', NULL),
(2, 'natalia', 'na@gmail.com', '123', 1, '2022-04-09 05:53:41', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechasdepublicacion`
--

CREATE TABLE `fechasdepublicacion` (
  `idFechaDePublicacion` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechasdepublicacion`
--

INSERT INTO `fechasdepublicacion` (`idFechaDePublicacion`, `fecha`) VALUES
(1, '2022-04-09'),
(2, '2022-04-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idLibros` int(11) NOT NULL,
  `Titulo_idTitulo` int(11) NOT NULL,
  `Editor_idEditor` int(11) NOT NULL,
  `FechaDePublicacion_idFechaDePublicacion` int(11) NOT NULL,
  `Edicion_idEdicion` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `precioMinoristaSugerido` int(11) NOT NULL,
  `Valoracion_idValoracion` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `OrdenesDePedidos_idOrdenDePedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idLibros`, `Titulo_idTitulo`, `Editor_idEditor`, `FechaDePublicacion_idFechaDePublicacion`, `Edicion_idEdicion`, `costo`, `precioMinoristaSugerido`, `Valoracion_idValoracion`, `descripcion`, `OrdenesDePedidos_idOrdenDePedido`) VALUES
(1, 1, 1, 1, 1, 12, 15, 5, 'aaa', NULL),
(2, 3, 1, 1, 1, 12, 15, 5, NULL, NULL),
(3, 4, 2, 2, 2, 20000, 50000, 1, NULL, NULL),
(4, 5, 3, 2, 3, 10000, 60000, 2, 'lo mejor', NULL),
(5, 1, 1, 1, 1, 3, 15, 1, 'aaa prueba', NULL),
(6, 1, 1, 1, 1, 5, 15, 2, 'bueno', NULL),
(7, 3, 1, 1, 1, 12, 15, 6, 'aa', NULL),
(8, 7, 1, 1, 1, 5, 15, 1, 'buenos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_has_autores`
--

CREATE TABLE `libros_has_autores` (
  `Libros_idLibros` int(11) NOT NULL,
  `Autores_idAutores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenesdepedidos`
--

CREATE TABLE `ordenesdepedidos` (
  `idOrdenDePedido` int(11) NOT NULL,
  `fechaCompra` datetime NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `Clientes_idCliente` int(11) NOT NULL,
  `Empleados_idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenesdepedidos`
--

INSERT INTO `ordenesdepedidos` (`idOrdenDePedido`, `fechaCompra`, `total`, `Clientes_idCliente`, `Empleados_idEmpleado`) VALUES
(1, '2022-04-10 02:13:05', 60000, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos`
--

CREATE TABLE `titulos` (
  `idTitulo` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `titulos`
--

INSERT INTO `titulos` (`idTitulo`, `titulo`) VALUES
(1, 'Sanss Francisco'),
(3, 'aSan Francisco'),
(4, 'prueba'),
(5, 'alfredo'),
(6, 'lo mejor'),
(7, 'San Francisco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `idValoraciones` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`idValoraciones`, `tipo`) VALUES
(1, 'extraordinario'),
(2, 'excelente'),
(3, 'bueno'),
(4, 'dañado'),
(5, 'Chicago'),
(6, 'Abre el menu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  ADD PRIMARY KEY (`idEdicion`);

--
-- Indices de la tabla `editores`
--
ALTER TABLE `editores`
  ADD PRIMARY KEY (`idEditor`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `fechasdepublicacion`
--
ALTER TABLE `fechasdepublicacion`
  ADD PRIMARY KEY (`idFechaDePublicacion`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idLibros`),
  ADD KEY `fk_Libros_Editores1_idx` (`Editor_idEditor`),
  ADD KEY `fk_Libros_Titulos1_idx` (`Titulo_idTitulo`),
  ADD KEY `fk_Libros_Valoraciones1_idx` (`Valoracion_idValoracion`),
  ADD KEY `fk_Libros_Ediciones1_idx` (`Edicion_idEdicion`),
  ADD KEY `fk_Libros_FechasDePublicacion1_idx` (`FechaDePublicacion_idFechaDePublicacion`),
  ADD KEY `fk_Libros_OrdenesDePedidos1_idx` (`OrdenesDePedidos_idOrdenDePedido`);

--
-- Indices de la tabla `libros_has_autores`
--
ALTER TABLE `libros_has_autores`
  ADD PRIMARY KEY (`Libros_idLibros`,`Autores_idAutores`),
  ADD KEY `fk_Libros_has_Autores_Autores1_idx` (`Autores_idAutores`),
  ADD KEY `fk_Libros_has_Autores_Libros_idx` (`Libros_idLibros`);

--
-- Indices de la tabla `ordenesdepedidos`
--
ALTER TABLE `ordenesdepedidos`
  ADD PRIMARY KEY (`idOrdenDePedido`,`Clientes_idCliente`,`Empleados_idEmpleado`),
  ADD KEY `fk_OrdenesDePedidos_Clientes1_idx` (`Clientes_idCliente`),
  ADD KEY `fk_OrdenesDePedidos_Empleados1_idx` (`Empleados_idEmpleado`);

--
-- Indices de la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`idTitulo`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`idValoraciones`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  MODIFY `idEdicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `editores`
--
ALTER TABLE `editores`
  MODIFY `idEditor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fechasdepublicacion`
--
ALTER TABLE `fechasdepublicacion`
  MODIFY `idFechaDePublicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idLibros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ordenesdepedidos`
--
ALTER TABLE `ordenesdepedidos`
  MODIFY `idOrdenDePedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `titulos`
--
ALTER TABLE `titulos`
  MODIFY `idTitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `idValoraciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_Libros_Ediciones1` FOREIGN KEY (`Edicion_idEdicion`) REFERENCES `ediciones` (`idEdicion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_Editores1` FOREIGN KEY (`Editor_idEditor`) REFERENCES `editores` (`idEditor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_FechasDePublicacion1` FOREIGN KEY (`FechaDePublicacion_idFechaDePublicacion`) REFERENCES `fechasdepublicacion` (`idFechaDePublicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_OrdenesDePedidos1` FOREIGN KEY (`OrdenesDePedidos_idOrdenDePedido`) REFERENCES `ordenesdepedidos` (`idOrdenDePedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_Titulos1` FOREIGN KEY (`Titulo_idTitulo`) REFERENCES `titulos` (`idTitulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_Valoraciones1` FOREIGN KEY (`Valoracion_idValoracion`) REFERENCES `valoraciones` (`idValoraciones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libros_has_autores`
--
ALTER TABLE `libros_has_autores`
  ADD CONSTRAINT `fk_Libros_has_Autores_Autores1` FOREIGN KEY (`Autores_idAutores`) REFERENCES `autores` (`idAutor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_has_Autores_Libros` FOREIGN KEY (`Libros_idLibros`) REFERENCES `libros` (`idLibros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ordenesdepedidos`
--
ALTER TABLE `ordenesdepedidos`
  ADD CONSTRAINT `fk_OrdenesDePedidos_Clientes1` FOREIGN KEY (`Clientes_idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenesDePedidos_Empleados1` FOREIGN KEY (`Empleados_idEmpleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
