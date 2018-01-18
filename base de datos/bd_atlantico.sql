-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2017 a las 23:40:56
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_atlantico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbordado`
--

CREATE TABLE IF NOT EXISTS `tbordado` (
  `cod_bor` int(7) NOT NULL AUTO_INCREMENT,
  `pre_bor` float(8,2) NOT NULL,
  `fec_mod` date NOT NULL,
  PRIMARY KEY (`cod_bor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbordado`
--

INSERT INTO `tbordado` (`cod_bor`, `pre_bor`, `fec_mod`) VALUES
(1, 5000.00, '2017-09-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcliente`
--

CREATE TABLE IF NOT EXISTS `tcliente` (
  `cod_cli` int(8) NOT NULL AUTO_INCREMENT,
  `rif_cli` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `nom_cli` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `tlfn_cli` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dir_cli` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `pers_cli` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `correo_cli` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `zona_fk` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `municipio_fk` char(2) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_cli`),
  KEY `fk_zona` (`zona_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tcliente`
--

INSERT INTO `tcliente` (`cod_cli`, `rif_cli`, `nom_cli`, `tlfn_cli`, `dir_cli`, `pers_cli`, `correo_cli`, `zona_fk`, `municipio_fk`) VALUES
(1, 'J-30407659-2', 'ASOCIACION DE PRODUCTORES AGRICOLAS INDEPENDIENTES', '04245943762 ', 'CARRETERA B PARCELA N° 25 U.A.T TUREN PORTUGUESA', 'KATIUSKA VILLARROEL PANDO', 'KATIUSKA.VILLARROEL@GRUPO-PAI.COM ', '18', '15'),
(2, 'J-29880422-0', 'MECANOIDEA', '04145576334', 'KM 7 VIA CAMBURITO', 'CARMEN ACEVEDO', 'CWACEVEDO@GMAIL.COM', '18', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcompra`
--

CREATE TABLE IF NOT EXISTS `tcompra` (
  `nro_com` int(7) NOT NULL,
  `fec_com` date NOT NULL,
  `iva_pro` decimal(5,2) NOT NULL,
  `con_pag` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `pla_pag` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dto_com` decimal(5,2) DEFAULT NULL,
  `fec_anula` date DEFAULT NULL,
  `usu_anula` int(4) DEFAULT NULL,
  `proveedor_fk` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_fk` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `total_compra` decimal(7,2) NOT NULL,
  `sub_compra` decimal(7,2) NOT NULL,
  PRIMARY KEY (`nro_com`),
  KEY `fk_prov` (`proveedor_fk`),
  KEY `fk_nro_usua_idx` (`usuario_fk`),
  KEY `fk_condi` (`con_pag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcuello`
--

CREATE TABLE IF NOT EXISTS `tcuello` (
  `cod_cuello` int(7) NOT NULL AUTO_INCREMENT,
  `precio` float(8,2) NOT NULL,
  `fecha_mod` date NOT NULL,
  PRIMARY KEY (`cod_cuello`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tcuello`
--

INSERT INTO `tcuello` (`cod_cuello`, `precio`, `fecha_mod`) VALUES
(1, 11000.00, '2017-09-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdetallecompra`
--

CREATE TABLE IF NOT EXISTS `tdetallecompra` (
  `id_detallecompra` int(11) NOT NULL AUTO_INCREMENT,
  `pre_uni` decimal(7,2) NOT NULL,
  `can_pro` int(11) NOT NULL,
  `cod_pro` int(11) NOT NULL,
  `nro_com` int(7) NOT NULL,
  `tot_pro` decimal(7,2) NOT NULL,
  `nom_produ` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cod_pro_prove` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_detallecompra`),
  KEY `fk_producto` (`cod_pro`),
  KEY `fk_compra` (`nro_com`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdetallefactura`
--

CREATE TABLE IF NOT EXISTS `tdetallefactura` (
  `id_detallefactura` int(11) NOT NULL AUTO_INCREMENT,
  `can_ven_pro` int(11) NOT NULL,
  `pre_ven_pro` decimal(8,2) NOT NULL,
  `producto` int(11) NOT NULL,
  `pesob_pro` decimal(8,3) NOT NULL,
  `peson_pro` decimal(8,3) NOT NULL,
  `factura` int(7) NOT NULL,
  `tot_pro` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id_detallefactura`),
  KEY `fk_pro` (`producto`),
  KEY `fk_fac` (`factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdetallepresupuesto`
--

CREATE TABLE IF NOT EXISTS `tdetallepresupuesto` (
  `presupuesto` int(11) NOT NULL,
  `cod_det_pre` int(12) NOT NULL AUTO_INCREMENT,
  `cod_pro` int(11) NOT NULL,
  `can_pro` int(4) NOT NULL,
  `bordados` int(1) DEFAULT NULL,
  `pre_bor` int(5) NOT NULL,
  `cos_iva` decimal(10,2) NOT NULL,
  `cos_sin_iva` decimal(10,2) NOT NULL,
  `cos_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_det_pre`),
  KEY `cod_pro` (`cod_pro`),
  KEY `presupuesto` (`presupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tdetallepresupuesto`
--

INSERT INTO `tdetallepresupuesto` (`presupuesto`, `cod_det_pre`, `cod_pro`, `can_pro`, `bordados`, `pre_bor`, `cos_iva`, `cos_sin_iva`, `cos_total`) VALUES
(1, 1, 1, 10, 0, 0, '0.00', '94213.00', '942130.00'),
(1, 2, 1, 20, 0, 0, '0.00', '94213.00', '1884260.00'),
(2, 5, 1, 10, 0, 0, '0.00', '94213.00', '942130.00'),
(2, 6, 1, 15, 0, 0, '0.00', '94213.00', '1413195.00'),
(3, 8, 1, 5, 0, 0, '0.00', '94213.00', '471065.00'),
(4, 9, 1, 100, 0, 0, '0.00', '94213.00', '9421300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfactura`
--

CREATE TABLE IF NOT EXISTS `tfactura` (
  `nro_fac` int(7) NOT NULL,
  `fec_fac` date NOT NULL,
  `fec_ven` date NOT NULL,
  `tip_com` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `est_fac` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fec_anu` datetime DEFAULT NULL,
  `usu_anu` char(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente_fk` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_fk` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `tot_fac` decimal(7,2) NOT NULL,
  PRIMARY KEY (`nro_fac`),
  KEY `fk_cli` (`cliente_fk`),
  KEY `fk_vende_idx` (`usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmodelo`
--

CREATE TABLE IF NOT EXISTS `tmodelo` (
  `cod_mod` int(3) NOT NULL AUTO_INCREMENT,
  `nom_mod` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cod_pro` int(11) DEFAULT NULL,
  `cos_mod` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`cod_mod`),
  KEY `cod_pro` (`cod_pro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tmodelo`
--

INSERT INTO `tmodelo` (`cod_mod`, `nom_mod`, `cod_pro`, `cos_mod`) VALUES
(1, 'NO APLICA', NULL, NULL),
(2, 'COLUMBIA', NULL, '2500.00'),
(3, 'CANESU', NULL, '1500.00'),
(4, 'CLASICA', NULL, '0.00'),
(5, 'CUELLO MAO', NULL, '0.00'),
(6, 'CUELLO DE TELA', NULL, '0.00'),
(7, 'GRANDE', NULL, '2000.00'),
(8, 'MEDIANO', NULL, '1500.00'),
(9, 'PEQUEÑO', NULL, '1000.00'),
(10, 'CUELLO V', NULL, '0.00'),
(11, 'CUELLO REDONDO', NULL, '0.00'),
(12, 'TRES COSTURAS', NULL, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmunicipio`
--

CREATE TABLE IF NOT EXISTS `tmunicipio` (
  `cod_muni` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `zona_fk` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `des_muni` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_muni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tmunicipio`
--

INSERT INTO `tmunicipio` (`cod_muni`, `zona_fk`, `des_muni`) VALUES
('1', '18', 'Agua Blanca   '),
('10', '18', 'San Génaro de Boconoito   '),
('11', '18', 'San Isidro Labrador   '),
('12', '18', 'San Rafael de Onoto   '),
('13', '18', 'Santa Rosalía    '),
('14', '18', 'Sucre   '),
('15', '18', 'Turén'),
('2', '18', 'Araure'),
('3', '18', 'Esteller   '),
('4', '18', 'Guanare'),
('5', '18', 'Ospino'),
('6', '18', 'Páez     '),
('7', '18', 'Guanarito'),
('8', '18', 'Monseñor José Vicente de Unda   '),
('9', '18', 'Papelón      ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprecio_color`
--

CREATE TABLE IF NOT EXISTS `tprecio_color` (
  `cod_pre_col` int(2) NOT NULL AUTO_INCREMENT,
  `nom_pre_col` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_tela` int(2) NOT NULL,
  `pre_col` float(8,2) NOT NULL,
  PRIMARY KEY (`cod_pre_col`),
  KEY `tipo_tela` (`tipo_tela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tprecio_color`
--

INSERT INTO `tprecio_color` (`cod_pre_col`, `nom_pre_col`, `tipo_tela`, `pre_col`) VALUES
(1, 'ESPECIAL', 7, 248400.00),
(2, 'ESPECIAL', 6, 286200.00),
(3, 'AZUL REY', 7, 288900.00),
(4, 'AZUL REY', 6, 305100.00),
(5, 'BLANCO', 7, 189000.00),
(6, 'BLANCO', 6, 206550.00),
(7, 'PASTEL', 7, 205200.00),
(8, 'PASTEL', 6, 240300.00),
(9, 'OSCURO', 6, 253800.00),
(10, 'OSCURO', 7, 232200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpresupuesto`
--

CREATE TABLE IF NOT EXISTS `tpresupuesto` (
  `cod_presu` int(11) NOT NULL,
  `cli_presu` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `fec_presu` date NOT NULL,
  `ven_presu` date NOT NULL,
  `fec_ent` date DEFAULT NULL,
  `fec_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ela_presu` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_pago` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abo_pre` decimal(10,2) DEFAULT NULL,
  `res_pre` decimal(10,2) DEFAULT NULL,
  `sub_total_presu` decimal(10,2) NOT NULL,
  `val_iva` int(2) NOT NULL,
  `monto_iva_presu` decimal(10,2) NOT NULL,
  `tot_presu` decimal(10,2) NOT NULL,
  `est_pre` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fec_anu` date DEFAULT NULL,
  `usu_anu` char(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod_presu`),
  KEY `cli_presu` (`cli_presu`,`ela_presu`),
  KEY `cli_presu_2` (`cli_presu`),
  KEY `ela_presu` (`ela_presu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tpresupuesto`
--

INSERT INTO `tpresupuesto` (`cod_presu`, `cli_presu`, `fec_presu`, `ven_presu`, `fec_ent`, `fec_mod`, `ela_presu`, `tipo_pago`, `abo_pre`, `res_pre`, `sub_total_presu`, `val_iva`, `monto_iva_presu`, `tot_presu`, `est_pre`, `fec_anu`, `usu_anu`) VALUES
(1, 'J-30407659-2', '2017-10-09', '2017-10-11', '2017-11-09', '2017-10-09 20:10:12', '10729713', '0', '0.00', '0.00', '2826390.00', 12, '339166.80', '3165556.80', '1', NULL, NULL),
(2, 'J-29880422-0', '2017-10-09', '2017-10-11', '2017-11-09', '2017-10-09 20:18:59', '10729713', '0', '0.00', '0.00', '2355325.00', 12, '282639.00', '2637964.00', '1', NULL, NULL),
(3, 'J-30407659-2', '2017-10-09', '2017-10-11', '2017-11-09', '2017-10-09 20:22:00', '10729713', '0', '0.00', '0.00', '471065.00', 12, '56527.80', '527592.80', '1', NULL, NULL),
(4, 'J-29880422-0', '2017-10-10', '2017-10-12', '2017-11-10', '2017-10-10 16:47:19', '10729713', '0', '0.00', '0.00', '9421300.00', 12, '1130556.00', '10551856.00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproducto`
--

CREATE TABLE IF NOT EXISTS `tproducto` (
  `cod_pro` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pro` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tela` int(7) DEFAULT NULL,
  `modelo` int(3) DEFAULT NULL,
  `tip_pro` int(3) DEFAULT NULL,
  `precio` int(7) DEFAULT NULL,
  `talla` int(2) DEFAULT NULL,
  `manga` int(1) DEFAULT NULL,
  PRIMARY KEY (`cod_pro`),
  KEY `tela` (`tela`),
  KEY `modelo` (`modelo`),
  KEY `tip_pro` (`tip_pro`),
  KEY `color` (`precio`),
  KEY `talla` (`talla`),
  KEY `manga` (`manga`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tproducto`
--

INSERT INTO `tproducto` (`cod_pro`, `nom_pro`, `tela`, `modelo`, `tip_pro`, `precio`, `talla`, `manga`) VALUES
(1, 'CHEMIS CLASICA DE CABALLERO EN PIQUE AZUL REY', 6, 4, 2, 1, 0, 0),
(2, 'CHEMIS CLASICA EN PIQUE BLANCO', 6, 4, 2, 2, 0, 1),
(3, 'FRANELA CUELLO V EN JERSEY BLANCO T2 M/C', 7, 10, 6, 3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproveedor`
--

CREATE TABLE IF NOT EXISTS `tproveedor` (
  `cod_prov` int(5) NOT NULL,
  `rif_prov` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `nom_prov` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `tlfn_prov` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dir_prov` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `correo_prov` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pers_prov` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `est_prov` char(1) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tproveedor`
--

INSERT INTO `tproveedor` (`cod_prov`, `rif_prov`, `nom_prov`, `tlfn_prov`, `dir_prov`, `correo_prov`, `pers_prov`, `est_prov`) VALUES
(0, 'V-08105867-5', 'Creaciones y Bordados Oquendo', '0255-6652561', 'Urb. 12 de Octubre calle 8, casa N°1', 'aoquendo81@gmail.com', 'Alberto Oquendo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttalla`
--

CREATE TABLE IF NOT EXISTS `ttalla` (
  `cod_talla` int(2) NOT NULL AUTO_INCREMENT,
  `nom_talla` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `juvenil` int(1) NOT NULL,
  PRIMARY KEY (`cod_talla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `ttalla`
--

INSERT INTO `ttalla` (`cod_talla`, `nom_talla`, `juvenil`) VALUES
(0, 'Seleccione', 0),
(2, '1', 1),
(3, '2', 1),
(4, '4', 1),
(5, '6', 1),
(6, '8', 1),
(7, '10', 1),
(8, '12', 1),
(9, '14', 1),
(10, '16', 1),
(11, '18', 1),
(12, 'S', 2),
(13, 'M', 2),
(14, 'L', 2),
(15, 'XL', 2),
(16, '2XL', 2),
(17, '3XL', 2),
(18, '4XL', 2),
(19, 'S', 3),
(20, 'M', 3),
(21, 'L', 3),
(22, 'XL', 3),
(23, '2XL', 3),
(24, '3XL', 3),
(25, '4XL', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttela`
--

CREATE TABLE IF NOT EXISTS `ttela` (
  `cod_tela` int(7) NOT NULL AUTO_INCREMENT,
  `nom_tela` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `can_tela` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_tela` int(2) NOT NULL,
  `pre_tela` int(2) DEFAULT NULL,
  PRIMARY KEY (`cod_tela`),
  KEY `tipo_tela` (`tipo_tela`),
  KEY `pre_tel` (`pre_tela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `ttela`
--

INSERT INTO `ttela` (`cod_tela`, `nom_tela`, `can_tela`, `tipo_tela`, `pre_tela`) VALUES
(1, ' AZUL REY', '2 kg', 6, 4),
(2, ' BLANCO', '5kg', 6, 6),
(3, ' BLANCO', '10kg', 7, 5),
(4, ' NEGRO', '0kg', 7, 10),
(5, ' NEGRO', '0kg', 6, 9),
(6, ' MARINO', '0kg', 7, 10),
(7, ' MARINO', '0kg', 6, 9),
(8, ' GRIS MELANGE', '0kg', 6, 9),
(9, ' GRIS MELANGE', '0kg', 7, 10),
(10, ' GRIS RATON', '0kg', 6, 9),
(11, ' GRIS RATON', '0kg', 7, 10),
(12, ' AMARILLO', '0kg', 7, 10),
(13, ' AMARILLO', '0kg', 6, 9),
(14, ' AZUL REY', '0kg', 7, 3),
(15, ' CATERPILLA', '0kg', 6, 9),
(16, ' CATERPILLA', '0kg', 7, 10),
(17, ' BEIGE', '0kg', 7, 7),
(18, ' BEIGE', '0kg', 6, 8),
(19, ' AZUL CELESTE', '0kg', 7, 7),
(20, ' AZUL CELESTE', '0kg', 6, 8),
(21, ' ROSADO', '0kg', 7, 7),
(22, ' ROSADO', '0kg', 6, 8),
(23, ' ROJO', '0kg', 7, 1),
(24, ' ROJO', '0kg', 6, 2),
(25, ' VERDE BENETTON', '0kg', 7, 1),
(26, ' VERDE BENETTON', '0kg', 6, 2),
(27, ' TURQUESA', '0kg', 7, 1),
(28, ' TURQUESA', '0kg', 6, 2),
(29, ' VINOTINTO', '0kg', 6, 2),
(30, ' VINOTINTO', '0kg', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipo_producto`
--

CREATE TABLE IF NOT EXISTS `ttipo_producto` (
  `cod_tip_pro` int(3) NOT NULL AUTO_INCREMENT,
  `nom_tip` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_tip_pro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `ttipo_producto`
--

INSERT INTO `ttipo_producto` (`cod_tip_pro`, `nom_tip`) VALUES
(1, 'CAMISA'),
(2, 'CHEMIS'),
(3, 'MONO'),
(4, 'JEAN'),
(5, 'BATA'),
(6, 'FRANELA'),
(7, 'BORDADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipo_tela`
--

CREATE TABLE IF NOT EXISTS `ttipo_tela` (
  `cod_tipo_tela` int(2) NOT NULL AUTO_INCREMENT,
  `nom_tipo_tela` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pre_tipo_tela` float(10,2) NOT NULL,
  `can_uso_tela` float(4,2) DEFAULT NULL,
  `ope_tela` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod_tipo_tela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `ttipo_tela`
--

INSERT INTO `ttipo_tela` (`cod_tipo_tela`, `nom_tipo_tela`, `pre_tipo_tela`, `can_uso_tela`, `ope_tela`) VALUES
(1, 'OXFORD', 10500.00, 1.50, 'X'),
(2, 'ALG. EGIPTO', 8000.00, 1.50, 'X'),
(3, 'TASLAN', 8000.00, NULL, NULL),
(4, 'DACRON', 5500.00, NULL, NULL),
(5, 'DRILL', 8000.00, NULL, NULL),
(6, 'PIQUE', 22000.00, 3.00, '/'),
(7, 'JERSEY', 22000.00, 4.00, '/'),
(8, 'ATLETICA', 5000.00, NULL, NULL),
(9, 'GABARDINA', 7000.00, NULL, NULL),
(10, 'NO APLICA', 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE IF NOT EXISTS `tusuario` (
  `ced_usu` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `nick_usu` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nom_usu` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `ape_usu` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `con_usu` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tip_usu` int(1) NOT NULL,
  `est_usu` int(1) NOT NULL,
  `cont_cla` int(1) DEFAULT NULL,
  `pregunta1` char(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pregunta2` char(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `respuesta1` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `respuesta2` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ced_usu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`ced_usu`, `nick_usu`, `nom_usu`, `ape_usu`, `con_usu`, `tip_usu`, `est_usu`, `cont_cla`, `pregunta1`, `pregunta2`, `respuesta1`, `respuesta2`) VALUES
('10729713', 'gregorio', 'Gregorio', 'Rodriguez', 'adcd7048512e64b48da55b027577886ee5a36350', 2, 0, 0, '1', '1', 'hola', 'chao'),
('21056985', 'juan', 'Juan', 'Rodriguez', 'fe703d258c7ef5f50b71e06565a65aa07194907f', 2, 1, 4, '1', '1', 'hola', 'chao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tzona`
--

CREATE TABLE IF NOT EXISTS `tzona` (
  `cod_zona` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `des_zona` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_zona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tzona`
--

INSERT INTO `tzona` (`cod_zona`, `des_zona`) VALUES
(' 6', 'Bolívar'),
('1', 'Amazonas'),
('10', 'Falcón'),
('11', 'Distrito Capital'),
('12', 'Guárico'),
('13', 'Lara'),
('14', 'Mérida'),
('15', 'Miranda'),
('16', 'Monagas'),
('17', 'Nueva Esparta'),
('18', 'Portuguesa'),
('19', 'Sucre'),
('2', 'anzoatégui'),
('20', 'Táchira'),
('21', 'Trujillo'),
('22', 'Vargas'),
('23', 'Yaracuy'),
('24', 'Zulia'),
('3', 'Apure'),
('4', 'Aragua'),
('5', 'Barinas'),
('7', 'Carabobo'),
('8', 'Cojedes'),
('9', 'Delta Amacuro');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tcliente`
--
ALTER TABLE `tcliente`
  ADD CONSTRAINT `fk_zona` FOREIGN KEY (`zona_fk`) REFERENCES `tzona` (`cod_zona`);

--
-- Filtros para la tabla `tcompra`
--
ALTER TABLE `tcompra`
  ADD CONSTRAINT `fk_nro_vende` FOREIGN KEY (`usuario_fk`) REFERENCES `tusuario` (`ced_usu`);

--
-- Filtros para la tabla `tdetallecompra`
--
ALTER TABLE `tdetallecompra`
  ADD CONSTRAINT `tdetallecompra_ibfk_1` FOREIGN KEY (`nro_com`) REFERENCES `tcompra` (`nro_com`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tdetallefactura`
--
ALTER TABLE `tdetallefactura`
  ADD CONSTRAINT `fk_fac` FOREIGN KEY (`factura`) REFERENCES `tfactura` (`nro_fac`);

--
-- Filtros para la tabla `tfactura`
--
ALTER TABLE `tfactura`
  ADD CONSTRAINT `fk_vende` FOREIGN KEY (`usuario_fk`) REFERENCES `tusuario` (`ced_usu`);

--
-- Filtros para la tabla `tpresupuesto`
--
ALTER TABLE `tpresupuesto`
  ADD CONSTRAINT `tpresupuesto_ibfk_2` FOREIGN KEY (`ela_presu`) REFERENCES `tusuario` (`ced_usu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tproducto`
--
ALTER TABLE `tproducto`
  ADD CONSTRAINT `tproducto_ibfk_4` FOREIGN KEY (`modelo`) REFERENCES `tmodelo` (`cod_mod`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tproducto_ibfk_5` FOREIGN KEY (`tip_pro`) REFERENCES `ttipo_producto` (`cod_tip_pro`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tproducto_ibfk_6` FOREIGN KEY (`precio`) REFERENCES `ttela` (`cod_tela`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ttela`
--
ALTER TABLE `ttela`
  ADD CONSTRAINT `ttela_ibfk_1` FOREIGN KEY (`pre_tela`) REFERENCES `tprecio_color` (`cod_pre_col`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
