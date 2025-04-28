-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2025 at 06:37 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smapsrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `baptismal_records`
--

DROP TABLE IF EXISTS `baptismal_records`;
CREATE TABLE IF NOT EXISTS `baptismal_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `child_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `baptism_date` date NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `godparents` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `priest_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `baptism_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptismal_records`
--

INSERT INTO `baptismal_records` (`id`, `child_name`, `dob`, `birth_place`, `gender`, `baptism_date`, `father_name`, `mother_name`, `address`, `godparents`, `priest_name`, `baptism_time`) VALUES
(2, 'Jaylord Suazo', '2002-08-10', 'Nasipit', 'Female', '2025-04-15', 'Joel', 'Rose', 'Camagong', 'Hanerie,Lia', 'Fr. Leo', '10:49:00'),
(3, 'Reina Joyce P. Suazo', '2002-08-10', 'Malitbog', 'Female', '2025-04-16', 'Joel', 'Rosita', 'Nasipit', 'Hanerie', 'Fr. Leo', '10:00:00'),
(6, 'Zach', '2004-08-08', 'Nasipit', 'Male', '2025-10-08', 'Vito', 'Lea', 'Japan', 'Renzo,Ria', 'Fr. Leo', '09:56:00'),
(7, 'James Roel', '1991-07-21', 'Malitbog', 'Male', '1991-10-09', 'Joel', 'Rose', 'Nasipit', 'Dina, Franco', 'Fr.Gab', '10:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `communion_records`
--

DROP TABLE IF EXISTS `communion_records`;
CREATE TABLE IF NOT EXISTS `communion_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `participant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `school_grade` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `communion_date` date NOT NULL,
  `priest_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communion_records`
--

INSERT INTO `communion_records` (`id`, `participant_name`, `dob`, `gender`, `school_grade`, `guardian_name`, `contact`, `communion_date`, `priest_name`, `address`) VALUES
(1, 'Reina Joyce Peramide Suazo', '2002-08-10', 'Female', 'SMCC College', 'Isabel Abanes', '09588460799', '2010-08-09', 'Fr. Leo', 'Camagong'),
(2, 'Sheena Rose Suazo', '2010-10-09', 'Female', 'Saint Michael College of Caraga', 'James Ruel Suazo', '09674833995', '2024-09-08', 'Fr. Leo', 'Camagong'),
(3, 'Donna Mae', '2002-05-27', 'Female', ' Japan Philippine Institute of Technology', 'Juan', '096945994367', '2025-02-02', 'Fr. Leo', 'Mactan, Cebu'),
(5, 'Rosita Peramide Suazo', '1961-05-25', 'Female', 'Saint Michael Institute', 'Ben', 'Mila', '1975-06-06', 'Fr. Amoroso', 'Nasipit');

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_records`
--

DROP TABLE IF EXISTS `confirmation_records`;
CREATE TABLE IF NOT EXISTS `confirmation_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `child_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `confirmation_date` date NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `godparents` text NOT NULL,
  `priest_name` varchar(255) NOT NULL,
  `confirmation_time` time NOT NULL,
  `certificate_number` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `confirmation_records`
--

INSERT INTO `confirmation_records` (`id`, `child_name`, `dob`, `birth_place`, `gender`, `confirmation_date`, `father_name`, `mother_name`, `address`, `contact`, `godparents`, `priest_name`, `confirmation_time`, `certificate_number`, `created_at`, `updated_at`) VALUES
(1, 'Reina Joyce Suazo', '2002-08-10', 'NASIPIT', 'Female', '2015-01-02', 'JOEL', 'ROSE', 'JUANGON', '098754367899', 'Leon', 'Fr. Celo', '09:00:00', NULL, '2025-04-27 03:01:26', '2025-04-27 13:22:31'),
(2, 'Maraiah Queen Arceta', '2001-01-27', 'Cebu City', 'Female', '2014-09-09', 'Dick Arceta', 'Malou Arceta', 'Lapu-Lapu,Cebu City', '09588460799', 'Direk Lauren,cecel', 'Fr. Leo', '10:00:00', NULL, '2025-04-27 03:29:22', '2025-04-27 09:54:10'),
(3, 'José Protasio Rizal Mercado y Alonso Realonda', '1861-06-19', 'Calamba, Laguna', 'Male', '1861-06-21', 'Francisco Engracio Rizal Mercado y Alejandro', 'eodora Alonso Realonda y Quintos', 'Calamba, Laguna', '0943496956947', 'Fr. Pedro Casanas', 'Rev. Rufino Collantes', '10:00:00', NULL, '2025-04-27 13:26:26', '2025-04-27 13:26:26'),
(4, 'Joel Gantala  Suazo', '1961-10-20', 'Cagayan De Oro', 'Male', '1979-12-02', 'Unofredo', 'Arcadia', 'Nasipit ', '095945943954', 'Diosdado,Lea', 'Fr. Amoroso ', '10:46:00', NULL, '2025-04-28 01:46:56', '2025-04-28 01:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_records`
--

DROP TABLE IF EXISTS `marriage_records`;
CREATE TABLE IF NOT EXISTS `marriage_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `groom_name` varchar(255) NOT NULL,
  `groom_dob` date NOT NULL,
  `groom_address` varchar(255) NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `bride_dob` date NOT NULL,
  `bride_address` varchar(255) NOT NULL,
  `marriage_date` date NOT NULL,
  `marriage_time` time NOT NULL,
  `priest_name` varchar(255) NOT NULL,
  `witnesses` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `marriage_records`
--

INSERT INTO `marriage_records` (`id`, `groom_name`, `groom_dob`, `groom_address`, `bride_name`, `bride_dob`, `bride_address`, `marriage_date`, `marriage_time`, `priest_name`, `witnesses`, `location`) VALUES
(1, 'Jose P. Rizal', '1861-06-19', 'Calamba', 'Josephine Bracken', '1876-08-09', 'Hong Kong', '1896-12-30', '10:00:00', 'Fr. Victor', 'Don Charr', 'Dapitan'),
(2, 'Michael', '2003-11-08', 'Manila', 'Aila', '2001-01-27', 'Cebu', '2025-04-01', '10:50:00', 'Fr. Charrr', 'Mekaya Jellies', 'SMAP'),
(4, 'Cole', '2002-01-01', 'Bohol', 'Molai', '2002-02-05', 'Batangas', '2025-02-14', '09:57:00', 'Fr. Victor ', 'Bloom', 'SMAP ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'smapsrms2025');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
