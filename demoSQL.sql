-- Tabelldefinition för ansökande.
-- Notera att vi har en konstgjord huvudnyckel och
-- vi har valt att låta personnumret vara unikt.
-- Det är bättre då personnummret är en sträng.
DROP TABLE IF EXISTS `applicant`;
CREATE TABLE `applicant` (
  `id` 				INT 			NOT NULL AUTO_INCREMENT ,
  `personal_number` VARCHAR(12) 	UNIQUE NOT NULL , -- <------------------
  `surname` 		VARCHAR(45) 	NOT NULL ,
  `firstname` 		VARCHAR(45) 	NOT NULL ,
  `address` 		VARCHAR(100)	NULL,
  `e_mail` 			VARCHAR(45) 	NULL,
  -- more column definitions here... 
  -- vi har 'CHARACTER SET utf8 COLLATE utf8_bin' på alla VARCHAR.
  PRIMARY KEY (`id`) 
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- Observera att vårt formulär för ansökande visar den information som
-- finns för deet angivna personnumret, och tomt om det inte redan finns. 

-- SQL-fråga för att lägga in en ansökande.
-- Vi vill lägga in datan i en ny rad,
-- om personen har ett nytt personnummer. 
-- Annars så uppdaterar vi alla kolumner för den raden,
-- förutom id:et och personnumret(som är unikt).
-- Syntaxen blir då:
INSERT INTO applicant (	
	`personal_number`,
	`surname` , 
	`firstname` ,
	`address` , 
	`e_mail`, 
	-- more columns here... 
) 
VALUES (
	'$personal_number',
	'$surname', 
	'$firstname',  
	'$address', 
	'$e_mail', 
	-- ...
)
ON DUPLICATE KEY UPDATE -- <------------------
	`surname` 		= '$surname', 
	`firstname` 	= '$firstname',  
	`address` 		= '$address', 
	`e_mail` 		= '$e_mail' ,
	-- ... 
;

-- Det finns andra insert-strategier. 
-- De är IGNORE och REPLACE.
-- Om vi har t.ex. angett IGNORE och försöker lägga till en 
-- rad där ett unikt/a värden som redan finns, 
-- läggs inget till och den ger inget sql-fel.  
-- Syntaxen är för IGNORE:
INSERT IGNORE INTO applicant ( -- p.s.s. ...