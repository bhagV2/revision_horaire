-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2026 at 09:15 AM
-- Server version: 8.0.46-0ubuntu0.24.04.4
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `horaire`
--
CREATE DATABASE IF NOT EXISTS `horaire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `horaire`;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ex. I.DA-P3A',
  `annee_scolaire` varchar(9) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ex. 2026-2027',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `nom`, `annee_scolaire`) VALUES
(1, 'I.DA-P3A', '2026-2027'),
(2, 'I.DA-P2D', '2025-2026'),
(3, 'I.DA-P1D', '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ex. AWEB3',
  `nom` varchar(120) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ex. Atelier Web',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `code`, `nom`) VALUES
(1, 'ARASP', 'Atelier Raspberry'),
(2, 'M323', 'Module 323'),
(3, 'AWEB', 'Atelier Web'),
(4, 'M335', 'Module 335'),
(5, 'APROG', 'Atelier Programmation'),
(6, 'M223', 'Module 223'),
(7, 'Ang', 'Anglais'),
(8, 'Phy', 'Physique'),
(9, 'Dro', 'Droit'),
(10, 'Fra', 'Français'),
(11, 'Mat', 'Mathématiques');

-- --------------------------------------------------------

--
-- Table structure for table `creneaux`
--

DROP TABLE IF EXISTS `creneaux`;
CREATE TABLE IF NOT EXISTS `creneaux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classe_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') COLLATE utf8mb4_general_ci NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `salle` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_id` (`cours_id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creneaux`
--

INSERT INTO `creneaux` (`id`, `classe_id`, `cours_id`, `jour`, `heure_debut`, `heure_fin`, `salle`) VALUES
(1, 1, 1, 'lundi', '08:05:00', '11:40:00', 'C305'),
(2, 1, 2, 'lundi', '12:40:00', '16:10:00', 'C101'),
(3, 1, 3, 'mardi', '08:05:00', '11:40:00', 'C101'),
(4, 1, 4, 'mardi', '12:40:00', '16:10:00', 'C101'),
(5, 1, 7, 'mercredi', '08:05:00', '09:40:00', '1.72'),
(6, 1, 8, 'mercredi', '10:05:00', '11:40:00', '1.74'),
(7, 1, 9, 'mercredi', '11:45:00', '12:30:00', '1.72'),
(8, 1, 10, 'mercredi', '13:30:00', '15:20:00', '1.64'),
(9, 1, 11, 'mercredi', '15:25:00', '17:00:00', '1.63'),
(10, 1, 3, 'jeudi', '08:05:00', '11:40:00', 'R104'),
(11, 1, 5, 'jeudi', '12:40:00', '16:10:00', 'R123'),
(12, 1, 6, 'vendredi', '08:05:00', '11:40:00', 'RR04'),
(13, 1, 5, 'vendredi', '12:40:00', '16:10:00', 'C209');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
