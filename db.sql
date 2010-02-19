SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf-8_bin COLLATE utf-8_bin ;
USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`admission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`admission`;
CREATE TABLE `mydb`.`admission` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `start` DATE NULL ,
  `stop` DATE NULL ,
  `last_application_date` DATE NULL ,
  `last_completion_date` DATE NULL ,
  `semester_start` DATE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`education_start`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`education_start` 
CREATE  TABLE `mydb`.`education_start`(
  `id` INT NOT NULL AUTO_INCREMENT ,
  `education_id` INT NOT NULL ,
  `education_education_start_id` INT NOT NULL ,
  `admission_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `education_id`, `education_education_start_id`, `admission_id`) ,
  INDEX `fk_education_start_education` (`education_id` ASC, `education_education_start_id` ASC) ,
  INDEX `fk_education_start_admission` (`admission_id` ASC) ,
  CONSTRAINT `fk_education_start_education`
    FOREIGN KEY (`education_id` , `education_education_start_id` )
    REFERENCES `mydb`.`education` (`id` , `education_start_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_education_start_admission`
    FOREIGN KEY (`admission_id` )
    REFERENCES `mydb`.`admission` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`education`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`education` 
CREATE TABLE `mydb`.`education`(
  `id` INT NOT NULL AUTO_INCREMENT ,
  `education_start_id` INT NOT NULL ,
  `city` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `name` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  PRIMARY KEY (`id`, `education_start_id`) ,
  INDEX `fk_education_education_start` (`education_start_id` ASC) ,
  CONSTRAINT `fk_education_education_start`
    FOREIGN KEY (`education_start_id` )
    REFERENCES `mydb`.`education_start` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`applicant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`applicant` 
CREATE TABLE `mydb`.`applicant`(
  `personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `surname` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `firstname` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `co_address` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `postal_code` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `postal_area` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `telephone` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `mobile` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `e_mail` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  PRIMARY KEY (`personal_number`) )
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`log_entry`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`log_entry` 
CREATE TABLE `mydb`.`log_entry`(
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NULL ,
  `content` TEXT NULL ,
  `author` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT 'Stina ' ,
  `subject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `applicant_personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  PRIMARY KEY (`id`, `applicant_personal_number`) ,
  INDEX `fk_Log_Entry_Applicant` (`applicant_personal_number` ASC) ,
  CONSTRAINT `fk_Log_Entry_Applicant`
    FOREIGN KEY (`applicant_personal_number` )
    REFERENCES `mydb`.`applicant` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`admission_occasion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`admission_occasion` 
CREATE TABLE `mydb`.`admission_occasion`(
  `id` INT NOT NULL AUTO_INCREMENT ,
  `arrival_date` DATE NULL ,
  `applicant_personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `registration_date` DATE NULL ,
  `admission_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `applicant_personal_number`, `admission_id`) ,
  INDEX `fk_admission_occasion_applicant` (`applicant_personal_number` ASC) ,
  INDEX `fk_admission_occasion_admission` (`admission_id` ASC) ,
  CONSTRAINT `fk_admission_occasion_applicant`
    FOREIGN KEY (`applicant_personal_number` )
    REFERENCES `mydb`.`applicant` (`personal_number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_admission_occasion_admission`
    FOREIGN KEY (`admission_id` )
    REFERENCES `mydb`.`admission` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`application`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`application` 
CREATE TABLE `mydb`.`application` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `status` ENUM('admitted','not admitted','declined','reserve','non eligibile','admitted somewhere else') NULL ,
  `basic_eligibility` ENUM('yes','no','exemption') NULL ,
  `priority` INT NULL ,
  `test_points` DECIMAL(2,1) NULL ,
  `school_points` DECIMAL(3,1) NULL ,
  `admission_occasion_id` INT NOT NULL ,
  `admission_occasion_applicant_personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `selection_points` DECIMAL(3,1) NULL ,
  `university_points` DECIMAL(2,1) NULL ,
  `work_points` DECIMAL(2,1) NULL ,
  PRIMARY KEY (`id`, `admission_occasion_id`, `admission_occasion_applicant_personal_number`) ,
  INDEX `fk_application_admission_occasion` (`admission_occasion_id` ASC, `admission_occasion_applicant_personal_number` ASC) ,
  CONSTRAINT `fk_application_admission_occasion`
    FOREIGN KEY (`admission_occasion_id` , `admission_occasion_applicant_personal_number` )
    REFERENCES `mydb`.`admission_occasion` (`id` , `applicant_personal_number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`criterion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`criterion` 
CREATE TABLE `mydb`.`criterion`(
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`application_fulfills_criterion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`application_fulfills_criterion` 
CREATE TABLE `mydb`.`application_fulfills_criterion`(
  `criterion_id` INT NOT NULL ,
  `application_id` INT NOT NULL ,
  `application_admission_occasion_id` INT NOT NULL ,
  `application_admission_occasion_applicant_personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `fulfilled_by` ENUM(' regular', 'real competence', 'exemption') NULL ,
  PRIMARY KEY (`criterion_id`, `application_id`, `application_admission_occasion_id`, `application_admission_occasion_applicant_personal_number`) ,
  INDEX `fk_criterion_has_application_criterion` (`criterion_id` ASC) ,
  INDEX `fk_criterion_has_application_application` (`application_id` ASC, `application_admission_occasion_id` ASC, `application_admission_occasion_applicant_personal_number` ASC) ,
  CONSTRAINT `fk_criterion_has_application_criterion`
    FOREIGN KEY (`criterion_id` )
    REFERENCES `mydb`.`criterion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_criterion_has_application_application`
    FOREIGN KEY (`application_id` , `application_admission_occasion_id` , `application_admission_occasion_applicant_personal_number` )
    REFERENCES `mydb`.`application` (`id` , `admission_occasion_id` , `admission_occasion_applicant_personal_number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`education_start_requires_criterion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`education_start_requires_criterion` 
CREATE TABLE `mydb`.`education_start_requires_criterion`(
  `education_start_id` INT NOT NULL ,
  `criterion_id` INT NOT NULL ,
  PRIMARY KEY (`education_start_id`, `criterion_id`) ,
  INDEX `fk_education_start_has_criterion_education_start` (`education_start_id` ASC) ,
  INDEX `fk_education_start_has_criterion_criterion` (`criterion_id` ASC) ,
  CONSTRAINT `fk_education_start_has_criterion_education_start`
    FOREIGN KEY (`education_start_id` )
    REFERENCES `mydb`.`education_start` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_education_start_has_criterion_criterion`
    FOREIGN KEY (`criterion_id` )
    REFERENCES `mydb`.`criterion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
