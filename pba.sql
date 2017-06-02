-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2012 a las 05:19:20
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` enum('Prácticas de riego','Sobrepastoreo','Uso de agroquímicos','Labranza','Tala de árboles','Quemas','Compactación de suelos','Pesca','Piscicultura','¿Otra?') DEFAULT NULL,
  `actividad_realizacion` enum('Si','No') DEFAULT NULL,
  `tipo_otro` varchar(45) DEFAULT NULL,
  `frecuencia` varchar(45) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activities_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `actividad`, `actividad_realizacion`, `tipo_otro`, `frecuencia`, `property_id`) VALUES
(1, 'Prácticas de riego', 'Si', NULL, 'Cada 15 dias', 1),
(2, 'Uso de agroquímicos', 'No', NULL, '', 1),
(3, 'Piscicultura', 'Si', NULL, 'A diario', 1),
(4, 'Uso de agroquímicos', 'Si', NULL, 'CAda año', 1),
(5, 'Sobrepastoreo', 'Si', NULL, 'cada mes', 1),
(6, 'Prácticas de riego', 'Si', NULL, '5', 7),
(7, 'Prácticas de riego', 'Si', NULL, 'hjg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  `aco_id` int(10) NOT NULL,
  `aro_id` int(10) NOT NULL,
  PRIMARY KEY (`id`,`aco_id`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociations`
--

