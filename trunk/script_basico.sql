-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2013 at 12:15 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET FOREIGN_KEY_CHECKS=0;
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

DROP TABLE IF EXISTS `concursante`;
CREATE TABLE IF NOT EXISTS `concursante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `escuela` varchar(255) NOT NULL,
  `cursa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `transporte` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `opcion`
--

DROP TABLE IF EXISTS `opcion`;
CREATE TABLE IF NOT EXISTS `opcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pregunta_id` (`pregunta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `opcion`
--

INSERT INTO `opcion` (`id`, `pregunta_id`, `texto`) VALUES
(1, 1, 'Peñarol'),
(2, 1, 'Nacional'),
(3, 1, 'Defensor'),
(4, 2, 'Argentina'),
(5, 2, 'Uruguay'),
(6, 2, 'Brasil'),
(7, 2, 'Japon'),
(8, 2, 'Alemania');

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) NOT NULL,
  `respuesta` int(11) DEFAULT NULL,
  `mensajeok` varchar(255) NOT NULL,
  `mensajeerror` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `respuesta` (`respuesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`id`, `pregunta`, `respuesta`, `mensajeok`, `mensajeerror`) VALUES
(1, '¿Quien salio campeon de futbol uruguayo?', 1, 'Sigue como vas!!', 'Mmmm sigue mejorando!'),
(2, '¿Quien gano el mundial de 1930?', 5, 'En serio?? Wow!!', 'Tu puede ir mejorando!!');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opcion`
--
ALTER TABLE `opcion`
  ADD CONSTRAINT `opcion_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`);

--
-- Constraints for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`respuesta`) REFERENCES `opcion` (`id`);
SET FOREIGN_KEY_CHECKS=1;

