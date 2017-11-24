-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

DROP TABLE IF EXISTS `evento`;
CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  `local` varchar(64) COLLATE utf8_bin NOT NULL,
  `disponivelParaAlunos` tinyint(1) NOT NULL,
  `disponivelParaExterno` tinyint(1) NOT NULL,
  `palestrante` int(11) NOT NULL,
  `descricao` varchar(256) COLLATE utf8_bin NOT NULL,
  `limiteUsuarios` int(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `palestrante` (`palestrante`),
  CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`palestrante`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `evento_usuario`;
CREATE TABLE `evento_usuario` (
  `evento` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  KEY `evento` (`evento`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `evento_usuario_ibfk_1` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`),
  CONSTRAINT `evento_usuario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `email` varchar(64) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(32) COLLATE utf8_bin NOT NULL,
  `password` varchar(512) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(64) COLLATE utf8_bin NOT NULL,
  `estado` varchar(64) COLLATE utf8_bin NOT NULL,
  `tipoInstituicao` varchar(32) COLLATE utf8_bin NOT NULL,
  `nomeInstituicao` varchar(32) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- 2017-11-24 14:56:23