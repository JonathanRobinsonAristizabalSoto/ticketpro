-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2024 a las 01:30:53
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
-- Base de datos: `ticketpro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `fecha_comentario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_ticket`, `id_usuario`, `comentario`, `fecha_comentario`) VALUES
(1, 1, 2, '¿Cuándo necesitan los cupos?', '2023-10-01'),
(2, 1, 1, 'Para la próxima semana. La empresa necesita capacitar a su personal para cumplir con las normativas de seguridad.', '2023-10-01'),
(3, 3, 4, '¿Cuándo podemos agendar el mantenimiento?', '2023-10-03'),
(4, 3, 3, 'Lo antes posible. Los equipos están presentando fallas y necesitamos mantener la operatividad.', '2023-10-03'),
(5, 4, 5, '¿Qué tipo de capacitación necesitan?', '2023-10-04'),
(6, 4, 4, 'Capacitación en desarrollo de aplicaciones web. La entidad está implementando un nuevo sistema.', '2023-10-04'),
(7, 5, 3, 'Podemos agendar una reunión para discutir los detalles.', '2023-10-05'),
(8, 5, 5, 'Perfecto. Necesitamos consultoría para un proyecto de transformación digital.', '2023-10-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_evento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id_evento`, `id_ticket`, `accion`, `id_usuario`, `fecha_evento`) VALUES
(1, 1, 'Creación de ticket', 1, '2023-10-01'),
(2, 1, 'Asignación de agente', 2, '2023-10-01'),
(3, 2, 'Creación de ticket', 2, '2023-10-02'),
(4, 2, 'Cierre de ticket', 1, '2023-10-02'),
(5, 3, 'Creación de ticket', 3, '2023-10-03'),
(6, 3, 'Actualización de ticket', 4, '2023-10-03'),
(7, 4, 'Creación de ticket', 4, '2023-10-04'),
(8, 4, 'Asignación de agente', 5, '2023-10-04'),
(9, 5, 'Creación de ticket', 5, '2023-10-05'),
(10, 5, 'Cierre de ticket', 3, '2023-10-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id_programa` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `version` varchar(50) NOT NULL,
  `tipo_de_formacion` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `nivel_de_formacion` varchar(255) NOT NULL,
  `duracion` int(11) NOT NULL,
  `linea_tecnologica` varchar(255) NOT NULL,
  `red_tecnologica` varchar(255) NOT NULL,
  `red_de_conocimiento` varchar(255) NOT NULL,
  `modalidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id_programa`, `codigo`, `version`, `tipo_de_formacion`, `nombre`, `descripcion`, `nivel_de_formacion`, `duracion`, `linea_tecnologica`, `red_tecnologica`, `red_de_conocimiento`, `modalidad`) VALUES
