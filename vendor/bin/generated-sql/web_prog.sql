
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- produkte
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `produkte`;

CREATE TABLE `produkte`
(
    `ID` INTEGER NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(100) NOT NULL,
    `Kategorie` VARCHAR(20) NOT NULL,
    `Beschreibung` TEXT NOT NULL,
    `Preis` DOUBLE NOT NULL,
    `Bild` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
