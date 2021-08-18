-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 18 Août 2021 à 12:11
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `agent_tracking`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `Noms` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(200) NOT NULL,
  UNIQUE KEY `Noms` (`Noms`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `attendance_arrival`
--

CREATE TABLE IF NOT EXISTS `attendance_arrival` (
  `Employee_ID` varchar(30) NOT NULL,
  `Names` varchar(30) NOT NULL,
  `Function` varchar(30) NOT NULL,
  `Departement` varchar(30) NOT NULL,
  `Heure` varchar(30) NOT NULL,
  `Date` varchar(30) NOT NULL,
  PRIMARY KEY (`Heure`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `attendance_exit`
--

CREATE TABLE IF NOT EXISTS `attendance_exit` (
  `Employee_ID` varchar(30) NOT NULL,
  `Names` varchar(30) NOT NULL,
  `Function` varchar(30) NOT NULL,
  `Departement` varchar(30) NOT NULL,
  `Heure` varchar(30) NOT NULL,
  `Date` varchar(30) NOT NULL,
  PRIMARY KEY (`Heure`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `card_swap`
--

CREATE TABLE IF NOT EXISTS `card_swap` (
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `card_uid` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Contenu de la table `card_swap`
--

INSERT INTO `card_swap` (`timestamp`, `card_uid`, `status`) VALUES
('2021-08-18 10:32:52', '62984242', 1),
('2021-08-18 10:32:53', '62984242', 1),
('2021-08-18 10:32:59', '204820742955', 1),
('2021-08-18 11:55:05', '629842422', 1),
('2021-08-18 12:10:27', '4654646', 1),
('2021-08-18 12:10:50', '204820742955', 1);

-- --------------------------------------------------------

--
-- Structure de la table `config`
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

--
-- Contenu de la table `config`
--

INSERT INTO `config` (`alarm/speech`, `heure-arrivee-a`, `heure-arrivee-b`, `heure-sortie-a`, `heure-sortie-b`, `heure-pause-a`, `heure-pause-b`) VALUES
('alarm', '07:45:00', '09:45:00', '15:00:00', '18:00:00', '12:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `id_tag_record`
--

CREATE TABLE IF NOT EXISTS `id_tag_record` (
  `CARD_UID` varchar(30) DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  `Employee_ID` varchar(30) DEFAULT NULL,
  `Names` varchar(30) DEFAULT NULL,
  `Function` varchar(100) NOT NULL,
  `Departement` varchar(100) DEFAULT NULL,
  UNIQUE KEY `id` (`CARD_UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `id_tag_record`
--

INSERT INTO `id_tag_record` (`CARD_UID`, `image`, `Employee_ID`, `Names`, `Function`, `Departement`) VALUES
('204820742955 ', 'img/profile/adminadmin_img_5815(2).jpg', 'ADM924724', 'Admin Admin', 'Admin Chief', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `logs`
--

INSERT INTO `logs` (`id`, `Roll_Number`, `Names`, `Profiles`, `Date`, `Time`, `TimeStamp`) VALUES
(1, 'SE/TT/2008011', 'BENJAMIN WIL PALUKU', 'Telecom', '2020-10-19', '14:03:43', '2020-10-19 12:03:43'),
(2, 'SE/IT/200806', 'ANSIMA CIBALINDA ELVIS', 'Hi-TECH', '2020-10-19', '14:03:52', '2020-10-19 12:03:52');

-- --------------------------------------------------------

--
-- Structure de la table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `Noms` varchar(50) DEFAULT NULL,
  `Mail` varchar(30) DEFAULT NULL,
  `Telephone` varchar(30) NOT NULL,
  `Function/entreprise` varchar(50) DEFAULT NULL,
  `NumeroIdentite` varchar(30) NOT NULL,
  `Motif` varchar(30) NOT NULL,
  `Personnes_A_Voir` varchar(30) NOT NULL,
  `Heure` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  PRIMARY KEY (`Personnes_A_Voir`,`Heure`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
