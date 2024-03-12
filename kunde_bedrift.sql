-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 08:58 AM
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
-- Table structure for table `kunde_bedrift`
--

CREATE TABLE `kunde_bedrift` (
  `kunde_id` int(11) NOT NULL,
  `navn` varchar(50) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `postnummer` varchar(4) NOT NULL,
  `poststed` varchar(30) NOT NULL,
  `org_form` varchar(20) NOT NULL,
  `reg_dato` datetime NOT NULL,
  `org_nr` int(20) NOT NULL,
  `beskrivelse` varchar(250) NOT NULL,
  `kunde_hos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kunde_bedrift`
--
ALTER TABLE `kunde_bedrift`
  ADD PRIMARY KEY (`kunde_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kunde_bedrift`
--
ALTER TABLE `kunde_bedrift`
  MODIFY `kunde_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
