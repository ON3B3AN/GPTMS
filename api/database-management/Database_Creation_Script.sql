-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`User`;
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Course`;
CREATE TABLE IF NOT EXISTS `mydb`.`Course` (
  `course_id` INT NOT NULL AUTO_INCREMENT,
  `course_name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE INDEX `course_id_UNIQUE` (`course_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Hole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Hole`;
CREATE TABLE IF NOT EXISTS `mydb`.`Hole` (
  `hole_id` INT NOT NULL AUTO_INCREMENT,
  `Course_course_id` INT NOT NULL,
  `hole_number` INT NOT NULL,
  `hole_par` INT NOT NULL,
  `longitude` DOUBLE NOT NULL,
  `latitude` DOUBLE NOT NULL,
  `avg_pop` TIME NOT NULL,
  `hint` VARCHAR(1000) NULL,
  PRIMARY KEY (`hole_id`),
  INDEX `fk_Hole_Course1_idx` (`Course_course_id` ASC) ,
  CONSTRAINT `fk_Hole_Course1`
    FOREIGN KEY (`Course_course_id`)
    REFERENCES `mydb`.`Course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Party`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Party`;
CREATE TABLE IF NOT EXISTS `mydb`.`Party` (
  `party_id` INT NOT NULL AUTO_INCREMENT,
  `Course_course_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NULL,
  `size` INT NOT NULL,
  `longitude` DOUBLE NOT NULL,
  `latitude` DOUBLE NOT NULL,
  `golf_cart` TINYINT(1) ZEROFILL NOT NULL,
  PRIMARY KEY (`party_id`),
  UNIQUE INDEX `player_id_UNIQUE` (`party_id` ASC) ,
  INDEX `fk_Party_Course1_idx` (`Course_course_id` ASC) ,
  CONSTRAINT `fk_Party_Course1`
    FOREIGN KEY (`Course_course_id`)
    REFERENCES `mydb`.`Course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Player`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Player`;
CREATE TABLE IF NOT EXISTS `mydb`.`Player` (
  `User_user_id` INT NOT NULL,
  `Party_party_id` INT NOT NULL,
  `handicap` INT NULL,
  PRIMARY KEY (`User_user_id`, `Party_party_id`),
  INDEX `fk_Player_User_idx` (`User_user_id` ASC) ,
  INDEX `fk_Player_Party1_idx` (`Party_party_id` ASC) ,
  CONSTRAINT `fk_Player_User`
    FOREIGN KEY (`User_user_id`)
    REFERENCES `mydb`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Player_Party1`
    FOREIGN KEY (`Party_party_id`)
    REFERENCES `mydb`.`Party` (`party_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Score`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Score`;
CREATE TABLE IF NOT EXISTS `mydb`.`Score` (
  `Hole_hole_id` INT NOT NULL,
  `Player_User_user_id` INT NOT NULL,
  `Player_Party_party_id` INT NOT NULL,
  `stroke` INT NOT NULL,
  `total_score` INT NOT NULL,
  PRIMARY KEY (`Hole_hole_id`, `Player_User_user_id`, `Player_Party_party_id`),
  INDEX `fk_Score_Hole1_idx` (`Hole_hole_id` ASC) ,
  INDEX `fk_Score_Player1_idx` (`Player_User_user_id` ASC, `Player_Party_party_id` ASC) ,
  CONSTRAINT `fk_Score_Hole1`
    FOREIGN KEY (`Hole_hole_id`)
    REFERENCES `mydb`.`Hole` (`hole_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Score_Player1`
    FOREIGN KEY (`Player_User_user_id` , `Player_Party_party_id`)
    REFERENCES `mydb`.`Player` (`User_user_id` , `Party_party_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Employee`;
CREATE TABLE IF NOT EXISTS `mydb`.`Employee` (
  `emp_id` INT NOT NULL AUTO_INCREMENT,
  `User_user_id` INT NOT NULL,
  `Course_course_id` INT NOT NULL,
  `security_lvl` INT NOT NULL,
  PRIMARY KEY (`emp_id`),
  INDEX `fk_Employee_User1_idx` (`User_user_id` ASC) ,
  INDEX `fk_Employee_Course1_idx` (`Course_course_id` ASC) ,
  CONSTRAINT `fk_Employee_User1`
    FOREIGN KEY (`User_user_id`)
    REFERENCES `mydb`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Employee_Course1`
    FOREIGN KEY (`Course_course_id`)
    REFERENCES `mydb`.`Course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tee`;
CREATE TABLE IF NOT EXISTS `mydb`.`Tee` (
  `tee_id` INT NOT NULL AUTO_INCREMENT,
  `Hole_hole_id` INT NOT NULL,
  `distance_to_pin` DOUBLE NOT NULL,
  `tee_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tee_id`),
  INDEX `fk_Tee_Hole1_idx` (`Hole_hole_id` ASC) ,
  CONSTRAINT `fk_Tee_Hole1`
    FOREIGN KEY (`Hole_hole_id`)
    REFERENCES `mydb`.`Hole` (`hole_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
