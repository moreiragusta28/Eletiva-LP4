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
-- Table `usuario` (usuários do sistema)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cargo` (cargos de funcionários)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cargo` (
  `cargo_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`cargo_id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `turno` (turnos de trabalho)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `turno` (
  `turno_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `periodo` VARCHAR(50) NOT NULL,       -- Ex.: Manhã, Tarde, Noite
  `hora_inicio` TIME NOT NULL,
  `hora_fim` TIME NOT NULL,
  PRIMARY KEY (`turno_id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `funcionario` (cadastro de funcionários)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `funcionario` (
  `funcionario_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `salario` DECIMAL(8,2) NOT NULL,      -- pode ser salário ou valor/hora
  `cargo_id` INT NOT NULL,
  `turno_id` INT NOT NULL,
  PRIMARY KEY (`funcionario_id`),
  INDEX `fk_funcionario_cargo_idx` (`cargo_id` ASC),
  INDEX `fk_funcionario_turno_idx` (`turno_id` ASC),
  CONSTRAINT `fk_funcionario_cargo`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `cargo` (`cargo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_funcionario_turno`
    FOREIGN KEY (`turno_id`)
    REFERENCES `turno` (`turno_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `ponto` (batidas de ponto)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ponto` (
  `ponto_id` INT NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `tipo` ENUM('ENTRADA','SAIDA') NOT NULL,
  PRIMARY KEY (`ponto_id`),
  INDEX `fk_ponto_funcionario_idx` (`funcionario_id` ASC),
  CONSTRAINT `fk_ponto_funcionario`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `funcionario` (`funcionario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
