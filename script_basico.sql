-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2013 at 06:01 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `surco`
--
CREATE DATABASE `surco` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `surco`;

-- --------------------------------------------------------

--
-- Table structure for table `concursante`
--

CREATE TABLE IF NOT EXISTS `concursante` (
  `ci` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `lastname` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `school` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `grade` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `transportation` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ci`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `concursante`
--

INSERT INTO `concursante` (`ci`, `name`, `lastname`, `age`, `phone`, `email`, `state`, `school`, `grade`, `transportation`) VALUES
(12345678, 'name', 'lastname', 9, '654654654', 'example@example.com', 'state', 'school', 'grade', 'transportation'),
(39678133, 'Rodrigo', 'Santellan', 12, '26134135', 'rsantellan@gmail.com', 'Montevideo', 'experimental', '4', 'tren'),
(98765432, 'name', 'lastname', 10, '2131231', 'example@example.com', 'state', 'school', 'grade', 'transportation');

-- --------------------------------------------------------

--
-- Table structure for table `opcion`
--

CREATE TABLE IF NOT EXISTS `opcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `correcto` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pregunta_id` (`pregunta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `opcion`
--

INSERT INTO `opcion` (`id`, `pregunta_id`, `texto`, `correcto`) VALUES
(1, 1, 'Si', 1),
(2, 1, 'Dos de ellas son la 18113 y  la 18191', 1),
(3, 1, 'Otra es la ley 19061', 1),
(4, 1, 'No existe ninguna ley nacional de tránsito.', 0),
(5, 2, 'Si', 1),
(6, 2, 'No habla de eso', 0),
(7, 2, 'Sí y sólo aplica para Montevideo', 0),
(8, 2, 'Sí y sólo aplica para el interior del país.', 0),
(9, 3, 'Tiene que usarlo el conductor', 1),
(10, 3, 'Si viaja un acompañante tiene usarlo  también', 1),
(11, 3, 'Tienen que usarlo conductor y acompañante siempre', 1),
(12, 3, 'Esta medida es porque favorece la visibilidad a distancia del conductor y su acompañante', 1),
(13, 4, 'Colocar material  reflectante en el elemento sobre el objeto', 1),
(14, 4, 'Pegar un adhesivo de tu grupo musical favorito', 0),
(15, 4, 'Agregarle un cordón rojo', 0),
(16, 4, 'Pintar de azul el elemento', 0),
(17, 5, 'Un gorro de lana', 0),
(18, 5, 'Un sombrero', 0),
(19, 5, 'Un casco protector de seguridad que cumpla con la normativa.', 1),
(20, 5, 'Un pañuelo celeste', 0),
(21, 6, 'el acompañante (niño o adolescente) alcance los posapies del vehículo', 1),
(22, 6, 'el acompañante (niño o adolescente) vaya sentado de costado', 0),
(23, 6, 'el acompañante (niño o adolescente) viaje con mochila', 0),
(24, 6, 'no es necesario tomar en cuenta si llega a los posapies del vehículo', 0),
(25, 7, 'Sistema de freno delantero y trasero', 1),
(26, 7, 'Espejos retrovisores, más timbre o bocina', 1),
(27, 7, 'Sistema lumínico delantero (luz blanca  y un reflectante de igual color) y  sistema lumínico trasero (luz roja y un reflectante de igual color)', 1),
(28, 7, 'El equipamiento es obligatorio tanto para vehículos de paseo como  de trabajo', 1),
(29, 8, '2', 1),
(30, 8, '3', 0),
(31, 8, '4', 0),
(32, 8, 'Todas las que soporte el vehículo', 0),
(33, 9, 'Dos reflectantes en cada una de sus ruedas', 1),
(34, 9, 'Dos bandas reflectantes en ambos frentes de cada pedal', 1),
(35, 9, 'Un asiento con música', 0),
(36, 9, 'Una calcomanía violeta', 0),
(37, 10, 'Están exentas de contar con el equipamiento de seguridad sólo cuando se encuentren participando en entrenamiento o en competencia', 1),
(38, 10, 'No están exentas del equipamiento de seguridad', 0),
(39, 10, 'Necesitan estar pintadas de verde', 0),
(40, 10, 'Es importante que sean de una marca determinada', 0),
(41, 11, 'Un equipo de lluvia', 0),
(42, 11, 'Una tarjeta personal', 0),
(43, 11, 'Un casco de plástico', 0),
(44, 11, 'Un casco protector certificado (como mínimo) y estar el vehiculo además con su empadronamiento respectivo (tener placas de matricula)', 1),
(45, 12, 'Hablar o cantar', 1),
(46, 12, 'Hablar por celular y enviar mensajes', 0),
(47, 12, 'Tomar mate', 0),
(48, 12, 'Llevar una botella de refresco en la mano', 0),
(49, 13, 'Obligatorias y su incumplimiento deriva en sanciones', 1),
(50, 13, 'De alcance nacional', 1),
(51, 13, 'De alcance parcial, sólo para la capital del país', 0),
(52, 13, 'Son sugerencias y se puede optar en seguirlas o no', 0),
(53, 14, 'Tener la edad correspondiente', 1),
(54, 14, 'Realizar el exámen teórico y práctico correspondiente ', 1),
(55, 14, 'Obtener la habilitación (licencia de conducir)', 1),
(56, 14, 'Nada. Se puede circular sin hacer o gestionar trámite alguno', 0),
(57, 15, 'El estado general de su vehículo previo a usarlo', 1),
(58, 15, 'Si tiene algún elemento de seguridad dañado y en tal caso lo reemplace antes de volver a circular', 1),
(59, 15, 'Estar al tanto de las nuevas disposiciones de tránsito y seguridad vial que se instrumentan para protegerlo a él y al resto de la población', 1),
(60, 15, 'No necesita revisar nada en su vehículo, ni tampoco preocuparse por mantenerse informarse de la normativa vigente', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`id`, `nro`, `pregunta`) VALUES
(1, 1, '1) ¿Existe para todo el Uruguay una ley de tránsito y seguridad vial?'),
(2, 2, '2) La ley 19061 indica entre otros puntos, cuales  dispositivos y elementos de  seguridad necesitan tener presente los motociclistas y ciclistas de nuestro país.'),
(3, 3, '3) Se establece que quienes circulen en motos, ciclomotores, motocicletas, cuadriciclos y similares deberán usar durante su circulación chaleco o campera reflectiva o bandas reflectivas. Esto refiere a que...'),
(4, 4, '4) Si el vehículo (moto, ciclomotor o similar) tiene algún elemento adicional fijo o semi fijo (espejo, valijas, mochila u otros) que pueda impedir visualizar adecuadamente al chofer o acompañante desde atrás, lo recomendable será...'),
(5, 5, '5) A partir de la normativa vigente, todas las personas (adultos y menores) que se trasladan en bicicletas, requerirán usar como elemento de protección'),
(6, 6, '6) Si un conductor de moto, ciclomotor o similar transporta como acompañante a un niño o adolescente, además de tener presente los elementos de seguridad necesarios, es imprescindible que...'),
(7, 7, '7) Para poder circular, todas las bicicletas, motos, ciclomotores, motocicletas, cuadriciclos y similares (de cualquier tipo) deberán contar con un equipamiento obligatorio de seguridad que comprende:'),
(8, 8, '8) En una motocicleta, el máximo total de personas que pueden viajar es :'),
(9, 9, '9) A partir de la nueva reglamentación todas las bicicletas que se vendan deberán contar con equipamiento de seguridad y además...'),
(10, 10, '10) Las  bicicletas, exclusivamente destinadas a competencias deportivas'),
(11, 11, '11)  La venta de motos, ciclomotores o similares "cero kilómetro", a partir de la reglamentación vigente, debe ser acompañada de...'),
(12, 12, '12) Cuando se está conduciendo una moto, bicicleta o similar está permitido...'),
(13, 13, '13) Las disposiciones de las leyes de tránsito son:'),
(14, 14, '14) Para poder circular en una moto, motocicleta o similar se requiere:'),
(15, 15, '15) Es necesario que el conductor de una bicicleta, moto, motocicleta o similar verifique con frecuencia:');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opcion`
--
ALTER TABLE `opcion`
  ADD CONSTRAINT `opcion_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
