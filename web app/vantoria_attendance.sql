-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 01:00 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `UID` int(30) NOT NULL AUTO_INCREMENT,
  `Noms` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(200) NOT NULL,
  `Company` varchar(30) NOT NULL,
  `Join_Date` varchar(30) NOT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `UID` (`UID`),
  UNIQUE KEY `UID_2` (`UID`),
  UNIQUE KEY `UID_3` (`UID`),
  UNIQUE KEY `Noms` (`Noms`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_arrival`
--

CREATE TABLE IF NOT EXISTS `attendance_arrival` (
  `Employee ID` varchar(30) DEFAULT NULL,
  `Names` varchar(30) DEFAULT NULL,
  `FUNCTION` varchar(30) NOT NULL,
  `Departement` varchar(20) DEFAULT NULL,
  `Heure` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_exit`
--

CREATE TABLE IF NOT EXISTS `attendance_exit` (
  `Employee ID` varchar(30) DEFAULT NULL,
  `Names` varchar(30) DEFAULT NULL,
  `FUNCTION` varchar(30) NOT NULL,
  `Departement` varchar(20) DEFAULT NULL,
  `Heure` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `alarm/speech` varchar(30) NOT NULL,
  `heure-arrivee-a` varchar(30) NOT NULL,
  `heure-arrivee-b` varchar(30) NOT NULL,
  `heure-sortie-a` varchar(30) NOT NULL,
  `heure-sortie-b` varchar(30) NOT NULL,
  `heure-pause-a` varchar(30) NOT NULL,
  `heure-pause-b` varchar(30) NOT NULL,
  PRIMARY KEY (`alarm/speech`,`heure-arrivee-a`,`heure-arrivee-b`,`heure-sortie-a`,`heure-sortie-b`,`heure-pause-a`,`heure-pause-b`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `id_tag_record`
--

CREATE TABLE IF NOT EXISTS `id_tag_record` (
  `CARD UID` varchar(30) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `Employee ID` varchar(30) DEFAULT NULL,
  `Names` varchar(30) DEFAULT NULL,
  `FUNCTION` varchar(30) NOT NULL,
  `Departement` varchar(20) DEFAULT NULL,
  `EXPIRY DATE` varchar(100) NOT NULL,
  `Employee STATUS` varchar(15) NOT NULL,
  UNIQUE KEY `id` (`CARD UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `id_tag_record`
--

INSERT INTO `id_tag_record` (`CARD UID`, `image`, `Employee ID`, `Names`, `FUNCTION`, `Departement`, `EXPIRY DATE`, `Employee STATUS`) VALUES
('000002512467520', '', 'SE/TT/2008011', 'BENJAMIN WIL PALUKU', '', 'Telecom', '', ''),
('000000107012259', '', 'SE/IT/200806', 'ANSIMA CIBALINDA ELVIS', '', 'Hi-TECH', '', ''),
('2512467520', '', '201750122', 'KENAYA_LUNE MASIKA', '', 'Y3/COT/D', '', ''),
('107012259', '', 'SET/IT/200806', 'ANSIMA CIBALINDA ELVIS', '', 'Elo and IT dept', '', ''),
('1871478220', '', '201650334', 'JUSTIN MASIMANGO', '', 'Y2/ETT/D', '', ''),
('1551363559', '', '201510100', 'ANABELLA MUNAMAME', '', 'Y3/EBS/A/D', '', ''),
('83923405265', '', '201650201', 'ALICIA KAREKE', '', 'Y1/ETT/D', '', ''),
('1070122594', '', '201750233', 'ELVIS KANYABO', '', 'Y1/CS/E', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Roll_Number` varchar(30) DEFAULT NULL,
  `Names` varchar(30) DEFAULT NULL,
  `Profiles` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `TimeStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Roll_Number` (`Roll_Number`,`Names`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `Roll_Number`, `Names`, `Profiles`, `Date`, `Time`, `TimeStamp`) VALUES
(1, 'SE/TT/2008011', 'BENJAMIN WIL PALUKU', 'Telecom', '2020-10-19', '14:03:43', '2020-10-19 12:03:43'),
(2, 'SE/IT/200806', 'ANSIMA CIBALINDA ELVIS', 'Hi-TECH', '2020-10-19', '14:03:52', '2020-10-19 12:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `Noms` varchar(50) DEFAULT NULL,
  `Mail` varchar(30) DEFAULT NULL,
  `Telephone` varchar(30) NOT NULL,
  `Function/entreprise` varchar(50) DEFAULT NULL,
  `Numero PIece d'identite` varchar(30) NOT NULL,
  `Heure` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
