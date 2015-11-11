-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2015 alle 16:20
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
-- Struttura della tabella `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `name` varchar(200) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `idIdea` int(11) DEFAULT NULL,
  `idUser` varchar(200) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `idUser` varchar(200) DEFAULT NULL,
  `idIdea` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `dateOfInsert` date NOT NULL,
  `description` text NOT NULL,
  `idUser` varchar(200) NOT NULL,
  `financier` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `lastLogin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`name`, `surname`, `dateOfBirth`, `email`, `password`, `sex`, `imPath`, `lastLogin`) VALUES
('pippo', 'pluto', '2015-11-12', 'email@email.it', 'pwd', 'm', '', '2015-11-10');

--
-- Indexes for dumped tables
--

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Limiti per le tabelle scaricate
--

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
