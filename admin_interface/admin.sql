CREATE DATABASE IF NOT EXISTS `CLLDB`
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE `CLLDB`;

DROP TABLE IF EXISTS `USER`;
CREATE TABLE IF NOT EXISTS `USER` (
    `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `hachuuid` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
    `DateCreated` DATE NOT NULL,
    `Name` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `LastName` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `PhoneNumber` VARCHAR(20) COLLATE utf8_general_ci NOT NULL,
    `Status` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `Email` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,   
    `Password` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `Gender` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `Salt` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `type` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `CAISSES`;
CREATE TABLE IF NOT EXISTS `CAISSES` (
    `id_caisse` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `source` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `date_caisse` DATE NOT NULL,
    `monton` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `transactiontype` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,

)