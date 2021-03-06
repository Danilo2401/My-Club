-- MySQL Script generated by MySQL Workbench
-- Tue Jun 29 16:34:23 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema baza_klub
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema baza_klub
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `baza_klub` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci ;
USE `baza_klub` ;

-- -----------------------------------------------------
-- Table `baza_klub`.`podaci_o_zurci`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `baza_klub`.`podaci_o_zurci` (
  `id_podaci` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `datum_zurke` DATE NOT NULL,
  `vreme_zurke_od` TIME NOT NULL,
  `vreme_zurke_do` TIME NOT NULL,
  `vrsta_zurke` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_podaci`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `baza_klub`.`komentari`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `baza_klub`.`komentari` (
  `id_komentari` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `naslov` VARCHAR(60) NOT NULL,
  `opis` VARCHAR(100) NOT NULL,
  `ime_korisnika` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_komentari`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
