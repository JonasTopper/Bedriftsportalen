-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18. Mar, 2024 10:31 AM
-- Tjener-versjon: 10.4.32-MariaDB
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
-- Tabellstruktur for tabell `ansatte`
--

CREATE TABLE `ansatte` (
  `ansatte_id` int(11) NOT NULL,
  `ansatte_etternavn` varchar(30) NOT NULL,
  `ansatte_fornavn` varchar(30) NOT NULL,
  `ansatte_stilling` varchar(40) NOT NULL,
  `ansatte_kontakt_person` tinyint(4) NOT NULL,
  `ansatte_tlf_nr` varchar(15) NOT NULL,
  `ansatte_epost` varchar(250) NOT NULL,
  `ansatte_bedrift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bedrifter`
--

CREATE TABLE `bedrifter` (
  `bedrift_id` int(11) NOT NULL,
  `bedrift_navn` varchar(45) NOT NULL,
  `bedrift_adresse` varchar(45) NOT NULL,
  `bedrift_org_form` varchar(45) NOT NULL,
  `bedrift_reg_dato` date NOT NULL,
  `bedrift_org_nr` varchar(45) NOT NULL,
  `bedrift_beskrivelse` varchar(250) DEFAULT NULL,
  `bedrift_post_nr` varchar(4) NOT NULL,
  `bedrift_post_sted` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bedrifter_innlogging`
--

CREATE TABLE `bedrifter_innlogging` (
  `bedrifter_id` int(11) NOT NULL,
  `bedrifter_brukernavn` varchar(45) NOT NULL,
  `bedrifter_passord` varchar(18) NOT NULL,
  `bedrifter_is_admin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `postnummer`
--

CREATE TABLE `postnummer` (
  `postnr` varchar(4) NOT NULL,
  `poststed` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ansatte`
--
ALTER TABLE `ansatte`
  ADD PRIMARY KEY (`ansatte_id`),
  ADD UNIQUE KEY `ansatte_id_UNIQUE` (`ansatte_id`),
  ADD KEY `bedrift_id_idx` (`ansatte_bedrift_id`);

--
-- Indexes for table `bedrifter`
--
ALTER TABLE `bedrifter`
  ADD PRIMARY KEY (`bedrift_id`),
  ADD UNIQUE KEY `bedrift_id_UNIQUE` (`bedrift_id`),
  ADD UNIQUE KEY `bedrift_navn_UNIQUE` (`bedrift_navn`),
  ADD KEY `postnr_kobling_idx` (`bedrift_post_nr`);

--
-- Indexes for table `bedrifter_innlogging`
--
ALTER TABLE `bedrifter_innlogging`
  ADD PRIMARY KEY (`bedrifter_id`),
  ADD UNIQUE KEY `brukere_id_UNIQUE` (`bedrifter_id`),
  ADD UNIQUE KEY `bedrifter_brukernavn_UNIQUE` (`bedrifter_brukernavn`);

--
-- Indexes for table `postnummer`
--
ALTER TABLE `postnummer`
  ADD PRIMARY KEY (`postnr`),
  ADD UNIQUE KEY `postnr_UNIQUE` (`postnr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ansatte`
--
ALTER TABLE `ansatte`
  MODIFY `ansatte_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bedrifter`
--
ALTER TABLE `bedrifter`
  MODIFY `bedrift_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bedrifter_innlogging`
--
ALTER TABLE `bedrifter_innlogging`
  MODIFY `bedrifter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `ansatte`
--
ALTER TABLE `ansatte`
  ADD CONSTRAINT `bedrift_id` FOREIGN KEY (`ansatte_bedrift_id`) REFERENCES `bedrifter` (`bedrift_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Begrensninger for tabell `bedrifter`
--
ALTER TABLE `bedrifter`
  ADD CONSTRAINT `postnr_kobling` FOREIGN KEY (`bedrift_post_nr`) REFERENCES `postnummer` (`postnr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Begrensninger for tabell `bedrifter_innlogging`
--
ALTER TABLE `bedrifter_innlogging`
  ADD CONSTRAINT `bedrift_navn` FOREIGN KEY (`bedrifter_brukernavn`) REFERENCES `bedrifter` (`bedrift_navn`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