CREATE TABLE IF NOT EXISTS `asociations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `comercializacion` enum('Si','No') DEFAULT NULL,
  `informacion_financiera` enum('Si','No') DEFAULT NULL,
  `infraestructura` enum('Si','No') DEFAULT NULL,
  `apoyo_agricola` enum('Nunca','Casi nunca','A veces','Siempre') DEFAULT NULL,
  `apoyo_familiar` enum('Nunca','Casi nunca','A veces','Siempre') DEFAULT NULL,
  `experiencias_agricultores` enum('Nunca','Casi nunca','A veces','Siempre') DEFAULT NULL,
  `participacion` enum('Nunca','Casi nunca','A veces','Siempre') DEFAULT NULL,
  `reuniones` enum('Nunca','Casi nunca','A veces','Siempre') DEFAULT NULL,
  `confianza_lideres` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_socios` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_vecinos` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_intermediarios` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_comerciantes` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_empresarios` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_autoridades` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `confianza_tecnicos` enum('Nada','Poca','Mediana','Alta') DEFAULT NULL,
  `observaciones` text,
  `tierras` tinyint(1) DEFAULT NULL,
  `oficinas` tinyint(1) DEFAULT NULL,
  `maquinaria` tinyint(1) DEFAULT NULL,
  `herramientas` tinyint(1) DEFAULT NULL,
  `cultivos` tinyint(1) DEFAULT NULL,
  `otro_estructura` varchar(55) DEFAULT NULL,
  `centros_acopio` tinyint(1) DEFAULT NULL,
  `decision_consenso` tinyint(1) DEFAULT NULL,
  `decision_director` tinyint(1) DEFAULT NULL,
  `decision_consejo` tinyint(1) DEFAULT NULL,
  `decision_otro` tinyint(1) DEFAULT NULL,
  `decision_no_sabe` tinyint(1) DEFAULT NULL,
  `decision_asamblea` tinyint(1) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Asociations_candidates1_idx` (`candidate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `asociations`
--

INSERT INTO `asociations` (`id`, `nombre`, `comercializacion`, `informacion_financiera`, `infraestructura`, `apoyo_agricola`, `apoyo_familiar`, `experiencias_agricultores`, `participacion`, `reuniones`, `confianza_lideres`, `confianza_socios`, `confianza_vecinos`, `confianza_intermediarios`, `confianza_comerciantes`, `confianza_empresarios`, `confianza_autoridades`, `confianza_tecnicos`, `observaciones`, `tierras`, `oficinas`, `maquinaria`, `herramientas`, `cultivos`, `otro_estructura`, `centros_acopio`, `decision_consenso`, `decision_director`, `decision_consejo`, `decision_otro`, `decision_no_sabe`, `decision_asamblea`, `candidate_id`) VALUES
(1, 'xxxxxxxxxxxx', 'Si', 'Si', 'Si', 'Casi nunca', 'Casi nunca', 'Casi nunca', 'Casi nunca', 'Nunca', 'Nada', 'Mediana', 'Poca', 'Poca', 'Poca', 'Poca', 'Mediana', 'Alta', 'gdfgdfsgsd fsdf', 1, 1, 1, 1, 1, 'sdf', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'terter', 'Si', 'No', 'No', 'Nunca', 'Nunca', 'Siempre', 'Siempre', 'Casi nunca', 'Nada', 'Poca', 'Poca', 'Nada', 'Mediana', 'Poca', 'Mediana', 'Alta', 'teterter   ter ter er tert ert  tert ert er     ter ter     erter  tret er ter  twert wer twer twer', 1, 1, 1, 1, 1, 'tert', 1, 0, 1, 0, 1, 1, 1, 2),
(3, 'qqqqqqqqqqqqqqqqq', 'Si', 'Si', 'Si', 'Nunca', 'Casi nunca', 'A veces', 'A veces', 'Siempre', 'Nada', 'Poca', 'Nada', 'Mediana', 'Nada', 'Poca', 'Nada', 'Poca', 'TUDCCEEASDFasdfasd', 0, 0, 1, 0, 1, 'fasd', 0, 1, 1, 0, 0, 1, 1, 3),
(4, 'ZZZZZZZZZz', 'No', 'Si', 'No', 'A veces', 'A veces', 'Casi nunca', 'A veces', 'Casi nunca', 'Poca', 'Poca', 'Poca', 'Poca', 'Nada', 'Mediana', 'Nada', 'Nada', 'er', 0, 0, 1, 0, 1, 'yre', 0, 1, 1, 1, 1, 1, 1, 4),
(5, 'pppppppppppp', 'Si', 'Si', 'Si', 'Nunca', 'A veces', 'Nunca', 'Nunca', 'Siempre', 'Nada', 'Nada', 'Nada', 'Nada', 'Nada', 'Poca', 'Poca', 'Nada', 'gsdfgdfgsdf', 0, 0, 1, 0, 1, 'das', 0, 1, 0, 0, 0, 1, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Guadaña','Motoazada','Motobombas','Básculas','Cosechadoras costales','Tractor','Picadora','Bombas espalda','Motosierra','Fumigadoras a motor') DEFAULT NULL,
  `otro` varchar(45) DEFAULT NULL,
  `home_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assets_homes1` (`home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `assets`
--

INSERT INTO `assets` (`id`, `tipo`, `otro`, `home_id`) VALUES
(4, 'Motoazada', '5345', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `association_infrastructures`
--

CREATE TABLE IF NOT EXISTS `association_infrastructures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asociation_id` int(11) NOT NULL,
  `tipo` enum('Tierras','Oficinas','Centros de acopio','Maquinaria','Cultivos','Herramientas') DEFAULT NULL,
  `otra_cual` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_association_infrastructures_Asociations1_idx` (`asociation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(45) DEFAULT NULL,
  `segundo_nombre` varchar(45) DEFAULT NULL,
  `primer_apelllido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `tipo_documento` enum('Sin registro','C.C','T.I','NUI','Registro civil') DEFAULT NULL,
  `numero_identificacion` varchar(45) DEFAULT NULL,
  `genero` enum('','Hombre','Mujer') DEFAULT NULL,
  `estado_civil` enum('Soltero','Casado','Union libre','Viudo','Divorciado') DEFAULT NULL,
  `escolaridad` enum('Ninguna','Primaria','Secunadaria','Técnico','Tecnólogo','Universitario') DEFAULT NULL,
  `seguridad_social` enum('Cotizante regimen contributivo','Beneficiario regimen contributivo','Sisben','Otro','Ninguno') DEFAULT NULL,
  `ocupacion` enum('Agricultor','Ganadero','Comerciante','Artesano','Ama de casa','Estudiante','Desempleado','Pensionado') DEFAULT NULL,
  `nivel_sisben` int(11) DEFAULT NULL,
  `prestadora_salud` varchar(50) DEFAULT NULL,
  `discapacidad` text,
  `fecha_nacimiento` date DEFAULT NULL,
  `parentesco` enum('Jefe de hogar','Esposo(a)/Conpañero(a)','Padre','Madre','Abuelo(a)','Hijo(a)','Hermano(a)','Nieto(a)','Tio(a)','Sobrino(a)','Ahijado(a)','Cuñado(a)','Primo(a)','Otro') DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_candidates_properties1` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `candidates`
--

INSERT INTO `candidates` (`id`, `primer_nombre`, `segundo_nombre`, `primer_apelllido`, `segundo_apellido`, `tipo_documento`, `numero_identificacion`, `genero`, `estado_civil`, `escolaridad`, `seguridad_social`, `ocupacion`, `nivel_sisben`, `prestadora_salud`, `discapacidad`, `fecha_nacimiento`, `parentesco`, `edad`, `property_id`) VALUES
(2, '42', '423', '423', '4234', NULL, NULL, 'Mujer', 'Union libre', '', 'Sisben', 'Ama de casa', 423, '4234', '42342424  fefwerwr', NULL, 'Ahijado(a)', 423, 1),
(3, 'sdc', 'csd', 'csd', 'csd', NULL, NULL, 'Mujer', 'Soltero', 'Técnico', 'Sisben', 'Comerciante', 243, 'fsfsdfsfd', 'sdfsfsfsf', NULL, 'Tio(a)', 243, 1),
(4, 'eqw', 'eqw', 'eqw', 'eqw', NULL, NULL, 'Hombre', 'Casado', 'Técnico', 'Cotizante regimen contributivo', 'Pensionado', 432, '4234', '2434234234234', NULL, 'Abuelo(a)', 321, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certifications`
--

CREATE TABLE IF NOT EXISTS `certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entidad` varchar(90) COLLATE armscii8_bin DEFAULT NULL,
  `nombre_certificacion` text COLLATE armscii8_bin,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_certifications_productive_pools1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `certifications`
--

INSERT INTO `certifications` (`id`, `entidad`, `nombre_certificacion`, `fecha_inicio`, `fecha_fin`, `productive_poll_id`) VALUES
(1, 'ds', 0x66667364, '2012-09-19', '2012-09-28', 2),
(2, 'fdsdf', 0x736466, '2012-09-05', '2012-09-26', 2),
(3, '654', 0x363435363435, '2012-10-23', '2012-10-02', 1),
(4, '645', 0x363435, '2012-10-03', '2012-10-03', 1),
(5, 'gdf', 0x67736466677364, '2012-10-23', '2012-10-29', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `departament_id` int(11) NOT NULL,
  `divipol` int(11) DEFAULT NULL,
  `uaf` int(11) DEFAULT NULL,
  `ley_segunda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cities_departaments1` (`departament_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1214 ;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `name`, `departament_id`, `divipol`, `uaf`, `ley_segunda`) VALUES
(1, 'MEDELLIN', 1, 5001, 12, 0),
(2, 'ABEJORRAL', 1, 5002, 15, 0),
(3, 'ABRIAQUI', 1, 5004, 24, 0),
(4, 'ALEJANDRIA', 1, 5021, 12, 0),
(5, 'AMAGA', 1, 5030, 13, 0),
(6, 'AMALFI', 1, 5031, 23, 0),
(7, 'ANDES', 1, 5034, 13, 0),
(8, 'ANGELOPOLIS', 1, 5036, 13, 0),
(9, 'ANGOSTURA', 1, 5038, 21, 0),
(10, 'ANORI', 1, 5040, 23, 0),
(11, 'SANTAFE DE ANTIOQUIA', 1, 5042, 24, 0),
(12, 'ANZA', 1, 5044, 24, 0),
(13, 'APARTADO', 1, 5045, 42, 0),
(14, 'ARBOLETES', 1, 5051, 42, 0),
(15, 'ARGELIA', 1, 5055, 26, 0),
(16, 'ARMENIA', 1, 5059, 13, 0),
(17, 'BARBOSA', 1, 5079, 23, 0),
(18, 'BELMIRA', 1, 5086, 21, 0),
(19, 'BELLO', 1, 5088, 12, 0),
(20, 'BETANIA', 1, 5091, 13, 0),
(21, 'BETULIA', 1, 5093, 13, 0),
(22, 'BOLIVAR', 1, 5101, 13, 0),
(23, 'BRICEÑO', 1, 5107, 21, 0),
(24, 'BURITICA', 1, 5113, 24, 0),
(25, 'CACERES', 1, 5120, 48, 0),
(26, 'CAICEDO', 1, 5125, 24, 0),
(27, 'CALDAS', 1, 5129, 12, 0),
(28, 'CAMPAMENTO', 1, 5134, 21, 0),
(29, 'CAÑASGORDAS', 1, 5138, 24, 0),
(30, 'CARACOLI', 1, 5142, 23, 0),
(31, 'CARAMANTA', 1, 5145, 13, 0),
(32, 'CAREPA', 1, 5147, 42, 0),
(33, 'CARMEN DE VIBORAL', 1, 5148, 12, 0),
(34, 'CAROLINA', 1, 5150, 21, 0),
(35, 'CAUCASIA', 1, 5154, 48, 0),
(36, 'CHIGORODO', 1, 5172, 42, 0),
(37, 'CISNEROS', 1, 5190, 23, 0),
(38, 'COCORNA', 1, 5197, 15, 0),
(39, 'CONCEPCION', 1, 5206, 12, 0),
(40, 'CONCORDIA', 1, 5209, 13, 0),
(41, 'COPACABANA', 1, 5212, 12, 0),
(42, 'CURRULAO-ANTIOQUIA', 1, 5837, 42, 0),
(43, 'DABEIBA', 1, 5234, 24, 0),
(44, 'DON MATIAS', 1, 5237, 21, 0),
(45, 'EBEJICO', 1, 5240, 24, 0),
(46, 'EL BAGRE', 1, 5250, 48, 0),
(47, 'ENTRERRIOS', 1, 5264, 21, 0),
(48, 'ENVIGADO', 1, 5266, 12, 0),
(49, 'FREDONIA', 1, 5282, 13, 0),
(50, 'FRONTINO', 1, 5284, 24, 0),
(51, 'GIRALDO', 1, 5306, 24, 0),
(52, 'GIRARDOTA', 1, 5308, 12, 0),
(53, 'GOMEZ PLATA', 1, 5310, 21, 0),
(54, 'GRANADA', 1, 5313, 12, 0),
(55, 'GUADALUPE', 1, 5315, 21, 0),
(56, 'GUARNE', 1, 5318, 12, 0),
(57, 'GUATAPE', 1, 5321, 12, 0),
(58, 'HELICONIA', 1, 5347, 24, 0),
(59, 'HISPANIA', 1, 5353, 13, 0),
(60, 'ITAGUI', 1, 5360, 12, 0),
(61, 'ITUANGO', 1, 5361, 21, 0),
(62, 'JARDIN', 1, 5364, 13, 0),
(63, 'JERICO', 1, 5368, 13, 0),
(64, 'LA CEJA', 1, 5376, 12, 0),
(65, 'LA ESTRELLA', 1, 5380, 12, 0),
(66, 'LA PINTADA', 1, 5390, 21, 0),
(67, 'LA UNION', 1, 5400, 12, 0),
(68, 'BELEN - ANTIOQUIA', 18, 5001, 12, 0),
(69, 'LIBORINA', 1, 5411, 24, 0),
(70, 'MACEO', 1, 5425, 53, 0),
(71, 'MARINILLA', 1, 5440, 12, 0),
(72, 'MONTEBELLO', 1, 5467, 13, 0),
(73, 'MURINDO', 1, 5475, 42, 1),
(74, 'MUTATA', 1, 5480, 42, 0),
(75, 'NARIÑO', 1, 5483, 26, 0),
(76, 'NECOCLI', 1, 5490, 42, 0),
(77, 'NECHI', 1, 5495, 48, 0),
(78, 'OLAYA', 1, 5501, 24, 0),
(79, 'EL BAGRE-ANTIOQUIA', 1, 5250, 48, 0),
(80, 'PEÑOL', 1, 5541, 12, 0),
(81, 'PEQUE', 1, 5543, 24, 0),
(82, 'PUEBLORRICO', 1, 5576, 13, 0),
(83, 'PUERTO BERRIO', 1, 5579, 53, 0),
(84, 'PUERTO NARE', 1, 5585, 53, 0),
(85, 'PUERTO TRIUNFO', 1, 5591, 53, 0),
(86, 'REMEDIOS', 1, 5604, 23, 0),
(87, 'RETIRO', 1, 5607, 12, 0),
(88, 'RIONEGRO', 1, 5615, 12, 0),
(89, 'SABANALARGA', 1, 5628, 24, 0),
(90, 'SABANETA', 1, 5631, 12, 0),
(91, 'SALGAR', 1, 5642, 13, 0),
(92, 'SAN ANDRES', 1, 5647, 21, 0),
(93, 'SAN CARLOS', 1, 5649, 15, 0),
(94, 'SAN FRANCISCO', 1, 5652, 15, 0),
(95, 'SAN JERONIMO', 1, 5656, 24, 0),
(96, 'SAN JOSE DE LA MONTA', 1, 5658, 21, 0),
(97, 'SAN JUAN DE URABA', 1, 5659, 42, 0),
(98, 'SAN LUIS', 1, 5660, 15, 0),
(99, 'SAN PEDRO', 1, 5664, 21, 0),
(100, 'SAN PEDRO DE URABA', 1, 5665, 42, 0),
(101, 'SAN RAFAEL', 1, 5667, 15, 0),
(102, 'SAN ROQUE', 1, 5670, 23, 0),
(103, 'SAN VICENTE', 1, 5674, 12, 0),
(104, 'SANTA BARBARA', 1, 5679, 13, 0),
(105, 'SANTA ROSA DE OSOS', 1, 5686, 21, 0),
(106, 'SANTO DOMINGO', 1, 5690, 12, 0),
(107, 'SANTUARIO', 1, 5697, 15, 0),
(108, 'SEGOVIA', 1, 5736, 23, 0),
(109, 'SONSON', 1, 5756, 53, 0),
(110, 'SOPETRAN', 1, 5761, 24, 0),
(111, 'TAMESIS', 1, 5789, 13, 0),
(112, 'TARAZA', 1, 5790, 48, 0),
(113, 'TARSO', 1, 5792, 13, 0),
(114, 'TITIRIBI', 1, 5809, 13, 0),
(115, 'TOLEDO', 1, 5819, 21, 0),
(116, 'TURBO', 1, 5837, 42, 0),
(117, 'URAMITA', 1, 5842, 24, 0),
(118, 'URRAO', 1, 5847, 13, 1),
(119, 'VALDIVIA', 1, 5854, 48, 0),
(120, 'VALPARAISO', 1, 5856, 13, 0),
(121, 'VEGACHI', 1, 5858, 23, 0),
(122, 'VENECIA', 1, 5861, 13, 0),
(123, 'VIGIA DEL FUERTE', 1, 5873, 42, 1),
(124, 'YALI', 1, 5885, 23, 0),
(125, 'YARUMAL', 1, 5887, 21, 0),
(126, 'YOLOMBO', 1, 5890, 23, 0),
(127, 'YONDO', 1, 5893, 53, 0),
(128, 'ZARAGOZA', 1, 5895, 48, 0),
(129, 'ALTAMIRA', 1, 5093, 13, 0),
(130, 'SAN CRISTOBAL', 1, 5001, 12, 0),
(131, 'ATLANTICO', 2, 8001, 10, 0),
(132, 'BARRANQUILLA', 2, 8001, 10, 0),
(133, 'BARANOA', 2, 8078, 10, 0),
(134, 'CAMPECHE-ATLANTICO', 2, 8078, 10, 0),
(135, 'CAMPO D LA CRUZ', 2, 8137, 8, 0),
(136, 'CANDELARIA', 2, 8141, 8, 0),
(137, 'GALAPA', 2, 8296, 10, 0),
(138, 'JUAN DE ACOSTA', 2, 8372, 16, 0),
(139, 'LA PLAYA-ATLANTICO', 2, 8001, 10, 0),
(140, 'LURUACO', 2, 8421, 9, 0),
(141, 'MALAMBO', 2, 8433, 9, 0),
(142, 'MANATI', 2, 8436, 8, 0),
(143, 'PALMAR DDE VARELA', 2, 8520, 9, 0),
(144, 'PIOJO', 2, 8549, 16, 0),
(145, 'POLONUEVO', 2, 8558, 10, 0),
(146, 'PONEDERA', 2, 8560, 8, 0),
(147, 'PUERTO COLOMBIA', 2, 8573, 0, 0),
(148, 'REPELON', 2, 8606, 16, 0),
(149, 'SABANAGRANDE', 2, 8634, 9, 0),
(150, 'SABANALARGA', 2, 8638, 10, 0),
(151, 'SANTA LUCIA', 2, 8675, 9, 0),
(152, 'SANTO TOMAS', 2, 8685, 9, 0),
(153, 'SOLEDAD', 2, 8758, 9, 0),
(154, 'SUAN', 2, 8770, 9, 0),
(155, 'TUBARA', 2, 8832, 16, 0),
(156, 'USIACURI', 2, 8849, 10, 0),
(157, 'BOGOTA D.C.', 3, 11001, 10, 0),
(158, 'BOSA-BOGOTA D.C.', 3, 11001, 10, 0),
(159, 'ENGATIVA-BOGOTA D.C.', 3, 11001, 10, 0),
(160, 'FONTIBON-BOGOTA D.C.', 3, 11001, 10, 0),
(161, 'SUBA-BOGOTA D.C.', 3, 11001, 10, 0),
(162, 'USAQUEN-BOGOTA D.C.', 3, 11001, 10, 0),
(163, 'USME-BOGOTA D.C.', 3, 11001, 10, 0),
(164, 'CARTAGENA', 4, 13001, 41, 0),
(165, 'ACHI', 4, 13006, 35, 0),
(166, 'ALTOS DEL ROSARIO', 4, 13030, 35, 0),
(167, 'ARENAL', 4, 13042, 35, 0),
(168, 'ARJONA', 4, 13052, 26, 0),
(169, 'ARROYOHONDO', 4, 13062, 35, 0),
(170, 'BARRANCO DE LOBA', 4, 13074, 35, 0),
(171, 'CALAMAR', 4, 13140, 35, 0),
(172, 'CANTAGALLO', 4, 13160, 35, 0),
(173, 'CICUCO', 4, 13188, 35, 0),
(174, 'CORDOBA', 4, 13212, 35, 0),
(175, 'CLEMENCIA', 4, 13222, 41, 0),
(176, 'EL CARMEN DE BOLIVAR', 4, 13244, 35, 0),
(177, 'EL GUAMO', 4, 13248, 16, 0),
(178, 'EL PEÑON', 4, 13268, 35, 0),
(179, 'HATILLO DE LOBA', 4, 13300, 35, 0),
(180, 'MAGANGUE', 4, 13430, 35, 0),
(181, 'MAHATES', 4, 13433, 26, 0),
(182, 'MARGARITA', 4, 13440, 35, 0),
(183, 'MARIA LA BAJA', 4, 13442, 35, 0),
(184, 'REGIDOR', 4, 13580, 35, 0),
(185, 'MONTECRISTO', 4, 13458, 35, 1),
(186, 'VILLA RICA - VALLE', 4, 13001, 41, 0),
(187, 'MOMPOS', 4, 13468, 35, 0),
(188, 'MORALES', 4, 13473, 35, 0),
(189, 'PINILLOS', 4, 13549, 35, 0),
(190, 'REGIDOR', 4, 13580, 35, 0),
(191, 'RIO VIEJO', 4, 13600, 35, 0),
(192, 'SANCRISTOBAL', 4, 13620, 26, 0),
(193, 'SAN ESTANISLAO', 4, 13647, 35, 0),
(194, 'SAN FERNANDO', 4, 13650, 35, 0),
(195, 'SAN JACINTO', 4, 13654, 35, 0),
(196, 'SANJACINTO DEL CAUCA', 4, 13655, 35, 0),
(197, 'SAN JUAN NEPOMUCENO', 4, 13657, 35, 0),
(198, 'SAN MARTIN DE LOBA', 4, 13667, 35, 0),
(199, 'SAN PABLO', 4, 13670, 13, 1),
(200, 'SANTA CATALINA', 4, 13673, 41, 0),
(201, 'SANTA ROSA', 4, 13683, 41, 0),
(202, 'SANTA ROSA DEL SUR', 4, 13688, 35, 0),
(203, 'SIMITI', 4, 13744, 85, 0),
(204, 'SOPLAVIENTO', 4, 13760, 26, 0),
(205, 'TALAIGUA NUEVO', 4, 13780, 35, 0),
(206, 'PUERTO RICO', 4, 13810, 35, 0),
(207, 'TURBACO', 4, 13836, 41, 0),
(208, 'TURBANA', 4, 13838, 26, 0),
(209, 'VILLANUEVA', 4, 13873, 41, 0),
(210, 'ZAMBRANO', 4, 13894, 35, 0),
(211, 'TUNJA', 5, 15001, 7, 0),
(212, 'ALMEIDA', 5, 15022, 7, 0),
(213, 'AQUITANIA', 5, 15047, 7, 0),
(214, 'ARCABUCO', 5, 15051, 6, 0),
(215, 'BELEN', 5, 15087, 15, 0),
(216, 'BERBEO', 5, 15090, 13, 0),
(217, 'BETEITIVA', 5, 15092, 25, 0),
(218, 'BOAVITA', 5, 15097, 25, 0),
(219, 'BOYACA', 5, 15104, 7, 0),
(220, 'BRICENO', 5, 15106, 13, 0),
(221, 'BUENAVISTA', 5, 15109, 13, 0),
(222, 'BUSBANZA', 5, 15114, 25, 0),
(223, 'CALDAS', 5, 15131, 7, 0),
(224, 'CAMPOHERMOSO', 5, 15135, 13, 0),
(225, 'CERINZA', 5, 15162, 6, 0),
(226, 'CHINAVITA', 5, 15172, 7, 0),
(227, 'CHIQUINQUIRA', 5, 15176, 15, 0),
(228, 'CHISCAS', 5, 15180, 31, 0),
(229, 'CHITA', 5, 15183, 15, 0),
(230, 'CHITARAQUE', 5, 15185, 13, 0),
(231, 'CHIVATA', 5, 15187, 7, 0),
(232, 'CIENEGA', 5, 15189, 15, 0),
(233, 'COMBITA', 5, 15204, 7, 0),
(234, 'COPER', 5, 15212, 13, 0),
(235, 'CORRALES', 5, 15215, 25, 0),
(236, 'COVARACHIA', 5, 15218, 25, 0),
(237, 'CUBARA', 5, 15223, 61, 0),
(238, 'CUCAITA', 5, 15224, 7, 0),
(239, 'CUITIVA', 5, 15226, 7, 0),
(240, 'CHIQUIZA', 5, 15232, 6, 0),
(241, 'CHIVOR', 5, 15236, 7, 0),
(242, 'DUITAMA', 5, 15238, 7, 0),
(243, 'EL COCUY', 5, 15244, 31, 0),
(244, 'EL ESPINO', 5, 15248, 25, 0),
(245, 'FIRAVITOBA', 5, 15272, 6, 0),
(246, 'FLORESTA', 5, 15276, 25, 0),
(247, 'GACHANTIVA', 5, 15293, 7, 0),
(248, 'GAMEZA', 5, 15296, 25, 0),
(249, 'GARAGOA', 5, 15299, 7, 0),
(250, 'GUACAMAYAS', 5, 15317, 25, 0),
(251, 'GUATEQUE', 5, 15322, 7, 0),
(252, 'GUAYATA', 5, 15325, 7, 0),
(253, 'GUICAN', 5, 15332, 31, 0),
(254, 'IZA', 5, 15362, 7, 0),
(255, 'JENESANO', 5, 15367, 5, 0),
(256, 'JERICO', 5, 15368, 31, 0),
(257, 'LABRANZAGRANDE', 5, 15377, 25, 0),
(258, 'LA CAPILLA', 5, 15380, 7, 0),
(259, 'LA VICTORIA', 5, 15401, 15, 0),
(260, 'LA UVITA', 5, 15403, 31, 0),
(261, 'VILLA DE LEYVA', 5, 15407, 7, 0),
(262, 'MACANAL', 5, 15425, 7, 0),
(263, 'MARIPI', 5, 15442, 13, 0),
(264, 'MIRAFLORES', 5, 15455, 13, 0),
(265, 'MONGUA', 5, 15464, 25, 0),
(266, 'MONGUI', 5, 15466, 25, 0),
(267, 'MONIQUIRA', 5, 15469, 13, 0),
(268, 'MOTAVITA', 5, 15476, 7, 0),
(269, 'MUZO', 5, 15480, 13, 0),
(270, 'NOBSA', 5, 15491, 25, 0),
(271, 'NUEVO COLON', 5, 15494, 7, 0),
(272, 'OICATA', 5, 15500, 15, 0),
(273, 'OTANCHE', 5, 15507, 13, 0),
(274, 'PACHAVITA', 5, 15511, 7, 0),
(275, 'PAEZ', 5, 15514, 13, 0),
(276, 'PAIPA', 5, 15516, 6, 0),
(277, 'PAJARITO', 5, 15518, 25, 0),
(278, 'PANQUEBA', 5, 15522, 25, 1),
(279, 'PAUNA', 5, 15531, 13, 0),
(280, 'PAYA', 5, 15533, 25, 0),
(281, 'PAZ DE RIO', 5, 15537, 25, 0),
(282, 'PESCA', 5, 15542, 7, 0),
(283, 'PISVA', 5, 15550, 25, 0),
(284, 'PUERTO BOYACA', 5, 15572, 53, 0),
(285, 'QUIPAMA', 5, 15580, 13, 0),
(286, 'RAMIRIQUI', 5, 15599, 5, 0),
(287, 'RAQUIRA', 5, 15600, 7, 0),
(288, 'RONDON', 5, 15621, 13, 0),
(289, 'SABOYA', 5, 15632, 7, 0),
(290, 'SACHICA', 5, 15638, 7, 0),
(291, 'SAMACA', 5, 15646, 7, 0),
(292, 'SAN EDUARDO', 5, 15660, 13, 0),
(293, 'SAN JOSE DE PARE', 5, 15664, 13, 0),
(294, 'SAN LUIS DE GACENO', 5, 15667, 13, 0),
(295, 'SAN MATEO', 5, 15673, 25, 0),
(296, 'SAN MIGUEL DE SEMA', 5, 15676, 7, 0),
(297, 'SAN PABLO DE BORBUR', 5, 15681, 15, 0),
(298, 'SANTANA', 5, 15686, 15, 0),
(299, 'BELENCITO', 5, 15491, 25, 0),
(300, 'SANTA MARIA', 5, 15690, 13, 0),
(301, 'SANTA ROSA DE VITERB', 5, 15693, 6, 0),
(302, 'SANTA SOFIA', 5, 15696, 7, 0),
(303, 'SATIVANORTE', 5, 15720, 25, 0),
(304, 'SATIVASUR', 5, 15723, 25, 0),
(305, 'SIACHOQUE', 5, 15740, 7, 0),
(306, 'SOATA', 5, 15753, 25, 0),
(307, 'SOCOTA', 5, 15755, 31, 0),
(308, 'SOCHA', 5, 15757, 25, 0),
(309, 'SOGAMOSO', 5, 15759, 6, 0),
(310, 'SOMONDOCO', 5, 15761, 7, 0),
(311, 'SORA', 5, 15762, 7, 0),
(312, 'SOTAQUIRA', 5, 15763, 6, 0),
(313, 'SORACA', 5, 15764, 7, 0),
(314, 'SUSACON', 5, 15774, 25, 0),
(315, 'SUTAMARCHAN', 5, 15776, 7, 0),
(316, 'SUTATENZA', 5, 15778, 7, 0),
(317, 'TASCO', 5, 15790, 25, 0),
(318, 'TENZA', 5, 15798, 7, 0),
(319, 'TIBANA', 5, 15804, 5, 0),
(320, 'TIBASOSA', 5, 15806, 6, 0),
(321, 'TINJACA', 5, 15808, 7, 0),
(322, 'TIPACOQUE', 5, 15810, 15, 0),
(323, 'TOCA', 5, 15814, 7, 0),
(324, 'TOGUI', 5, 15816, 13, 0),
(325, 'TOPAGA', 5, 15820, 25, 0),
(326, 'TOTA', 5, 15822, 7, 0),
(327, 'TUNUNGUA', 5, 15832, 13, 0),
(328, 'TURMEQUE', 5, 15835, 5, 0),
(329, 'TUTA', 5, 15837, 6, 0),
(330, 'TUTASA', 5, 15839, 25, 0),
(331, 'UMBITA', 5, 15842, 15, 0),
(332, 'VENTAQUEMADA', 5, 15861, 5, 0),
(333, 'VIRACACHA', 5, 15879, 5, 0),
(334, 'ZETAQUIRA', 5, 15897, 13, 0),
(335, 'MANIZALES', 6, 17001, 7, 0),
(336, 'AGUADAS', 6, 17013, 12, 0),
(337, 'ANSERMA', 6, 17042, 10, 0),
(338, 'ARANZAZU', 6, 17050, 12, 0),
(339, 'BELALCAZAR', 6, 17088, 10, 0),
(340, 'CHINCHINA', 6, 17174, 13, 0),
(341, 'FILADELFIA', 6, 17272, 10, 0),
(342, 'LA DORADA', 6, 17380, 10, 0),
(343, 'LA MERCED', 6, 17388, 12, 0),
(344, 'MANZANARES', 6, 17433, 13, 0),
(345, 'MARMATO', 6, 17442, 10, 0),
(346, 'MARQUETALIA', 6, 17444, 13, 0),
(347, 'MARULANDA', 6, 17446, 18, 0),
(348, 'NEIRA', 6, 17486, 10, 0),
(349, 'NORCASIA', 6, 17495, 13, 0),
(350, 'PACORA', 6, 17513, 12, 0),
(351, 'PALESTINA', 6, 17524, 7, 0),
(352, 'PENSILVANIA', 6, 17541, 19, 0),
(353, 'RIOSUCIO', 6, 17614, 10, 0),
(354, 'RISARALDA', 6, 17616, 10, 0),
(355, 'SALAMINA', 6, 17653, 12, 0),
(356, 'SAN JOSE', 6, 17665, 13, 0),
(357, 'SAMANA', 6, 17662, 26, 0),
(358, 'SAN JOSE', 6, 17665, 13, 0),
(359, 'SUPIA', 6, 17777, 10, 0),
(360, 'VICTORIA', 6, 17867, 26, 0),
(361, 'VILLAMARIA', 6, 17873, 10, 0),
(362, 'VITERBO', 6, 17877, 10, 0),
(363, 'NORCASIA', 6, 17495, 13, 0),
(364, 'ARBOLEDA', 6, 17541, 19, 0),
(365, 'ARAUCA', 6, 17524, 7, 0),
(366, 'BOLIVIA', 6, 17541, 19, 0),
(367, 'FLORENCIA', 6, 17662, 26, 0),
(368, 'MONTEBONITO', 6, 17446, 18, 0),
(369, 'SAN FELIX', 6, 17653, 12, 0),
(370, 'SAN JOSE DE RISARALDA', 6, 17665, 13, 0),
(371, 'FLORENCIA', 7, 18001, 70, 0),
(372, 'ALBANIA', 7, 18029, 86, 0),
(373, 'BELEN DE LOS ANDAQUI', 7, 18094, 58, 0),
(374, 'CARTAGENA DEL CHAIRA', 7, 18150, 70, 0),
(375, 'CURILLO', 7, 18205, 86, 0),
(376, 'EL DONCELLO', 7, 18247, 58, 0),
(377, 'EL PAUJIL', 7, 18256, 58, 0),
(378, 'LA MONTAÑITA', 7, 18410, 58, 0),
(379, 'MATICURO', 7, 18460, 86, 0),
(380, 'MILAN', 7, 18460, 86, 0),
(381, 'MORELIA', 7, 18479, 58, 0),
(382, 'PUERTO RICO', 7, 18592, 58, 0),
(383, 'SAN JOSE DE FRAGUA', 7, 18610, 58, 0),
(384, 'SAN VICENTE DEL CAGUÁN', 7, 18753, 58, 0),
(385, 'SOLANO', 7, 18756, 86, 0),
(386, 'SOLANO', 7, 18756, 86, 0),
(387, 'SOLITA', 7, 18785, 70, 0),
(388, 'VALPARAISO', 7, 18860, 86, 0),
(389, 'GUACAMAYAS', 7, 18479, 58, 0),
(390, 'POPAYAN', 8, 19001, 5, 0),
(391, 'ALMAGUER', 8, 19022, 5, 0),
(392, 'VILLA RICA (Cauca)', 8, 19845, 14, 0),
(393, 'ARGELIA', 8, 19050, 26, 1),
(394, 'BALBOA', 8, 19075, 7, 0),
(395, 'BOLIVAR', 8, 19100, 7, 0),
(396, 'BUENOS AIRES', 8, 19110, 17, 0),
(397, 'CAJIBIO', 8, 19130, 5, 0),
(398, 'CALDONO', 8, 19137, 17, 0),
(399, 'CALOTO', 8, 19142, 5, 0),
(400, 'CORINTO', 8, 19212, 5, 0),
(401, 'EL BORDO-CAUCA', 8, 19532, 7, 0),
(402, 'EL TAMBO', 8, 19256, 17, 0),
(403, 'FLORENCIA', 8, 19290, 58, 0),
(404, 'GUAPI', 8, 19318, 42, 0),
(405, 'INZA', 8, 19355, 5, 0),
(406, 'JAMBALO', 8, 19364, 5, 0),
(407, 'LA SIERRA', 8, 19392, 5, 0),
(408, 'LA VEGA', 8, 19397, 5, 0),
(409, 'LOPEZ', 8, 19418, 42, 0),
(410, 'MERCADERES', 8, 19450, 7, 0),
(411, 'MIRANDA', 8, 19455, 5, 0),
(412, 'MORALES', 8, 19473, 35, 0),
(413, 'PADILLA', 8, 19513, 14, 0),
(414, 'PAEZ', 8, 19517, 5, 0),
(415, 'PATÍA', 8, 19532, 7, 0),
(416, 'PIAMONTE', 8, 19533, 14, 0),
(417, 'PIENDAMO', 8, 19548, 14, 0),
(418, 'PUERTO TEJADA', 8, 19573, 14, 0),
(419, 'PURACE', 8, 19585, 8, 0),
(420, 'ROSAS', 8, 19622, 5, 0),
(421, 'SAN SEBASTIAN', 8, 19693, 31, 1),
(422, 'SANTANDER DE QUILICH', 8, 19698, 5, 0),
(423, 'SANTA ROSA', 8, 19701, 35, 0),
(424, 'SANTANDER', 8, 19698, 5, 0),
(425, 'SILVIA', 8, 19743, 8, 0),
(426, 'SOTARA', 8, 19760, 8, 0),
(427, 'SUAREZ', 8, 19780, 17, 0),
(428, 'SUCRE', 8, 19785, 14, 0),
(429, 'TIMBIO', 8, 19807, 5, 0),
(430, 'TIMBIQUI', 8, 19809, 42, 0),
(431, 'TORIBIO', 8, 19821, 8, 0),
(432, 'TOTORO', 8, 19824, 8, 0),
(433, 'VILLA RICA (Tol)', 23, 73873, 20, 0),
(434, 'SIBERIA', 8, 19137, 17, 0),
(435, 'VALLEDUPAR', 9, 20001, 26, 0),
(436, 'AGUACHICA', 9, 20011, 28, 0),
(437, 'AGUSTIN CODAZZI', 9, 20013, 26, 0),
(438, 'ASTREA', 9, 20032, 26, 0),
(439, 'BECERRIL', 9, 20045, 26, 0),
(440, 'BOSCONIA', 9, 20060, 41, 0),
(441, 'CASACARA-CESAR', 9, 20013, 26, 0),
(442, 'CHIMICHAGUA', 9, 20175, 35, 0),
(443, 'CHIRIGUANA', 9, 20178, 35, 0),
(444, 'CURUMANI', 9, 20228, 28, 0),
(445, 'EL COPEY', 9, 20238, 26, 0),
(446, 'EL PASO', 9, 20250, 41, 0),
(447, 'GAMARRA', 9, 20295, 35, 0),
(448, 'GONZALEZ', 9, 20310, 33, 1),
(449, 'LA GLORIA', 9, 20383, 35, 0),
(450, 'LA JAGUA DE IBIRICO', 9, 20400, 41, 0),
(451, 'MANAURE BALCON DEL CESAR', 9, 20443, 127, 1),
(452, 'PAILITAS', 9, 20517, 28, 0),
(453, 'PELAYA', 9, 20550, 28, 0),
(454, 'PUEBLO BELLO', 9, 20570, 33, 0),
(455, 'RIO DE ORO', 9, 20614, 14, 0),
(456, 'LA PAZ', 9, 20621, 26, 0),
(457, 'SAN ALBERTO', 9, 20710, 18, 0),
(458, 'SAN DIEGO', 9, 20750, 26, 0),
(459, 'SAN MARTIN', 9, 20770, 18, 0),
(460, 'TAMALAMEQUE', 9, 20787, 33, 0),
(461, 'LA LOMA CESAR', 9, 20250, 41, 0),
(462, 'MONTERIA', 10, 23001, 8, 0),
(463, 'AYAPEL', 10, 23068, 36, 0),
(464, 'BUENAVISTA', 10, 23079, 36, 0),
(465, 'CANALETE', 10, 23090, 17, 0),
(466, 'CERETE', 10, 23162, 8, 0),
(467, 'MONTELIBANO', 10, 23466, 36, 0),
(468, 'CHIMA', 10, 23168, 20, 0),
(469, 'CHINU', 10, 23182, 11, 0),
(470, 'CIENAGA DE ORO', 10, 23189, 17, 0),
(471, 'CORDOBA', 10, 23419, 17, 0),
(472, 'COTORRA', 10, 23300, 22, 0),
(473, 'LA APARTADA', 10, 23350, 22, 0),
(474, 'LORICA', 10, 23417, 20, 0),
(475, 'LOS CORDOBAS', 10, 23419, 17, 0),
(476, 'MOMIL', 10, 23464, 20, 0),
(477, 'MONTELIBANO', 10, 23466, 36, 0),
(478, 'MOÑITOS', 10, 23500, 17, 0),
(479, 'PLANETA RICA', 10, 23555, 36, 0),
(480, 'PUEBLO NUEVO', 10, 23570, 36, 0),
(481, 'PUERTO ESCONDIDO', 10, 23574, 17, 0),
(482, 'PUERTO LIBERTADOR', 10, 23580, 36, 0),
(483, 'PURISIMA', 10, 23586, 20, 0),
(484, 'SAHAGUN', 10, 23660, 11, 0),
(485, 'SAN ANDRES SOTAVENTO', 10, 23670, 11, 0),
(486, 'SAN ANTERO', 10, 23672, 17, 0),
(487, 'SAN BERNARDO DEL VIE', 10, 23675, 17, 0),
(488, 'SAN CARLOS', 10, 23678, 8, 0),
(489, 'SAN PELAYO', 10, 23686, 17, 0),
(490, 'TIERRALTA', 10, 23807, 43, 0),
(491, 'VALENCIA', 10, 23855, 43, 0),
(492, 'AGUA DE DIOS', 11, 25001, 20, 0),
(493, 'SANTANDERCITO', 11, 25645, 14, 0),
(494, 'ALBAN', 11, 25019, 20, 0),
(495, 'ANAPOIMA', 11, 25035, 5, 0),
(496, 'ANOLAIMA', 11, 25040, 5, 0),
(497, 'APULO-CUNDINAMARCA', 11, 25599, 20, 0),
(498, 'ARBELAEZ', 11, 25053, 10, 0),
(499, 'BELTRAN', 11, 25086, 20, 0),
(500, 'BITUIMA', 11, 25095, 14, 0),
(501, 'BOJACA', 11, 25099, 12, 0),
(502, 'CABRERA', 11, 25120, 12, 0),
(503, 'CACHIPAY', 11, 25123, 5, 0),
(504, 'CAJICA', 11, 25126, 12, 0),
(505, 'CUNDAY', 11, 73226, 11, 0),
(506, 'CAPARRAPI', 11, 25148, 27, 0),
(507, 'CAQUEZA', 11, 25151, 10, 0),
(508, 'CARMEN DE CARUPA', 11, 25154, 12, 0),
(509, 'CHAGUANI', 11, 25168, 27, 0),
(510, 'CHIA', 11, 25175, 12, 0),
(511, 'CHIPAQUE', 11, 25178, 10, 0),
(512, 'CHOACHI', 11, 25181, 10, 0),
(513, 'CHOCONTA', 11, 25183, 12, 0),
(514, 'COGUA', 11, 25200, 12, 0),
(515, 'COTA', 11, 25214, 12, 0),
(516, 'CUCUNUBA', 11, 25224, 12, 0),
(517, 'EL COLEGIO', 11, 25245, 5, 0),
(518, 'LA LOMA', 11, 0, 14, 0),
(519, 'EL PENON', 11, 25258, 20, 0),
(520, 'EL ROSAL', 11, 25260, 14, 0),
(521, 'EL ROSAL', 11, 25260, 14, 0),
(522, 'FACATATIVA', 11, 25269, 12, 0),
(523, 'FOMEQUE', 11, 25279, 10, 0),
(524, 'FOSCA', 11, 25281, 10, 0),
(525, 'FUNZA', 11, 25286, 12, 0),
(526, 'FUQUENE', 11, 25288, 12, 0),
(527, 'FUSAGASUGA', 11, 25290, 10, 0),
(528, 'GACHALA', 11, 25293, 15, 0),
(529, 'GACHANCIPA', 11, 25295, 12, 0),
(530, 'GACHETA', 11, 25297, 15, 0),
(531, 'GAMA', 11, 25299, 15, 0),
(532, 'GIRARDOT', 11, 25307, 20, 0),
(533, 'GRANADA', 11, 25312, 10, 0),
(534, 'GUACHETA', 11, 25317, 12, 0),
(535, 'GUADUAS', 11, 25320, 27, 0),
(536, 'GUASCA', 11, 25322, 15, 0),
(537, 'GUATAQUI', 11, 25324, 20, 0),
(538, 'GUATAVITA', 11, 25326, 15, 0),
(539, 'GUAYABAL DE SIQUIMA', 11, 25328, 20, 0),
(540, 'GUAYABETAL', 11, 25335, 10, 0),
(541, 'GUTIERREZ', 11, 25339, 10, 0),
(542, 'JERUSALEN', 11, 25368, 20, 0),
(543, 'JERUSALEN-CUNDINAMARCA', 11, 25368, 20, 0),
(544, 'JUNIN', 11, 25372, 15, 0),
(545, 'LA CALERA', 11, 25377, 15, 0),
(546, 'LA MESA', 11, 25386, 5, 0),
(547, 'LA PALMA', 11, 25394, 20, 0),
(548, 'LA PEÑA', 11, 25398, 20, 0),
(549, 'LA VEGA', 11, 25402, 20, 0),
(550, 'LENGUAZAQUE', 11, 25407, 12, 0),
(551, 'MACHETA', 11, 25426, 15, 0),
(552, 'MADRID', 11, 25430, 12, 0),
(553, 'MANTA', 11, 25436, 15, 0),
(554, 'MEDINA', 11, 25438, 14, 0),
(555, 'MOSQUERA', 11, 25473, 12, 0),
(556, 'NARIÑO', 11, 25483, 20, 0),
(557, 'NEMOCON', 11, 25486, 12, 0),
(558, 'NILO', 11, 25488, 20, 0),
(559, 'NIMAIMA', 11, 25489, 20, 0),
(560, 'NOCAIMA', 11, 25491, 20, 0),
(561, 'VENECIA', 11, 25506, 10, 0),
(562, 'PACHO', 11, 25513, 20, 0),
(563, 'PAIME', 11, 25518, 20, 0),
(564, 'PANDI', 11, 25524, 10, 0),
(565, 'PARATEBUENO', 11, 25530, 14, 0),
(566, 'PASCA', 11, 25535, 10, 0),
(567, 'PUERTO SALGAR', 11, 25572, 10, 0),
(568, 'PULI', 11, 25580, 20, 0),
(569, 'QUEBRADANEGRA', 11, 25592, 20, 0),
(570, 'QUETAME', 11, 25594, 10, 0),
(571, 'QUIPILE', 11, 25596, 5, 0),
(572, 'APULO', 11, 25599, 20, 0),
(573, 'RICAURTE', 11, 25612, 20, 0),
(574, 'S.ANTONIO TEQUENDAMA', 11, 25645, 14, 0),
(575, 'SAN BERNARDO', 11, 25649, 10, 0),
(576, 'SAN CAYETANO', 11, 25653, 20, 0),
(577, 'SAN FRANCISCO', 11, 25658, 20, 0),
(578, 'SAN JUAN DE RIO SECO', 11, 25662, 27, 0),
(579, 'SASAIMA', 11, 25718, 14, 0),
(580, 'SESQUILE', 11, 25736, 15, 0),
(581, 'SIBATE', 11, 25740, 10, 0),
(582, 'SILVANIA', 11, 25743, 10, 0),
(583, 'SIMIJACA', 11, 25745, 12, 0),
(584, 'SOACHA', 11, 25754, 10, 0),
(585, 'SOPO', 11, 25758, 12, 0),
(586, 'SUBACHOQUE', 11, 25769, 12, 0),
(587, 'SUESCA', 11, 25772, 12, 0),
(588, 'SUPATA', 11, 25777, 20, 0),
(589, 'SUSA', 11, 25779, 12, 0),
(590, 'SUTATAUSA', 11, 25781, 12, 0),
(591, 'TABIO', 11, 25785, 12, 0),
(592, 'TAUSA', 11, 25793, 12, 0),
(593, 'TENA', 11, 25797, 5, 0),
(594, 'TENJO', 11, 25799, 12, 0),
(595, 'TIBACUY', 11, 25805, 10, 0),
(596, 'TIBITO-CUNDINAMARCA', 11, 25817, 12, 0),
(597, 'TIBIRITA', 11, 25807, 15, 0),
(598, 'TOCAIMA', 11, 25815, 20, 0),
(599, 'TOCANCIPA', 11, 25817, 12, 0),
(600, 'TOPAIPI', 11, 25823, 20, 0),
(601, 'UBALA', 11, 25839, 15, 0),
(602, 'UBAQUE', 11, 25841, 10, 0),
(603, 'UBATE', 11, 25843, 12, 0),
(604, 'UNE', 11, 25845, 10, 0),
(605, 'UTICA', 11, 25851, 20, 0),
(606, 'VERGARA', 11, 25862, 20, 0),
(607, 'VIANI', 11, 25867, 13, 0),
(608, 'VILLAGOMEZ', 11, 25871, 20, 0),
(609, 'VILLAPINZON', 11, 25873, 12, 0),
(610, 'VILLETA', 11, 25875, 20, 0),
(611, 'VIOTA', 11, 25878, 10, 0),
(612, 'YACOPI', 11, 25885, 20, 0),
(613, 'ZIPACON', 11, 25898, 12, 0),
(614, 'ZIPACON', 11, 25898, 12, 0),
(615, 'ZIPAQUIRA', 11, 25899, 12, 0),
(616, 'CUMACA', 11, 25805, 10, 0),
(617, 'QUIBDO', 12, 27001, 55, 1),
(618, 'ACANDI', 12, 27006, 20, 0),
(619, 'ALTO BAUDO', 12, 27025, 23, 0),
(620, 'ANDAGOYA-CHOCO', 12, 27450, 42, 0),
(621, 'ATRATO', 12, 27050, 42, 0),
(622, 'BAGADO', 12, 27073, 55, 0),
(623, 'BAHIA SOLANO', 12, 27075, 23, 0),
(624, 'BAJO BAUDO', 12, 27077, 23, 1),
(625, 'BAJO SAN JUAN-CHOCO', 12, 27361, 58, 0),
(626, 'BELEN DE BAJIRA', 12, 27086, 42, 0),
(627, 'BOJAYA', 12, 27099, 55, 0),
(628, 'CANTON DEL SAN PABLO', 12, 27135, 58, 1),
(629, 'CARMEN DEL DARIEN', 12, 27150, 42, 0),
(630, 'CERTEGUI', 12, 27160, 42, 0),
(631, 'CONDOTO', 12, 27205, 58, 0),
(632, 'EL CARMEN DE ATRATO', 12, 27245, 55, 0),
(633, 'EL LITORAL DEL SAN J', 12, 27250, 58, 1),
(634, 'ITSMINA', 12, 27361, 58, 0),
(635, 'JURADO', 12, 27372, 23, 0),
(636, 'LLORO', 12, 27413, 55, 0),
(637, 'MEDIO ATRATO', 12, 27425, 42, 1),
(638, 'MEDIO BAUDO', 12, 27430, 42, 1),
(639, 'MEDIO SAN JUAN', 12, 27450, 42, 0),
(640, 'NOVITA', 12, 27491, 58, 0),
(641, 'NUQUI', 12, 27495, 23, 0),
(642, 'RIO IRO', 12, 27580, 42, 0),
(643, 'RIO QUITO', 12, 27600, 42, 1),
(644, 'RIOSUCIO', 12, 27615, 20, 0),
(645, 'SAN JOSE DEL PALMAR', 12, 27660, 58, 0),
(646, 'SIPI', 12, 27745, 58, 1),
(647, 'TADO', 12, 27787, 15, 0),
(648, 'UNGUIA', 12, 27800, 20, 0),
(649, 'UNION PANAMERICANA', 12, 27810, 42, 0),
(650, 'NEIVA', 13, 41001, 30, 0),
(651, 'ACEVEDO', 13, 41006, 30, 1),
(652, 'AGRADO', 13, 41013, 30, 0),
(653, 'AIPE', 13, 41016, 30, 0),
(654, 'ALGECIRAS', 13, 41020, 30, 0),
(655, 'ALTAMIRA', 13, 41026, 30, 1),
(656, 'BARAYA', 13, 41078, 30, 0),
(657, 'CAMPOALEGRE', 13, 41132, 30, 0),
(658, 'COLOMBIA', 13, 41206, 30, 0),
(659, 'ELIAS', 13, 41244, 30, 0),
(660, 'GARZON', 13, 41298, 30, 1),
(661, 'GIGANTE', 13, 41306, 30, 0),
(662, 'GUADALUPE', 13, 41319, 18, 1),
(663, 'HOBO', 13, 41349, 35, 0),
(664, 'IQUIRA', 13, 41357, 18, 0),
(665, 'ISNOS', 13, 41359, 18, 0),
(666, 'LA ARGENTINA', 13, 41378, 18, 0),
(667, 'LA PLATA', 13, 41396, 18, 0),
(668, 'NATAGA', 13, 41483, 30, 0),
(669, 'OPORAPA', 13, 41503, 18, 0),
(670, 'PAICOL', 13, 41518, 30, 0),
(671, 'PALERMO', 13, 41524, 30, 0),
(672, 'PALESTINA', 13, 41530, 30, 1),
(673, 'PITAL', 13, 41548, 30, 0),
(674, 'PITALITO', 13, 41551, 30, 0),
(675, 'RIVERA', 13, 41615, 35, 0),
(676, 'SALADOBLANCO', 13, 41660, 18, 0),
(677, 'SAN AGUSTIN', 13, 41668, 18, 0),
(678, 'SANTA MARIA', 13, 41676, 18, 0),
(679, 'SUAZA', 13, 41770, 30, 1),
(680, 'TARQUI', 13, 41791, 30, 0),
(681, 'TESALIA', 13, 41797, 30, 0),
(682, 'TELLO', 13, 41799, 30, 0),
(683, 'TERUEL', 13, 41801, 30, 0),
(684, 'TIMANA', 13, 41807, 35, 1),
(685, 'VILLAVIEJA', 13, 41872, 35, 0),
(686, 'YAGUARA', 13, 41885, 35, 0),
(687, 'VEGA LARGA', 13, 41001, 30, 0),
(688, 'RIOHACHA', 14, 44001, 72, 0),
(689, 'ALBANIA', 14, 44035, 67, 0),
(690, 'BARRANCAS', 14, 44078, 72, 0),
(691, 'DIBULLA', 14, 44090, 72, 0),
(692, 'DISTRACCION', 14, 44098, 43, 0),
(693, 'EL MOLINO', 14, 44110, 43, 0),
(694, 'DIBULLA-GUAJIRA', 14, 44090, 72, 0),
(695, 'FONSECA', 14, 44279, 43, 0),
(696, 'HATONUEVO', 14, 44378, 72, 0),
(697, 'LA JAGUA DEL PILAR', 14, 44420, 67, 0),
(698, 'MAICAO', 14, 44430, 72, 0),
(699, 'MANAURE', 14, 44560, 67, 0),
(700, 'SAN JUAN DEL CESAR', 14, 44650, 43, 0),
(701, 'URIBIA', 14, 44847, 127, 0),
(702, 'URUMITA', 14, 44855, 43, 0),
(703, 'VILLANUEVA', 14, 44874, 43, 0),
(704, 'PUERTO BOLIVAR', 14, 44847, 127, 0),
(705, 'SANTA MARTA', 15, 47001, 14, 0),
(706, 'ALGARROBO', 15, 47030, 34, 0),
(707, 'ARACATACA', 15, 47053, 14, 0),
(708, 'ARIGUANI', 15, 47058, 54, 0),
(709, 'CERRO SAN ANTONIO', 15, 47161, 49, 0),
(710, 'CHIVOLO', 15, 47170, 54, 0),
(711, 'CIENAGA', 15, 47189, 14, 0),
(712, 'CONCORDIA', 15, 47205, 34, 0),
(713, 'EL BANCO', 15, 47245, 31, 0),
(714, 'EL RODADERO-MAGDALENA', 15, 47001, 14, 0),
(715, 'EL PIÑON', 15, 47258, 49, 0),
(716, 'EL RETEN', 15, 47268, 34, 0),
(717, 'FUNDACION', 15, 47288, 49, 0),
(718, 'GUAMAL', 15, 47318, 40, 0),
(719, 'LA GAIRA-MAGDALENA', 15, 47001, 14, 0),
(720, 'NUEVA GRANADA', 15, 47460, 34, 0),
(721, 'PEDRAZA', 15, 47541, 49, 0),
(722, 'PIJIÑO', 15, 47545, 34, 0),
(723, 'PIVIJAY', 15, 47551, 49, 0),
(724, 'PLATO', 15, 47555, 54, 0),
(725, 'PUEBLOVIEJO', 15, 47570, 14, 0),
(726, 'REMOLINO', 15, 47605, 15, 0),
(727, 'SABANAS DE SAN ANGEL', 15, 47660, 34, 0),
(728, 'SALAMINA', 15, 47675, 49, 0),
(729, 'BOLIVIA - CALDAS', 15, 0, 34, 0),
(730, 'SAN SEBASTIAN BUENAV', 15, 47692, 40, 0),
(731, 'SAN ZENON', 15, 47703, 31, 0),
(732, 'SANTA ANA', 15, 47707, 7, 0),
(733, 'SANTA BARBARA DE PINTO', 15, 47720, 34, 0),
(734, 'SITIONUEVO', 15, 47745, 15, 0),
(735, 'TENERIFE', 15, 47798, 54, 0),
(736, 'ZAPAYAN', 15, 47960, 34, 0),
(737, 'ZONA BANANERA', 15, 47980, 34, 0),
(738, 'VILLAVICENCIO', 16, 50001, 28, 0),
(739, 'ACACIAS', 16, 50006, 28, 0),
(740, 'APIARI-META', 16, 50001, 28, 0),
(741, 'BARRANCA DE UPIA', 16, 50110, 28, 0),
(742, 'CABUYARO', 16, 50124, 34, 0),
(743, 'CASTILLA LA NUEVA', 16, 50150, 34, 0),
(744, 'CUBARRAL', 16, 50223, 28, 0),
(745, 'CUMARAL', 16, 50226, 28, 0),
(746, 'EL CALVARIO', 16, 50245, 28, 0),
(747, 'EL CASTILLO', 16, 50251, 28, 0),
(748, 'EL DORADO', 16, 50270, 28, 0),
(749, 'FUENTE DE ORO', 16, 50287, 34, 0),
(750, 'GRANADA', 16, 50313, 34, 0),
(751, 'GUAMAL', 16, 50318, 28, 0),
(752, 'MAPIRIPAN', 16, 50325, 1360, 0),
(753, 'MESETAS', 16, 50330, 59, 1),
(754, 'LA MACARENA', 16, 50350, 59, 1),
(755, 'LA URIBE', 16, 50370, 59, 0),
(756, 'LEJANIAS', 16, 50400, 28, 0),
(757, 'MEDINA', 16, 0, 83, 0),
(758, 'PUERTO CONCORDIA', 16, 50450, 59, 0),
(759, 'MESETAS-META', 16, 50330, 59, 0),
(760, 'PUERTO GAITAN', 16, 50568, 102, 0),
(761, 'PUERTO LOPEZ', 16, 50573, 34, 0),
(762, 'PUERTO LLERAS', 16, 50577, 102, 0),
(763, 'PUERTO RICO', 16, 50590, 59, 0),
(764, 'RESTREPO', 16, 50606, 28, 0),
(765, 'SAN CARLOS GUAROA', 16, 50680, 34, 0),
(766, 'SAN JUAN DE ARAMA', 16, 50683, 102, 0),
(767, 'SAN JUANITO', 16, 50686, 28, 0),
(768, 'SAN MARTIN', 16, 50689, 34, 0),
(769, 'SURIMENA-META', 16, 50680, 34, 0),
(770, 'VISTA HERMOSA', 16, 50711, 59, 0),
(771, 'MEDELLIN DE ARIARI', 16, 50251, 28, 0),
(772, 'PASTO', 17, 52001, 10, 0),
(773, 'ALBAN', 17, 52019, 10, 0),
(774, 'ALDANA', 17, 52022, 10, 0),
(775, 'ANCUYA', 17, 52036, 10, 0),
(776, 'ARBOLEDA', 17, 52051, 10, 0),
(777, 'BARBACOAS', 17, 52079, 38, 1),
(778, 'BELEN', 17, 52083, 10, 0),
(779, 'BOCA DE SATINGA-NARIÑO', 17, 52490, 38, 0),
(780, 'BUESACO', 17, 52110, 10, 0),
(781, 'COLON', 17, 52203, 10, 0),
(782, 'CONSACA', 17, 52207, 10, 0),
(783, 'CONTADERO', 17, 52210, 10, 0),
(784, 'CORDOBA', 17, 52215, 10, 0),
(785, 'CUASPUD', 17, 52224, 10, 0),
(786, 'CUMBAL', 17, 52227, 22, 0),
(787, 'CUMBITARA', 17, 52233, 22, 1),
(788, 'CHACHAGUI', 17, 52240, 10, 0),
(789, 'EL CHARCO', 17, 52250, 38, 0),
(790, 'EL PEÑOL', 17, 52254, 17, 0),
(791, 'EL ROSARIO', 17, 52256, 50, 0),
(792, 'EL TABLON', 17, 52258, 10, 0),
(793, 'EL TAMBO', 17, 52260, 50, 0),
(794, 'FUNES', 17, 52287, 10, 0),
(795, 'GUACHUCAL', 17, 52317, 10, 0),
(796, 'GUAITARILLA', 17, 52320, 10, 0),
(797, 'GUALMATAN', 17, 52323, 10, 0),
(798, 'ILES', 17, 52352, 10, 0),
(799, 'IMUES', 17, 52354, 10, 0),
(800, 'IPIALES', 17, 52356, 10, 0),
(801, 'LA CRUZ', 17, 52378, 10, 0),
(802, 'LA FLORIDA', 17, 52381, 10, 0),
(803, 'LA LLANADA', 17, 52385, 10, 0),
(804, 'LA TOLA', 17, 52390, 38, 0),
(805, 'LA UNION', 17, 52399, 10, 0),
(806, 'LEIVA', 17, 52405, 17, 0),
(807, 'LINARES', 17, 52411, 10, 0),
(808, 'LOS ANDES', 17, 52418, 22, 0),
(809, 'MAGUI', 17, 52427, 38, 0),
(810, 'MALLAMA', 17, 52435, 22, 0),
(811, 'MOSQUERA', 17, 52473, 17, 0),
(812, 'NARIÑO', 17, 52480, 17, 0),
(813, 'OLAYA HERRERA', 17, 52490, 38, 0),
(814, 'OSPINA', 17, 52506, 10, 0),
(815, 'FRANCIS PIZARRO', 17, 52520, 38, 0),
(816, 'POLICARPA', 17, 52540, 50, 0),
(817, 'POTOSI', 17, 52560, 10, 0),
(818, 'PROVIDENCIA', 17, 52565, 10, 0),
(819, 'PUERRES', 17, 52573, 10, 0),
(820, 'PUPIALES', 17, 52585, 10, 0),
(821, 'RICAURTE', 17, 52612, 17, 1),
(822, 'ROBERTO PAYAN', 17, 52621, 38, 0),
(823, 'SAMANIEGO', 17, 52678, 22, 0),
(824, 'SANDONA', 17, 52683, 10, 0),
(825, 'SAN BERNARDO', 17, 52685, 10, 0),
(826, 'SAN LORENZO', 17, 52687, 10, 0),
(827, 'SAN PABLO', 17, 52693, 10, 0),
(828, 'SAN PEDRO DE CARTAGO', 17, 52694, 10, 0),
(829, 'SANTA BARBARA', 17, 52696, 17, 0),
(830, 'SANTACRUZ', 17, 52699, 22, 0),
(831, 'SAPUYES', 17, 52720, 10, 0),
(832, 'TAMINANGO', 17, 52786, 10, 0),
(833, 'TANGUA', 17, 52788, 10, 0),
(834, 'TUMACO', 17, 52835, 38, 0),
(835, 'TUQUERRES', 17, 52838, 10, 0),
(836, 'YACUANQUER', 17, 52885, 10, 0),
(837, 'CUCUTA', 18, 54001, 37, 0),
(838, 'ABREGO', 18, 54003, 26, 0),
(839, 'ARBOLEDAS', 18, 54051, 20, 0),
(840, 'BOCHALEMA', 18, 54099, 20, 0),
(841, 'BUCARASICA', 18, 54109, 20, 0),
(842, 'CACOTA', 18, 54125, 26, 0),
(843, 'CACHIRA', 18, 54128, 20, 0),
(844, 'CHINACOTA', 18, 54172, 26, 0),
(845, 'CHITAGA', 18, 54174, 10, 0),
(846, 'CONVENCION', 18, 54206, 20, 0),
(847, 'CUCUTILLA', 18, 54223, 20, 0),
(848, 'DURANIA', 18, 54239, 20, 0),
(849, 'EL CARMEN', 18, 54245, 20, 0),
(850, 'EL TARRA', 18, 54250, 26, 0),
(851, 'EL ZULIA', 18, 54261, 37, 0),
(852, 'GRAMALOTE', 18, 54313, 20, 0),
(853, 'HACARI', 18, 54344, 26, 0),
(854, 'HERRAN', 18, 54347, 20, 0),
(855, 'LABATECA', 18, 54377, 20, 0),
(856, 'LA ESPERANZA', 18, 54385, 37, 0),
(857, 'LA PLAYA', 18, 54398, 26, 0),
(858, 'LOS PATIOS', 18, 54405, 37, 0),
(859, 'LOURDES', 18, 54418, 20, 0),
(860, 'MUTISCUA', 18, 54480, 10, 0),
(861, 'OCAÑA', 18, 54498, 26, 0),
(862, 'PAMPLONA', 18, 54518, 20, 0),
(863, 'PAMPLONITA', 18, 54520, 20, 0),
(864, 'PUERTO SANTANDER', 18, 54553, 26, 0),
(865, 'RAGONVALIA', 18, 54599, 20, 0),
(866, 'SALAZAR', 18, 54660, 37, 0),
(867, 'SAN CALIXTO', 18, 54670, 26, 0),
(868, 'SAN CAYETANO', 18, 54673, 37, 0),
(869, 'SANTIAGO', 18, 54680, 37, 0),
(870, 'SARDINATA', 18, 54720, 26, 0),
(871, 'SILOS', 18, 54743, 10, 0),
(872, 'TEORAMA', 18, 54800, 26, 0),
(873, 'TIBU', 18, 54810, 26, 0),
(874, 'TOLEDO', 18, 54820, 61, 0),
(875, 'VILLA CARO', 18, 54871, 20, 0),
(876, 'VILLA DEL ROSARIO', 18, 54874, 20, 0),
(877, 'GIBRALTAR', 18, 54820, 61, 0),
(878, 'LA GABARRA', 18, 54810, 26, 0),
(879, 'LA VEGA', 18, 54128, 20, 0),
(880, 'LAS MERCEDES', 18, 54720, 26, 0),
(881, 'ARMENIA', 19, 63001, 7, 0),
(882, 'BARCELONA-QUINDIO', 19, 63130, 12, 0),
(883, 'BUENAVISTA', 19, 63111, 10, 0),
(884, 'CALARCA', 19, 63130, 12, 0),
(885, 'CIRCASIA', 19, 63190, 7, 0),
(886, 'CORDOBA', 19, 63212, 10, 0),
(887, 'FILANDIA', 19, 63272, 10, 0),
(888, 'GENOVA', 19, 63302, 12, 0),
(889, 'LA TEBAIDA', 19, 63401, 7, 0),
(890, 'MONTENEGRO', 19, 63470, 10, 0),
(891, 'PIJAO', 19, 63548, 12, 0),
(892, 'QUIMBAYA', 19, 63594, 10, 0),
(893, 'SALENTO', 19, 63690, 12, 1),
(894, 'PEREIRA', 20, 66001, 7, 0),
(895, 'APIA', 20, 66045, 10, 0),
(896, 'BALBOA', 20, 66075, 9, 0),
(897, 'BELEN DE UMBRIA', 20, 66088, 7, 0),
(898, 'DOS QUEBRADAS', 20, 66170, 7, 0),
(899, 'GUATICA', 20, 66318, 7, 0),
(900, 'IRRA-RISARALDA', 20, 66594, 7, 0),
(901, 'LA CELIA', 20, 66383, 10, 0),
(902, 'LA VIRGINIA', 20, 66400, 10, 0),
(903, 'MARSELLA', 20, 66440, 7, 0),
(904, 'MISTRATO', 20, 66456, 10, 0),
(905, 'PUEBLO RICO', 20, 66572, 15, 0),
(906, 'QUINCHIA', 20, 66594, 7, 0),
(907, 'SANTA ROSA DE CABAL', 20, 66682, 7, 0),
(908, 'SANTUARIO', 20, 66687, 10, 0),
(909, 'BUCARAMANGA', 21, 68001, 10, 0),
(910, 'AGUA CLARA', 21, 0, 12, 0),
(911, 'AGUADA', 21, 68013, 18, 0),
(912, 'ALBANIA', 21, 68020, 18, 0),
(913, 'ARATOCA', 21, 68051, 12, 0),
(914, 'BARBOSA', 21, 68077, 8, 0),
(915, 'BARICHARA', 21, 68079, 12, 0),
(916, 'BARRANCABERMEJA', 21, 68081, 18, 0),
(917, 'BETULIA', 21, 68092, 10, 0),
(918, 'BOLIVAR', 21, 68101, 18, 0),
(919, 'CABRERA', 21, 68121, 10, 0),
(920, 'CALIFORNIA', 21, 68132, 12, 0),
(921, 'CAPITANEJO', 21, 68147, 8, 0),
(922, 'CARCASI', 21, 68152, 8, 0),
(923, 'CEPITA', 21, 68160, 12, 0),
(924, 'CERRITO', 21, 68162, 8, 0),
(925, 'CHARALA', 21, 68167, 8, 0),
(926, 'CHARTA', 21, 68169, 12, 0),
(927, 'CHIMA', 21, 68176, 12, 0),
(928, 'CHIPATA', 21, 68179, 18, 0),
(929, 'CIMITARRA', 21, 68190, 18, 0),
(930, 'CONCEPCION', 21, 68207, 8, 0),
(931, 'CONFINES', 21, 68209, 8, 0),
(932, 'CONTRATACION', 21, 68211, 18, 0),
(933, 'COROMORO', 21, 68217, 8, 0),
(934, 'CURITI', 21, 68229, 8, 0),
(935, 'EL CARMEN', 21, 68235, 10, 0),
(936, 'EL GUACAMAYO', 21, 68245, 18, 0),
(937, 'EL PEÑON', 21, 68250, 18, 0),
(938, 'EL PLAYON', 21, 68255, 10, 0),
(939, 'ENCINO', 21, 68264, 8, 0),
(940, 'ENCISO', 21, 68266, 8, 0),
(941, 'FLORIAN', 21, 68271, 18, 0),
(942, 'FLORIDABLANCA', 21, 68276, 10, 0),
(943, 'GALAN', 21, 68296, 12, 0),
(944, 'GAMBITA', 21, 68298, 12, 0),
(945, 'GIRON', 21, 68307, 10, 0),
(946, 'GUACA', 21, 68318, 8, 0),
(947, 'GUADALUPE', 21, 68320, 12, 0),
(948, 'GUAPOTA', 21, 68322, 8, 0),
(949, 'GUAVATA', 21, 68324, 18, 0),
(950, 'GUEPSA', 21, 68327, 8, 0),
(951, 'HATO', 21, 68344, 12, 0),
(952, 'JESUS MARIA', 21, 68368, 18, 0),
(953, 'JORDAN', 21, 68370, 12, 0),
(954, 'LA BELLEZA', 21, 68377, 18, 0),
(955, 'LANDAZURI', 21, 68385, 18, 0),
(956, 'LA PAZ', 21, 68397, 18, 0),
(957, 'LEBRIJA', 21, 68406, 10, 0),
(958, 'LOS SANTOS', 21, 68418, 12, 0),
(959, 'MACARAVITA', 21, 68425, 8, 0),
(960, 'MALAGA', 21, 68432, 8, 0),
(961, 'MATANZA', 21, 68444, 12, 0),
(962, 'MOGOTES', 21, 68464, 8, 0),
(963, 'MOLAGAVITA', 21, 68468, 8, 0),
(964, 'OCAMONTE', 21, 68498, 8, 0),
(965, 'OIBA', 21, 68500, 12, 0),
(966, 'ONZAGA', 21, 68502, 12, 0),
(967, 'PALMAR', 21, 68522, 8, 0),
(968, 'PALMAS SOCORRO', 21, 68524, 8, 0),
(969, 'PARAMO', 21, 68533, 8, 0),
(970, 'PIEDECUESTA', 21, 68547, 10, 0),
(971, 'PINCHOTE', 21, 68549, 8, 0),
(972, 'PUENTE NACIONAL', 21, 68572, 8, 0),
(973, 'PUERTO PARRA', 21, 68573, 18, 1),
(974, 'PUERTO WILCHES', 21, 68575, 18, 0),
(975, 'RIONEGRO', 21, 68615, 18, 0),
(976, 'SABANA DE TORRES', 21, 68655, 18, 0),
(977, 'SAN ANDRES', 21, 68669, 8, 0),
(978, 'SAN BENITO', 21, 68673, 18, 0),
(979, 'SAN GIL', 21, 68679, 8, 0),
(980, 'SAN JOAQUIN', 21, 68682, 12, 0),
(981, 'SAN JOSE DE MIRANDA', 21, 68684, 8, 0),
(982, 'SAN MIGUEL', 21, 68686, 8, 0),
(983, 'SAN VICENTE DE CHUCURÍ', 21, 68689, 10, 0),
(984, 'SANTA BARBARA', 21, 68705, 12, 0),
(985, 'SANTA HELENA DEL OPO', 21, 68720, 18, 0),
(986, 'SIMACOTA', 21, 68745, 18, 0),
(987, 'SOCORRO', 21, 68755, 12, 0),
(988, 'SUAITA', 21, 68770, 12, 0),
(989, 'SUCRE', 21, 68773, 18, 0),
(990, 'SURATA', 21, 68780, 12, 0),
(991, 'TONA', 21, 68820, 12, 0),
(992, 'VALLE DE SAN JOSE', 21, 68855, 8, 0),
(993, 'VELEZ', 21, 68861, 18, 0),
(994, 'VETAS', 21, 68867, 12, 0),
(995, 'VILLANUEVA', 21, 68872, 8, 0),
(996, 'ZAPATOCA', 21, 68895, 10, 0),
(997, 'SAN FRANCISCO', 21, 68322, 8, 0),
(998, 'EL CENTRO', 21, 68081, 18, 0),
(999, 'SAN JOSE DE SUAVITA', 21, 68770, 12, 0),
(1000, 'SINCELEJO', 22, 70001, 36, 0),
(1001, 'BUENAVISTA', 22, 70110, 12, 0),
(1002, 'CAIMITO', 22, 70124, 54, 0),
(1003, 'COLOSO', 22, 70204, 36, 0),
(1004, 'COROZAL', 22, 70215, 16, 0),
(1005, 'COVEÑAS', 22, 70221, 28, 0),
(1006, 'CHALAN', 22, 70230, 36, 0),
(1007, 'COVEÑAS-SUCRE', 22, 70221, 28, 0),
(1008, 'EL ROBLE', 22, 70233, 28, 0),
(1009, 'GALERAS', 22, 70235, 16, 0),
(1010, 'GUARANDA', 22, 70265, 31, 0),
(1011, 'HATO NUEVO-SUCRE', 22, 70215, 16, 0),
(1012, 'LA UNION', 22, 70400, 54, 0),
(1013, 'LOS PALMITOS', 22, 70418, 16, 0),
(1014, 'MAJAGUAL', 22, 70429, 31, 0),
(1015, 'MORROA', 22, 70473, 36, 0),
(1016, 'OVEJAS', 22, 70508, 36, 0),
(1017, 'PALMITO', 22, 70523, 36, 0),
(1018, 'SAMPUES', 22, 70670, 16, 0),
(1019, 'SAN BENITO ABAD', 22, 70678, 36, 0),
(1020, 'SAN JUAN DE BETULIA', 22, 70702, 16, 0),
(1021, 'SAN MARCOS', 22, 70708, 31, 0),
(1022, 'SAN ONOFRE', 22, 70713, 36, 0),
(1023, 'SAN PEDRO', 22, 70717, 16, 0),
(1024, 'SINCE', 22, 70742, 16, 0),
(1025, 'SUCRE', 22, 70771, 31, 0),
(1026, 'TOLU', 22, 70820, 15, 0),
(1027, 'TOLUVIEJO', 22, 70823, 36, 0),
(1028, 'IBAGUE', 23, 73001, 10, 0),
(1029, 'ALPUJARRA', 23, 73024, 11, 0),
(1030, 'ALVARADO', 23, 73026, 14, 0),
(1031, 'AMBALEMA', 23, 73030, 16, 0),
(1032, 'ANZOATEGUI', 23, 73043, 11, 0),
(1033, 'ARMERO', 23, 73055, 11, 0),
(1034, 'ATACO', 23, 73067, 11, 0),
(1035, 'CAJAMARCA', 23, 73124, 11, 0),
(1036, 'CARMEN DE APICALA', 23, 73148, 16, 0),
(1037, 'CASABIANCA', 23, 73152, 20, 0),
(1038, 'CHAPARRAL', 23, 73168, 6, 0),
(1039, 'COELLO', 23, 73200, 16, 0),
(1040, 'COYAIMA', 23, 73217, 11, 0),
(1041, 'CUNDAY', 23, 73226, 11, 0),
(1042, 'DOLORES', 23, 73236, 6, 0),
(1043, 'ESPINAL', 23, 73268, 16, 0),
(1044, 'FALAN', 23, 73270, 6, 0),
(1045, 'FLANDES', 23, 73275, 14, 0),
(1046, 'FRESNO', 23, 73283, 13, 0),
(1047, 'GUAMO', 23, 73319, 14, 0),
(1048, 'HERVEO', 23, 73347, 19, 0),
(1049, 'HONDA', 23, 73349, 10, 0),
(1050, 'ICONONZO', 23, 73352, 6, 0),
(1051, 'GUAYABAL', 23, 73055, 11, 0),
(1052, 'LERIDA', 23, 73408, 6, 0),
(1053, 'LIBANO', 23, 73411, 6, 0),
(1054, 'MARIQUITA', 23, 73443, 10, 0),
(1055, 'MELGAR', 23, 73449, 11, 0),
(1056, 'MURILLO', 23, 73461, 20, 0),
(1057, 'NATAGAIMA', 23, 73483, 34, 0),
(1058, 'ORTEGA', 23, 73504, 11, 0),
(1059, 'PALOCABILDO', 23, 73520, 14, 0),
(1060, 'PIEDRAS', 23, 73547, 16, 0),
(1061, 'PLANADAS', 23, 73555, 20, 0),
(1062, 'PRADO', 23, 73563, 11, 0),
(1063, 'PURIFICACION', 23, 73585, 16, 0),
(1064, 'RIOBLANCO', 23, 73616, 20, 0),
(1065, 'RONCESVALLES', 23, 73622, 20, 0),
(1066, 'ROVIRA', 23, 73624, 20, 0),
(1067, 'SALDAÑA', 23, 73671, 16, 0),
(1068, 'SAN ANTONIO', 23, 73675, 20, 0),
(1069, 'SAN LUIS', 23, 73678, 16, 0),
(1070, 'SANTA ISABEL', 23, 73686, 20, 0),
(1071, 'SUAREZ', 23, 73770, 16, 0),
(1072, 'VALLE DE SAN JUAN', 23, 73854, 16, 0),
(1073, 'VENADILLO', 23, 73861, 11, 0),
(1074, 'VILLAHERMOSA', 23, 73870, 20, 0),
(1075, 'VILLARRICA', 23, 73873, 20, 0),
(1076, 'CHICORAL-TOLIMA', 23, 73268, 16, 0),
(1077, 'JUNIN', 23, 73411, 6, 0),
(1078, 'CADIZ', 23, 73168, 6, 0),
(1079, 'HERRERA', 23, 73616, 20, 0),
(1080, 'PALO CABILDO', 23, 73520, 14, 0),
(1081, 'GAITANA', 23, 73555, 20, 0),
(1082, 'PLAYA RICA', 23, 73675, 20, 0),
(1083, 'SANTIAGO PEREZ', 23, 73067, 11, 0),
(1084, 'SANTA TERESA', 23, 73411, 6, 0),
(1085, 'TRES ESQUINAS', 23, 73226, 11, 0),
(1086, 'CALI', 24, 76001, 4, 0),
(1087, 'ALCALA', 24, 76020, 6, 0),
(1088, 'ANDALUCIA', 24, 76036, 6, 0),
(1089, 'ANSERMANUEVO', 24, 76041, 4, 0),
(1090, 'ARGELIA', 24, 76054, 4, 1),
(1091, 'BOLIVAR', 24, 76100, 4, 0),
(1092, 'BUENAVENTURA', 24, 76109, 5, 1),
(1093, 'BUGA', 24, 76111, 6, 0),
(1094, 'BUGALAGRANDE', 24, 76113, 4, 0),
(1095, 'CAICEDONIA', 24, 76122, 6, 0),
(1096, 'CALIMA', 24, 76126, 8, 0),
(1097, 'CANDELARIA', 24, 76130, 4, 0),
(1098, 'CARTAGO', 24, 76147, 6, 0),
(1099, 'DAGUA', 24, 76233, 8, 1),
(1100, 'DARIEN-VALLE', 24, 76126, 8, 1),
(1101, 'EL AGUILA', 24, 76243, 4, 0),
(1102, 'EL CAIRO', 24, 76246, 4, 1),
(1103, 'EL CERRITO', 24, 76248, 6, 0),
(1104, 'EL DOVIO', 24, 76250, 4, 1),
(1105, 'FLORIDA', 24, 76275, 6, 0),
(1106, 'GINEBRA', 24, 76306, 6, 0),
(1107, 'GUACARI', 24, 76318, 6, 0),
(1108, 'JAMUNDI', 24, 76364, 6, 0),
(1109, 'LA CUMBRE', 24, 76377, 5, 1),
(1110, 'LA PAILA', 24, 76895, 4, 0),
(1111, 'LA UNION', 24, 76400, 4, 0),
(1112, 'LA VICTORIA', 24, 76403, 6, 0),
(1113, 'OBANDO', 24, 76497, 6, 0),
(1114, 'PALMIRA', 24, 76520, 6, 0),
(1115, 'PRADERA', 24, 76563, 6, 0),
(1116, 'RESTREPO', 24, 76606, 5, 1),
(1117, 'RIOFRIO', 24, 76616, 4, 0),
(1118, 'ROLDANILLO', 24, 76622, 4, 0),
(1119, 'SAN PEDRO', 24, 76670, 6, 0),
(1120, 'SEVILLA', 24, 76736, 9, 0),
(1121, 'TORO', 24, 76823, 4, 0),
(1122, 'TRUJILLO', 24, 76828, 4, 0),
(1123, 'TULUA', 24, 76834, 6, 0),
(1124, 'ULLOA', 24, 76845, 6, 0),
(1125, 'VERSALLES', 24, 76863, 5, 0),
(1126, 'VIJES', 24, 76869, 4, 0),
(1127, 'YOTOCO', 24, 76890, 4, 0),
(1128, 'YUMBO', 24, 76892, 4, 0),
(1129, 'ZARZAL', 24, 76895, 4, 0),
(1130, 'ARAUCA', 25, 81001, 24, 0),
(1131, 'ARAUQUITA', 25, 81065, 24, 0),
(1132, 'CRAVO NORTE', 25, 81220, 850, 0),
(1133, 'FORTUL', 25, 81300, 24, 0),
(1134, 'PUERTO RONDON', 25, 81591, 850, 0),
(1135, 'SARAVENA', 25, 81736, 24, 0),
(1136, 'TAME', 25, 81794, 24, 0),
(1137, 'YOPAL', 26, 85001, 45, 0),
(1138, 'AGUAZUL', 26, 85010, 45, 0),
(1139, 'CHAMEZA', 26, 85015, 65, 0),
(1140, 'HATO COROZAL', 26, 85125, 45, 0),
(1141, 'LA SALINA', 26, 85136, 65, 0),
(1142, 'MANI', 26, 85139, 45, 0),
(1143, 'MONTERREY', 26, 85162, 45, 0),
(1144, 'NUNCHIA', 26, 85225, 45, 0),
(1145, 'OROCUE', 26, 85230, 321, 0),
(1146, 'PAZ DE ARIPORO', 26, 85250, 321, 0),
(1147, 'PORE', 26, 85263, 45, 0),
(1148, 'RECETOR', 26, 85279, 65, 0),
(1149, 'SABANALARGA', 26, 85300, 45, 0),
(1150, 'SACAMA', 26, 85315, 65, 0),
(1151, 'SAN LUIS DE PALENQUE', 26, 85325, 321, 0),
(1152, 'TAMARA', 26, 85400, 65, 0),
(1153, 'TAURAMENA', 26, 85410, 321, 0),
(1154, 'TRINIDAD', 26, 85430, 321, 0),
(1155, 'VILLANUEVA', 26, 85440, 45, 0),
(1156, 'MOCOA', 27, 86001, 45, 0),
(1157, 'COLON', 27, 86219, 10, 1),
(1158, 'ORITO', 27, 86320, 35, 0),
(1159, 'PUERTO ASIS', 27, 86568, 70, 0),
(1160, 'PUERTO CAICEDO', 27, 86569, 70, 0),
(1161, 'PUERTO GUZMAN', 27, 86571, 35, 0),
(1162, 'PUERTO  LEGUIZAMO', 27, 86573, 70, 0),
(1163, 'SIBUNDOY', 27, 86749, 10, 1),
(1164, 'SAN FRANCISCO', 27, 86755, 10, 0),
(1165, 'SAN MIGUEL', 27, 86757, 70, 0),
(1166, 'SANTIAGO', 27, 86760, 10, 0),
(1167, 'VALLE GUAMUEZ', 27, 86865, 70, 0),
(1168, 'LA HORMIGA-PUTUMAYO', 27, 86865, 70, 0),
(1169, 'VILLAGARZON', 27, 86885, 35, 0),
(1170, 'SAN ANDRES', 28, 88001, 0, 0),
(1171, 'PROVIDENCIA', 28, 88564, 0, 0),
(1172, 'LETICIA', 29, 91001, 67, 0),
(1173, 'EL ENCANTO', 29, 91263, 105, 1),
(1174, 'LA CHORRERA', 29, 91405, 105, 0),
(1175, 'LA PEDRERA', 29, 91407, 105, 0),
(1176, 'LA VICTORIA', 29, 91430, 105, 1),
(1177, 'MIRITI-PARANA', 29, 91460, 105, 0),
(1178, 'PUERTO ALEGRIA', 29, 91530, 105, 1),
(1179, 'PUERTO ALEGRIA', 29, 91530, 105, 1),
(1180, 'PUERTO NARIÑO', 29, 91540, 46, 0),
(1181, 'PTO SANTANDER', 29, 91669, 202, 0),
(1182, 'TARAPACA', 29, 91798, 105, 1),
(1183, 'INIRIDA', 30, 94001, 0, 0),
(1184, 'GUAVIARE', 30, 0, 0, 0),
(1185, 'MAPIRIPANA', 30, 94663, 0, 1),
(1186, 'SAN FELIPE', 30, 94883, 0, 1),
(1187, 'PUERTO COLOMBIA', 30, 94884, 0, 1),
(1188, 'LA GUADALUPE', 30, 94885, 0, 1),
(1189, 'CACAHUAL', 30, 94886, 0, 1),
(1190, 'PANA PANA', 30, 94887, 0, 1),
(1191, 'MORICHAL NUEVO', 30, 94888, 0, 1),
(1192, 'MIRAFLORES', 30, 0, 0, 0),
(1193, 'SAN JOSE DEL GUAVIARE', 31, 95001, 104, 0),
(1194, 'CALAMAR', 31, 95015, 163, 0),
(1195, 'EL RETORNO', 31, 95025, 75, 0),
(1196, 'MIRAFLORES', 31, 95200, 104, 1),
(1197, 'MORICHAL', 31, 95025, 75, 0),
(1198, 'MITU', 32, 97001, 0, 1),
(1199, 'CARURU', 32, 97161, 0, 1),
(1200, 'PACOA', 32, 97511, 0, 1),
(1201, 'TARAIRA', 32, 97666, 0, 1),
(1202, 'PAPUNAUA', 32, 97777, 0, 1),
(1203, 'YAVARATE', 32, 97889, 0, 1),
(1204, 'PUERTO CARRENO', 33, 99001, 956, 0),
(1205, 'NUEVA ANTIOQUIA', 33, 99524, 956, 0),
(1206, 'LA PRIMAVERA', 33, 99524, 956, 0),
(1207, 'SANTA RITA', 33, 99773, 956, 0),
(1208, 'SANTA ROSALIA', 33, 99624, 956, 0),
(1209, 'SAN JOSE DE OCUNE', 33, 99773, 956, 0),
(1210, 'CUMARIBO', 33, 99773, 956, 0),
(1211, 'SIN INFORMACION', 33, 0, 0, 0),
(1212, 'SAN JOSÉ DE URÉ', 10, 23682, 22, 0),
(1213, 'TIQUISIO', 4, 13810, 35, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumptions`
--

CREATE TABLE IF NOT EXISTS `consumptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumo_estimado` varchar(45) DEFAULT NULL,
  `porcentaje_cosecha` int(11) DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  `productive_activity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_consumptions_productive_polls1` (`productive_poll_id`),
  KEY `fk_consumptions_productive_activities1` (`productive_activity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `consumptions`
--

INSERT INTO `consumptions` (`id`, `consumo_estimado`, `porcentaje_cosecha`, `productive_poll_id`, `productive_activity_id`) VALUES
(1, 'aaab', 42342, 3, 19),
(2, '4234', 42342, 3, 2),
(3, 'fasdf', 534, 3, 18),
(4, 'wre', 543, 4, 19),
(5, '534', 534, 4, 8),
(6, '', 1, 1, 3),
(7, '43', 4, 1, 2),
(8, '423', 43, 6, 10),
(9, 'dgfr', 5588, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conventions`
--

CREATE TABLE IF NOT EXISTS `conventions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(80) DEFAULT NULL,
  `institucion` varchar(80) DEFAULT NULL,
  `asociation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conventions_asociations1_idx` (`asociation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `conventions`
--

INSERT INTO `conventions` (`id`, `tipo`, `institucion`, `asociation_id`) VALUES
(1, 'gdf', 'gdfgdf', 0),
(2, 'gsdfg', 'gsdfg', 0),
(3, 'MMMMMMM', 'fasd', 4),
(4, 'PPPPPPPPP', 'fsda', 4),
(5, 'fasdf', 'fasdfasd', 4),
(6, '3545', '5345345', 4),
(7, 'ÑÑÑÑÑÑÑÑ', 'jjj', 4),
(8, 'LLLLLLLLLL', 'terte', 4),
(9, 'fds', 'fsdfsd', 5),
(10, 'fsdf', 'sfdfs', 5),
(11, 'fgh', 'hdfgd', 1),
(12, 'hdf', 'hdf', 1),
(13, 'erw', 'twert', 2),
(14, 'twert', 'werter', 2),
(15, 'gdf', 'gdfg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coverages`
--

CREATE TABLE IF NOT EXISTS `coverages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cobertura` enum('Bosques','Montañas','Rastrojo','Pasto','Cultivos','Otros') DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `porcentaje` double DEFAULT NULL,
  `area_total` int(11) DEFAULT NULL,
  `porcentaje_total` double DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coverages_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `coverages`
--

INSERT INTO `coverages` (`id`, `cobertura`, `area`, `porcentaje`, `area_total`, `porcentaje_total`, `property_id`) VALUES
(1, 'Bosques', 100, 20, NULL, NULL, 1),
(2, 'Bosques', 445, NULL, 22, NULL, 1),
(3, 'Bosques', 445, 8, 22, NULL, 1),
(4, 'Bosques', 445, 10, 22, NULL, 1),
(5, 'Bosques', 445, 12, 22, NULL, 1),
(6, 'Montañas', 5000, 89, NULL, NULL, 1),
(7, 'Pasto', 5000, 89, NULL, NULL, 1),
(8, 'Pasto', 5000, 99, NULL, NULL, 1),
(9, 'Bosques', 60, 90, 8, 12, 1),
(10, 'Otros', 5, 5, 8, 5, 7),
(11, 'Rastrojo', 7, 6, NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `degraded_areas`
--

CREATE TABLE IF NOT EXISTS `degraded_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `causa` enum('Erosión','Deforestación','Explotación minera','Uso de agroquímicos','Sobrepastoreo','¿Otro?') DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `area_total` int(11) DEFAULT NULL,
  `porcentaje_total` float DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coverages_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `degraded_areas`
--

INSERT INTO `degraded_areas` (`id`, `causa`, `area`, `porcentaje`, `area_total`, `porcentaje_total`, `property_id`) VALUES
(1, 'Erosión', 5, 6, 5, 5, 1),
(2, 'Sobrepastoreo', 30000, 5, 500000, 9, 1),
(3, 'Deforestación', 3, 4, 2, 2, 1),
(4, 'Erosión', 1, 2, 2, 4, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departaments`
--

CREATE TABLE IF NOT EXISTS `departaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `capital` varchar(45) DEFAULT NULL,
  `departamentscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `departaments`
--

INSERT INTO `departaments` (`id`, `name`, `codigo`, `capital`, `departamentscol`) VALUES
(1, 'ANTIOQUIA', 'ANT', 'MEDELLIN', NULL),
(2, 'ATLANTICO', 'ATL', 'BARRANQUILLA', NULL),
(3, 'BOGOTA', 'BOG', 'BOGOTA', NULL),
(4, 'BOLIVAR', 'BOL', 'CARTAGENA', NULL),
(5, 'BOYACÁ', 'BOY', 'TUNJA', NULL),
(6, 'CALDAS', 'CAL', 'MANIZALES', NULL),
(7, 'CAQUETA', 'CAQ', 'FLORENCIA', NULL),
(8, 'CAUCA', 'CAU', 'POPAYAN', NULL),
(9, 'CESAR', 'CES', 'VALLEDUPAR', NULL),
(10, 'CORDOBA', 'COR', 'MONTERIA', NULL),
(11, 'CUNDINAMARCA', 'CUN', 'BOGOTA', NULL),
(12, 'CHOCÓ', 'CHO', 'QUIBDO', NULL),
(13, 'HUILA', 'HUI', 'NEIVA', NULL),
(14, 'LA GUAJIRA', 'GUAJ', 'RIOHACHA', NULL),
(15, 'MAGDALENA', 'MAG', 'SANTA MARTA', NULL),
(16, 'META', 'MET', 'VILLAVICENCIO', NULL),
(17, 'NARIÑO', 'NAR', 'PASTO', NULL),
(18, 'NORTE SANTANDER', 'NOR', 'CUCUTA', NULL),
(19, 'QUINDIO', 'QUI', 'ARMENIA', NULL),
(20, 'RISARALDA', 'RIS', 'PEREIRA', NULL),
(21, 'SANTANDER', 'SAN', 'BUCARAMANGA', NULL),
(22, 'SUCRE', 'SUC', 'SINCELEJO', NULL),
(23, 'TOLIMA', 'TOL', 'IBAGUE', NULL),
(24, 'VALLE', 'VAL', 'CALI', NULL),
(25, 'ARAUCA', 'ARA', 'ARAUCA', NULL),
(26, 'CASANARE', 'CAS', 'YOPAL', NULL),
(27, 'PUTUMAYO', 'PUT', 'MOCOA', NULL),
(28, 'SAN ANDRES', 'SNA', 'SAN ANDRES', NULL),
(29, 'AMAZONAS', 'AMA', 'LETICIA', NULL),
(30, 'GUAINIA', '94000', 'INIRIDA', NULL),
(31, 'GUAVIARE', '95000', '', NULL),
(32, 'VAUPES', '97000', '', NULL),
(33, 'VICHADA', '99000', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('Radio','Televisor','Equipo de sonido','Modém internet','Refrigerador','Estufa a gas','Teléfono celular','Computador','Bicicleta','Motocicleta','Automovil/Camión') DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `home_id` int(11) NOT NULL,
  `otro` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_devices_homes1` (`home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id`, `name`, `cantidad`, `home_id`, `otro`) VALUES
(1, 'Automovil/Camión', 2, 0, 'rwerwe'),
(6, 'Equipo de sonido', 53, 5, '534'),
(5, 'Televisor', 53, 5, 'gdsf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `environments`
--

CREATE TABLE IF NOT EXISTS `environments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inundacion_area` int(11) DEFAULT NULL,
  `inundacion_periodo` date DEFAULT NULL,
  `derrumbe_area` int(11) DEFAULT NULL,
  `derrumbe_ubicacion` varchar(45) DEFAULT NULL,
  `sensibilizacion1` enum('Si','No') DEFAULT NULL,
  `sensibilizacion2` enum('Si','No') DEFAULT NULL,
  `observacion` text,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_environments_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `environments`
--

INSERT INTO `environments` (`id`, `inundacion_area`, `inundacion_periodo`, `derrumbe_area`, `derrumbe_ubicacion`, `sensibilizacion1`, `sensibilizacion2`, `observacion`, `property_id`) VALUES
(1, 9, '2012-10-06', 12, 'Norte del predio', 'No', 'Si', '', 11),
(2, NULL, '2012-10-12', NULL, '', NULL, NULL, '', 11),
(3, 699, '2012-10-12', 6, '', 'Si', 'No', '', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exploitation_types`
--

CREATE TABLE IF NOT EXISTS `exploitation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` double DEFAULT NULL,
  `tipo` enum('Agrícola','Pecuaria','Forestal') DEFAULT NULL,
  `cultivo` varchar(100) DEFAULT NULL,
  `tipo_agricola` enum('Solo','Asociado') DEFAULT NULL,
  `tipo_pecuario` enum('Bovinos','Piscicultura','Especies Menores') DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exploitation_types_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `exploitation_types`
--

INSERT INTO `exploitation_types` (`id`, `area`, `tipo`, `cultivo`, `tipo_agricola`, `tipo_pecuario`, `property_id`) VALUES
(1, 1, 'Forestal', 'rewwreerwe', 'Solo', 'Piscicultura', 0),
(2, 5555, 'Pecuaria', 'etr', 'Solo', 'Bovinos', 1),
(3, NULL, 'Agrícola', 'jghj', 'Solo', 'Bovinos', 11),
(4, 666, 'Pecuaria', 'hhgdhfghdfg', 'Solo', 'Bovinos', 1),
(5, -9, 'Forestal', NULL, NULL, 'Bovinos', 1),
(6, 32323, 'Agrícola', 'jghj', 'Solo', NULL, 11),
(7, NULL, 'Pecuaria', NULL, NULL, 'Bovinos', 11),
(8, 32323, 'Pecuaria', NULL, NULL, 'Bovinos', 11),
(9, 11111, 'Pecuaria', NULL, NULL, 'Bovinos', 0),
(10, 4444, 'Pecuaria', NULL, NULL, 'Bovinos', 0),
(11, 5, 'Agrícola', '', 'Solo', NULL, 7),
(12, 4, 'Pecuaria', NULL, NULL, 'Piscicultura', 7),
(13, 54, 'Agrícola', 'trrtr', 'Solo', NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_poblacion` enum('Campesino','Desplazado','Mujer cabeza de familia','Indigena','Rom') DEFAULT NULL,
  `nombre_sostiene_familia` varchar(70) DEFAULT NULL,
  `nombre_encargado_crianza` varchar(70) DEFAULT NULL,
  `vulnerabilidad` enum('Ninguna','Estrato 1-2','Ola invernal','Orden público') DEFAULT NULL,
  `area_adjudicada` float DEFAULT NULL,
  `otros_ingresos` tinyint(1) DEFAULT NULL,
  `ingeso_mensual_promedio` int(11) DEFAULT '0',
  `gasto_alimentos` int(11) DEFAULT '0',
  `gasto_servicios` int(11) DEFAULT '0',
  `gasto_educacion` int(11) DEFAULT '0',
  `gasto_transporte` int(11) DEFAULT '0',
  `gasto_salud` int(11) DEFAULT '0',
  `gasto_arriendo` int(11) DEFAULT '0',
  `gasto_entretenimiento` int(11) DEFAULT '0',
  `gasto_comunicaciones` int(11) DEFAULT '0',
  `gasto_deudas` int(11) DEFAULT '0',
  `gasto_otros` varchar(45) DEFAULT '0',
  `descripcion_otros_gastos` varchar(45) DEFAULT '0',
  `actividad_economica_1` enum('Agricultura','Pesca','Ganaderia','Comercio','Transporte','Mano de obra en la comunidad','Mano de obra no en la comunidad','Artesanias','Bares y restaurantes','Servicio domestico','Jornalero','Otra') DEFAULT NULL,
  `actividad_economica_2` enum('Agricultura','Pesca','Ganaderia','Comercio','Transporte','Mano de obra en la comunidad','Mano de obra no en la comunidad','Artesanias','Bares y restaurantes','Servicio domestico','Jornalero','Otra') DEFAULT NULL,
  `actividad_economica_3` enum('Agricultura','Pesca','Ganaderia','Comercio','Transporte','Mano de obra en la comunidad','Mano de obra no en la comunidad','Artesanias','Bares y restaurantes','Servicio domestico','Jornalero','Otra') DEFAULT NULL,
  `transporte_carro` tinyint(1) DEFAULT NULL,
  `transporte_moto` tinyint(1) DEFAULT NULL,
  `transporte_bicicleta` tinyint(1) DEFAULT NULL,
  `transporte_animal` tinyint(1) DEFAULT NULL,
  `trasansporte_publico` tinyint(1) DEFAULT NULL,
  `transporte_fluvial` tinyint(1) DEFAULT NULL,
  `transporte_otro` varchar(70) DEFAULT NULL,
  `ingreso_cabeza` int(11) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_families_candidates1` (`candidate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `families`
--

INSERT INTO `families` (`id`, `tipo_poblacion`, `nombre_sostiene_familia`, `nombre_encargado_crianza`, `vulnerabilidad`, `area_adjudicada`, `otros_ingresos`, `ingeso_mensual_promedio`, `gasto_alimentos`, `gasto_servicios`, `gasto_educacion`, `gasto_transporte`, `gasto_salud`, `gasto_arriendo`, `gasto_entretenimiento`, `gasto_comunicaciones`, `gasto_deudas`, `gasto_otros`, `descripcion_otros_gastos`, `actividad_economica_1`, `actividad_economica_2`, `actividad_economica_3`, `transporte_carro`, `transporte_moto`, `transporte_bicicleta`, `transporte_animal`, `trasansporte_publico`, `transporte_fluvial`, `transporte_otro`, `ingreso_cabeza`, `candidate_id`) VALUES
(2, 'Desplazado', 'Andres Camargo', 'ines bellada', 'Ola invernal', 120, 1, 600000, 5000, 2300, 5600, 9000, 8888, 7778, 88886, 8888, 777, '777', 'Celular', 'Bares y restaurantes', 'Mano de obra no en la comunidad', 'Artesanias', 1, 0, 1, 0, 0, 0, '', 50000, 2),
(3, 'Desplazado', 'Juan Delgado', 'Anibal Quijano', 'Estrato 1-2', 500, 0, 600000, 50000, 60000, 30000, 65000, 500000, 1000000, 60000, 892100, 9000000, '600000', 'celular', 'Ganaderia', 'Comercio', 'Mano de obra no en la comunidad', 0, 0, 0, 1, 0, 1, '', 50000, 3),
(4, 'Mujer cabeza de familia', 'Juan Camargo', 'Delia Camargo', 'Orden público', 155, 0, 1500000, 21231, 212185, 5, 555, 5555, 2222, 121212, 2121, 212, '', '', 'Mano de obra en la comunidad', 'Mano de obra no en la comunidad', 'Bares y restaurantes', 0, 1, 0, 0, 0, 0, '', NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `family_polls`
--

CREATE TABLE IF NOT EXISTS `family_polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_aliado` varchar(100) DEFAULT NULL,
  `nombre_encuestador` varchar(100) DEFAULT NULL,
  `documento_encuestador` varchar(45) DEFAULT NULL,
  `fecha_entrevista` date DEFAULT NULL,
  `numero_visitas` int(11) DEFAULT NULL,
  `codigo_formulario` varchar(45) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  `nombre_encuestado` varchar(60) DEFAULT NULL,
  `documento_encuestado` varchar(60) DEFAULT NULL,
  `telefono_fijo` varchar(60) DEFAULT NULL,
  `tefono_celular` varchar(60) DEFAULT NULL,
  `correo_electronico` varchar(60) DEFAULT NULL,
  `ubicacion_residencia` enum('Fuera del predio','Dentro del predio') DEFAULT NULL,
  `tipo_poblacion` enum('Campesino','Desplazado') DEFAULT NULL,
  `grupo_poblacion` enum('Mujeres cabeza de hogar','Indígenas','Negritudes','Rom') DEFAULT NULL,
  `etnia` varchar(60) DEFAULT NULL,
  `fecha_desplazamiento` varchar(60) DEFAULT NULL,
  `vereda_desplazamiento` varchar(45) DEFAULT NULL,
  `vulnerabilidad` enum('No','Desplazamiento','Estrato uno o dos','Ola invernal','Orden público') DEFAULT NULL,
  `vereda` varchar(60) DEFAULT NULL,
  `corregimiento` varchar(60) DEFAULT NULL,
  `observaciones` text,
  `departament_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `ciudad_desplazamiento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_family_polls_candidates1` (`candidate_id`),
  KEY `fk_family_polls_departaments1` (`departament_id`),
  KEY `fk_family_polls_cities1` (`city_id`),
  KEY `fk_family_polls_cities2` (`ciudad_desplazamiento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `family_polls`
--

INSERT INTO `family_polls` (`id`, `nombre_aliado`, `nombre_encuestador`, `documento_encuestador`, `fecha_entrevista`, `numero_visitas`, `codigo_formulario`, `candidate_id`, `nombre_encuestado`, `documento_encuestado`, `telefono_fijo`, `tefono_celular`, `correo_electronico`, `ubicacion_residencia`, `tipo_poblacion`, `grupo_poblacion`, `etnia`, `fecha_desplazamiento`, `vereda_desplazamiento`, `vulnerabilidad`, `vereda`, `corregimiento`, `observaciones`, `departament_id`, `city_id`, `ciudad_desplazamiento`) VALUES
(12, 'dasd', 'as', '31', '2012-10-09', 2434, 'eqwe', 3, 'eqwe', 'eeqwe', 'eqw', 'eqw', 'w@perro.com', 'Dentro del predio', 'Desplazado', 'Mujeres cabeza de hogar', 'muuu', '2012-10-02', 'dasda', 'Estrato uno o dos', 'ds', 'das', 'dasdad\nsvdvs\nvsdv\n\nvsv\n\n\nvsdvs', 19, 892, 12),
(13, 'fsd', 'fsd', '432', '2012-10-09', 3, '42', 4, '42', '423', '423', '42342', 'wer@algo.com', 'Dentro del predio', 'Campesino', 'Mujeres cabeza de hogar', 'rweq', NULL, NULL, 'Ola invernal', 'rwe', 'rqwe', 'rwerqerqwe\nrwqrqwr\nrqwerwqerqwerwerwerwq', 16, 754, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floor_units`
--

CREATE TABLE IF NOT EXISTS `floor_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` int(11) DEFAULT NULL,
  `pendiente` double DEFAULT NULL,
  `erosion` enum('Alta','Moderada','Baja','No hay') DEFAULT NULL,
  `profundidad_efectiva` int(11) DEFAULT NULL,
  `pedregosidad` enum('Si','No') DEFAULT NULL,
  `salinidad` enum('Alta','Moderada','Baja','No hay') DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `drenaje` enum('Si','No') DEFAULT NULL,
  `encharcamiento` enum('Si','No') DEFAULT NULL,
  `inundabilidad` enum('Si','No') DEFAULT NULL,
  `freatico` int(11) DEFAULT NULL,
  `textura` varchar(45) DEFAULT NULL,
  `ph` double DEFAULT NULL,
  `area_util` int(11) DEFAULT NULL,
  `agrologica` varchar(45) DEFAULT NULL,
  `horizonte` int(11) DEFAULT NULL,
  `pedregosidad_superficial` varchar(45) DEFAULT NULL,
  `otro` varchar(45) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_floor_units_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `floor_units`
--

INSERT INTO `floor_units` (`id`, `area`, `pendiente`, `erosion`, `profundidad_efectiva`, `pedregosidad`, `salinidad`, `color`, `drenaje`, `encharcamiento`, `inundabilidad`, `freatico`, `textura`, `ph`, `area_util`, `agrologica`, `horizonte`, `pedregosidad_superficial`, `otro`, `property_id`) VALUES
(1, 4, 2, 'Baja', 2, 'Si', 'Alta', NULL, 'Si', 'Si', 'Si', 4545, '87555', 8877, 554, 'I', 775, 'Si', '878', 7),
(2, 5, 5, 'Moderada', 58, 'Si', 'Moderada', NULL, 'Si', 'Si', 'Si', 8, '87555', 89, 8, 'III', 52, 'Si', '55', 7),
(3, 5, 5, 'Alta', 58, 'Si', 'Alta', NULL, 'Si', 'Si', 'Si', 55, '5', 5, 554, 'II', 52, 'Si', '5', 7),
(4, 423, 423, 'Alta', 423, 'Si', 'Baja', '423', 'Si', 'Si', 'Si', 423, '423', 423, 423, 'VII', 423, 'Si', '423', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floor_uses`
--

CREATE TABLE IF NOT EXISTS `floor_uses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clase` enum('I','II','III','IV','V','VI','VII','VIII') DEFAULT NULL,
  `agricultura` float DEFAULT NULL,
  `pecuaria` float DEFAULT NULL,
  `forestal_productiva` float DEFAULT NULL,
  `otros_usos` float DEFAULT NULL,
  `area_no_explotada` float DEFAULT NULL,
  `forestal_protectora` float DEFAULT NULL,
  `no producitva` float DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `floor_units_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coverages_properties1_idx` (`property_id`),
  KEY `fk_floor_uses_floor_units1_idx` (`floor_units_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floor_utilities`
--

CREATE TABLE IF NOT EXISTS `floor_utilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clase` enum('I','II','III','IV','V','VI','VII','VIII') DEFAULT NULL,
  `agricultura` double DEFAULT NULL,
  `pecuaria` double DEFAULT NULL,
  `forestal_productiva` double DEFAULT NULL,
  `otros_usos` double DEFAULT NULL,
  `area_no_explotada` double DEFAULT NULL,
  `forestal_protectora` double DEFAULT NULL,
  `no_productiva` double DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coverages_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `floor_utilities`
--

INSERT INTO `floor_utilities` (`id`, `clase`, `agricultura`, `pecuaria`, `forestal_productiva`, `otros_usos`, `area_no_explotada`, `forestal_protectora`, `no_productiva`, `property_id`) VALUES
(1, 'II', 565, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'I', 5, 8, 9, 5, 3, 0, 0, 7),
(3, 'I', 4, 4, 4, 4, 45, 5, 6, 7),
(4, 'II', 53, 534, 53, 53, 534, 534, 534, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups_items`
--

CREATE TABLE IF NOT EXISTS `groups_items` (
  `item_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups_items`
--

INSERT INTO `groups_items` (`item_id`, `group_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups_tabs`
--

CREATE TABLE IF NOT EXISTS `groups_tabs` (
  `tab_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`tab_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups_tabs`
--

INSERT INTO `groups_tabs` (`tab_id`, `group_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `homes`
--

CREATE TABLE IF NOT EXISTS `homes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenencia` enum('Arriendo','Propia','Familiar','Bajo su cuidado') DEFAULT NULL,
  `otro_tenencia` varchar(60) DEFAULT NULL,
  `tipo` enum('Finca','Casa','Habitación','Otro') DEFAULT NULL,
  `tipo_otro` varchar(60) DEFAULT NULL,
  `cantidad_habitaciones` int(11) DEFAULT NULL,
  `personas_habitan` int(11) DEFAULT NULL,
  `materiales` enum('Ladrillo bloque','Adobe','Bahareque','Guadua','Madera','Otro') DEFAULT NULL,
  `otro_material` varchar(45) DEFAULT NULL,
  `techo` enum('Tejas de barro','Tejas de eternit','Zinc','Plastico','Paja o palma','Otro') DEFAULT NULL,
  `techo_otro` varchar(45) DEFAULT NULL,
  `piso` enum('Tierra','Baldosa','Cemento','Otro') DEFAULT NULL,
  `piso_otro` varchar(45) DEFAULT NULL,
  `combustible_coccion` enum('Leña','Gas propano','Gas natural','Estufa eléctrica','Estufa gasolina','Otro') DEFAULT NULL,
  `otro_combustible_coccion` varchar(45) DEFAULT NULL,
  `inodoro_alcantarillado` tinyint(1) DEFAULT NULL,
  `inodoro_desconectado` tinyint(1) DEFAULT NULL,
  `inodoro_pozo` tinyint(1) DEFAULT NULL,
  `letrina` tinyint(1) DEFAULT NULL,
  `inodoro_sin` tinyint(1) DEFAULT NULL,
  `sala` tinyint(1) DEFAULT NULL,
  `comedor` tinyint(1) DEFAULT NULL,
  `cocina` tinyint(1) DEFAULT NULL,
  `banio` tinyint(1) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_homes_candidates1` (`candidate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `homes`
--

INSERT INTO `homes` (`id`, `tenencia`, `otro_tenencia`, `tipo`, `tipo_otro`, `cantidad_habitaciones`, `personas_habitan`, `materiales`, `otro_material`, `techo`, `techo_otro`, `piso`, `piso_otro`, `combustible_coccion`, `otro_combustible_coccion`, `inodoro_alcantarillado`, `inodoro_desconectado`, `inodoro_pozo`, `letrina`, `inodoro_sin`, `sala`, `comedor`, `cocina`, `banio`, `candidate_id`) VALUES
(1, 'Propia', 'f', 'Finca', '', 312, 31, 'Adobe', '312', 'Tejas de eternit', '312', 'Tierra', '312', 'Leña', 'dasd', 1, 1, 1, 1, 1, 1, 1, 1, 1, 5),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(5, 'Arriendo', 'gfd', 'Finca', 'gdfg', 243, 534, 'Adobe', '5', 'Tejas de barro', '5345', 'Baldosa', '534', 'Leña', '534', 1, 1, 1, 1, 1, 1, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_spaces`
--

CREATE TABLE IF NOT EXISTS `home_spaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('Sala','Comedor','Cocina','Servicios sanitarios') DEFAULT NULL,
  `home_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_home_spaces_homes1` (`home_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icono` varchar(45) DEFAULT NULL,
  `nombre` varchar(55) DEFAULT NULL,
  `controlador` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `icono`, `nombre`, `controlador`, `accion`, `menu_id`) VALUES
(1, NULL, 'Listar menus', 'Menus', 'index', 1),
(2, '', 'Adicionar menu', 'Menus', 'add', 1),
(3, '', 'Adicionar Items', 'Items', 'add', 2),
(4, '', 'Listar Items', 'Items', 'index', 2),
(5, '', 'Listar grupos', 'Groups', 'index', 3),
(6, '', 'Listar usuarios', 'Users', 'index', 4),
(7, '', 'Listar objetos', 'ObjectCreators', 'index', 5),
(8, '', 'Listar pestañas', 'Tabs', 'index', 6),
(9, '', 'Adicionar pestañas', 'Tabs', 'add', 6),
(10, '', 'Listar departamentos', 'Departaments', 'index', 7),
(11, '', 'Municipios', 'Cities', 'index', 7),
(15, '', 'Cabezas de familia', 'Candidates', 'index', 8),
(16, '', 'Familiares', 'relatives', 'index', 8),
(14, '', 'Aspirantes', 'Candidates', 'index', 7),
(17, '', 'Información general', 'Families', 'index', 8),
(18, '', 'Producción y comercialización', 'ProductivePolls', 'index', 8),
(19, '', 'Actividades productivas', 'ProductiveActivities', 'index', 7),
(20, '', 'asociación y organización', 'Asociations', 'index', 8),
(21, '', 'Información de la vivienda', 'homes', 'index', 8),
(22, '', 'Listar predios', 'Properties', 'index', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenders`
--

CREATE TABLE IF NOT EXISTS `lenders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` enum('Banco Agrario','ONG microfinanciera','Cooperativas','Proveedores de insumos','Amigos o familiares','Casa de empeño','Prestamistas particulares','Otra institucion') DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lenders_productive_pool1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `lenders`
--

INSERT INTO `lenders` (`id`, `nombre`, `productive_poll_id`) VALUES
(1, 'Banco Agrario', 0),
(2, 'Banco Agrario', 0),
(3, 'Casa de empeño', 0),
(4, 'Banco Agrario', 1),
(5, 'ONG microfinanciera', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `live_stocks`
--

CREATE TABLE IF NOT EXISTS `live_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Aves de corral','Conejos','Chivos','Cerdos','Caballos','Burros','Mulas','Ganado vacuno','Otro') DEFAULT NULL,
  `otro` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `home_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_live_stocks_homes1` (`home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `live_stocks`
--

INSERT INTO `live_stocks` (`id`, `tipo`, `otro`, `cantidad`, `home_id`) VALUES
(4, 'Conejos', '5', 534, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marketing_lines`
--

CREATE TABLE IF NOT EXISTS `marketing_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_canal` enum('asociación','Plaza de mercado','Intermediario','Almacén de  cadena','Tienda','Restaurante','Industria','Exportador','Otro') DEFAULT NULL,
  `nombre_canal` varchar(55) DEFAULT NULL,
  `variedad` varchar(45) DEFAULT NULL,
  `calidad` enum('Primera','Segunda','Tercera') DEFAULT NULL,
  `unidad` varchar(45) DEFAULT NULL,
  `unidades_anio` varchar(45) DEFAULT NULL,
  `precio_promedio_unidad` int(11) DEFAULT NULL,
  `entrega` enum('En Finca','Transporta hasta el canal') DEFAULT NULL,
  `enero` tinyint(1) DEFAULT NULL,
  `febrero` tinyint(1) DEFAULT NULL,
  `marzo` tinyint(1) DEFAULT NULL,
  `abril` tinyint(1) DEFAULT NULL,
  `mayo` tinyint(1) DEFAULT NULL,
  `junio` tinyint(1) DEFAULT NULL,
  `juiio` tinyint(1) DEFAULT NULL,
  `agosto` tinyint(1) DEFAULT NULL,
  `septiembre` tinyint(1) DEFAULT NULL,
  `octubre` tinyint(1) DEFAULT NULL,
  `noviembre` tinyint(1) DEFAULT NULL,
  `diciembre` tinyint(1) DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  `productive_activity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_marketing_lines_productive_polls1` (`productive_poll_id`),
  KEY `fk_marketing_lines_productive_activities1` (`productive_activity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `marketing_lines`
--

INSERT INTO `marketing_lines` (`id`, `tipo_canal`, `nombre_canal`, `variedad`, `calidad`, `unidad`, `unidades_anio`, `precio_promedio_unidad`, `entrega`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `juiio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`, `productive_poll_id`, `productive_activity_id`) VALUES
(1, 'Intermediario', 'gsdf', 'gsdf', 'Primera', '3', '534', 534, 'Transporta hasta el canal', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3),
(2, 'asociación', 'vsd', 'fsd', 'Primera', 'fsdf', 'fds', NULL, 'En Finca', 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 19),
(3, 'Intermediario', 'dsf', 'fsd', 'Primera', '234', '423', 423, 'En Finca', 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 3),
(4, 'asociación', 'rt', 'ert', 'Segunda', 'etrt', 'ter', NULL, 'Transporta hasta el canal', 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 19),
(5, 'asociación', 'er', 'r', 'Segunda', 'tert', 'ter', 464, 'En Finca', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 11),
(6, 'asociación', 'ytr', 'yrty', 'Primera', 'yrt', '54', 54, NULL, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 4, 16),
(7, 'asociación', '6', '64', 'Segunda', '645', '645', 645, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 18),
(8, 'asociación', 'das', 'das', 'Primera', 'ads', 'das', 34, 'En Finca', 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 20),
(9, 'Plaza de mercado', 'fsdf', 'fsd', 'Primera', '423', 'fsdf', NULL, 'En Finca', 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 6, 4),
(10, 'asociación', 'fsdf', 'fsdf', 'Primera', 'fsd', 'sfdf', 31, 'En Finca', 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `icono` varchar(25) DEFAULT NULL,
  `tab_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `url`, `icono`, `tab_id`) VALUES
(1, 'Menus', NULL, NULL, 1),
(2, 'Items', '', '', 1),
(3, 'Groups', '', '', 1),
(4, 'Users', '', '', 1),
(5, 'Objetos', '', '', 1),
(6, 'Pestañas', '', '', 1),
(7, 'Parametros generales', '', '', 2),
(8, 'Familias', '', '', 3),
(9, 'Predios', '', '', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Cooperativa','Asociación','SAT','JAC','EAT','Otro') DEFAULT NULL,
  `tipo_otro` varchar(45) DEFAULT NULL,
  `legalidad` enum('SI','NO') DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `sigla` varchar(20) DEFAULT NULL,
  `representante_nombre` varchar(45) DEFAULT NULL,
  `numero_miembros` int(11) DEFAULT NULL,
  `numero_asociados` int(11) DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_organizations_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `organizations`
--

INSERT INTO `organizations` (`id`, `tipo`, `tipo_otro`, `legalidad`, `nombre`, `sigla`, `representante_nombre`, `numero_miembros`, `numero_asociados`, `tiempo`, `property_id`) VALUES
(1, 'Asociación', 'dxf', 'NO', 'KK', 'ghg', 'camilo', 455, 44, 20, 1),
(2, 'EAT', NULL, 'SI', 'Baladi', '', 'fvgbnm', 1, 2, 5, 1),
(3, 'SAT', NULL, 'SI', 'cera', '', 'yonei', NULL, NULL, 3, 1),
(4, 'EAT', NULL, 'SI', 'Cootierras', 'Ninguna', 'Camila valbuena', 5, 5, 7, 1),
(5, '', 'ONG', 'SI', 'Veritas', 'ONU', 'Mark Zuckerberg', 7, 5, 7, 1),
(6, 'Cooperativa', 'dfdreererr', 'SI', 'erwereeeeeeeeeeeeee', 'ssssssssssssssssssss', 'aaaaaaaaaaaaaaaa', 45556556, 56248, 444444, 1),
(7, 'Cooperativa', 'dfdff', NULL, 'erereer', 'e4e', 'reere3', 566, 656, 66, 7),
(9, 'Asociación', '', 'SI', 'rqwe', 'rqwer', 'qwre', 53, 5234, 523, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potentials`
--

CREATE TABLE IF NOT EXISTS `potentials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origen` enum('Agrícola','Pecuaría','Forestal','','Forestal') DEFAULT NULL,
  `tipo_otro` varchar(45) DEFAULT NULL,
  `lineas_productivas` varchar(90) DEFAULT NULL,
  `area_explotacion` int(11) DEFAULT NULL,
  `infraestrutura` enum('Si','No') DEFAULT NULL,
  `infraestrutura_tipo` enum('Beneficiario','Establos','Bodega','Otro') DEFAULT NULL,
  `tipo_otro2` varchar(45) DEFAULT NULL,
  `observacion` text,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_potentials_properties1_idx` (`property_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practices`
--

CREATE TABLE IF NOT EXISTS `practices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Buenas Prácticas Agrícolas (BPA)','Mejoramiento de semillas, razas, especies','Fertilización Orgánica','Fertilización Química','Producción limpia','Conservación de recursos naturales','Labranza minima') DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_practices_productive_pools1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `practices`
--

INSERT INTO `practices` (`id`, `tipo`, `productive_poll_id`) VALUES
(1, '', 0),
(2, '', 0),
(3, '', 0),
(4, '', 2),
(5, '', 2),
(6, 'Conservación de recursos naturales', 2),
(7, 'Buenas Prácticas Agrícolas (BPA)', 2),
(8, '', 2),
(9, 'Conservación de recursos naturales', 2),
(10, 'Fertilización Orgánica', 2),
(11, 'Producción limpia', 2),
(12, 'Mejoramiento de semillas, razas, especies', 2),
(13, 'Buenas Prácticas Agrícolas (BPA)', 2),
(14, 'Fertilización Orgánica', 2),
(15, 'Labranza minima', 2),
(16, '', 2),
(17, '', 2),
(18, 'Labranza minima', 2),
(19, 'Mejoramiento de semillas, razas, especies', 4),
(20, 'Producción limpia', 4),
(21, 'Mejoramiento de semillas, razas, especies', 3),
(22, 'Fertilización Orgánica', 3),
(23, 'Buenas Prácticas Agrícolas (BPA)', 1),
(24, 'Buenas Prácticas Agrícolas (BPA)', 1),
(25, 'Buenas Prácticas Agrícolas (BPA)', 1),
(26, 'Buenas Prácticas Agrícolas (BPA)', 6),
(27, 'Producción limpia', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productive_activities`
--

CREATE TABLE IF NOT EXISTS `productive_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(65) DEFAULT NULL,
  `tipo` enum('Agricola','Pecuario','Forestal') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=180 ;

--
-- Volcado de datos para la tabla `productive_activities`
--

INSERT INTO `productive_activities` (`id`, `nombre`, `tipo`) VALUES
(2, 'AGUA ENVASADA', 'Agricola'),
(3, 'AGUACATE', 'Agricola'),
(4, 'AJIES Y PIMIENTOS', 'Agricola'),
(5, 'AJONJOLI', 'Agricola'),
(6, 'AJOS', 'Agricola'),
(7, 'ALGODON SIN DESMOTAR', 'Agricola'),
(8, 'ARRACACHA', 'Agricola'),
(9, 'ARROZ', 'Agricola'),
(10, 'ARROZ PERGAMINO', 'Agricola'),
(11, 'ARROZ-FORESTAL', 'Agricola'),
(12, 'ARVEJA', 'Agricola'),
(13, 'ARVEJA SECA', 'Agricola'),
(14, 'ARVEJA VERDE', 'Agricola'),
(15, 'BANANOS', 'Agricola'),
(16, 'BANCO DE PROTEINAS', 'Agricola'),
(17, 'CACAO', 'Agricola'),
(18, 'CACOTA DE CAFE', 'Agricola'),
(19, 'CANA DE AZUCAR', 'Agricola'),
(20, 'CAFE', 'Agricola'),
(21, 'CAFÉ-AGUACATE', 'Agricola'),
(22, 'CAÑA', 'Agricola'),
(23, 'CAÑA FORRAJERA', 'Agricola'),
(24, 'CAÑA PANELERA', 'Agricola'),
(25, 'CARACOL', 'Agricola'),
(26, 'CAUCHO', 'Agricola'),
(27, 'CAUCHO EN BRUTO', 'Agricola'),
(28, 'CEBADA PELADA', 'Agricola'),
(29, 'CEBOLLA', 'Agricola'),
(30, 'CEBOLLA JUNCA', 'Agricola'),
(31, 'CHONTADURO', 'Agricola'),
(32, 'CILANTRO', 'Agricola'),
(33, 'CITRICOS N.E.P.', 'Agricola'),
(34, 'CLAVOS DE OLOR', 'Agricola'),
(35, 'CURIES', 'Agricola'),
(36, 'FLORES Y HOJAS MEDICINALES', 'Agricola'),
(37, 'FRIJOLES', 'Agricola'),
(38, 'FRUTAS FRESCAS N.E.P.', 'Agricola'),
(39, 'GANADERIA', ''),
(40, 'GANADERIA DOBLE PROPOSITO', ''),
(41, 'GANADO CABRIO', 'Agricola'),
(42, 'GANADO OVINO', ''),
(43, 'GANADO PORCINO', ''),
(44, 'GANADO VACUNO', ''),
(45, 'GANDERIA DE CEBA', ''),
(46, 'GRANADILLA', 'Agricola'),
(47, 'GUANABANA', 'Agricola'),
(48, 'GUAYABA', 'Agricola'),
(49, 'GUAYABAS', 'Agricola'),
(50, 'HABICHUELA', 'Agricola'),
(51, 'HIERBAS MEDICINALES', 'Agricola'),
(52, 'HORTALIZAS Y LEGUMBRES N.E.P.', 'Agricola'),
(53, 'LECHE FRESCA', 'Agricola'),
(54, 'LEGUMINOSAS SECAS N.E.P.', 'Agricola'),
(55, 'LIMONES', 'Agricola'),
(56, 'LULO', 'Agricola'),
(57, 'LULOS', 'Agricola'),
(58, 'MADERA EN BRUTO', 'Agricola'),
(59, 'MADERABLES', 'Agricola'),
(60, 'MAIZ', 'Agricola'),
(61, 'MANGO', 'Agricola'),
(62, 'MANGOS', 'Agricola'),
(63, 'MANI', 'Agricola'),
(64, 'MANZANAS', 'Agricola'),
(65, 'MARACUYA', 'Agricola'),
(66, 'MARANON', 'Agricola'),
(67, 'MORA', 'Agricola'),
(68, 'MORA- LULO', 'Agricola'),
(69, 'MORAS Y FRAMBUESAS', 'Agricola'),
(70, 'ÑAME', 'Agricola'),
(71, 'OVINOS', 'Agricola'),
(72, 'Palma', 'Agricola'),
(73, 'PAPAS', 'Agricola'),
(74, 'PAPAYA', 'Agricola'),
(75, 'PASTO', 'Agricola'),
(76, 'PASTOS', 'Agricola'),
(77, 'PASTOS DE CORTE', 'Agricola'),
(78, 'PECUARIA', ''),
(79, 'PEPINOS Y SIMILARES', 'Agricola'),
(80, 'PESCADOS DE AGUA DULCE', 'Agricola'),
(81, 'PIMIENTA', 'Agricola'),
(82, 'PIÑAS', 'Agricola'),
(83, 'PLANTAS FORRAJERAS', 'Agricola'),
(84, 'PLATANOS', 'Agricola'),
(85, 'POLLOS Y GALLINAS', ''),
(86, 'SABILA', 'Agricola'),
(87, 'SEMILLAS Y BAYAS N.E.P.', 'Agricola'),
(88, 'SOYA', 'Agricola'),
(89, 'TABACO EN RAMA', 'Agricola'),
(90, 'TOMATE DE ARBOL', 'Agricola'),
(91, 'TOMATES', 'Agricola'),
(92, 'UCHUVA', 'Agricola'),
(93, 'YUCA', 'Agricola'),
(94, 'ACEITUNAS FRESCAS', 'Agricola'),
(95, 'ALCAPARRAS', 'Agricola'),
(96, 'ANIS', 'Agricola'),
(97, 'ARRACACHA', 'Agricola'),
(98, 'ATUNES', ''),
(99, 'AVENA', 'Agricola'),
(100, 'BOROJO', 'Agricola'),
(101, 'BREVAS', 'Agricola'),
(102, 'CADILLO - BALSO', 'Agricola'),
(103, 'CANELA', 'Agricola'),
(104, 'CARBON VEGETAL', 'Agricola'),
(105, 'CEBADA-RASPA', 'Agricola'),
(106, 'CENTENO', 'Agricola'),
(107, 'CERA DE ABEJAS', 'Agricola'),
(108, 'CEREZAS FRESCAS', 'Agricola'),
(109, 'CIRUELAS', 'Agricola'),
(110, 'CLARAS Y YEMAS DE HUEVOS CONGELADAS', 'Agricola'),
(111, 'COCOS', 'Agricola'),
(112, 'COMINOS', 'Agricola'),
(113, 'CONEJOS', ''),
(114, 'CORTEZAS MEDICINALES', 'Agricola'),
(115, 'CORTEZAS TINTORERAS Y CURTIENTES', 'Agricola'),
(116, 'CREMA DE LECHE CRUDA - NATA', 'Agricola'),
(117, 'CRUSTACEOS DE AGUA DULCE', ''),
(118, 'CRUSTACEOS DE MAR', ''),
(119, 'CURUBAS', 'Agricola'),
(120, 'DURAZNOS', 'Agricola'),
(121, 'EMBRIONES DE PATO', ''),
(122, 'ESPARRAGOS', 'Agricola'),
(123, 'ESPECIAS N.E.P.', 'Agricola'),
(124, 'ESTROPAJOS', 'Agricola'),
(125, 'FRESAS', 'Agricola'),
(126, 'FRUTO DE PALMA AFRICANA', 'Agricola'),
(127, 'GANADO CABALLAR', ''),
(128, 'GOMA ARABIGA', 'Agricola'),
(129, 'GOMA TRAGACANTO', 'Agricola'),
(130, 'HOJA DE FIQUE O PITA', 'Agricola'),
(131, 'HOJAS Y FLORES N.E.P.', 'Agricola'),
(132, 'HUEVOS', ''),
(133, 'LANA SIN LAVAR', 'Agricola'),
(134, 'LINAZA', 'Agricola'),
(135, 'LUPULO', 'Agricola'),
(136, 'MIEL DE ABEJAS', 'Agricola'),
(137, 'MILLO SORGO', 'Agricola'),
(138, 'MIMBRE-CA#A Y SIMILARES', 'Agricola'),
(139, 'MOLUSCOS DE AGUA DULCE', ''),
(140, 'MOLUSCOS DE MAR', 'Agricola'),
(141, 'NARANJAS', 'Agricola'),
(142, 'NUECES', 'Agricola'),
(143, 'NUECES OLEAGINOSAS N.E.P.', 'Agricola'),
(144, 'PAJA PARA ESCOBAS Y SIMILARES', 'Agricola'),
(145, 'PALMA', 'Agricola'),
(146, 'PALMITOS', 'Agricola'),
(147, 'PATOS', ''),
(148, 'PAVOS', ''),
(149, 'PERAS', 'Agricola'),
(150, 'PESCADOS N.E.P. DE MAR', ''),
(151, 'PIELES DE ANIMALES DE CAZA SIN CURTIR', ''),
(152, 'PIELES DE CAIMAN SIN CURTIR', 'Pecuario'),
(153, 'PIELES DE REPTILES N.E.P. SIN CURTIR', ''),
(154, 'RAICES DE PLANTAS', 'Agricola'),
(155, 'REMOLACHA', 'Agricola'),
(156, 'RESINAS VEGETALES N.E.P.', 'Agricola'),
(157, 'SALMONES', ''),
(158, 'SARDINAS', ''),
(159, 'SEMILLA DE GIRASOL', 'Agricola'),
(160, 'SEMILLA DE HIGUERILLA', 'Agricola'),
(161, 'SEMILLA DE RICINO', 'Agricola'),
(162, 'SEMILLAS OLEAGINOSAS N.E.P.', 'Agricola'),
(163, 'SETAS U HONGOS', 'Agricola'),
(164, 'SUB-PRODUCTOS AGRICOLAS DE CEREALES', 'Agricola'),
(165, 'TE SIN ELEBORAR', 'Agricola'),
(166, 'TOTUMAS - SECAS', 'Agricola'),
(167, 'TRIGO EN GRANO', 'Agricola'),
(168, 'UVAS', 'Agricola'),
(169, 'VENENO DE SERPIENTES', ''),
(170, 'ZANAHORIA', 'Agricola'),
(171, ' ASOCIADO', 'Agricola'),
(172, 'GULUPA', 'Agricola'),
(173, 'REPOLLO', 'Agricola'),
(174, 'MELON', 'Agricola'),
(175, 'BROCOLI', 'Agricola'),
(176, 'LECHUGA', 'Agricola'),
(177, 'CUY', ''),
(178, 'TRUCHA ARCO IRIS', ''),
(179, 'QUINUA', 'Agricola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productive_areas`
--

CREATE TABLE IF NOT EXISTS `productive_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(45) DEFAULT NULL,
  `associado` tinyint(1) DEFAULT NULL,
  `unidad` enum('ha','metro','metro cuadrado','metro cúbico') DEFAULT NULL,
  `densidad` int(11) DEFAULT NULL,
  `volumen_producion` float DEFAULT NULL,
  `unidad_produccion` enum('Tonelada','Kilogramo','Bulto','Litro') DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `cosechas` int(11) DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  `productive_activity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productive_areas_productive_activities1` (`productive_activity_id`),
  KEY `fk_productive_areas_productive_polls1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `productive_areas`
--

INSERT INTO `productive_areas` (`id`, `area`, `associado`, `unidad`, `densidad`, `volumen_producion`, `unidad_produccion`, `orden`, `cosechas`, `productive_poll_id`, `productive_activity_id`) VALUES
(1, '1323', 1, 'ha', 12, 2121, 'Tonelada', 1, 323, 1, 6),
(2, '4234', 1, 'ha', 423, 423, '', 4, 432, 1, 11),
(3, '333', 1, 'metro', 333, 333, 'Tonelada', 333, 333, 1, 2),
(4, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2),
(5, '534', 1, 'ha', 543, 5353, 'Kilogramo', 534, 534, 1, 2),
(6, '534', 1, 'ha', 543, 5353, 'Kilogramo', 534, 534, 1, 2),
(7, '534', 1, 'ha', 543, 5353, 'Kilogramo', 534, 534, 1, 2),
(8, '534', 1, 'ha', 543, 5353, 'Kilogramo', 534, 534, 1, 2),
(9, '534', 1, 'ha', 543, 5353, 'Kilogramo', 534, 534, 1, 2),
(10, '534', 1, 'metro', 542, 34, 'Tonelada', 543, 343, 1, 2),
(11, '756', 1, 'metro', 756, 765, 'Tonelada', 4, 756, 1, 2),
(12, '534', 1, 'ha', 5345, 5345, 'Tonelada', 54, 5345, 1, 2),
(13, '32', 1, 'metro', 32, 32, 'Tonelada', 1, 32, 1, 2),
(14, '4234', 1, 'metro', 32, 32, 'Tonelada', 3, 32, 2, 2),
(15, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(16, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(17, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(18, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(19, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(20, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(21, '534', 1, 'metro', 4454, 9, 'Tonelada', 5, 545646, 2, 2),
(22, '776', 1, 'metro', 986, 987908, 'Kilogramo', 876, 54, 2, 2),
(23, '534', 1, 'metro', 534, 53, 'Kilogramo', 5234, 5345, 2, 9),
(24, '4554', 1, 'ha', 54, 54, 'Bulto', 1, 54, 3, 5),
(25, '323', 1, 'ha', 323, 32, 'Tonelada', 2, 323, 3, 4),
(26, '43', 1, 'ha', 423, 423, 'Tonelada', 2, 432, 3, 4),
(27, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(28, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(29, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(30, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(31, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(32, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(33, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(34, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(35, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(36, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(37, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(38, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(39, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(40, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(41, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(42, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(43, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(44, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(45, '4554', 1, 'ha', 54, 54, 'Bulto', 4, 54, 3, 2),
(46, '4554', 1, 'ha', 54, 54, 'Bulto', 1, 54, 3, 2),
(47, '4554', 1, 'ha', 54, 54, 'Bulto', 1, 54, 3, 14),
(48, '331', 1, 'metro', 312, 123, 'Kilogramo', 2, 3123, 4, 19),
(49, '3', 1, 'ha', 312, 321, 'Tonelada', 3, 312, 1, 4),
(50, '534', 1, 'metro', 534, 53, 'Tonelada', 534, 534, 534, 2),
(51, '312', 1, 'metro cuadrado', 312, 312, '', 13, 312, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productive_polls`
--

CREATE TABLE IF NOT EXISTS `productive_polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dominio_parcela` enum('Propia','Alquilada','Prestada','En sociedad') DEFAULT NULL,
  `riego` enum('Ninguno','Gravedad','Aspersión','Goteo') DEFAULT NULL,
  `analisis_suelo` enum('Si','No') DEFAULT NULL,
  `fecha_analisis` date DEFAULT NULL,
  `volumen_cultivo_primario` enum('Se ha mantenido igual','Ha mejorado','Ha disminuido') DEFAULT NULL,
  `concepto_cultivo_primario` text,
  `volumen_cultivo_secundario` varchar(45) DEFAULT NULL,
  `concepto_cultivo_secundario` text,
  `porcentaje_perdidas` int(11) DEFAULT NULL,
  `asistencia_tecnica` enum('UMATA (secretaria de Agricultura Municipal)','Secretaría de Agricultura Departamental','EPSAGRO','Gremios','Universidad','Particular (agrónomo técnico  veterinario  zootecnista o administrador agropecuario)','SENA','ONG') DEFAULT NULL,
  `asistencia_otro` varchar(50) DEFAULT NULL,
  `asistencia_ciclo_produccion` tinyint(1) DEFAULT NULL,
  `asistencia_manejo_cultivo` tinyint(1) DEFAULT NULL,
  `asistencia_comercializacion` tinyint(1) DEFAULT NULL,
  `asistencia_asociatividad` tinyint(1) DEFAULT NULL,
  `asistencia_financiera` tinyint(1) DEFAULT NULL,
  `asistencia_proyecto` tinyint(1) DEFAULT NULL,
  `cuenta_bancaria` tinyint(1) DEFAULT NULL,
  `solicitud_credito` tinyint(1) DEFAULT NULL,
  `entidad_solicitud` varchar(50) DEFAULT NULL,
  `otorgacion_credito` enum('Si','No','No han respondido') DEFAULT NULL,
  `negado_garantias` tinyint(1) DEFAULT NULL,
  `negado_por_historia` tinyint(1) DEFAULT NULL,
  `negado_por_reporte` tinyint(1) DEFAULT NULL,
  `negado_por_capacidad` tinyint(1) DEFAULT NULL,
  `negado_por_documentos` tinyint(1) DEFAULT NULL,
  `precio_cosecha` enum('Empeoró','Mejoró') DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productive_polls_candidates1` (`candidate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `productive_polls`
--

INSERT INTO `productive_polls` (`id`, `dominio_parcela`, `riego`, `analisis_suelo`, `fecha_analisis`, `volumen_cultivo_primario`, `concepto_cultivo_primario`, `volumen_cultivo_secundario`, `concepto_cultivo_secundario`, `porcentaje_perdidas`, `asistencia_tecnica`, `asistencia_otro`, `asistencia_ciclo_produccion`, `asistencia_manejo_cultivo`, `asistencia_comercializacion`, `asistencia_asociatividad`, `asistencia_financiera`, `asistencia_proyecto`, `cuenta_bancaria`, `solicitud_credito`, `entidad_solicitud`, `otorgacion_credito`, `negado_garantias`, `negado_por_historia`, `negado_por_reporte`, `negado_por_capacidad`, `negado_por_documentos`, `precio_cosecha`, `candidate_id`) VALUES
(1, 'Propia', 'Ninguno', '', '2012-09-19', 'Ha mejorado', 'fsdaf', 'Ha mejorado', 'fasdf', 243, 'UMATA (secretaria de Agricultura Municipal)', '423', 0, 1, 1, 1, 0, 0, 1, 1, '423', 'Si', 1, 0, 0, 1, 1, 'Empeoró', 1),
(2, 'Propia', 'Ninguno', '', '0000-00-00', 'Se ha mantenido igual', 'juftt', 'Ha mejorado', 'dgfrty', 55847, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(3, 'Propia', 'Gravedad', '', '0000-00-00', 'Se ha mantenido igual', '54', 'Ha mejorado', '5454', 56, 'Secretaría de Agricultura Departamental', '', 0, 0, 1, 1, 1, 0, 1, 0, 'ojioj ', 'No', 0, 1, 0, 1, 0, 'Empeoró', 4),
(4, 'Propia', 'Gravedad', '', '2000-01-23', 'Se ha mantenido igual', '234234', 'Se ha mantenido igual', '243 sdf sd', 2345, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(5, 'Propia', 'Aspersión', '', '2012-10-02', 'Se ha mantenido igual', 'eeeee yrt yrty rty rty', 'Se ha mantenido igual', 'eeeeeeeee', 423, 'UMATA (secretaria de Agricultura Municipal)', 'yrtyr', 1, 1, 0, 1, 1, 1, 1, 1, 'ytr', 'No', 1, 1, 1, 1, 1, 'Empeoró', 2),
(6, 'Propia', 'Gravedad', 'Si', NULL, 'Se ha mantenido igual', 'fsd', 'Ha mejorado', 'fsdf', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productive_problems`
--

CREATE TABLE IF NOT EXISTS `productive_problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Condiciones del terreno','Problemas Climáticos','Problemas de suelos','Plagas','Enfermedades','Problemas asociados al riego','Calidad de la semilla','Acceso a la tierra','Falta de Recursos Financieros') DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productive_problems_productive_polls1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `productive_problems`
--

INSERT INTO `productive_problems` (`id`, `tipo`, `valor`, `productive_poll_id`) VALUES
(18, 'Falta de Recursos Financieros', 6, 2),
(17, 'Calidad de la semilla', 7, 2),
(16, 'Problemas asociados al riego', 6, 2),
(15, 'Enfermedades', 8, 2),
(14, 'Plagas', 4, 2),
(13, 'Problemas de suelos', 3, 2),
(12, 'Condiciones del terreno', 2, 2),
(11, 'Problemas Climáticos', 5, 2),
(10, 'Problemas Climáticos', 34, 0),
(19, 'Falta de Recursos Financieros', 8, 2),
(20, 'Plagas', 4, 1),
(21, 'Enfermedades', 3, 1),
(22, 'Problemas Climáticos', 1, 1),
(23, 'Problemas Climáticos', 2, 3),
(24, 'Plagas', 3, 3),
(25, 'Problemas Climáticos', 2, 4),
(26, 'Problemas Climáticos', 3, 4),
(27, 'Problemas Climáticos', 1, 1),
(28, 'Condiciones del terreno', 2, 1),
(29, 'Condiciones del terreno', 1, 1),
(30, 'Problemas de suelos', 1, 6),
(31, 'Acceso a la tierra', 4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) DEFAULT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `cedula_catastral` varchar(45) DEFAULT NULL,
  `origen` enum('FNA (Fondo Nacional del Ahorro)','DNE (Dirección Nacional de Estupefacientes)','Baldíos','Acuicultura','Compra Directa') DEFAULT NULL,
  `extension` int(11) DEFAULT NULL,
  `georeferencia1` int(11) DEFAULT NULL,
  `georeferencia2` int(11) DEFAULT NULL,
  `georeferencia3` int(11) DEFAULT NULL,
  `georeferencia4` int(11) DEFAULT NULL,
  `georeferencia5` int(11) DEFAULT NULL,
  `georeferencia6` int(11) DEFAULT NULL,
  `colindante_norte` varchar(90) DEFAULT NULL,
  `colindante_sur` varchar(90) DEFAULT NULL,
  `colindante_occidente` varchar(90) DEFAULT NULL,
  `colindante_oriente` varchar(90) DEFAULT NULL,
  `fam_beneficiaria_campesina` int(11) DEFAULT NULL,
  `fam_beneficiaria_desplazada` int(11) DEFAULT NULL,
  `habitante_beneficiario_campesino` int(11) DEFAULT NULL,
  `habitante_beneficiario_desplazado` int(11) DEFAULT NULL,
  `habitante_no_beneficiario_campesino` int(11) DEFAULT NULL,
  `habitante_no_beneficiario_desplazado` int(11) DEFAULT NULL,
  `organization` enum('SI','NO') DEFAULT NULL,
  `vivienda` enum('SI','NO') DEFAULT NULL,
  `vivienda_numero` enum('De 1 a 10','De 11 a 20','De 21 a 30','De 31 a 40','De 41 a 50','De 51 a 70','De 71 a 100','Más de 100') DEFAULT NULL,
  `agua` enum('Acueducto público','Pila pública','Río, quebrada, manantial, nacimiento','Agua lluvia','Aguatero','Acueducto comunal o veredal','Pozo sin bomba, aljibe o barreno','Pozo con bomba','Carrotanque','Otra, ¿Cuál?') DEFAULT NULL,
  `electricidad` tinyint(1) DEFAULT NULL,
  `gas` tinyint(1) DEFAULT NULL,
  `telefono_fijo` tinyint(1) DEFAULT NULL,
  `ninguno` tinyint(1) DEFAULT NULL,
  `origen_productivo` enum('Agrícola','Pecuaría','Forestal','Acuícola','Otra') DEFAULT NULL,
  `tipo_otro` varchar(45) DEFAULT NULL,
  `lineas_productivas` text,
  `area_explotacion` int(11) DEFAULT NULL,
  `infraestructura` enum('Si','No') DEFAULT NULL,
  `infraestructura_tipo` enum('Beneficiario','Establos','Bodega','Otro') DEFAULT NULL,
  `tipo_otro2` varchar(45) DEFAULT NULL,
  `observacion` text,
  `encuestado` varchar(90) DEFAULT NULL,
  `documento` int(11) DEFAULT NULL,
  `vereda` varchar(60) DEFAULT NULL,
  `corregimiento` varchar(60) DEFAULT NULL,
  `altitud_max` int(11) DEFAULT NULL,
  `altitud_min` int(11) DEFAULT NULL,
  `temperatura_max` int(11) DEFAULT NULL,
  `temperatura_min` int(11) DEFAULT NULL,
  `piso` enum('Cálido','Templado','Frío') DEFAULT NULL,
  `lluvias` enum('Bimodal','Monomodal') DEFAULT NULL,
  `departament_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_properties_departaments1_idx` (`departament_id`),
  KEY `fk_properties_cities1_idx` (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `properties`
--

INSERT INTO `properties` (`id`, `nombre`, `matricula`, `cedula_catastral`, `origen`, `extension`, `georeferencia1`, `georeferencia2`, `georeferencia3`, `georeferencia4`, `georeferencia5`, `georeferencia6`, `colindante_norte`, `colindante_sur`, `colindante_occidente`, `colindante_oriente`, `fam_beneficiaria_campesina`, `fam_beneficiaria_desplazada`, `habitante_beneficiario_campesino`, `habitante_beneficiario_desplazado`, `habitante_no_beneficiario_campesino`, `habitante_no_beneficiario_desplazado`, `organization`, `vivienda`, `vivienda_numero`, `agua`, `electricidad`, `gas`, `telefono_fijo`, `ninguno`, `origen_productivo`, `tipo_otro`, `lineas_productivas`, `area_explotacion`, `infraestructura`, `infraestructura_tipo`, `tipo_otro2`, `observacion`, `encuestado`, `documento`, `vereda`, `corregimiento`, `altitud_max`, `altitud_min`, `temperatura_max`, `temperatura_min`, `piso`, `lluvias`, `departament_id`, `city_id`) VALUES
(1, '423', '42444', '423424', 'Baldíos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '423', 4234, '42342', '4234', NULL, NULL, NULL, NULL, NULL, NULL, 16, 752);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `property_controls`
--

CREATE TABLE IF NOT EXISTS `property_controls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formulario` varchar(45) DEFAULT NULL,
  `nombre_aliado` varchar(60) DEFAULT NULL,
  `numero_visitas` int(11) DEFAULT NULL,
  `nombre_encuestador` varchar(60) DEFAULT NULL,
  `documento_encuestador` varchar(60) DEFAULT NULL,
  `fecha_entrevista` date DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_controls_properties1` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `property_controls`
--

INSERT INTO `property_controls` (`id`, `formulario`, `nombre_aliado`, `numero_visitas`, `nombre_encuestador`, `documento_encuestador`, `fecha_entrevista`, `property_id`) VALUES
(1, '423', 'ee', NULL, 'qwe', NULL, '2015-04-17', 3),
(2, '42342', 'eq', NULL, 'eq', NULL, '2012-10-16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `property_polls`
--

CREATE TABLE IF NOT EXISTS `property_polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliado` varchar(45) DEFAULT NULL,
  `encuestador` varchar(45) DEFAULT NULL,
  `documento` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_polls_properties1_idx` (`property_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `public_services`
--

CREATE TABLE IF NOT EXISTS `public_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('Acueducto','Alcantarillado','Electricidad','Telefonía','Celular','Pozo séptico','Internet','Planta eléctrica') CHARACTER SET latin1 DEFAULT NULL,
  `home_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_public_services_homes1` (`home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `public_services`
--

INSERT INTO `public_services` (`id`, `name`, `home_id`) VALUES
(1, 'Alcantarillado', 0),
(2, 'Acueducto', 0),
(3, 'Alcantarillado', 0),
(4, 'Alcantarillado', 0),
(20, 'Alcantarillado', 5),
(19, 'Alcantarillado', 5),
(8, 'Telefonía', 3),
(9, 'Electricidad', 3),
(10, 'Planta eléctrica', 3),
(18, 'Celular', 5),
(12, 'Acueducto', 1),
(13, 'Alcantarillado', 2),
(14, 'Electricidad', 2),
(15, 'Pozo séptico', 2),
(16, 'Alcantarillado', 2),
(17, 'Internet', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relatives`
--

CREATE TABLE IF NOT EXISTS `relatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(45) DEFAULT NULL,
  `segundo_nombre` varchar(45) DEFAULT NULL,
  `primer_apelllido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `tipo_documento` enum('Sin registro','C.C','T.I','NUI','Registro civil') DEFAULT NULL,
  `numero_identificacion` varchar(45) DEFAULT NULL,
  `genero` enum('','Hombre','Mujer') DEFAULT NULL,
  `estado_civil` enum('Soltero','Casado','Union libre','Viudo','Divorciado') DEFAULT NULL,
  `escolaridad` enum('Ninguna','Primaria','Secunadaria','Técnico','Tecnólogo','Universitario') DEFAULT NULL,
  `seguridad_social` enum('Cotizante regimen contributivo','Beneficiario regimen contributivo','Sisben','Otro','Ninguno') DEFAULT NULL,
  `ocupacion` enum('Agricultor','Ganadero','Comerciante','Artesano','Ama de casa','Estudiante','Desempleado','Pensionado') DEFAULT NULL,
  `nivel_sisben` int(11) DEFAULT NULL,
  `prestadora_salud` varchar(50) DEFAULT NULL,
  `discapacidad` text,
  `fecha_nacimiento` date DEFAULT NULL,
  `parentesco` enum('Jefe de hogar','Esposo(a)/Conpañero(a)','Padre','Madre','Abuelo(a)','Hijo(a)','Hermano(a)','Nieto(a)','Tio(a)','Sobrino(a)','Ahijado(a)','Cuñado(a)','Primo(a)','Otro') DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relatives_candidates1` (`candidate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roads`
--

CREATE TABLE IF NOT EXISTS `roads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Pavimentada','Carreteable','Fluvial','Camino de herradura') DEFAULT NULL,
  `estado` enum('Bueno','Regular','Malo','NS/NR') DEFAULT NULL,
  `distancia` int(11) DEFAULT NULL,
  `descripcion` text,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_roads_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `roads`
--

INSERT INTO `roads` (`id`, `tipo`, `estado`, `distancia`, `descripcion`, `property_id`) VALUES
(2, 'Camino de herradura', 'Bueno', 20, 'Buen clima y paisaje!', 2),
(4, 'Pavimentada', 'Regular', 2, 'Ninguna', 1),
(5, 'Fluvial', 'Malo', 8, 'Mal clima', 3),
(6, 'Camino de herradura', 'NS/NR', 8, 'Dificil de llegar por ubicación', 4),
(7, 'Fluvial', 'Regular', 6, 'La chalupa tiene un costo de $8.000', 5),
(8, 'Carreteable', 'Malo', 6, 'ninguna', 6),
(9, 'Pavimentada', 'Bueno', 80, 'Buen clima, en ocasiones derrumbes', 7),
(10, 'Pavimentada', 'Bueno', 3, 'Ninguna', 8),
(11, 'Camino de herradura', 'Regular', 4, 'Camino de mulas', 9),
(12, 'Pavimentada', 'Bueno', 1, 'Nada', 7),
(13, 'Carreteable', 'Regular', 1, 'nada', 8),
(14, 'Pavimentada', 'NS/NR', 98, 'nada', 7),
(15, 'Camino de herradura', 'Bueno', 1, 'camino soleado', 4),
(16, 'Pavimentada', 'Bueno', 85, 'egrgergrgt', 4),
(17, 'Fluvial', 'NS/NR', 14, 'Mal clima', 3),
(18, 'Fluvial', 'Malo', 8, 'Mal climaXXXYYYYY', 3),
(19, 'Carreteable', 'Malo', 100, '', 4),
(20, 'Pavimentada', 'Bueno', 0, '', 4),
(21, 'Pavimentada', 'Bueno', 2, '', 4),
(22, 'Pavimentada', 'Bueno', 2, 'Buena!', 1),
(23, 'Fluvial', 'Malo', 534, 'dgdfgdf gdf g', 1),
(24, 'Pavimentada', 'Regular', 5, 'jekeidhdufhjeheheshdhwhsehehdeheheh', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabs`
--

CREATE TABLE IF NOT EXISTS `tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `icono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tabs`
--

INSERT INTO `tabs` (`id`, `titulo`, `icono`) VALUES
(1, 'Administrar', NULL),
(2, 'General', ''),
(3, 'Encuesta', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformations`
--

CREATE TABLE IF NOT EXISTS `transformations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Selección y empaque','Secado','Molido o picado','Estandarización de calidad','Pelado','Deshidratación','Elaboración de harinas','Lavado','Limpieza','Encerado') DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transformations_productive_pools1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `transformations`
--

INSERT INTO `transformations` (`id`, `tipo`, `productive_poll_id`) VALUES
(1, NULL, 0),
(2, 'Selección y empaque', 0),
(3, 'Secado', 2),
(4, 'Limpieza', 2),
(5, 'Secado', 2),
(6, 'Molido o picado', 4),
(7, 'Secado', 1),
(8, 'Deshidratación', 1),
(9, 'Selección y empaque', 1),
(10, 'Selección y empaque', 1),
(11, 'Selección y empaque', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nombre` varchar(35) DEFAULT NULL,
  `primer_apellido` varchar(25) DEFAULT NULL,
  `segundo_apellido` varchar(25) DEFAULT NULL,
  `created` varchar(25) DEFAULT NULL,
  `modified` varchar(25) DEFAULT NULL,
  `activo` int(11) NOT NULL,
  `cedula` varchar(25) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_users` (`username`,`password`),
  KEY `idx_username` (`username`),
  KEY `fk_users_groups` (`group_id`),
  KEY `fk_users_branches1` (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nombre`, `primer_apellido`, `segundo_apellido`, `created`, `modified`, `activo`, `cedula`, `telefono`, `group_id`, `branch_id`) VALUES
(1, 'wilavel', 'cac3cbd677ad114e69751652e86f1c4d5e1ff0ae', 'wilavel@hotmail.com', 'Wilson Javier', 'Avelino', 'Bravo', NULL, '1347157442', 0, '80252564', '3107801648', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `water_resources`
--

CREATE TABLE IF NOT EXISTS `water_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recurso_tipo` enum('Río','Quebrada','Caño','Laguna','Lago Artificial','Jagüey','Nacimiento','Aljibe','Riego Area Regable','Aljibe','¿Otros?') DEFAULT NULL,
  `tipo_otro` varchar(45) DEFAULT NULL,
  `recurso_cantidad` int(11) DEFAULT NULL,
  `recurso_nombre` varchar(45) DEFAULT NULL,
  `uso_agua_domestico` tinyint(4) DEFAULT NULL,
  `uso_agua_agricultura` tinyint(4) DEFAULT NULL,
  `uso_agua_ganaderia` tinyint(4) DEFAULT NULL,
  `uso_agua_piscicultura` tinyint(4) DEFAULT NULL,
  `disponibilidad` enum('Temporal','Permanente') DEFAULT NULL,
  `estado` enum('Bueno','Regular','Malo') DEFAULT NULL,
  `suficiencia` enum('Si','No') DEFAULT NULL,
  `suficiencia_razon` text,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_water_resources_properties1_idx` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `water_resources`
--

INSERT INTO `water_resources` (`id`, `recurso_tipo`, `tipo_otro`, `recurso_cantidad`, `recurso_nombre`, `uso_agua_domestico`, `uso_agua_agricultura`, `uso_agua_ganaderia`, `uso_agua_piscicultura`, `disponibilidad`, `estado`, `suficiencia`, `suficiencia_razon`, `property_id`) VALUES
(1, 'Nacimiento', '', 1, 'InceptionXXX', 0, 0, 0, 0, 'Permanente', 'Bueno', 'Si', 'Sueño tras sueño', 0),
(2, 'Río', '', 1, 'AmazonitasXXX', 0, 0, 0, 0, 'Permanente', 'Bueno', 'Si', '', 0),
(3, 'Río', '', 1, 'NilitoXXX', 0, 0, 0, 0, 'Permanente', 'Malo', 'No', 'Aridez', 0),
(4, 'Río', '', NULL, 'MagadalenaXXX', 0, 0, 0, 0, 'Permanente', 'Bueno', 'Si', '', 0),
(5, 'Río', '', NULL, 'caucaXXX', 0, 0, 0, 0, 'Permanente', 'Bueno', 'Si', '', 0),
(6, 'Laguna', '', 2, 'carXXX', 0, 0, 0, 0, 'Permanente', 'Regular', 'Si', '', 0),
(7, 'Caño', '', 1, 'care', 0, 0, 0, 0, 'Permanente', 'Bueno', 'Si', '', 1),
(8, 'Río', '', NULL, 'tota', 0, 0, 0, 0, 'Permanente', 'Regular', 'Si', '', 2),
(9, 'Río', '', NULL, 'yyyyy', 0, 0, 0, 0, 'Permanente', 'Bueno', 'Si', '', 1),
(10, 'Riego Area Regable', '', 1, 'TOYIMA', 0, 0, 0, 0, 'Permanente', 'Bueno', 'No', 'NADA', 1),
(11, 'Nacimiento', '', NULL, '', 0, 0, 0, 0, 'Temporal', 'Malo', 'No', 'as', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `water_sources`
--

CREATE TABLE IF NOT EXISTS `water_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Acueducto público','Pila pública','Río, quebrada, manantial, nacimiento','Agua lluvia','Aguatero','Acueducto comunal o veredal','Carrotanque','Pozo sin bomba, aljibe o barreno','Pozo con bomba') CHARACTER SET latin1 DEFAULT NULL,
  `home_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_water_sources_homes1` (`home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `water_sources`
--

INSERT INTO `water_sources` (`id`, `tipo`, `home_id`) VALUES
(1, 'Acueducto público', 3),
(2, 'Acueducto comunal o veredal', 3),
(3, 'Pozo con bomba', 3),
(4, 'Aguatero', 3),
(5, 'Pozo sin bomba, aljibe o barreno', 3),
(6, 'Agua lluvia', 3),
(7, 'Acueducto comunal o veredal', 3),
(14, 'Acueducto comunal o veredal', 5),
(13, 'Río, quebrada, manantial, nacimiento', 5),
(11, 'Acueducto público', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wrappers`
--

CREATE TABLE IF NOT EXISTS `wrappers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Canastilla','Costal','Guacal','Bolsa','Granel','Otro') DEFAULT NULL,
  `productive_poll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wrappers_productive_polls1` (`productive_poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `wrappers`
--

INSERT INTO `wrappers` (`id`, `tipo`, `productive_poll_id`) VALUES
(1, 'Guacal', 4),
(2, 'Canastilla', 3),
(3, 'Bolsa', 3),
(4, 'Canastilla', 1),
(5, 'Canastilla', 1),
(6, 'Costal', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
