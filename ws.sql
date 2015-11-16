-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 alle 09:18
-- Versione del server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ws`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `idIdea` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `name` varchar(200) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`name`, `id`) VALUES
('Software', 1),
('Art', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `idIdea` int(11) DEFAULT NULL,
  `idUser` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`idIdea`, `idUser`, `date`, `text`, `Score`) VALUES
(1, 'email@email.it', '0000-00-00 00:00:00', 'Good', 0),
(1, 'email@email.it', '2015-11-11 08:36:00', 'Good ideas :) !', 0),
(1, 'a.leo@unisa.it', '2015-11-12 00:14:00', 'Bad Idea! It already exist!', 0),
(2, 's.romano1992@gmail.com', '2015-11-20 00:00:00', 'I''m a genius', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `idUser` varchar(200) DEFAULT NULL,
  `idIdea` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `follow`
--

INSERT INTO `follow` (`idUser`, `idIdea`, `date`) VALUES
('a.leo@unisa.it', 1, '2015-11-11 00:00:00'),
('email@email.it', 2, '2015-11-05 12:25:00'),
('s.romano1992@gmail.com', 1, '2015-11-04 08:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `hascategory`
--

CREATE TABLE IF NOT EXISTS `hascategory` (
  `idCategory` int(11) DEFAULT NULL,
  `idIdea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `idea`
--

CREATE TABLE IF NOT EXISTS `idea` (
  `nome` varchar(200) NOT NULL,
`id` int(11) NOT NULL,
  `dateOfInsert` datetime NOT NULL,
  `description` text NOT NULL,
  `idUser` varchar(200) NOT NULL,
  `financier` varchar(200) DEFAULT NULL,
  `dateOfFinancing` datetime DEFAULT NULL,
  `imPath` text NOT NULL,
  `url_video` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `idea`
--

INSERT INTO `idea` (`nome`, `id`, `dateOfInsert`, `description`, `idUser`, `financier`, `dateOfFinancing`, `imPath`, `url_video`) VALUES
('ip multi socket 220v', 1, '2015-11-13 09:33:17', 'this idea want to realize a muilti socket with an ip address and possibility of switch it in on/off mdoe by using internet.', 's.romano1992@gmail.com', 's.romano1992@gmail.com', '2015-11-14 16:00:00', '', ''),
('vision tool', 2, '2015-11-17 08:12:46', 'idea is to realiza a tool for vision tasks. ', 's.romano1992@gmail.com', 'a.leo@unisa.it', '0000-00-00 00:00:00', '', ''),
('name1', 7, '2015-11-14 10:57:53', 'descr', 's.romano1992@gmail.com', NULL, '0000-00-00 00:00:00', '', ''),
('idea9', 8, '2015-11-06 00:00:00', 'descri idea 9', 's.romano1992@gmail.com', NULL, '0000-00-00 00:00:00', 'http://www.sromano.altervista.org/progetto_smartwatch/home.jpg', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `sex` char(1) NOT NULL,
  `imPath` text NOT NULL,
  `lastLogin` datetime NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `validationCode` text NOT NULL,
  `registrationDate` datetime DEFAULT NULL,
  `webPage` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`name`, `surname`, `dateOfBirth`, `email`, `password`, `sex`, `imPath`, `lastLogin`, `confirmed`, `validationCode`, `registrationDate`, `webPage`) VALUES
('Amedeo', 'Leo', '1992-09-08', 'a.leo@unisa.it', 'aleo', 'm', '', '2015-11-13 00:00:00', 0, '', NULL, NULL),
('pippo', 'pluto', '2015-11-12', 'email@email.it', 'pwd', 'm', '', '2015-11-10 00:00:00', 0, '', NULL, NULL),
('Luigia', 'Leo', '0000-00-00', 'luigialeo94@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 'userImg/luigialeo94@gmail.com.png', '2015-11-15 21:26:37', 1, 'cbcaf7255dcc6087410ad50a9d0abb22', '2015-11-15 16:46:24', ''),
('Simone', 'Romano', '0000-00-00', 'pianobarsimone@hotmail.it', '58e75ed3e996fa86b037920c1626b9ce', '', 'userImg/pianobarsimone@hotmail.it.png', '2015-11-16 09:15:25', 1, '8873df96ff9fe44e47a69fc3acc0f89e', '2015-11-16 08:20:15', ''),
('Simone', 'Romano', '0000-00-00', 's.romano1992@gmail.com', NULL, 'm', 'https://scontent.xx.fbcdn.net/hprofile-xpt1/v/t1.0-1/p50x50/11695888_851302401625643_2317299565397082538_n.jpg?oh=a7371e28b70771b0a1c084d3cd44b0ad&oe=56F0DF68', '2015-11-16 09:15:45', 1, '', '2015-11-13 07:25:54', 'http://www.sromano.altervista.org');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
 ADD KEY `idIdea` (`idIdea`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`date`), ADD KEY `idIdea` (`idIdea`), ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
 ADD KEY `idUser` (`idUser`), ADD KEY `idIdea` (`idIdea`);

--
-- Indexes for table `hascategory`
--
ALTER TABLE `hascategory`
 ADD KEY `idCategory` (`idCategory`), ADD KEY `idIdea` (`idIdea`);

--
-- Indexes for table `idea`
--
ALTER TABLE `idea`
 ADD PRIMARY KEY (`id`), ADD KEY `idUser` (`idUser`,`financier`), ADD KEY `financier` (`financier`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
 ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `attachment`
--
ALTER TABLE `attachment`
ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`idIdea`) REFERENCES `idea` (`id`);

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`idIdea`) REFERENCES `idea` (`id`),
ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `utente` (`email`);

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utente` (`email`),
ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`idIdea`) REFERENCES `idea` (`id`);

--
-- Limiti per la tabella `hascategory`
--
ALTER TABLE `hascategory`
ADD CONSTRAINT `hascategory_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`),
ADD CONSTRAINT `hascategory_ibfk_2` FOREIGN KEY (`idIdea`) REFERENCES `idea` (`id`);

--
-- Limiti per la tabella `idea`
--
ALTER TABLE `idea`
ADD CONSTRAINT `idea_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utente` (`email`),
ADD CONSTRAINT `idea_ibfk_2` FOREIGN KEY (`financier`) REFERENCES `utente` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
