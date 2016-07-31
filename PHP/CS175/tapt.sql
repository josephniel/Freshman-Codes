-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2015 at 02:30 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tapt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `first_name`, `last_name`, `type`) VALUES
(1, 'admin', 'HHrjaW/l57kcvzdgYmzRYQ==', 'Main', 'Admin', 1),
(2, 'another_admin', 'd2P9NQ/YtG1M03GBMxTBBw==', 'Another', 'Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `analyst`
--

CREATE TABLE IF NOT EXISTS `analyst` (
  `id` int(11) NOT NULL,
  `dwng_id` char(6) NOT NULL,
  `my_request_id` varchar(100) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analyst`
--

INSERT INTO `analyst` (`id`, `dwng_id`, `my_request_id`, `first_name`, `last_name`, `email_address`) VALUES
(1, 'NZRR6R', 'Aileen.Grueso', 'Aileen C', 'Grueso', 'aileen.grueso@hpe.com'),
(2, 'QZ450G', 'A.Monteras', 'Alkin Raymond M', 'Monteras', 'alkin-raymond.monteras@hpe.com'),
(3, 'SZQ4R6', 'A.Constantino', 'Allen Joseph M.', 'Constantino', 'allen-joseph-m.constantino@hpe.com'),
(4, 'MZFLZY', 'Arianne-Joy.Candor', 'Arianne Joy A', 'Candor', 'arianne-joy.candor@hpe.com'),
(5, 'LZWJY0', 'Charles.Bonotan-Jr', 'Charles A', 'Bonotan Jr', 'charles.bonotan-jr@hpe.com'),
(6, 'MZ5CNQ', 'Charmine.Meimban', 'Charmine', 'Meimban', 'charmine.meimban@hpe.com'),
(7, 'QZBMG2', 'Crizcel.Panogao', 'Crizcel F', 'Panogao', 'crizcel.panogao@hpe.com'),
(9, 'BZT9F1', 'D.Camacho', 'Dennis Laurence F', 'Camacho', 'denscamacho@hpe.com'),
(10, 'VZRKW8', 'Enrico.Ebuenga', 'Enrico T.', 'Ebuenga', 'enrico-t.ebuenga@hpe.com'),
(11, 'KZMZNL', 'Gerald-John.Ecleo', 'Gerald John', 'Ecleo', 'gerald-john.ecleo@hpe.com'),
(12, 'KZCD3T', 'Guillermo.RosalesIII', 'Guillermo', 'Rosales III', 'guillermo.par.rosales-iii@hpe.com'),
(13, 'DZWY73', 'Jane.Macasa', 'Jane G', 'Macasa', 'jane.macasa@hpe.com'),
(14, 'JZGY1F', 'Jeffrey.Casar', 'Jeffrey A.', 'Casar', 'jeffrey-a.casar@hpe.com'),
(15, 'PZNN2L', 'Jeric.DelaCruz', 'Jeric E.', 'Dela Cruz', 'jeric-e.dela-cruz@hpe.com'),
(16, 'LZ30VP', 'Jexer-Jek.Rolle', 'Jexer Jek B.', 'Rolle', 'jexer-jek-b.rolle@hpe.com'),
(17, 'XZ6551', 'Jillianne.Villanueva', 'Jillianne', 'Villanueva', 'jillianne.n.villanueva@hpe.com'),
(18, 'GZM5B5', 'John-Paul.Sotoya', 'John Paul', 'Sotoya', 'john-paul.sotoya@hpe.com'),
(19, '---001', '-', 'John Rey', 'Abad', 'john-rey.abad@hpe.com'),
(20, '---002', '-', 'Jondel', 'De Castro', 'jondel.de-castro@hpe.com'),
(21, 'qwerty', 'qwerty', 'Joseph Niel', 'Tuazon', 'josephnieltuazon@yahoo.com'),
(22, 'WZS61Q', 'Joseph-Neal.Lacatan', 'Joseph Neal M', 'Lacatan', 'joseph-neal.lacatan@hpe.com'),
(23, 'VZB082', 'Joseph-Noel.Padilla', 'Joseph Noel', 'Padilla', 'joseph-noel.padilla@hpe.com'),
(24, 'VZ942N', 'Junie.Danguecan', 'Junie', 'Danguecan', 'junie.danguecan@hpe.com'),
(25, 'ZZ5S1N', 'Katherine.Bonilla', 'Katherine M', 'Bonilla', 'katherine.bonilla@hpe.com'),
(26, 'MZFYVQ', 'Manilyn.Sia', 'Manilyn V', 'Sia', 'manilyn.sia@hpe.com'),
(27, 'FZKHYT', 'M.Fronda', 'Manuel Benedict R', 'Fronda', 'manuel-benedict.fronda@hpe.com'),
(28, 'LZ8C8T', 'M.Antonio', 'Maria Cecilia', 'Antonio', 'maria.cec.antonio@hpe.com'),
(29, 'CZRFF9', 'Maria-Nitalia.Dayrit', 'Maria Nitalia D.', 'Dayrit', 'maria-nitalia-d.dayrit@hpe.com'),
(30, 'PZDJSK', 'Maricris.Salvador', 'Maricris C.', 'Salvador', 'maricris-c.salvador@hpe.com'),
(31, 'DZ0PP6', 'Mary-Grace.Manahan', 'Mary Grace M', 'Manahan', 'mary-grace.manahan@hpe.com'),
(32, 'KZXCHV', 'Michael.Lucila', 'Michael', 'Lucila', 'michael.lucila@hpe.com'),
(33, 'BZQLQ3', 'Myraquel.Flores', 'Myraquel G', 'Flores', 'myraquel.flores@hpe.com'),
(34, 'HZ1X92', 'Neil-Aldrin.Penales', 'Neil Aldrin P', 'Penales', 'neil.penales@hpe.com'),
(35, 'XZ9RZ8', 'P.Desiderio', 'Patricia Marie C', 'Desiderio', 'patricia-marie.desiderio@hpe.com'),
(36, 'HZK966', 'P.Oliver', 'Paul', 'Oliver', 'paul.oliver@hpe.com'),
(37, 'TZV1Z1', 'Ralp.Rodil', 'Ralp', 'Rodil', 'ralp.rodil@hpe.com'),
(38, 'FZFPGN', 'Raquel.Ramos', 'Raquel D.', 'Ramos', 'raquel-d.ramos@hpe.com'),
(39, 'DZG9QP', 'Raymond.Ababa', 'Raymond', 'Ababa', 'raymond-b.ababa@hpe.com'),
(40, 'JZ6326', 'Vanjo.Perez', 'Vanjo T.', 'Perez', 'vanjo-t.perez@hpe.com');

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE IF NOT EXISTS `assign` (
  `id` int(11) NOT NULL,
  `line_item` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`id`, `line_item`, `review`, `progress`, `total`) VALUES
(1, 2, 2, 5, 9),
(2, 2, 2, 5, 9),
(3, 3, 2, 4, 9),
(4, 3, 2, 4, 9),
(5, 3, 2, 4, 9),
(6, 3, 2, 4, 9),
(7, 3, 2, 1, 6),
(9, 3, 2, 1, 6),
(10, 3, 2, 1, 6),
(11, 2, 2, 2, 6),
(12, 3, 2, 1, 6),
(13, 3, 2, 1, 6),
(14, 2, 2, 2, 6),
(15, 2, 2, 2, 6),
(16, 2, 2, 2, 6),
(17, 2, 2, 2, 6),
(18, 2, 2, 2, 6),
(19, 2, 2, 2, 6),
(20, 2, 2, 2, 6),
(21, 2, 2, 2, 6),
(22, 2, 2, 2, 6),
(23, 2, 2, 2, 6),
(24, 2, 2, 2, 6),
(25, 3, 2, 1, 6),
(26, 3, 2, 1, 6),
(27, 3, 2, 1, 6),
(28, 3, 2, 1, 6),
(29, 3, 2, 1, 6),
(30, 3, 2, 1, 6),
(31, 3, 2, 1, 6),
(32, 3, 2, 1, 6),
(33, 3, 3, 0, 6),
(34, 3, 3, 0, 6),
(35, 3, 3, 0, 6),
(36, 3, 3, 0, 6),
(37, 3, 3, 0, 6),
(38, 3, 3, 0, 6),
(39, 3, 2, 19, 24),
(40, 2, 2, 20, 24);

-- --------------------------------------------------------

--
-- Table structure for table `equation`
--

CREATE TABLE IF NOT EXISTS `equation` (
  `id` char(1) NOT NULL,
  `formula` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equation`
--

INSERT INTO `equation` (`id`, `formula`) VALUES
('K', 'D * 5'),
('L', 'E * 10'),
('M', 'F * 10'),
('N', 'G * 12'),
('O', 'H * 3'),
('P', 'I * 10'),
('Q', 'J * 40'),
('R', 'K + L + M + N + O + P + Q'),
('T', '(((S * 7.5) * 60) * 0.9)'),
('U', 'R / T'),
('V', '(D / 2) + E + F + G + ( H / 2.66 ) + I + J'),
('W', 'V / S');

-- --------------------------------------------------------

--
-- Table structure for table `productivity`
--

CREATE TABLE IF NOT EXISTS `productivity` (
  `id` int(11) NOT NULL,
  `review` int(11) NOT NULL DEFAULT '0',
  `line_item` int(11) NOT NULL DEFAULT '0',
  `progress` int(11) NOT NULL DEFAULT '0',
  `emails` int(11) NOT NULL DEFAULT '0',
  `bulk` int(11) NOT NULL DEFAULT '0',
  `telephone` int(11) NOT NULL DEFAULT '0',
  `install` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productivity`
--

INSERT INTO `productivity` (`id`, `review`, `line_item`, `progress`, `emails`, `bulk`, `telephone`, `install`) VALUES
(1, 2, 0, 8, 7, 7, 7, 7),
(2, 2, 18, 8, 7, 7, 7, 7),
(3, 2, 21, 0, 0, 1, 0, 0),
(4, 2, 0, 0, 0, 0, 0, 0),
(5, 2, 126, 0, 0, 0, 0, 0),
(6, 2, 114, 0, 0, 1, 0, 0),
(7, 2, 18, 0, 1, 0, 0, 0),
(9, 2, 0, 0, 0, 0, 0, 0),
(10, 2, 0, 0, 0, 0, 0, 0),
(11, 2, 27, 57, 56, 56, 56, 56),
(12, 2, 0, 0, 0, 0, 0, 0),
(13, 2, 0, 0, 0, 0, 0, 0),
(14, 2, 105, 21, 21, 22, 21, 21),
(15, 2, 15, 7, 8, 7, 7, 7),
(16, 2, 99, 7, 7, 8, 7, 7),
(17, 2, 0, 0, 0, 0, 0, 0),
(18, 2, 84, 0, 0, 0, 0, 0),
(19, 2, 0, 0, 0, 0, 0, 0),
(20, 2, 0, 0, 0, 0, 0, 0),
(21, 2, 0, 0, 0, 0, 0, 0),
(22, 2, 132, 0, 0, 0, 0, 0),
(23, 2, 111, 0, 0, 0, 0, 0),
(24, 2, 0, 0, 0, 0, 0, 0),
(25, 2, 15, 7, 8, 7, 7, 7),
(26, 2, 0, 106, 105, 105, 105, 105),
(27, 2, 84, 0, 1, 0, 0, 0),
(28, 2, 0, 0, 0, 0, 0, 0),
(29, 2, 24, 28, 28, 29, 28, 28),
(30, 2, 144, 22, 21, 21, 21, 21),
(31, 2, 0, 0, 0, 0, 0, 0),
(32, 2, 0, 0, 0, 0, 0, 0),
(33, 3, 72, 35, 36, 35, 35, 35),
(34, 3, 6, 57, 56, 56, 56, 56),
(35, 3, 0, 0, 0, 0, 0, 0),
(36, 3, 3, 0, 0, 0, 0, 0),
(37, 3, 0, 0, 0, 0, 0, 0),
(38, 3, 0, 0, 0, 0, 0, 0),
(39, 2, 0, 0, 0, 0, 0, 0),
(40, 2, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analyst`
--
ALTER TABLE `analyst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equation`
--
ALTER TABLE `equation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productivity`
--
ALTER TABLE `productivity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign`
--
ALTER TABLE `assign`
  ADD CONSTRAINT `ibfk_1``` FOREIGN KEY (`id`) REFERENCES `analyst` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productivity`
--
ALTER TABLE `productivity`
  ADD CONSTRAINT `ibfk_2` FOREIGN KEY (`id`) REFERENCES `analyst` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
