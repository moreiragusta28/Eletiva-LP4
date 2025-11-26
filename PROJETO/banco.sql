-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetophp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetophp` DEFAULT CHARACTER SET utf8 ;
USE `projetophp` ;

-- -----------------------------------------------------
-- Table `usuario`  (login do sistema)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `categoria`  (usada como CARGO)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `turno`  (turnos de trabalho)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `turno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `periodo` VARCHAR(50) NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fim` TIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `produto`  (usada como FUNCIONARIO)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,   -- nome do funcionário
  `valor` DECIMAL(8,2) NOT NULL,       -- salário ou valor hora
  `categoria_id` INT NOT NULL,         -- cargo
  `turno_id` INT NOT NULL,             -- turno de trabalho
  PRIMARY KEY (`id`),
  INDEX `fk_produto_categoria_idx` (`categoria_id` ASC),
  INDEX `fk_produto_turno_idx` (`turno_id` ASC),
  CONSTRAINT `fk_produto_categoria`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_turno`
    FOREIGN KEY (`turno_id`)
    REFERENCES `turno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `ponto`  (batidas de ponto)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ponto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `tipo` ENUM('ENTRADA','SAIDA') NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ponto_funcionario_idx` (`funcionario_id` ASC),
  CONSTRAINT `fk_ponto_funcionario`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;