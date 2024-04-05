-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05. Apr, 2024 11:16 AM
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
-- Tabellstruktur for tabell `ansatte_tb`
--

CREATE TABLE `ansatte_tb` (
  `ansatte_id` bigint(20) UNSIGNED NOT NULL,
  `ansatte_etternavn` varchar(30) NOT NULL,
  `ansatte_fornavn` varchar(30) NOT NULL,
  `ansatte_stilling` varchar(40) NOT NULL,
  `ansatte_kontakt_person` tinyint(1) NOT NULL,
  `ansatte_tlf_nr` varchar(15) NOT NULL,
  `ansatte_epost` varchar(250) NOT NULL,
  `ansatte_bedrifts_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `ansatte_tb`
--

INSERT INTO `ansatte_tb` (`ansatte_id`, `ansatte_etternavn`, `ansatte_fornavn`, `ansatte_stilling`, `ansatte_kontakt_person`, `ansatte_tlf_nr`, `ansatte_epost`, `ansatte_bedrifts_id`) VALUES
(3, 'Fortnite', 'Sjo', 'Driftstekniker', 0, '999995', 'ninja@epost.no', 1),
(4, 'Topper', 'Jonas', 'Lærling', 0, '94055734', 'Jonas.topper@gmail.com', 1),
(5, 'Dehnhardt Maehlum', 'Oliver', 'Junior Utvikler', 0, '48474335', 'oliverdehnhardtmaehlum@gmail.com', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bedrifter_innlogging_tb`
--

CREATE TABLE `bedrifter_innlogging_tb` (
  `bedrifter_id` bigint(20) UNSIGNED NOT NULL,
  `bedrifter_brukernavn` varchar(45) NOT NULL,
  `bedrifter_passord` varchar(18) NOT NULL,
  `bedrifter_is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bedrifter_tb`
--

CREATE TABLE `bedrifter_tb` (
  `bedrift_id` bigint(20) UNSIGNED NOT NULL,
  `bedrift_navn` varchar(45) NOT NULL,
  `bedrift_adresse` varchar(45) NOT NULL,
  `bedrift_org_form` varchar(45) NOT NULL,
  `bedrift_reg_dato` date DEFAULT NULL,
  `bedrift_org_nr` varchar(45) NOT NULL,
  `bedrift_beskrivelse` varchar(250) DEFAULT NULL,
  `bedrift_post_nr` varchar(4) NOT NULL,
  `bedrift_post_sted` varchar(45) NOT NULL,
  `bedrift_logo_filepath` varchar(100) DEFAULT NULL,
  `bedrift_er_kunde` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `bedrifter_tb`
--

INSERT INTO `bedrifter_tb` (`bedrift_id`, `bedrift_navn`, `bedrift_adresse`, `bedrift_org_form`, `bedrift_reg_dato`, `bedrift_org_nr`, `bedrift_beskrivelse`, `bedrift_post_nr`, `bedrift_post_sted`, `bedrift_logo_filepath`, `bedrift_er_kunde`) VALUES
(1, 'Aplia', ' Centrumsgården Torggata 8', 'AS', '2023-06-13', '998850371 ', NULL, '3724', 'Skien', NULL, 0),
(2, 'Edge Branding', 'Dokkvegen 11', 'AS', '2018-03-23', 'AS', NULL, '3920', 'Porsgrunn', NULL, 0),
(9, 'JonasShip', 'Tullevegen 39', 'aS', NULL, '989126377', NULL, '3920', 'Porsgrunn', NULL, 0),
(11, 'Penis', 'Penisvegen 39', 'AS', NULL, '45543543542', NULL, '3920', 'Porsgrunn', NULL, 0),
(12, 'Gatship', 'Tullevegen 39', 'AS', NULL, '86349753434', NULL, '3920', 'Porsgrunn', NULL, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `postinformasjon_tb`
--

CREATE TABLE `postinformasjon_tb` (
  `postnummer` varchar(4) NOT NULL,
  `poststed` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `postinformasjon_tb`
--

INSERT INTO `postinformasjon_tb` (`postnummer`, `poststed`) VALUES
('3724', 'Skien'),
('3920', 'Porsgrunn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ansatte_tb`
--
ALTER TABLE `ansatte_tb`
  ADD PRIMARY KEY (`ansatte_id`),
  ADD KEY `bedriftsid index` (`ansatte_bedrifts_id`);

--
-- Indexes for table `bedrifter_innlogging_tb`
--
ALTER TABLE `bedrifter_innlogging_tb`
  ADD PRIMARY KEY (`bedrifter_id`),
  ADD KEY `bedrifter_brukernavn` (`bedrifter_brukernavn`);

--
-- Indexes for table `bedrifter_tb`
--
ALTER TABLE `bedrifter_tb`
  ADD PRIMARY KEY (`bedrift_id`),
  ADD UNIQUE KEY `bedrift_logo_filepath` (`bedrift_logo_filepath`),
  ADD KEY `bedrift_post_nr` (`bedrift_post_nr`),
  ADD KEY `bedrift_navn` (`bedrift_navn`);

--
-- Indexes for table `postinformasjon_tb`
--
ALTER TABLE `postinformasjon_tb`
  ADD PRIMARY KEY (`postnummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ansatte_tb`
--
ALTER TABLE `ansatte_tb`
  MODIFY `ansatte_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bedrifter_innlogging_tb`
--
ALTER TABLE `bedrifter_innlogging_tb`
  MODIFY `bedrifter_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bedrifter_tb`
--
ALTER TABLE `bedrifter_tb`
  MODIFY `bedrift_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `ansatte_tb`
--
ALTER TABLE `ansatte_tb`
  ADD CONSTRAINT `FK_ansatte_bedriftsid` FOREIGN KEY (`ansatte_bedrifts_id`) REFERENCES `bedrifter_tb` (`bedrift_id`) ON DELETE CASCADE;

--
-- Begrensninger for tabell `bedrifter_innlogging_tb`
--
ALTER TABLE `bedrifter_innlogging_tb`
  ADD CONSTRAINT `FK_bedrifts_innlogging` FOREIGN KEY (`bedrifter_brukernavn`) REFERENCES `bedrifter_tb` (`bedrift_navn`);

--
-- Begrensninger for tabell `bedrifter_tb`
--
ALTER TABLE `bedrifter_tb`
  ADD CONSTRAINT `fk_postnr` FOREIGN KEY (`bedrift_post_nr`) REFERENCES `postinformasjon_tb` (`postnummer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