(1, '22620442', '3', 'Complementaria', 'BASICO OPERATIVO TRABAJO SEGURO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 8, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(2, '22620443', '2', 'Complementaria', 'ADMINISTRATIVO  PARA JEFES DE AREA TRABAJO SEGURO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 10, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(3, '22620444', '3', 'Complementaria', 'COORDINADOR DE TRABAJO SEGURO EN ALTURAS.', 'Capacitación para trabajos en altura.', 'Curso especial', 80, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(4, '22620461', '2', 'Complementaria', 'RESCATE INDUSTRIAL EN TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 48, 'PRODUCCIÓN Y TRANSFORMACIÓN', 'TECNOLOGÍAS DE PRODUCCIÓN INDUSTRIAL', 'Infraestructura', 'Presencial'),
(5, '22620489', '1', 'Complementaria', 'TRABAJADOR AUTORIZADO PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 32, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(6, '22620490', '1', 'Complementaria', 'COORDINADOR DE TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 80, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(7, '22620491', '1', 'Complementaria', 'REENTRENAMIENTO EN TRABAJO EN ALTURAS PARA TRABAJADOR AUTORIZADO', 'Capacitación para trabajos en altura.', 'Curso especial', 16, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(8, '22620492', '1', 'Complementaria', 'ACTUALIZACION DE COORDINADORES PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 16, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(9, '22620493', '1', 'Complementaria', 'ACTUALIZACION DE ENTRENADORES PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 32, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(10, '22620494', '1', 'Complementaria', 'ENTRENADOR PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 130, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(11, '22620495', '1', 'Complementaria', 'FORMADOR DE ENTRENADORES PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 48, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(12, '22620496', '1', 'Complementaria', 'JEFES DE AREA PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 8, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(13, '41311191', '1', 'Complementaria', 'INSPECTOR DE CENTROS DE FORMACION Y ENTRENAMIENTO PARA TRABAJO EN ALTURAS Y ESPACIOS CONFINADOS', 'Capacitación para trabajos en altura.', 'Curso especial', 48, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial'),
(14, '86110513', '2', 'Complementaria', 'ACONDICIONAMIENTO DE ANDAMIOS PARA TRABAJO EN ALTURAS', 'Capacitación para trabajos en altura.', 'Curso especial', 48, 'MATERIALES HERRAMIENTAS', 'MATERIALES PARA LA CONSTRUCCIÓN', 'Construcción', 'Presencial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) NOT NULL,
  `descripcion_rol` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `descripcion_rol`) VALUES
(1, 'Administrador', NULL),
(2, 'Usuario', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo_de_solicitud` varchar(50) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `prioridad` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_agente` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_usuario`, `tipo_de_solicitud`, `titulo`, `descripcion`, `prioridad`, `estado`, `id_agente`, `fecha_creacion`, `fecha_actualizacion`, `id_programa`) VALUES
(1, 1, NULL, 'Solicitud de cupos para BASICO OPERATIVO TRABAJO SEGURO EN ALTURAS', 'Necesito 5 cupos para el curso de trabajo seguro en alturas.', 'Alta', 'abierto', NULL, '2023-10-01', '2023-10-01', 1),
(2, 2, NULL, 'Apertura de nuevo programa ADMINISTRATIVO PARA JEFES DE AREA TRABAJO SEGURO EN ALTURAS', 'Solicito la apertura de un nuevo programa de trabajo seguro en alturas.', 'Media', 'cerrado', NULL, '2023-10-02', '2023-10-02', 2),
(3, 3, NULL, 'Solicitud de cupos para COORDINADOR DE TRABAJO SEGURO EN ALTURAS', 'Necesito 3 cupos para el curso de coordinador de trabajo seguro en alturas.', 'Alta', 'resuelto', NULL, '2023-10-03', '2023-10-03', 3),
(4, 4, NULL, 'Solicitud de cupos para RESCATE INDUSTRIAL EN TRABAJO EN ALTURAS', 'Necesito 2 cupos para el curso de rescate industrial en trabajo en alturas.', 'Alta', 'abierto', NULL, '2023-10-04', '2023-10-04', 4),
(5, 5, NULL, 'Solicitud de cupos para TRABAJADOR AUTORIZADO PARA TRABAJO EN ALTURAS', 'Necesito 4 cupos para el curso de trabajador autorizado para trabajo en alturas.', 'Media', 'cerrado', NULL, '2023-10-05', '2023-10-05', 5),
(6, 1, NULL, 'Solicitud de cupos para COORDINADOR DE TRABAJO EN ALTURAS', 'Necesito 6 cupos para el curso de coordinador de trabajo en alturas.', 'Alta', 'progreso', NULL, '2023-10-06', '2023-10-06', 6),
(7, 2, NULL, 'Solicitud de cupos para REENTRENAMIENTO EN TRABAJO EN ALTURAS PARA TRABAJADOR AUTORIZADO', 'Necesito 2 cupos para el curso de reentrenamiento en trabajo en alturas.', 'Alta', 'abierto', NULL, '2023-10-07', '2023-10-07', 7),
(8, 3, NULL, 'Solicitud de cupos para ACTUALIZACION DE COORDINADORES PARA TRABAJO EN ALTURAS', 'Necesito 3 cupos para el curso de actualización de coordinadores.', 'Media', 'cerrado', NULL, '2023-10-08', '2023-10-08', 8),
(9, 4, NULL, 'Solicitud de cupos para ACTUALIZACION DE ENTRENADORES PARA TRABAJO EN ALTURAS', 'Necesito 4 cupos para el curso de actualización de entrenadores.', 'Alta', 'progreso', NULL, '2023-10-09', '2023-10-09', 9),
(10, 5, NULL, 'Solicitud de cupos para ENTRENADOR PARA TRABAJO EN ALTURAS', 'Necesito 5 cupos para el curso de entrenador para trabajo en alturas.', 'Alta', 'abierto', NULL, '2023-10-10', '2023-10-10', 10),
(11, 1, NULL, 'Solicitud de cupos para FORMADOR DE ENTRENADORES PARA TRABAJO EN ALTURAS', 'Necesito 2 cupos para el curso de formador de entrenadores.', 'Media', 'cerrado', NULL, '2023-10-11', '2023-10-11', 11),
(12, 2, NULL, 'Solicitud de cupos para JEFES DE AREA PARA TRABAJO EN ALTURAS', 'Necesito 3 cupos para el curso de jefes de área.', 'Alta', 'progreso', NULL, '2023-10-12', '2023-10-12', 12),
(13, 3, NULL, 'Solicitud de cupos para INSPECTOR DE CENTROS DE FORMACION Y ENTRENAMIENTO PARA TRABAJO EN ALTURAS Y ESPACIOS CONFINADOS', 'Necesito 4 cupos para el curso de inspector de centros de formación.', 'Alta', 'abierto', NULL, '2023-10-13', '2023-10-13', 13),
(14, 4, NULL, 'Solicitud de cupos para ACONDICIONAMIENTO DE ANDAMIOS PARA TRABAJO EN ALTURAS', 'Necesito 5 cupos para el curso de acondicionamiento de andamios.', 'Media', 'pendiente', NULL, '2023-10-14', '2023-10-14', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `tipo_documento` varchar(255) NOT NULL,
  `documento` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `tipo_documento`, `documento`, `nombre`, `apellido`, `email`, `telefono`, `departamento`, `municipio`, `password`, `id_rol`, `fecha_registro`, `estado`) VALUES
(1, 'CC', '1053810807', 'Jonathan Robinson', 'Aristizabal Soto', 'admin@gmail.com', '3187542709', 'Caldas', 'Manizales', '$2y$10$DZZkPzlQlZzEtlyyIdPFju3WGm8mUsLRKRna6qpu.9I5zUgm.8HtG', 1, '2024-09-07', 'activo'),
(2, 'CC', '87654321', 'María', 'Gómez', 'maria.gomez@example.com', '3201234567', 'Antioquia', 'Medellín', 'password123', 2, '2023-10-01', 'activo'),
(3, 'CC', '11223344', 'Carlos', 'López', 'carlos.lopez@example.com', '3109876543', 'Bogotá', 'Bogotá', 'password123', 2, '2023-10-02', 'activo'),
(4, 'CC', '44332211', 'Ana', 'Martínez', 'ana.martinez@example.com', '3001239876', 'Valle del Cauca', 'Cali', 'password123', 2, '2023-10-03', 'activo'),
(5, 'CC', '55667788', 'Luis', 'Rodríguez', 'luis.rodriguez@example.com', '3112233445', 'Santander', 'Bucaramanga', 'password123', 2, '2023-10-04', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_ticket` (`id_ticket`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_ticket` (`id_ticket`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id_programa`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_programa` (`id_programa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `email_2` (`email`),
  ADD KEY `documento_2` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
