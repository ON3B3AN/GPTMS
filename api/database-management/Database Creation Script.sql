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
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `employee` TINYINT NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Course` (
  `course_id` INT NOT NULL AUTO_INCREMENT,
  `course_name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE INDEX `course_id_UNIQUE` (`course_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Hole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Hole` (
  `hole_id` INT NOT NULL AUTO_INCREMENT,
  `course_id` INT NOT NULL,
  `hole_number` VARCHAR(45) NOT NULL,
  `hole_par` VARCHAR(45) NOT NULL,
  `tee1_dist` INT NULL,
  `tee2_dist` INT NULL,
  `tee3_dist` INT NULL,
  `tee4_dist` INT NULL,
  `tee5_dist` INT NULL,
  `tee6_dist` INT NULL,
  `avg_pop` TIME NULL,
  PRIMARY KEY (`hole_id`, `course_id`),
  INDEX `fk_Hole_GolfCourse1_idx` (`course_id` ASC) ,
  CONSTRAINT `fk_Hole_GolfCourse1`
    FOREIGN KEY (`course_id`)
    REFERENCES `mydb`.`Course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Party`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Party` (
  `party_id` INT NOT NULL AUTO_INCREMENT,
  `size` INT NOT NULL,
  `party_stime` DATETIME NOT NULL,
  `party_etime` DATETIME NULL,
  PRIMARY KEY (`party_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Golf_Game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Golf_Game` (
  `game_id` INT NOT NULL AUTO_INCREMENT,
  `Course_course_id` INT NOT NULL,
  `Party_party_id` INT NOT NULL,
  PRIMARY KEY (`game_id`, `Course_course_id`, `Party_party_id`),
  UNIQUE INDEX `player_id_UNIQUE` (`game_id` ASC) ,
  INDEX `fk_Golf_Game_Course1_idx` (`Course_course_id` ASC) ,
  INDEX `fk_Golf_Game_Party1_idx` (`Party_party_id` ASC) ,
  CONSTRAINT `fk_Golf_Game_Course1`
    FOREIGN KEY (`Course_course_id`)
    REFERENCES `mydb`.`Course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Golf_Game_Party1`
    FOREIGN KEY (`Party_party_id`)
    REFERENCES `mydb`.`Party` (`party_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Score`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Score` (
  `score_id` INT NOT NULL AUTO_INCREMENT,
  `Hole_hole_id` INT NOT NULL,
  `Hole_course_id` INT NOT NULL,
  `stroke` INT NOT NULL,
  `Golf_Game_game_id` INT NOT NULL,
  PRIMARY KEY (`score_id`, `Hole_hole_id`, `Hole_course_id`, `Golf_Game_game_id`),
  INDEX `fk_Score_Hole1_idx` (`Hole_hole_id` ASC, `Hole_course_id` ASC) ,
  INDEX `fk_Score_Golf_Game1_idx` (`Golf_Game_game_id` ASC) ,
  CONSTRAINT `fk_Score_Hole1`
    FOREIGN KEY (`Hole_hole_id` , `Hole_course_id`)
    REFERENCES `mydb`.`Hole` (`hole_id` , `course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Score_Golf_Game1`
    FOREIGN KEY (`Golf_Game_game_id`)
    REFERENCES `mydb`.`Golf_Game` (`game_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Role` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `User_user_id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_id`, `User_user_id`),
  INDEX `fk_role_User1_idx` (`User_user_id` ASC) ,
  CONSTRAINT `fk_role_User1`
    FOREIGN KEY (`User_user_id`)
    REFERENCES `mydb`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`History`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`History` (
  `history_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `Party_party_id` INT NOT NULL,
  `Score_score_id` INT NOT NULL,
  `Score_Hole_hole_id` INT NOT NULL,
  `Score_Hole_course_id` INT NOT NULL,
  PRIMARY KEY (`history_id`, `user_id`, `Party_party_id`, `Score_score_id`, `Score_Hole_hole_id`, `Score_Hole_course_id`),
  INDEX `fk_History_User1_idx` (`user_id` ASC) ,
  INDEX `fk_History_Party1_idx` (`Party_party_id` ASC) ,
  INDEX `fk_History_Score1_idx` (`Score_score_id` ASC, `Score_Hole_hole_id` ASC, `Score_Hole_course_id` ASC) ,
  CONSTRAINT `fk_History_User1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_History_Party1`
    FOREIGN KEY (`Party_party_id`)
    REFERENCES `mydb`.`Party` (`party_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_History_Score1`
    FOREIGN KEY (`Score_score_id` , `Score_Hole_hole_id` , `Score_Hole_course_id`)
    REFERENCES `mydb`.`Score` (`score_id` , `Hole_hole_id` , `Hole_course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Player`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Player` (
  `player_id` INT NOT NULL AUTO_INCREMENT,
  `Party_party_id` INT NOT NULL,
  `User_user_id` INT NOT NULL,
  `handicap` INT ZEROFILL NOT NULL,
  `longitude` DOUBLE NULL,
  `latitude` DOUBLE NULL,
  PRIMARY KEY (`player_id`, `Party_party_id`, `User_user_id`),
  INDEX `fk_Player_Party1_idx` (`Party_party_id` ASC) ,
  INDEX `fk_Player_User1_idx` (`User_user_id` ASC) ,
  CONSTRAINT `fk_Player_Party1`
    FOREIGN KEY (`Party_party_id`)
    REFERENCES `mydb`.`Party` (`party_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Player_User1`
    FOREIGN KEY (`User_user_id`)
    REFERENCES `mydb`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
