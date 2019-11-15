-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2011 at 06:36 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biodict_tiko`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_config`
--

CREATE TABLE IF NOT EXISTS `app_config` (
  `app_key` varchar(25) NOT NULL,
  `app_name` varchar(50) NOT NULL,
  `app_owner` varchar(50) DEFAULT NULL,
  `id_user` varchar(10) NOT NULL,
  `app_logo` blob,
  `btn_admin_vis` tinyint(4) NOT NULL DEFAULT '1',
  `logo_vis` tinyint(4) NOT NULL DEFAULT '1',
  `max_upload_size` int(11) DEFAULT '100000',
  `app_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`app_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_config`
--

INSERT INTO `app_config` (`app_key`, `app_name`, `app_owner`, `id_user`, `app_logo`, `btn_admin_vis`, `logo_vis`, `max_upload_size`, `app_url`) VALUES
('KMSBIO2011043085659115066', 'Kamus Anatomi Tubuh Manusia', 'Adi Widyawan', 'ADMTBD0001', NULL, 0, 0, 50000, 'http://tibandung.com');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE IF NOT EXISTS `app_users` (
  `id_user` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `added` datetime NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id_user`, `username`, `password`, `email`, `added`, `active`) VALUES
('ADMTBD0001', 'adiw', '68f1d2563af9ea3c57061dcd5e42fb4f', 'day4die@gmail.com', '2011-05-03 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `id_word` varchar(15) NOT NULL,
  `word` text NOT NULL,
  `last_update` datetime NOT NULL,
  `author` varchar(50) NOT NULL,
  `word_origin` varchar(30) DEFAULT NULL,
  `definition` text NOT NULL,
  `suplement` text,
  `references` text,
  `image` blob,
  PRIMARY KEY (`id_word`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `words`
--

