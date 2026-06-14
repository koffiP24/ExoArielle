-- phpMyAdmin SQL Dump
-- Base de données : `bd_viticole`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `bd_viticole`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `bd_viticole`;

-- --------------------------------------------------------
-- Table `utilisateur`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `motDePasse` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `utilisateur` (`nomUtilisateur`, `email`, `motDePasse`, `role`) VALUES
('Utilisateur demo', 'user@demo.com', '$2y$10$KhjxCcFhkSP8DRvsF9Z.4O5FGDHKUArNpM4d7btUB0u3GklmB51Ve', 'user'),
('Administrateur', 'admin.test@gmail.com', '$2y$10$ZYdGYUackRa/sysRA0Bmeei6asWpV5wAk/454NUCDZLbW4CzWDfgW', 'admin');

-- --------------------------------------------------------
-- Table `cepage`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cepage`;
CREATE TABLE IF NOT EXISTS `cepage` (
  `idCepage` int NOT NULL AUTO_INCREMENT,
  `nomCepage` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `couleurCepage` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `teneurSucre` int NOT NULL,
  `regionOrigine` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idCepage`),
  UNIQUE KEY `nomCepage` (`nomCepage`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cepage` (`idCepage`, `nomCepage`, `couleurCepage`, `teneurSucre`, `regionOrigine`) VALUES
(4, 'merlot', 'violet', 3, 'bas sassandra'),
(5, 'cabernet', 'rouge', 5, 'bordeaux'),
(6, 'bibr', 'blanc', 2, 'yamou');

-- --------------------------------------------------------
-- Table `negociant`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `negociant`;
CREATE TABLE IF NOT EXISTS `negociant` (
  `idNegociant` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nomNegociant` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `preNegociant` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `telNegociant` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idNegociant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `negociant` (`idNegociant`, `nomNegociant`, `preNegociant`, `telNegociant`) VALUES
('lahy271105', 'Lah', 'Yeshua', '0712171325'),
('Arielle852', 'Arielle', 'Succes', '54784245');

-- --------------------------------------------------------
-- Table `cuve`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cuve`;
CREATE TABLE IF NOT EXISTS `cuve` (
  `idCuve` int NOT NULL AUTO_INCREMENT,
  `letCuve` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `capCuve` int NOT NULL,
  `idCepage` int NOT NULL,
  PRIMARY KEY (`idCuve`),
  UNIQUE KEY `letCuve` (`letCuve`),
  KEY `idCepage` (`idCepage`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cuve` (`idCuve`, `letCuve`, `capCuve`, `idCepage`) VALUES
(1, 'd', 6, 4);

-- --------------------------------------------------------
-- Table `contrat`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `idContrat` int NOT NULL AUTO_INCREMENT,
  `numContrat` int NOT NULL,
  `datecontrat` date NOT NULL,
  `echeContrat` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `qtlivContrat` int NOT NULL,
  `datelivContrat` date NOT NULL,
  `idNegociant` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idContrat`),
  UNIQUE KEY `numContrat` (`numContrat`),
  KEY `idNegociant` (`idNegociant`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contrat` (`idContrat`, `numContrat`, `datecontrat`, `echeContrat`, `qtlivContrat`, `datelivContrat`, `idNegociant`) VALUES
(1, 1, '2026-06-11', 'qsdfghjkl', 11, '2026-06-17', 'lahy271105');

-- --------------------------------------------------------
-- Table `livraison`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `numLivraison` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `datereelLivraison` date NOT NULL,
  PRIMARY KEY (`numLivraison`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `livraison` (`numLivraison`, `datereelLivraison`) VALUES
('LIV001', '2026-06-17');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
