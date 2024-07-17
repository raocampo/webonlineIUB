-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2024 a las 16:42:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `cdg_carrera` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL,
  `horas` date NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `aul_vrt` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financiero`
--

CREATE TABLE `financiero` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `pgs_pnd` double NOT NULL,
  `pgs_apl` double NOT NULL,
  `facturas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fnc_pgsa`
--

CREATE TABLE `fnc_pgsa` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `colegiatura` double NOT NULL,
  `intereses` double NOT NULL,
  `otros` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fnc_pgsa`
--

INSERT INTO `fnc_pgsa` (`id`, `usuario`, `colegiatura`, `intereses`, `otros`, `total`) VALUES
(1, 'admin', 1380, 1400, 200, 2980),
(2, 'eric123', 1123, 1123, 321, 2568);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fnc_pgsp`
--

CREATE TABLE `fnc_pgsp` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `colegiatura` double NOT NULL,
  `intereses` double NOT NULL,
  `otros` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fnc_pgsp`
--

INSERT INTO `fnc_pgsp` (`id`, `usuario`, `colegiatura`, `intereses`, `otros`, `total`) VALUES
(1, 'admin', 1380, 1400, 200, 2980),
(2, 'eric123', 1123, 1123, 321, 2568);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `nmr_tel` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fch_nac` varchar(10) NOT NULL,
  `contrasena` varchar(10) NOT NULL,
  `ciudad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombres`, `usuario`, `identificacion`, `nmr_tel`, `correo`, `fch_nac`, `contrasena`, `ciudad`) VALUES
(1, 'Stefania Carolina Alvarado Soria', 'admin', '1104944143', '0987654312', 'admin@gmail.com', '2000-02-22', 'admin', 'Macará'),
(2, 'Eric Fernando Palta Cerro', 'eferpal01', '1105997736', '0987654321', 'eric@gmail.com', '22/04/2000', 'eric123', 'Macará');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `correo`, `contrasena`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$LIqFU2urc.XjtfqC6.iFnOkXyUWYx3ovtIL1IqR1LZK.NbjAMHQKa'),
(2, 'eric123', 'eric123@gmail.com', '$2y$10$1C9SaCCR14546dIWtAgtFOJ2xJdahZPangR0P/v/Tg8EWa6UNK1nK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_dmc`
--

CREATE TABLE `usu_dmc` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `cll_prn` varchar(100) NOT NULL,
  `cll_scn` varchar(100) NOT NULL,
  `cdg_pst` varchar(10) NOT NULL,
  `tlf_cnt` varchar(15) NOT NULL,
  `referencia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usu_dmc`
--

INSERT INTO `usu_dmc` (`id`, `usuario`, `cll_prn`, `cll_scn`, `cdg_pst`, `tlf_cnt`, `referencia`) VALUES
(1, 'admin', 'Mercadillo', 'Bernardo Valdivieso', '11009', '0982727373', 'Frente a la farmacia'),
(2, 'eric123', 'PARIS', 'JUAN ROBLES', '110099', '0928273742', 'DIAGONAL A LA TIENDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_dts`
--

CREATE TABLE `usu_dts` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `nmr_tel` varchar(15) NOT NULL,
  `fch_nac` date NOT NULL,
  `est_cvl` char(1) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usu_dts`
--

INSERT INTO `usu_dts` (`id`, `usuario`, `nombres`, `identificacion`, `nmr_tel`, `fch_nac`, `est_cvl`, `direccion`, `pais`, `provincia`, `ciudad`) VALUES
(1, 'admin', 'Carlos Andres Palacios Robles', '1108444773', '0987462521', '1994-07-20', 'C', 'Calle Juan de Salinas y Av. Orillas del Zamora', 'ECUADOR', 'LOJA', 'MACARA'),
(2, 'eric123', 'STIVEN PUERcA CALVA LOPEZ', '1199887733', '0984836740', '2004-07-13', 'C', 'AMAZONAS Y CENTENARIO', 'ECUADOR', 'LOJA', 'MACARÁ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`cdg_carrera`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `financiero`
--
ALTER TABLE `financiero`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `fnc_pgsa`
--
ALTER TABLE `fnc_pgsa`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `fnc_pgsp`
--
ALTER TABLE `fnc_pgsp`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usu_dmc`
--
ALTER TABLE `usu_dmc`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usu_dts`
--
ALTER TABLE `usu_dts`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `financiero`
--
ALTER TABLE `financiero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fnc_pgsa`
--
ALTER TABLE `fnc_pgsa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fnc_pgsp`
--
ALTER TABLE `fnc_pgsp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usu_dmc`
--
ALTER TABLE `usu_dmc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usu_dts`
--
ALTER TABLE `usu_dts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
