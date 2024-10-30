-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 17-08-2012 a las 00:43:05
-- Versión del servidor: 5.0.21
-- Versión de PHP: 5.1.4
-- 
-- Base de datos: `infousuarios`
-- 

-- --------------------------------------------------------

--

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` (
    `idusuario` BIGINT (20) NOT NULL AUTO_INCREMENT,
    `usnombre` VARCHAR(50) character set utf8 collate utf8_unicode_ci NOT NULL,
    `uspass` INT(11) NOT NULL,
    `usmail` VARCHAR(50) character set utf8 collate utf8_unicode_ci NOT NULL,
    `usdeshabilitado` TIMESTAMP NULL,
    PRIMARY KEY (`idusuario`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Estructura de tabla para la tabla `rol`
-- 
CREATE TABLE  `rol`(
    `idrol` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `rodescripcion` VARCHAR(50) character set utf8 collate utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`idrol`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Estructura de tabla para la tabla `usuariorol`
-- 
CREATE TABLE `usuariorol`(
    `idusuario` BIGINT (20) NOT NULL,
    `idrol` BIGINT (20) NOT NULL,
    PRIMARY KEY (`idusuario`,`idrol`),
    FOREIGN KEY (`idusuario`) REFERENCES `usuario`(`idusuario`),
    FOREIGN KEY (`idrol`) REFERENCES `rol`(`idrol`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;