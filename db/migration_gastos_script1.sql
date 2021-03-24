-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: gastos
-- Source Schemata: gastos
-- Created: Wed Mar 24 14:47:09 2021
-- Workbench Version: 6.3.4
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema gastos
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `gastos` ;
CREATE SCHEMA IF NOT EXISTS `gastos` ;

-- ----------------------------------------------------------------------------
-- Table gastos.categoria
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `gastos`.`categoria` (
  `id_empresa` INT(11) NOT NULL COMMENT '',
  `id` INT(11) NOT NULL COMMENT '',
  `nome` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  `tipo` VARCHAR(1) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id_empresa`, `id`)  COMMENT '')
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table gastos.empresa
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `gastos`.`empresa` (
  `id` INT(11) NOT NULL COMMENT '',
  `nome` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  `logotipo` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table gastos.indices
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `gastos`.`indices` (
  `id_empresa` INT(11) NOT NULL COMMENT '',
  `ano` INT(11) NOT NULL COMMENT '',
  `mes` INT(11) NOT NULL COMMENT '',
  `correcao` FLOAT NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id_empresa`, `ano`, `mes`)  COMMENT '')
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table gastos.lancamentos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `gastos`.`lancamentos` (
  `id_empresa` INT(11) NOT NULL COMMENT '',
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `id_usuario` INT(11) NOT NULL COMMENT '',
  `id_categoria` INT(11) NOT NULL COMMENT '',
  `id_pagamento` INT(11) NOT NULL COMMENT '',
  `emissao` DATE NULL DEFAULT NULL COMMENT '',
  `vencimento` DATE NULL DEFAULT NULL COMMENT '',
  `valor` FLOAT NULL DEFAULT NULL COMMENT '',
  `valor_indice` FLOAT NULL DEFAULT NULL COMMENT '',
  `complemento` VARCHAR(200) NULL DEFAULT NULL COMMENT '',
  `tipo` VARCHAR(1) NULL DEFAULT NULL COMMENT '',
  `paga` VARCHAR(1) NULL DEFAULT NULL COMMENT '',
  `anexo` VARCHAR(200) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`, `id_empresa`)  COMMENT '')
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table gastos.tipo_pagamento
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `gastos`.`tipo_pagamento` (
  `id_empresa` INT(11) NOT NULL COMMENT '',
  `id` INT(11) NOT NULL COMMENT '',
  `nome` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `icone` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `tipo` VARCHAR(1) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id_empresa`, `id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- ----------------------------------------------------------------------------
-- Table gastos.usuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `gastos`.`usuario` (
  `id_empresa` INT(11) NOT NULL COMMENT '',
  `id` INT(11) NOT NULL COMMENT '',
  `nome` VARCHAR(150) NULL DEFAULT NULL COMMENT '',
  `email` VARCHAR(200) NULL DEFAULT NULL COMMENT '',
  `senha` TEXT NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id_empresa`, `id`)  COMMENT '')
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;
SET FOREIGN_KEY_CHECKS = 1;
