SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `ad09_reldb4` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `ad09_reldb4`;

-- -----------------------------------------------------
-- Table `ad09_reldb4`.`applicant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `applicant`;
CREATE TABLE `applicant` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `personal_number` VARCHAR(12) UNIQUE NOT NULL ,
  `surname` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `firstname` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `co_address` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL ,
  `address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `postal_code` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `postal_area` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `telephone` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `mobile` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `e_mail` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  PRIMARY KEY (`id`) 
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`applicant`
-- -----------------------------------------------------

INSERT INTO `applicant` (
	`personal_number`, 
	`surname`, 
	`firstname`, 
	`co_address`, 
	`address`, 
	`postal_code`, 
	`postal_area`, 
	`telephone`, 
	`mobile`, 
	`e_mail`
)
VALUES (
	'010101-0101',
	'Svennson',
	'Olle',
	'',
	'testvägen 1',
	'14753',
	'Stockholm',
	'080808080',
	'070808080',
	'testmail@test.com'
);


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`admission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `admission`;
CREATE TABLE `admission` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `last_application_date` DATE NULL ,
  `last_completion_date` DATE NULL ,
  `year` INT NULL ,
  `semester` ENUM ('HT', 'VT') DEFAULT 'HT' NULL,
  UNIQUE (`year`, `semester`),
  PRIMARY KEY (`id`),
  INDEX ` admission_year` (`year` ASC),
  INDEX ` admission_semester` (`semester`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`admission`
-- -----------------------------------------------------

INSERT INTO `admission` (
	`id` ,
	`last_application_date` ,
	`last_completion_date` ,
	`year` ,
	`semester`
)
VALUES (
	66 , 
	'20081119' , 
	'20081212' ,  
	2009 , 
	'VT'
	);


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`criterion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `criterion`;
CREATE TABLE `criterion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`criterion`
-- -----------------------------------------------------
INSERT INTO `criterion` (
	`id`,
	`description`
)
VALUES 
	( 42, 'Matematik B' ), 
	( 43, 'Engelska B' ),
	( 44, 'Svenska B' );


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`education`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `education`;
CREATE TABLE `education` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `city` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `name` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  PRIMARY KEY (`id`) 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`education`
-- -----------------------------------------------------

INSERT INTO `education` (
	`id` ,
	`city` ,
	`name`
	)
VALUES 
	(1, 'Stockholm', 'Agile Developer'),
	(2, 'Göteborg' , 'Agile Developer'),
	(3, 'Stockholm', 'Energy Consultant'),
	(4, 'Malmö'    , 'Energy Consultant'),
	(5, 'Stockholm', 'IT Management');


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`log_entry`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `log_entry`;
CREATE TABLE `log_entry` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NULL ,
  `content` TEXT NULL ,
  `author` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT 'Stina ',
  `subject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `applicant_personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`, `applicant_personal_number`) ,
  INDEX `fk_Log_Entry_Applicant` (`applicant_personal_number` ASC) ,
  CONSTRAINT `fk_Log_Entry_Applicant`
    FOREIGN KEY (`applicant_personal_number` )
    REFERENCES `ad09_reldb4`.`applicant` (`personal_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION  
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`education_start`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `education_start`;
CREATE TABLE `education_start` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `education_id` INT NOT NULL ,
  `admission_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_education_start_education` (`education_id` ASC ) ,
  INDEX `fk_education_start_admission` (`admission_id` ASC) ,
  CONSTRAINT `fk_education_start_education`
    FOREIGN KEY (`education_id`)
    REFERENCES `ad09_reldb4`.`education` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_education_start_admission`
    FOREIGN KEY (`admission_id` )
    REFERENCES `ad09_reldb4`.`admission` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`education_start`
-- -----------------------------------------------------

INSERT INTO `education_start` (
	`id`,
 	`education_id`,
 	`admission_id`
	)
VALUES 
	( 5, 1, 66 ),
	( 6, 2, 66 ),
	( 7, 3, 66 ),
	( 8, 4, 66 ),
	( 9, 5, 66 );


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`application_occasion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `application_occasion`;
CREATE TABLE `application_occasion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `arrival_date` DATE NULL ,
  `applicant_personal_number` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `registration_date` DATE NULL ,
  `admission_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE KEY (`applicant_personal_number`,`admission_id`) ,
  INDEX `fk_application_occasion_applicant` (`applicant_personal_number` ASC) ,
  INDEX `fk_application_occasion_admission` (`admission_id` ASC) ,
  CONSTRAINT `fk_application_occasion_applicant`
    FOREIGN KEY (`applicant_personal_number` )
    REFERENCES `ad09_reldb4`.`applicant` (`personal_number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_application_occasion_admission`
    FOREIGN KEY (`admission_id` )
    REFERENCES `ad09_reldb4`.`admission` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`application_occasion`
-- -----------------------------------------------------

INSERT INTO `application_occasion` (
	`id`, 	
	`arrival_date`, 	
	`applicant_personal_number`, 	
	`registration_date`, 	
	`admission_id`
)
VALUES (
	22,
	'2010-02-25',
 	'010101-0101',
 	'2010-02-25',
	66
);


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`application`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `application`;
CREATE TABLE `application` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `status` ENUM('in progress','admitted','not admitted','declined','reserve','non eligibile','admitted somewhere else') NULL ,
  `basic_eligibility` ENUM('yes','no','exemption') NULL ,
  `priority` INT NULL ,
  `test_points` DECIMAL(2,1) NULL ,
  `school_points` DECIMAL(3,1) NULL ,
  `application_occasion_id` INT NOT NULL ,
  `selection_points` DECIMAL(3,1) NULL ,
  `university_points` DECIMAL(2,1) NULL ,
  `work_points` DECIMAL(2,1) NULL ,
  `education_start_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
	UNIQUE KEY(`application_occasion_id`, `education_start_id`) ,
  INDEX `fk_application_application_occasion` (`application_occasion_id` ASC) ,
  INDEX `fk_application_education_start` (`education_start_id` ASC ) ,
  CONSTRAINT `fk_application_application_occasion`
    FOREIGN KEY (`application_occasion_id`)
    REFERENCES `ad09_reldb4`.`application_occasion` (`id` )			   
    ON DELETE NO ACTION
    ON UPDATE NO ACTION ,
   CONSTRAINT `fk_application_education_start`
     FOREIGN KEY (`education_start_id`)
     REFERENCES `ad09_reldb4`.`education_start` (`id` )
     ON DELETE NO ACTION
     ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- -----------------------------------------------------
-- Data for table `ad09_reldb4`.`application`
-- -----------------------------------------------------

INSERT INTO `application` (
	`id`,
 	`status`,
 	`basic_eligibility`,
 	`priority`,
 	`test_points`,
 	`school_points`,
 	`application_occasion_id`,
 	`selection_points`,
 	`university_points`,
 	`work_points`,
 	`education_start_id`
)
VALUES 
	( 100, 'in progress', 'yes', 1, NULL, NULL, 22, NULL, NULL, NULL, 5 ),
	( 101, 'in progress', 'yes', 2, NULL, NULL, 22, NULL, NULL, NULL, 7 ),
	( 102, 'in progress', 'yes', 3, NULL, NULL, 22, NULL, NULL, NULL, 6 );


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`application_fulfills_criterion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `application_fulfills_criterion`;
CREATE TABLE `application_fulfills_criterion` (
  `criterion_id` INT NOT NULL ,
  `application_id` INT NOT NULL ,
  `fulfilled_by` ENUM('regular', 'real competence', 'exemption') NOT NULL DEFAULT 'regular',
  PRIMARY KEY (`criterion_id`, `application_id`) ,
  INDEX `fk_criterion_has_application_criterion` (`criterion_id` ASC) ,
  INDEX `fk_criterion_has_application_application` (`application_id` ASC) ,
  CONSTRAINT `fk_criterion_has_application_criterion`
    FOREIGN KEY (`criterion_id` )
    REFERENCES `ad09_reldb4`.`criterion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_criterion_has_application_application`
    FOREIGN KEY (`application_id`)
    REFERENCES `ad09_reldb4`.`application` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;


-- -----------------------------------------------------
-- Table `ad09_reldb4`.`education_start_requires_criterion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `education_start_requires_criterion`;
CREATE TABLE `education_start_requires_criterion` (
  `education_start_id` INT NOT NULL ,
  `criterion_id` INT NOT NULL ,
  PRIMARY KEY (`education_start_id`, `criterion_id`) ,
  INDEX `fk_education_start_has_criterion_education_start` (`education_start_id` ASC) ,
  INDEX `fk_education_start_has_criterion_criterion` (`criterion_id` ASC) ,
  CONSTRAINT `fk_education_start_has_criterion_education_start`
    FOREIGN KEY (`education_start_id` )
    REFERENCES `ad09_reldb4`.`education_start` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION ,
  CONSTRAINT `fk_education_start_has_criterion_criterion`
    FOREIGN KEY (`criterion_id` )
    REFERENCES `ad09_reldb4`.`criterion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION  
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
