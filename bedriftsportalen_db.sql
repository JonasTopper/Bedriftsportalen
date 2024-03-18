-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 12:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bedriftsportalen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ansatte`
--

CREATE TABLE `ansatte` (
  `ansatte_id` bigint(20) UNSIGNED NOT NULL,
  `ansatte_etternavn` varchar(30) NOT NULL,
  `ansatte_fornavn` varchar(30) NOT NULL,
  `ansatte_stilling` varchar(40) NOT NULL,
  `ansatte_kontakt_person` tinyint(1) NOT NULL,
  `ansatte_tlf_nr` varchar(15) NOT NULL,
  `ansatte_epost` varchar(250) NOT NULL,
  `ansatte_bedrifts_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bedrifter`
--

CREATE TABLE `bedrifter` (
  `bedrift_id` bigint(20) UNSIGNED NOT NULL,
  `bedrift_navn` varchar(45) NOT NULL,
  `bedrift_adresse` varchar(45) NOT NULL,
  `bedrift_org_form` varchar(45) NOT NULL,
  `bedrift_reg_dato` date NOT NULL,
  `bedrift_org_nr` varchar(45) NOT NULL,
  `bedrift_beskrivelse` varchar(250) DEFAULT NULL,
  `bedrift_post_nr` varchar(4) NOT NULL,
  `bedrift_post_sted` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bedrifter`
--

INSERT INTO `bedrifter` (`bedrift_id`, `bedrift_navn`, `bedrift_adresse`, `bedrift_org_form`, `bedrift_reg_dato`, `bedrift_org_nr`, `bedrift_beskrivelse`, `bedrift_post_nr`, `bedrift_post_sted`) VALUES
(1, 'Aplia', ' Centrumsgården Torggata 8', 'AS', '2023-06-13', '998850371 ', NULL, '3724', 'Skien');

-- --------------------------------------------------------

--
-- Table structure for table `bedrifter_innlogging`
--

CREATE TABLE `bedrifter_innlogging` (
  `bedrifter_id` bigint(20) UNSIGNED NOT NULL,
  `bedrifter_brukernavn` varchar(45) NOT NULL,
  `bedrifter_passord` varchar(18) NOT NULL,
  `bedrifter_is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postinformasjon`
--

CREATE TABLE `postinformasjon` (
  `postnummer` varchar(4) NOT NULL,
  `poststed` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postinformasjon`
--

INSERT INTO `postinformasjon` (`postnummer`, `poststed`) VALUES
('3724', 'Skien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ansatte`
--
ALTER TABLE `ansatte`
  ADD PRIMARY KEY (`ansatte_id`),
  ADD KEY `bedriftsid index` (`ansatte_bedrifts_id`);

--
-- Indexes for table `bedrifter`
--
ALTER TABLE `bedrifter`
  ADD PRIMARY KEY (`bedrift_id`),
  ADD KEY `bedrift_post_nr` (`bedrift_post_nr`),
  ADD KEY `bedrift_navn` (`bedrift_navn`);

--
-- Indexes for table `bedrifter_innlogging`
--
ALTER TABLE `bedrifter_innlogging`
  ADD PRIMARY KEY (`bedrifter_id`),
  ADD KEY `bedrifter_brukernavn` (`bedrifter_brukernavn`);

--
-- Indexes for table `postinformasjon`
--
ALTER TABLE `postinformasjon`
  ADD PRIMARY KEY (`postnummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ansatte`
--
ALTER TABLE `ansatte`
  MODIFY `ansatte_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bedrifter`
--
ALTER TABLE `bedrifter`
  MODIFY `bedrift_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bedrifter_innlogging`
--
ALTER TABLE `bedrifter_innlogging`
  MODIFY `bedrifter_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ansatte`
--
ALTER TABLE `ansatte`
  ADD CONSTRAINT `FK_ansatte_bedriftsid` FOREIGN KEY (`ansatte_bedrifts_id`) REFERENCES `bedrifter` (`bedrift_id`);

--
-- Constraints for table `bedrifter`
--
ALTER TABLE `bedrifter`
  ADD CONSTRAINT `fk_postnr` FOREIGN KEY (`bedrift_post_nr`) REFERENCES `postinformasjon` (`postnummer`);

--
-- Constraints for table `bedrifter_innlogging`
--
ALTER TABLE `bedrifter_innlogging`
  ADD CONSTRAINT `FK_bedrifts_innlogging` FOREIGN KEY (`bedrifter_brukernavn`) REFERENCES `bedrifter` (`bedrift_navn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
