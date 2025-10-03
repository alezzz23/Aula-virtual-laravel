-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2025 a las 01:22:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aula_virtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `registro` int(11) NOT NULL DEFAULT 1,
  `asistencia` tinyint(1) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `usuario_id`, `curso_id`, `materia_id`, `registro`, `asistencia`, `comentario`, `fecha`) VALUES
(89, 157, 60, 118, 1, 1, '', '2025-02-10 02:21:06'),
(90, 159, 60, 118, 1, 1, NULL, '2025-02-10 02:21:07'),
(91, 157, 60, 120, 1, 1, '', '2025-02-10 02:21:15'),
(92, 159, 60, 120, 1, 1, NULL, '2025-02-10 02:21:15'),
(94, 157, 60, 119, 1, 1, '', '2025-02-10 02:21:23'),
(95, 159, 60, 119, 1, 1, NULL, '2025-02-10 02:21:24'),
(98, 160, 59, 116, 1, 1, NULL, '2025-02-10 02:28:16'),
(99, 158, 59, 116, 1, 1, NULL, '2025-02-10 02:28:16'),
(100, 157, 60, 118, 1, 1, NULL, '2025-02-11 00:10:45'),
(101, 159, 60, 118, 1, 0, NULL, '2025-02-11 00:10:45'),
(104, 157, 60, 119, 1, 0, '', '2025-02-11 00:56:56'),
(105, 159, 60, 119, 1, 1, NULL, '2025-02-11 00:56:57'),
(223, 186, 59, 113, 1, 1, NULL, '2025-02-16 20:06:06'),
(224, 160, 59, 113, 1, 1, NULL, '2025-02-16 20:06:06'),
(225, 185, 59, 113, 1, 1, NULL, '2025-02-16 20:06:06'),
(226, 158, 59, 113, 1, 1, NULL, '2025-02-16 20:06:07'),
(247, 159, 60, 121, 1, 1, NULL, '2025-02-16 20:23:40'),
(248, 157, 60, 121, 1, 1, NULL, '2025-02-16 20:31:48'),
(249, 187, 60, 121, 1, 0, NULL, '2025-02-16 20:32:10'),
(250, 184, 60, 121, 1, 0, '', '2025-02-16 20:32:18'),
(251, 186, 59, 113, 1, 1, NULL, '2025-02-17 15:38:26'),
(252, 160, 59, 113, 1, 0, NULL, '2025-02-17 15:38:26'),
(253, 185, 59, 113, 1, 1, NULL, '2025-02-17 15:38:26'),
(254, 158, 59, 113, 1, 1, '', '2025-02-17 15:38:26'),
(255, 187, 60, 121, 1, 1, NULL, '2025-02-17 15:39:16'),
(257, 157, 60, 121, 1, 1, NULL, '2025-02-17 15:39:16'),
(258, 159, 60, 121, 1, 1, NULL, '2025-02-17 15:39:16'),
(259, 187, 60, 121, 2, 1, NULL, '2025-02-17 15:39:40'),
(260, 184, 60, 121, 2, 1, NULL, '2025-02-17 15:39:40'),
(261, 157, 60, 121, 2, 1, NULL, '2025-02-17 15:39:40'),
(262, 159, 60, 121, 2, 1, NULL, '2025-02-17 15:39:40'),
(263, 184, 60, 121, 1, 1, NULL, '2025-02-17 15:43:30'),
(264, 186, 59, 113, 1, 1, NULL, '2025-02-18 02:45:37'),
(265, 160, 59, 113, 1, 1, NULL, '2025-02-18 02:45:37'),
(266, 190, 59, 113, 1, 0, NULL, '2025-02-18 02:45:37'),
(267, 185, 59, 113, 1, 1, NULL, '2025-02-18 02:45:37'),
(268, 158, 59, 113, 1, 1, NULL, '2025-02-18 02:45:37'),
(269, 186, 59, 113, 2, 1, NULL, '2025-02-18 02:47:05'),
(270, 160, 59, 113, 2, 1, NULL, '2025-02-18 02:47:05'),
(271, 190, 59, 113, 2, 1, NULL, '2025-02-18 02:47:05'),
(272, 185, 59, 113, 2, 1, NULL, '2025-02-18 02:47:05'),
(273, 158, 59, 113, 2, 1, NULL, '2025-02-18 02:47:05'),
(274, 189, 60, 119, 1, 1, NULL, '2025-02-20 23:12:59'),
(275, 157, 60, 119, 1, 0, 'pase', '2025-02-20 23:12:59'),
(276, 159, 60, 119, 1, 1, NULL, '2025-02-20 23:12:59'),
(277, 184, 60, 119, 1, 1, NULL, '2025-02-20 23:12:59'),
(278, 187, 60, 119, 1, 1, NULL, '2025-02-20 23:12:59'),
(279, 189, 60, 119, 1, 1, NULL, '2025-02-20 23:29:55'),
(280, 157, 60, 119, 1, 1, 'pase', '2025-02-20 23:29:55'),
(281, 159, 60, 119, 1, 1, '\r\n', '2025-02-20 23:29:56'),
(282, 184, 60, 119, 1, 1, NULL, '2025-02-20 23:29:56'),
(283, 187, 60, 119, 1, 0, NULL, '2025-02-20 23:29:56'),
(284, 189, 60, 120, 1, 1, NULL, '2025-03-20 02:50:50'),
(285, 157, 60, 120, 1, 0, 'pase', '2025-03-20 02:50:51'),
(286, 159, 60, 120, 1, 1, NULL, '2025-03-20 02:50:51'),
(287, 184, 60, 120, 1, 1, NULL, '2025-03-20 02:50:51'),
(288, 187, 60, 120, 1, 1, NULL, '2025-03-20 02:50:51'),
(289, 189, 60, 118, 1, 1, 'pase', '2025-03-20 02:59:23'),
(290, 157, 60, 118, 1, 0, '', '2025-03-20 02:59:23'),
(291, 159, 60, 118, 1, 1, NULL, '2025-03-20 02:59:24'),
(292, 184, 60, 118, 1, 1, NULL, '2025-03-20 02:59:24'),
(293, 187, 60, 118, 1, 1, NULL, '2025-03-20 02:59:24'),
(294, 189, 60, 119, 1, 1, NULL, '2025-03-20 03:00:16'),
(295, 157, 60, 119, 1, 0, 'Pase', '2025-03-20 03:00:17'),
(296, 159, 60, 119, 1, 1, NULL, '2025-03-20 03:00:17'),
(297, 184, 60, 119, 1, 1, 'pase', '2025-03-20 03:00:18'),
(298, 187, 60, 119, 1, 1, NULL, '2025-03-20 03:00:18'),
(299, 157, 59, 113, 1, 1, NULL, '2025-04-19 23:08:33'),
(300, 157, 59, 114, 1, 1, NULL, '2025-04-19 23:08:38'),
(301, 157, 59, 116, 1, 0, NULL, '2025-04-19 23:08:43'),
(302, 157, 59, 114, 1, 1, NULL, '2025-07-21 14:23:08'),
(303, 157, 59, 116, 1, 0, NULL, '2025-07-21 14:23:30'),
(304, 157, 59, 117, 1, 1, NULL, '2025-07-21 14:23:41'),
(305, 157, 59, 115, 1, 0, NULL, '2025-07-21 14:23:57'),
(306, 186, 59, 113, 1, 1, NULL, '2025-07-21 19:56:49'),
(307, 190, 59, 113, 1, 1, NULL, '2025-07-21 19:56:49'),
(308, 191, 59, 113, 1, 1, NULL, '2025-07-21 19:56:49'),
(309, 158, 59, 113, 1, 1, NULL, '2025-07-21 19:56:49'),
(310, 185, 59, 113, 1, 1, NULL, '2025-07-21 19:56:49'),
(311, 160, 59, 113, 1, 1, NULL, '2025-07-21 19:56:49'),
(312, 189, 60, 121, 1, 1, NULL, '2025-07-21 19:57:02'),
(313, 157, 60, 121, 1, 1, NULL, '2025-07-21 19:57:02'),
(314, 159, 60, 121, 1, 1, NULL, '2025-07-21 19:57:02'),
(315, 184, 60, 121, 1, 1, NULL, '2025-07-21 19:57:02'),
(316, 187, 60, 121, 1, 1, NULL, '2025-07-21 19:57:02'),
(317, 186, 59, 113, 1, 1, NULL, '2025-08-07 22:15:24'),
(318, 190, 59, 113, 1, 1, NULL, '2025-08-07 22:15:24'),
(319, 191, 59, 113, 1, 1, NULL, '2025-08-07 22:15:24'),
(320, 158, 59, 113, 1, 1, NULL, '2025-08-07 22:15:24'),
(321, 185, 59, 113, 1, 1, NULL, '2025-08-07 22:15:24'),
(322, 160, 59, 113, 1, 1, NULL, '2025-08-07 22:15:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(70) NOT NULL,
  `idMa` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `seccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `seccion`, `estado`) VALUES
(51, '1er Año A', 1),
(52, '1er Año B', 1),
(53, '2do Año A', 1),
(54, '2do Año B', 1),
(55, '3er Año A', 1),
(56, '3er Año B', 1),
(57, '4to Año A', 1),
(58, '4to Año B', 1),
(59, '5to Año U', 1),
(60, '6to Año U', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace`
--

CREATE TABLE `enlace` (
  `id` int(8) NOT NULL,
  `url` varchar(225) NOT NULL,
  `descripcion` varchar(225) NOT NULL,
  `idMa` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `archivo` varchar(255) NOT NULL,
  `tipoArchivo` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `descripcion`, `archivo`, `tipoArchivo`, `fecha`) VALUES
(8, 'Página Web del Colegio Madre Emilia', 'Los estudiantes de 6to Año \"U\" crearon una pagina web, donde los estudiantes, profesores y administradores puedan flexibilizar sus tareas; los estudiantes pueden ver las actividades de las materias donde el profesor es quien las manda y en algunos casos los estudiantes pueden utilizar la plataforma para enviar tareas si es que tienen permisos por problemas de salud o deporte, además de poder enviar actividades, también puede registrar las notas del estudiante, así el estudiante puede ver sus notas y su promedio.\r\n\r\nMientras el administrador puede agregar los cursos, profesores, materias y estudiantes; e incluso puede subir publicaciones como esta en la plataforma y también tiene el el control total de las materias y poder gestionar las notas.\r\n\r\nY por ultimo tienen un apartado de chats, que son para enviar comentarios en las materias para comunicarse con los estudiantes y profesores.', 'hola.png', 'image/jpeg', '2025-01-11 00:59:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id` int(11) NOT NULL,
  `informacion` varchar(70) NOT NULL,
  `lapso` varchar(30) DEFAULT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`id`, `informacion`, `lapso`, `fecha`) VALUES
(44, 'Consejo de Profesores', NULL, '2025-07-19 00:41:00'),
(64, 'Corte de Notas', '3er Lapso', '2025-07-22 08:01:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia`
--

CREATE TABLE `guia` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `archivo` varchar(250) NOT NULL,
  `idMa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `materia` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profesor` int(30) NOT NULL,
  `curso` int(11) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `materia`, `profesor`, `curso`, `estado`) VALUES
(113, 'Castellano', 161, 59, 1),
(114, 'Informática', 162, 59, 1),
(115, 'Practicas de oficina', 164, 59, 1),
(116, 'Mantenimiento', 162, 59, 1),
(117, 'Programación', 162, 59, 1),
(118, 'Estructura de Datos', 163, 60, 1),
(119, 'Sistemas Operativos', 163, 60, 1),
(120, 'Proyecto', 163, 60, 1),
(121, 'Programación II', 162, 60, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `alumno` int(60) NOT NULL,
  `lapso` varchar(20) NOT NULL,
  `1era` int(2) NOT NULL,
  `2da` int(2) NOT NULL,
  `3era` int(2) NOT NULL,
  `4ta` int(2) NOT NULL,
  `adicionales` int(11) DEFAULT 0,
  `total` int(2) NOT NULL,
  `idMa` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `alumno`, `lapso`, `1era`, `2da`, `3era`, `4ta`, `adicionales`, `total`, `idMa`, `curso`, `periodo`) VALUES
(319, 157, '1er Lapso', 15, 20, 20, 18, 0, 18, 114, 59, 16),
(320, 157, '1er Lapso', 13, 17, 15, 20, 0, 16, 116, 59, 16),
(321, 157, '1er Lapso', 16, 20, 14, 20, 0, 18, 117, 59, 16),
(322, 157, '2do Lapso', 17, 10, 17, 17, 0, 15, 114, 59, 16),
(323, 157, '2do Lapso', 13, 19, 15, 15, 0, 16, 116, 59, 16),
(324, 157, '2do Lapso', 18, 13, 12, 20, 0, 16, 117, 59, 16),
(325, 157, '3er Lapso', 20, 15, 17, 14, 0, 17, 114, 59, 16),
(326, 157, '3er Lapso', 11, 17, 18, 20, 0, 17, 116, 59, 16),
(327, 157, '3er Lapso', 12, 12, 16, 14, 0, 14, 117, 59, 16),
(328, 157, '1er Lapso', 16, 11, 13, 14, 0, 14, 113, 59, 16),
(329, 157, '1er Lapso', 12, 10, 12, 13, 0, 12, 115, 59, 16),
(330, 157, '2do Lapso', 11, 11, 9, 13, 0, 11, 113, 59, 16),
(331, 157, '2do Lapso', 8, 12, 5, 20, 0, 11, 115, 59, 16),
(332, 157, '3er Lapso', 10, 10, 13, 14, 0, 12, 113, 59, 16),
(333, 157, '3er Lapso', 10, 13, 13, 20, 0, 14, 115, 59, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_clases`
--

CREATE TABLE `periodo_clases` (
  `id` int(11) NOT NULL,
  `fecha_inicio` int(4) NOT NULL,
  `fecha_final` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodo_clases`
--

INSERT INTO `periodo_clases` (`id`, `fecha_inicio`, `fecha_final`) VALUES
(16, 2024, 2025),
(17, 2025, 2026);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalizar`
--

CREATE TABLE `personalizar` (
  `id` int(11) NOT NULL,
  `colegio` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `color` varchar(200) NOT NULL,
  `fecha` timestamp(6) NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personalizar`
--

INSERT INTO `personalizar` (`id`, `colegio`, `logo`, `color`, `fecha`) VALUES
(22, '*Insertar Titulo*', 'img/logo_1754608644.jpeg', '#00704f', '2025-08-07 23:17:24.712981');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `idMa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prof_guia`
--

CREATE TABLE `prof_guia` (
  `id` int(11) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prof_guia`
--

INSERT INTO `prof_guia` (`id`, `usuario`, `curso`) VALUES
(38, 163, 60),
(39, 164, 58),
(40, 164, 57),
(43, 162, 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `usuario` int(60) NOT NULL,
  `comentario` varchar(999) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idMa` int(11) NOT NULL,
  `rol` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'Admin'),
(2, 'Profesor/a'),
(3, 'Estudiante'),
(4, 'Coordinador/a'),
(5, 'Coordinador/a de Evaluación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(9999) NOT NULL,
  `archivo` varchar(250) NOT NULL,
  `idMa` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareaimg`
--

CREATE TABLE `tareaimg` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `idMa` int(11) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userRole` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `userId`, `userRole`, `login_time`, `logout_time`) VALUES
(395, 61, 'Admin', '2025-04-20 01:27:15', '2025-04-20 01:59:38'),
(396, 157, 'Estudiante', '2025-04-20 01:59:49', NULL),
(397, 157, 'Estudiante', '2025-04-20 02:00:21', NULL),
(398, 61, 'Admin', '2025-04-20 02:00:32', '2025-04-20 02:00:47'),
(399, 157, 'Estudiante', '2025-04-20 02:00:59', '2025-04-20 02:01:24'),
(400, 61, 'Admin', '2025-04-20 02:02:15', '2025-04-20 02:02:34'),
(401, 157, 'Estudiante', '2025-04-20 02:02:42', NULL),
(402, 157, 'Estudiante', '2025-04-20 02:04:40', NULL),
(403, 157, 'Estudiante', '2025-04-20 02:04:57', NULL),
(404, 157, 'Estudiante', '2025-04-20 02:10:42', NULL),
(405, 157, 'Estudiante', '2025-04-20 02:12:04', NULL),
(406, 157, 'Estudiante', '2025-04-20 02:13:41', NULL),
(407, 61, 'Admin', '2025-04-20 06:18:37', '2025-04-22 02:17:28'),
(408, 61, 'Admin', '2025-04-22 02:17:36', NULL),
(409, 61, 'Admin', '2025-05-27 05:38:36', NULL),
(410, 61, 'Admin', '2025-05-27 05:38:36', NULL),
(411, 61, 'Admin', '2025-05-27 05:39:29', NULL),
(412, 61, 'Admin', '2025-05-27 05:39:29', NULL),
(413, 61, 'Admin', '2025-05-27 05:39:29', NULL),
(414, 61, 'Admin', '2025-05-27 05:39:29', NULL),
(415, 61, 'Admin', '2025-05-27 05:39:43', NULL),
(416, 61, 'Admin', '2025-06-22 18:56:03', '2025-06-22 20:03:25'),
(417, 61, 'Admin', '2025-06-22 20:03:35', '2025-06-22 21:20:44'),
(418, 157, 'Estudiante', '2025-06-22 21:20:50', '2025-06-22 21:22:30'),
(419, 61, 'Admin', '2025-06-22 21:22:38', '2025-06-22 21:42:21'),
(420, 157, 'Estudiante', '2025-06-22 21:42:34', '2025-06-22 22:30:35'),
(421, 61, 'Admin', '2025-06-22 22:30:41', NULL),
(422, 61, 'Admin', '2025-07-19 04:44:31', '2025-07-19 06:32:02'),
(423, 61, 'Admin', '2025-07-19 06:32:12', '2025-07-19 11:15:08'),
(424, 61, 'Admin', '2025-07-19 11:15:16', NULL),
(425, 61, 'Admin', '2025-07-20 09:28:59', '2025-07-20 09:38:07'),
(426, 163, 'Profesor/a', '2025-07-20 09:38:15', '2025-07-20 09:39:26'),
(427, 163, 'Profesor/a', '2025-07-20 09:39:47', '2025-07-20 09:45:22'),
(428, 61, 'Admin', '2025-07-20 09:45:26', NULL),
(429, 61, 'Admin', '2025-07-20 09:46:31', '2025-07-20 09:48:16'),
(430, 163, 'Profesor/a', '2025-07-20 09:48:27', NULL),
(431, 163, 'Profesor/a', '2025-07-21 07:27:40', NULL),
(432, 163, 'Profesor/a', '2025-07-21 07:27:41', '2025-07-21 07:28:49'),
(433, 162, 'Profesor/a', '2025-07-21 07:28:55', '2025-07-21 07:58:26'),
(434, 162, 'Profesor/a', '2025-07-21 07:58:32', '2025-07-21 07:59:17'),
(435, 61, 'Admin', '2025-07-21 07:59:24', '2025-07-21 10:41:42'),
(436, 61, 'Admin', '2025-07-21 10:41:48', '2025-07-21 12:46:10'),
(437, 61, 'Admin', '2025-07-21 12:46:17', '2025-07-21 12:58:47'),
(438, 163, 'Profesor/a', '2025-07-21 12:58:56', '2025-07-21 12:59:15'),
(439, 61, 'Admin', '2025-07-21 12:59:20', '2025-07-21 13:00:05'),
(440, 163, 'Profesor/a', '2025-07-21 13:00:19', NULL),
(441, 163, 'Profesor/a', '2025-07-21 13:00:20', '2025-07-21 13:23:21'),
(442, 61, 'Admin', '2025-07-21 13:05:20', NULL),
(443, 162, 'Profesor/a', '2025-07-21 13:23:26', '2025-07-21 13:58:53'),
(444, 61, 'Admin', '2025-07-21 13:59:04', NULL),
(445, 61, 'Admin', '2025-07-21 16:00:08', '2025-07-21 18:47:37'),
(446, 61, 'Admin', '2025-07-21 18:48:51', '2025-07-21 19:47:33'),
(447, 61, 'Admin', '2025-07-21 18:48:51', NULL),
(448, 61, 'Admin', '2025-07-21 20:25:41', '2025-07-21 21:46:51'),
(449, 61, 'Admin', '2025-07-21 21:46:57', NULL),
(450, 61, 'Admin', '2025-08-03 11:14:30', '2025-08-03 11:21:01'),
(451, 61, 'Admin', '2025-08-03 11:21:21', '2025-08-03 11:25:09'),
(452, 61, 'Admin', '2025-08-03 11:27:13', '2025-08-03 11:28:51'),
(453, 157, 'Estudiante', '2025-08-03 11:29:32', '2025-08-03 11:30:20'),
(454, 61, 'Admin', '2025-08-03 11:30:25', '2025-08-03 11:43:20'),
(455, 61, 'Admin', '2025-08-03 11:43:26', '2025-08-03 11:49:15'),
(456, 61, 'Admin', '2025-08-03 12:02:04', '2025-08-03 12:04:02'),
(457, 61, 'Admin', '2025-08-03 12:04:26', '2025-08-03 13:05:10'),
(458, 61, 'Admin', '2025-08-03 13:05:15', NULL),
(459, 61, 'Admin', '2025-08-04 10:03:40', '2025-08-04 10:03:41'),
(460, 61, 'Admin', '2025-08-04 10:03:54', '2025-08-04 10:17:39'),
(461, 61, 'Admin', '2025-08-04 10:22:48', '2025-08-04 10:24:42'),
(462, 61, 'Admin', '2025-08-04 10:25:40', '2025-08-04 10:26:08'),
(463, 61, 'Admin', '2025-08-04 10:26:19', '2025-08-04 10:27:22'),
(464, 61, 'Admin', '2025-08-04 10:27:30', '2025-08-04 12:36:15'),
(465, 61, 'Admin', '2025-08-04 12:36:33', NULL),
(466, 61, 'Admin', '2025-08-05 10:50:42', '2025-08-05 10:50:44'),
(467, 61, 'Admin', '2025-08-05 10:50:42', NULL),
(468, 61, 'Admin', '2025-08-05 10:50:51', '2025-08-05 10:51:42'),
(469, 61, 'Admin', '2025-08-05 10:51:49', '2025-08-05 10:59:19'),
(470, 61, 'Admin', '2025-08-05 11:10:46', NULL),
(471, 61, 'Admin', '2025-08-08 00:10:45', '2025-08-08 00:10:48'),
(472, 61, 'Admin', '2025-08-08 00:10:55', '2025-08-08 01:07:33'),
(473, 61, 'Admin', '2025-08-08 01:16:21', '2025-08-08 01:17:30'),
(474, 157, 'Estudiante', '2025-08-08 01:18:20', '2025-08-08 01:18:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namefull` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(12) NOT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `idRol` int(11) NOT NULL,
  `seccion` int(11) DEFAULT NULL,
  `enviar_tareas` tinyint(1) DEFAULT 0,
  `ver_notas` tinyint(4) DEFAULT 0,
  `estado` varchar(20) NOT NULL DEFAULT 'Activo',
  `guia` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `namefull`, `cedula`, `sexo`, `fecha_nacimiento`, `password`, `correo`, `telefono`, `idRol`, `seccion`, `enviar_tareas`, `ver_notas`, `estado`, `guia`) VALUES
(61, 'Maxon', NULL, '31656626', NULL, NULL, '$2y$10$PwachjBZtGRuTzJR.b9RD.iYkt.MFlAaGaT37eGCXS8zcytUgXGYi', 'maxondmdo@gmail.co', '04242022924', 1, NULL, 0, 0, 'Activo', 0),
(157, 'Deiner Montes de Oca', 'Montes de Oca Peña Deiner Christyan', '31656626', 'M', '2007-03-04', '$2y$10$sMxrsziaS5iilHh4gYDil.jRpt./uLxRV4OqBqww6wm5BV.hcqzlC', 'maxondmdo@gmail.com', '04242022924', 3, 60, 1, 1, 'Activo', 0),
(158, 'Elio Martinez', 'Martinez Torres Elio David', '31656622', 'M', '2007-04-09', '$2y$10$ayF0H3t6AfZf0kFBAI22h.nxgL27666nVqyPnmd6SITgb8.3.gXjK', 'elio@gmail.com', '04123459310', 3, 59, 1, 1, 'Activo', 0),
(159, 'José Pérez', 'Peréz Peña José Anthonio', '12345', 'M', '2007-02-14', '$2y$10$sA9XhW8rEs7zLH3zGbPcNecibODNW1AfMaaPntYRmtjTuuWZlz3eO', 'jose@gmail.com', '04125469223', 3, 60, 0, 0, 'Activo', 0),
(160, 'Alejandro Sojo', 'Sojo Alejandro', '12345', 'M', NULL, '$2y$10$JvkX48IeApKQojfJBKLoeu2n.eU4r2Au/5vGk8cGJeeejmZUMWLBK', 'ale@gmail.com', '0426745924', 3, 59, 0, 0, 'Activo', 0),
(161, 'Caridad Pérez', NULL, '12345', NULL, NULL, '$2y$10$hWl0pDX.mcdI/ZK81FUzZ.Qpw9mJgAddwd1YO9ws.n3lQk6BUKEFa', 'caridad@gmail.com', '04123459310', 2, NULL, 0, 0, 'Activo', 1),
(162, 'German Vergara', NULL, '12345', NULL, NULL, '$2y$10$teMrU9X9T53ivwyevGRRZutNrsXTDWHKT2.pAHic3ugrnIRjkMey6', 'german@gmail.com', '02125639351', 2, NULL, 0, 0, 'Activo', 1),
(163, 'Marjorie Amaro', NULL, '12345', NULL, NULL, '$2y$10$HHrFpntr/VfnlwT3LdliLOX1unyEhY9s5A2hltMbznJ.P3qgUWsWi', 'marjorie@gmail.com', '04123371310', 2, NULL, 0, 0, 'Activo', 1),
(164, 'Jenny Patiño', NULL, '12345', NULL, NULL, '$2y$10$DWLaxFbnLmzZFXpb0p7pceS/t.jHgfZbb3sETjqKeHpGWpGtm8DMy', 'jenni@gmail.com', '04246719386', 2, NULL, 0, 0, 'Activo', 1),
(182, 'Deiner ', NULL, '31656626', NULL, NULL, '$2y$10$czufCzU7IX0rUR5rUQ2qBOjLH.KziZGNv.XwvWIF3Dxgwd8sXzF9O', 'maxondmdo@gmail.com', '04242022924', 4, NULL, 0, 0, 'Activo', 0),
(183, 'Christyan', NULL, '31656626', NULL, NULL, '$2y$10$l/xH0ReLw1v8md9MlNGB.uzPckqunWtyzF4t6tm4RO57HA3lNQQB6', 'maxondmdo@gmail.com', '04242022924', 5, NULL, 0, 0, 'Activo', 0),
(184, 'Audymar Romero', 'Romero Lovera Audymar Shingia', '12345', 'F', '2007-09-29', '$2y$10$SOec/GLVuhon4vaYvdMbyupXxMZeTmHGastJrNL.inbmpKUOqeqNi', 'audymarsrl@gmail.com', '04242516721', 3, 60, 0, 0, 'Activo', 0),
(185, 'Braulio Paruta', 'Paruta Braulio', '12345', 'M', NULL, '$2y$10$zE1fA8tPdXSKdr4COLgo/eh9rDZ52jW97XMXin.VdCFqxiPSAiWJ6', 'braulio@gmail.com', '04127638910', 3, 59, 0, 0, 'Activo', 0),
(186, 'Aaron Agamez', 'Agamez Aaron', '12345', 'M', NULL, '$2y$10$92A.uJefWkomd0MWEpnBRu5dVffc61qhV/vMteeiSkH8QKUIoeuWy', 'aaron@gmail.com', '041419467123', 3, 59, 0, 0, 'Activo', 0),
(187, 'Angelo Romero', 'Romero Romero Angelo David', '12345', 'M', '2007-10-05', '$2y$10$OIYZJv6tRLa9DEvShuZyGenP7AU2r.Hh9XvJ5dG9fvkBgYJEvY1WW', 'angeloromero32170@gmail.com', '04162349842', 3, 60, 0, 0, 'Activo', 0),
(189, 'Junior Garcia', 'García Hernández Junior José', '12345', 'M', '2007-04-11', '$2y$10$8i5.fIIPQ4zDc2c2AmTcF.zzA0z15yjLeUOhg/lDvg.iaS2CyjFia', 'juniorgarciahernan12@gmail.com', '04142398641', 3, 60, 0, 0, 'Activo', 0),
(190, 'Anthony Fuentes', 'Fuentes Anthony', '12345', 'M', NULL, '$2y$10$YxZCnBFp25QYEgQKCQhcfupwBHhJQPtk3xFSweafrLwhQ3jxUt4F2', 'antoni@gmail.com', '04242561165', 3, 59, 0, 0, 'Activo', 0),
(191, 'Jesus Gonzales', 'Gonzales Iriarte Jesus Medina', '12345', 'M', NULL, '$2y$10$Hd5ZUtS9SxbOz/otuwMjveVdqObQd8NuRZxKYDjnI2treAtYhm.Hu', 'example@gmail.com', '04249081234', 3, 59, 0, 0, 'Activo', 0),
(199, 'Pablo', NULL, '1234567890', NULL, NULL, '$2y$10$iPNpsELOxHy4l4RAScrGE.WuW8QBOh/lDwhu4Mezz9P3m0CGe6rvO', 'maxondmdo@gmail.com', '04242022924', 2, NULL, 0, 0, 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(70) NOT NULL,
  `idMa` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `asistencia_ibfk_3` (`curso_id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enlace`
--
ALTER TABLE `enlace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guia`
--
ALTER TABLE `guia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso` (`curso`),
  ADD KEY `profesor` (`profesor`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`),
  ADD KEY `alumno` (`alumno`),
  ADD KEY `curso` (`curso`),
  ADD KEY `notas_ibfk_3` (`periodo`);

--
-- Indices de la tabla `periodo_clases`
--
ALTER TABLE `periodo_clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personalizar`
--
ALTER TABLE `personalizar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- Indices de la tabla `prof_guia`
--
ALTER TABLE `prof_guia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `curso` (`curso`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- Indices de la tabla `tareaimg`
--
ALTER TABLE `tareaimg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- Indices de la tabla `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `seccion` (`seccion`),
  ADD KEY `seccion_2` (`seccion`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMa` (`idMa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `enlace`
--
ALTER TABLE `enlace`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `guia`
--
ALTER TABLE `guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT de la tabla `periodo_clases`
--
ALTER TABLE `periodo_clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `personalizar`
--
ALTER TABLE `personalizar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `prof_guia`
--
ALTER TABLE `prof_guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `tareaimg`
--
ALTER TABLE `tareaimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `asistencia_ibfk_3` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `enlace`
--
ALTER TABLE `enlace`
  ADD CONSTRAINT `enlace_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `guia`
--
ALTER TABLE `guia`
  ADD CONSTRAINT `guia_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `curso` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `profesor` FOREIGN KEY (`profesor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `alumno` FOREIGN KEY (`alumno`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`periodo`) REFERENCES `periodo_clases` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `prof_guia`
--
ALTER TABLE `prof_guia`
  ADD CONSTRAINT `prof_guia_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `prof_guia_ibfk_2` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareaimg`
--
ALTER TABLE `tareaimg`
  ADD CONSTRAINT `tareaimg_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`seccion`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`idMa`) REFERENCES `materias` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
