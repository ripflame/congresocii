# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18)
# Database: congreso
# Generation Time: 2017-05-04 16:04:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table folio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `folio`;

CREATE TABLE `folio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(15) NOT NULL DEFAULT '',
  `registrado` int(1) NOT NULL DEFAULT '0',
  `natware` int(1) NOT NULL DEFAULT '0',
  `pulsera` int(11) DEFAULT NULL,
  `kit` int(1) NOT NULL DEFAULT '0',
  `registro_evento` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table participante
# ------------------------------------------------------------

DROP TABLE IF EXISTS `participante`;

CREATE TABLE `participante` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `ap_paterno` varchar(50) NOT NULL DEFAULT '',
  `ap_materno` varchar(50) NOT NULL DEFAULT '',
  `nacimiento` date NOT NULL,
  `sexo` int(1) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `escuela` varchar(50) NOT NULL DEFAULT '',
  `carrera` varchar(50) NOT NULL DEFAULT '',
  `semestre` varchar(50) NOT NULL DEFAULT '',
  `folio_id` int(11) unsigned NOT NULL,
  `taller_id` int(11) unsigned DEFAULT NULL,
  `visita_id` int(11) unsigned DEFAULT NULL,
  `concurso_pitch` int(1) NOT NULL DEFAULT '0',
  `titulo_pitch` varchar(50) DEFAULT NULL,
  `qep_id` int(11) unsigned DEFAULT NULL,
  `celular` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `participante_taller` (`taller_id`),
  KEY `participante_visita` (`visita_id`),
  KEY `participante_folio` (`folio_id`),
  KEY `qep_id` (`qep_id`),
  CONSTRAINT `participante_folio` FOREIGN KEY (`folio_id`) REFERENCES `folio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`qep_id`) REFERENCES `qep` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `participante_taller` FOREIGN KEY (`taller_id`) REFERENCES `taller` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `participante_visita` FOREIGN KEY (`visita_id`) REFERENCES `visita` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table qep
# ------------------------------------------------------------

DROP TABLE IF EXISTS `qep`;

CREATE TABLE `qep` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `cupo_disponible` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(250) DEFAULT NULL,
  `inscritos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table taller
# ------------------------------------------------------------

DROP TABLE IF EXISTS `taller`;

CREATE TABLE `taller` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `tallerista` varchar(50) NOT NULL DEFAULT '',
  `duracion` time DEFAULT NULL,
  `inscritos` int(2) NOT NULL DEFAULT '0',
  `cupo_disponible` int(2) NOT NULL DEFAULT '0',
  `descripcion` varchar(1023) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table visita
# ------------------------------------------------------------

DROP TABLE IF EXISTS `visita`;

CREATE TABLE `visita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `empresa` varchar(100) NOT NULL DEFAULT '',
  `hora_inicio` time DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `inscritos` int(2) NOT NULL DEFAULT '0',
  `cupo_disponible` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
