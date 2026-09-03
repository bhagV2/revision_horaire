-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2026 at 08:51 AM
-- Server version: 8.0.46-0ubuntu0.24.04.3
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

--
-- User: `horaireUSer`
--
DROP USER IF EXISTS 'horaireUser'@'localhost';
CREATE USER 'horaireUser'@'localhost' IDENTIFIED BY 'SuperHoraire';

GRANT INSERT ON horaire.* TO 'fooduser'@'localhost';
GRANT SELECT ON horaire.* TO 'fooduser'@'localhost';
GRANT UPDATE ON horaire.* TO 'fooduser'@'localhost';
GRANT DELETE ON horaire.* TO 'fooduser'@'localhost';

DROP USER IF EXISTS 'horaireUser'@'%';
CREATE USER 'horaireUser'@'%' IDENTIFIED BY 'SuperHoraire';

GRANT INSERT ON horaire.* TO 'fooduser'@'%';
GRANT SELECT ON horaire.* TO 'fooduser'@'%';
GRANT UPDATE ON horaire.* TO 'fooduser'@'%';
GRANT DELETE ON horaire.* TO 'fooduser'@'%';

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL COMMENT 'ex. I.DA-P3A',
  `annee_scolaire` varchar(9) NOT NULL COMMENT 'ex. 2026-2027'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
CREATE TABLE `cours` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL COMMENT 'ex. AWEB3',
  `nom` varchar(120) NOT NULL COMMENT 'ex. Atelier Web'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
CREATE TABLE `creneaux` (
  `id` int NOT NULL,
  `classe_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `salle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `creneaux`
--
ALTER TABLE `creneaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cours_id` (`cours_id`),
  ADD KEY `classe_id` (`classe_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `creneaux`
--
ALTER TABLE `creneaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creneaux`
--
ALTER TABLE `creneaux`
  ADD CONSTRAINT `creneaux_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `creneaux_ibfk_2` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
