-- Tabelldefinition.
-- notera att vi har en konstgjord huvudnyckel
-- istället har vi valt att låta personnumret vara unikt.
-- Det är bättre då personnummret är en sträng.
DROP TABLE IF EXISTS `applicant`;
CREATE TABLE `applicant` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `personal_number` VARCHAR(12) UNIQUE NOT NULL , -- <------------------
  `surname` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `firstname` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `e_mail` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  -- more column definitions here... ,
  PRIMARY KEY (`id`) 
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- SQL-fråga för att lägga in en ansökande.
-- Om personen har ett nytt personnummer, 
-- så lägger vi in datan i en ny rad,
-- annars så uppdaterar vi alla kolumner för den raden,
-- förutom id:et och personnumret(som är unikt).
INSERT INTO applicant (	
	`personal_number`,
	`surname` , 
	`firstname` ,
	`address` , 
	`e_mail`, 
	-- more columns here... 
) 
VALUES (
	'{$input["personal_number"]}',
	'{$input["surname"]}', 
	'{$input["firstname"]}',  
	'{$input["address"]}', 
	'{$input["e_mail"]}', 
	-- ...
)
ON DUPLICATE KEY UPDATE -- <------------------
	`surname` 		= '{$input["surname"]}', 
	`firstname` 	= '{$input["firstname"]}',  
	`address` 		= '{$input["address"]}', 
	`e_mail` 		= '{$input["e_mail"]}' ,
	-- ... 
;

-- Det finns andra insert-strategier. 
-- De är IGNORE och REPLACE.
-- Om vi har t.ex. angett IGNORE och försöker lägga till en 
-- rad där ett unikt/a värden som redan finns, 
-- läggs inget till och den ger inget sql-fel.  
-- Syntaxen är för IGNORE:
INSERT IGNORE INTO applicant ( -- ...