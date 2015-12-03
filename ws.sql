-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Dic 03, 2015 alle 15:48
-- Versione del server: 10.1.8-MariaDB
-- Versione PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ws`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attachment`
--

CREATE TABLE `attachment` (
  `idIdea` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE `category` (
  `name` varchar(200) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `comment` (
  `idIdea` int(11) DEFAULT NULL,
  `idUser` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `score_dom` varchar(10) NOT NULL,
  `score_pos` double NOT NULL,
  `score_neg` double NOT NULL,
  `score_neu` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`idIdea`, `idUser`, `date`, `text`, `score_dom`, `score_pos`, `score_neg`, `score_neu`) VALUES
(37, 'stefvkg@hotmail.it', '2015-11-24 21:12:30', 'Idea molto interessante. Complimenti', 'pos', 0.4, 0.2, 0.4),
(37, 'stefvkg@hotmail.it', '2015-11-28 11:28:15', 'Ottima idea :D', 'pos', 0.4, 0.2, 0.4),
(37, 'stefania.cardamone1@gmail.com', '2015-11-30 09:29:36', 'Perfetta! ', 'pos', 0.5, 0.25, 0.25),
(37, 'stefania.cardamone1@gmail.com', '2015-11-30 09:37:36', ':/', 'neg', 0.25, 0.5, 0.25),
(37, 'stefania.cardamone1@gmail.com', '2015-12-01 13:20:27', ':)', 'pos', 0.5, 0.25, 0.25);

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
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
('s.romano1992@gmail.com', 1, '2015-11-04 08:00:00'),
('stefania.cardamone1@gmail.com', 31, '2015-11-24 15:04:53'),
('stefania.cardamone1@gmail.com', 1, '2015-11-24 15:08:14'),
('stefvkg@hotmail.it', 37, '2015-11-28 11:27:58'),
('stefania.cardamone1@gmail.com', 7, '2015-12-01 08:43:15'),
('stefania.cardamone1@gmail.com', 8, '2015-12-03 15:45:08'),
('stefania.cardamone1@gmail.com', 9, '2015-12-03 15:47:52');

-- --------------------------------------------------------

--
-- Struttura della tabella `hascategory`
--

CREATE TABLE `hascategory` (
  `idCategory` int(11) DEFAULT NULL,
  `idIdea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `hascategory`
--

INSERT INTO `hascategory` (`idCategory`, `idIdea`) VALUES
(1, 29),
(1, 31),
(1, 35),
(2, 37),
(2, 39),
(1, 43),
(1, 60),
(1, 69),
(1, 71);

-- --------------------------------------------------------

--
-- Struttura della tabella `idea`
--

CREATE TABLE `idea` (
  `nome` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `dateOfInsert` datetime NOT NULL,
  `description` text NOT NULL,
  `idUser` varchar(200) NOT NULL,
  `financier` varchar(200) DEFAULT NULL,
  `dateOfFinancing` datetime DEFAULT NULL,
  `imPath` text NOT NULL,
  `url_video` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `idea`
--

INSERT INTO `idea` (`nome`, `id`, `dateOfInsert`, `description`, `idUser`, `financier`, `dateOfFinancing`, `imPath`, `url_video`) VALUES
('ip multi socket 220v', 1, '2015-11-13 09:33:17', 'This idea want to realize a multi socket with an ip address and possibility of switch it in on/off mdoe by using internet.', 's.romano1992@gmail.com', NULL, NULL, 'galleryTmp/idea1.jpg', ''),
('Vision tool', 2, '2015-11-17 08:12:46', 'his development equippes your thermoform tools with an automated data logging system thus giving insight into 3 main areas in your production chain:\r\n-process control\r\n-quality assurance\r\n-maintenance\r\nThis practical and costeffective data logging system monitors your thermoform tool throughout the whole production run. The modular concept of soft and hardware offers great scalability and can satisfy even sophisticated customer requirements.\r\nThe product developer can compile specific sets of parameters for individual products for later use which helps you standardize your process.\r\nThe maintenance engineer is able to enhance the availability of the tool through precise information about its state.\r\nThe data logging system can be integrated into existing as well as new thermoform tools.', 's.romano1992@gmail.com', NULL, NULL, 'galleryTmp/idea2.jpg', ''),
('Progetto Scuola 2015', 7, '2015-11-14 10:57:53', 'Il Progetto Scuola e la piattaforma di riflessione e condivisione che Expo Milano 2015 dedica alle iniziative rivolte a tutto il sistema formativo: dalle scuole dell infanzia alle Universita.\r\nLa visione e i valori della scuola sono determinanti per diffondere i contenuti e garantire l eredita della manifestazione; per questo docenti e studenti sono invitati a partecipare alla prossima Esposizione \r\nUniversale attraverso specifici percorsi formativi e didattici.\r\n \r\nLa sfida di Expo Milano 2015 parte proprio da questo presupposto. Permettere alle nuove generazioni di confrontarsi e formarsi sul Tema Nutrire il Pianeta, Energia per la Vita  e far si che il patrimonio generato all interno delle aule scolastiche di tutti i Paesi sia condiviso con la collettivita.', 's.romano1992@gmail.com', 'stefania.cardamone1@gmail.com', '2015-11-24 15:01:38', 'galleryTmp/idea7.jpg', ''),
('Computer Forensics', 8, '2015-11-06 00:00:00', 'La diffusione capillare dei dati digitali ha reso tale risorsa\r\nprobabilmente la piu preziosa nelle piu svariate realta quali i\r\nsingoli privati, le aziende e il settore pubblico.\r\nRisulta, quindi, fondamentale la Computer Forensics per la\r\ntutela e la difesa di informazioni tanto delicate e rilevanti,\r\nvisto che e cruciale in tematiche quali il riciclaggio di denaro e\r\ni reati tributari, i reati contro la persona, le frodi, l uso a\r\nscopo personale di materiale aziendale, la violazione del\r\ndiritto d autore, lo spionaggio industriale, la pedopornografia,\r\nlo stalking e molti altri.\r\nLo scopo di questo lavoro e quello di fornire una prima\r\ndescrizione su cosa si tratta in ambito della Computer\r\nForensics, quindi in particolare le attivita che generalmente\r\nvengono svolte su i dispositivi di memorizzazione di un\r\nPersonal Computer.\r\n', 's.romano1992@gmail.com', 'stefania.cardamone1@gmail.com', '2015-12-03 15:45:09', 'galleryTmp/idea8.jpg', ''),
('Windows Forensic Analysis: Data Remanence\r\n', 9, '2015-01-01 00:00:00', 'In questo scenario di Digital Forensics, il nostro progetto analizza il Sistema Operativo Microsoft\r\nWindows 7, mostrando le evidenze che possono essere generate, cancellate e modificate nei registri\r\ndel sistema. Presentiamo prima una panoramica sulle caratteristiche del Sistema Operativo\r\nMicrosoft Windows, tra cui le versioni, il File System, i registri e le proprieta nelle quali e possibile\r\ntrovare delle evidenze di tipo digitale.\r\nMostriamo in seguito, con casi di studio, come trovare delle evidenze all interno di Microsoft\r\nWindows 7, usando appositi strumenti ed inoltre analizzeremo il problema della Data Remanence\r\n(Persistenza dei dati nel sistema).', 'pianobarsimone@hotmail.it', 'stefvkg@hotmail.it', '2015-11-21 11:39:12', 'galleryTmp/idea9.jpg', ''),
('Le Botnet', 29, '2015-01-01 00:00:00', 'Data la crescente popolarita della rete e piu in particolare dell utilizzo dei siti di\r\ne-commerce e cresciuto anche il numero di attacchi che questi sistemi sono\r\ncostretti a subire da parte dei malintenzionati. Gia a partire dai primi anni 80 si\r\ne avuto un assaggio di quanto siano pericolosi tali attacchi, infatti e proprio in\r\nquegli anni che cominciano a venir fuori i primi hacker. Il loro obiettivo erano i sistemi informatici e telefonici e venivano portati sia per imparare e sfruttare le\r\ndebolezze dei vari sistemi presenti sulla rete sia per risparmiare sui costi di\r\nconnessione e delle chiamate utilizzando tali sistemi come ponte o\r\nsfruttandone la connessione ad Internet', 'stefvkg@hotmail.it', NULL, NULL, 'galleryTmp/idea23.jpeg', ''),
('WEB SPAMMING', 31, '2015-01-01 00:00:00', 'Il lavoro di questa tesina affronta il problema del web spamming. In relazione ai motori di\r\nricerca, si usa il termine spam per indicare siti o pagine preparati con l apposito scopo di\r\narrivare alle prime posizioni dei risultati, senza offrire un reale contenuto utile al navigatore.\r\nPer arrivare a discutere del problema del web spamming, quindi, dobbiamo prima capire e\r\nfocalizzare l attenzione sui motori di ricerca e sul loro funzionamento. ', 'stefvkg@hotmail.it', 'stefania.cardamone1@gmail.com', '2015-11-24 14:54:23', 'galleryTmp/idea30.jpg', ''),
('App Tripper', 35, '2015-01-01 00:00:00', 'Queste sono le app che ci piacciono. Ma proprio tanto. Stavolta lâ€™arte, infatti, Ã¨ presa di traverso: App Tripper serve infatti a connettere emozioni e ispirazioni nelle cittÃ  dâ€™arte italiane ed europee. Un bellâ€™esperimento di geografia emozionale ma anche una guida turistica 2.0 per orientarsi facilmente, accedere alle informazioni, capire su cosa vale la pena soffermarsi quanto al patrimonio storico-artistico e archeologico dei vari centri. Percorsi, mappe cucite su misura e anche elemento social. Puoi costruirti un profilo, una lista di contatti, caricare contenuti e capire quali categorie emotive hanno colpito di piÃ¹ gli altri in dieci cittÃ  italiane. Presto lâ€™Europa. ', 'stefania.cardamone1@gmail.com', NULL, NULL, 'galleryTmp/images.jpg', 'http://www.youtube.com/embed/Eke5xyR-Igw'),
('Artkive', 37, '2015-01-01 00:00:00', 'Chi lâ€™ha detto che gli schizzi dei piÃ¹ piccoli non sono opere dâ€™arte? Esprimono la creativitÃ  in nuce, quella piÃ¹ genuina. E spesso rischiano di perdersi, rovinarsi, ingiallirsi. Artkive ha piÃ¹ o meno lâ€™obiettivo di diventare quella sorta di librone in cui le mamme di ogni epoca e latitudine hanno incollato per anni le opere dei propri pargoli. Acquisisci, tagghi e condividi il disegno in un attimo. E poi da quel database puoi tirarci fuori altro, anche tornare a farne per esempio un libro in carne e fogli per i nonni. La filosofia skratch incontra geek mom, arte e hi tech. Imperdibile.', 'stefania.cardamone1@gmail.com', 'stefvkg@hotmail.it', '2015-11-24 21:12:33', 'galleryTmp/artKive.jpg', 'http://www.youtube.com/embed/IWUYuBvaGbY'),
('I grandi dellâ€™arte', 39, '2015-01-01 00:00:00', 'Qualcosa di piÃ¹ classico, orientato alla conoscenza. Ci mette lo zampino lo storico Philippe Daverio. I grandi dellâ€™arte Ã¨ una collana per iPad da poco lanciata da Giunti. Puoi studiare trecento capolavori in alta risoluzione e scendere fino ai dettagli. Il programmino legge i dipinti, suggerisce percorsi di navigazione, squaderna confronti fra artisti. Da Caravaggio a Vermeer, da Tiepolo a Botticelli passando per Raffaello, Leonardo, Van Gogh, Klimt, Picasso e Chagall: a disposizione anche biografie, bibliografie e interazione con gli strumenti musicali riprodotti nelle opere. Si puÃ² fare qualcosa anche offline. Va bene che tutto Ã¨ arte, ma un ripasso dei fondamentali non sarebbe male. ', 'stefania.cardamone1@gmail.com', NULL, NULL, 'galleryTmp/arte.jpg', ''),
('Bluetooth', 43, '2015-01-01 00:00:00', 'Le basi dell odierno Bluetooth le getta Ericsson nel 1994.\r\nL azienda svedese inizio una ricerca per trovare una nuova interfaccia di\r\ncomunicazione ad onde radio a basso costo, tra i cellulari ed i diversi accessori, che\r\nsoppiantasse l IRDA. L idea era quella che un minuscolo ricevitore radio immesso\r\nsia nel cellulare sia nell eventuale dispositivo da unire, avrebbero sostituito i vari\r\nfili usati all''epoca. Dopo circa un anno dal progetto iniziale, lo sviluppo della nuova\r\ntecnologia entro nella fase operativa ed il lavoro passo alla sezione ingegneristica\r\ndell Ericsson. Il progetto iniziale di fornire nuovi accessori per telefonia mobile ad\r\nonde radio, fu soppiantato da un progetto piu ambizioso, la creazione di una vera e\r\npropria nuova tecnologia per far comunicare qualsiasi tipo di dispositivo a breve\r\ndistanza', 'stefania.cardamone1@gmail.com', NULL, NULL, 'galleryTmp/idea43.jpg', ''),
('Digital Watermarking', 60, '2015-01-01 00:00:00', 'Il termine digital watermarking letteralmente significa filigrana digitale. Come la filigrana assicura\r\nautenticita ed integrita delle banconote, cosi i watermark dovrebbero garantire autenticita ed integrita\r\ndei documenti digitali (testuali, grafici, audio, video, etc.) in cui sono inseriti. L idea di base di questa nuova\r\ntecnologia e di inserire all interno del documento da proteggere una sequenza di bit detta watermark.\r\n', 'stefania.cardamone1@gmail.com', NULL, NULL, 'galleryTmp/idea60.jpg', ''),
('iPod Touch & iPhone \r\n', 69, '2015-01-01 00:00:00', 'The Apple iPod didn t ignore Apple s PDA roots. Each iPod had the ability to store\r\ncalendar and contact information, and subsequent generations of iPods gave the\r\nconsumer the ability to view photos and then video. The original iPod was capable only\r\nof syncing with a Mac because of its FireWire interface. Windows users saw the utility of\r\nthe iPod and were clamoring for it, so Apple switched to USB and has never looked\r\nback. ', 'stefania.cardamone1@gmail.com', NULL, NULL, 'galleryTmp/idea69.jpg', ''),
('Image OSN Identification\r\n', 71, '2015-01-01 00:00:00', 'Obiettivo del nostro progetto e la ricerca di un modo per classificare le immagini provenienti dai\r\nvari online social network. In particolare, e necessario uno strumento che permetta di riconoscere da\r\nquale OSN proviene una fissata immagine digitale. Poiche in letteratura esistono solamente\r\nstrumenti per identificare la specifica fotocamera digitale o il modello che ha scattato l immagine,\r\ncioe source camera identification (CI) e model camera identification (MI), dobbiamo esaminare\r\nstrumenti alternativi per il raggiungimento del nostro obiettivo.\r\n', 'stefania.cardamone1@gmail.com', NULL, NULL, 'galleryTmp/idea70.jpg', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `notice`
--

CREATE TABLE `notice` (
  `idNotice` int(11) NOT NULL,
  `idDestinatario` varchar(200) NOT NULL,
  `idIdea` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `type` enum('Comment','Financier','Follower','') NOT NULL,
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `notice`
--

INSERT INTO `notice` (`idNotice`, `idDestinatario`, `idIdea`, `date`, `text`, `type`, `confirmed`) VALUES
(21, 'amedeo.leo92@gmail.com', 8, '2015-11-17 11:49:51', '', 'Financier', 0),
(22, 's.romano1992@gmail.com', 8, '2015-11-17 11:49:51', '', 'Financier', 1),
(23, 'a.leo@unisa.it', 8, '2015-11-17 11:49:51', '', 'Financier', 0),
(24, 'amedeo.leo92@gmail.com', 8, '2015-11-17 11:53:09', '', 'Financier', 0),
(25, 's.romano1992@gmail.com', 8, '2015-11-17 11:53:09', '', 'Financier', 0),
(26, 'a.leo@unisa.it', 8, '2015-11-17 11:53:09', '', 'Financier', 0),
(27, 'amedeo.leo92@gmail.com', 8, '2015-11-17 00:00:00', 'prova', 'Comment', 0),
(28, 's.romano1992@gmail.com', 8, '2015-11-17 15:04:25', '', 'Follower', 0),
(29, 'a.leo@unisa.it', 8, '2015-11-17 15:43:54', '', 'Comment', 0),
(30, 's.romano1992@gmail.com', 8, '2015-11-17 20:12:39', '', 'Follower', 0),
(31, 'a.leo@unisa.it', 8, '2015-11-17 20:32:44', '', 'Comment', 0),
(32, 'a.leo@unisa.it', 8, '2015-11-17 20:34:59', '', 'Comment', 0),
(33, 'a.leo@unisa.it', 8, '2015-11-17 20:37:29', '', 'Comment', 0),
(34, 'amedeo.leo92@gmail.com', 8, '2015-11-19 00:00:00', 'Prova', 'Financier', 0),
(35, 'amedeo.leo92@gmail.com', 7, '2015-11-11 00:00:00', 'test1', 'Financier', 0),
(36, 'amedeo.leo92@gmail.com', 2, '2015-11-03 00:00:00', 'test2', 'Comment', 0),
(37, 'a.leo@unisa.it', 8, '2015-11-18 16:00:18', 'La ideaidea9che stai seguendo ha un nuovo commento:[Amedeo Leo]:test', 'Comment', 0),
(38, 's.romano1992@gmail.com', 8, '2015-11-20 16:20:06', 'La tua ideaidea9ha un nuovo follower: .lele martini.', 'Follower', 0),
(39, 's.romano1992@gmail.com', 8, '2015-11-20 16:53:09', 'La tua ideaidea9ha un nuovo follower: .lele martini.', 'Follower', 0),
(40, 's.romano1992@gmail.com', 8, '2015-11-21 13:43:28', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: okk', 'Comment', 0),
(41, 'luigilomasto@gmail.com', 8, '2015-11-21 13:43:28', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: okk', 'Comment', 0),
(42, 'pianobarsimone@hotmail.it', 8, '2015-11-21 13:43:29', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: okk', 'Comment', 0),
(43, 'luigialeo94@gmail.com', 8, '2015-11-21 13:43:29', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: okk', 'Comment', 0),
(44, 's.romano1992@gmail.com', 8, '2015-11-23 13:23:34', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: ciao. proviamo ', 'Comment', 0),
(45, 'luigilomasto@gmail.com', 8, '2015-11-23 13:23:34', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: ciao. proviamo ', 'Comment', 0),
(46, 'pianobarsimone@hotmail.it', 8, '2015-11-23 13:23:34', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: ciao. proviamo ', 'Comment', 0),
(47, 'luigialeo94@gmail.com', 8, '2015-11-23 13:23:35', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: ciao. proviamo ', 'Comment', 0),
(48, 's.romano1992@gmail.com', 8, '2015-11-23 15:13:16', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Amedeo fuck you', 'Comment', 0),
(49, 'luigilomasto@gmail.com', 8, '2015-11-23 15:13:16', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Amedeo fuck you', 'Comment', 0),
(50, 'pianobarsimone@hotmail.it', 8, '2015-11-23 15:13:16', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Amedeo fuck you', 'Comment', 0),
(51, 'luigialeo94@gmail.com', 8, '2015-11-23 15:13:17', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Amedeo fuck you', 'Comment', 0),
(52, 's.romano1992@gmail.com', 8, '2015-11-23 15:15:19', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Giovanni non stai bene', 'Comment', 0),
(53, 'luigilomasto@gmail.com', 8, '2015-11-23 15:15:19', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Giovanni non stai bene', 'Comment', 0),
(54, 'pianobarsimone@hotmail.it', 8, '2015-11-23 15:15:19', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Giovanni non stai bene', 'Comment', 0),
(55, 'luigialeo94@gmail.com', 8, '2015-11-23 15:15:19', 'La ideaidea9 che hai commentato ha un nuovo commento:[Luigia Leo]: Giovanni non stai bene', 'Comment', 0),
(56, 'stefvkg@hotmail.it', 29, '2015-11-24 14:40:28', 'La tua ideaaaaaha un nuovo follower: .Stefania Cardamone.', 'Follower', 0),
(57, 'stefvkg@hotmail.it', 29, '2015-11-24 14:43:00', 'La tua ideaaaaaha un nuovo follower: .Stefania Cardamone.', 'Follower', 0),
(58, 'stefvkg@hotmail.it', 31, '2015-11-24 15:04:53', 'La tua ideadddha un nuovo follower: .Stefania Cardamone.', 'Follower', 0),
(59, 'a.leo@unisa.it', 1, '2015-11-24 15:07:45', 'La ideaip multi socket 220v che stai seguendo ha un nuovo commento:[Stefania Cardamone]: Stefania...PRova commenti', 'Comment', 0),
(60, 's.romano1992@gmail.com', 1, '2015-11-24 15:07:45', 'La ideaip multi socket 220v che stai seguendo ha un nuovo commento:[Stefania Cardamone]: Stefania...PRova commenti', 'Comment', 0),
(61, 'email@email.it', 1, '2015-11-24 15:07:45', 'La ideaip multi socket 220v che hai commentato ha un nuovo commento:[Stefania Cardamone]: Stefania...PRova commenti', 'Comment', 0),
(62, 's.romano1992@gmail.com', 1, '2015-11-24 15:08:14', 'La tua ideaip multi socket 220vha un nuovo follower: .Stefania Cardamone.', 'Follower', 0),
(63, 'stefania.cardamone1@gmail.com', 29, '2015-11-24 15:12:02', 'test', 'Financier', 1),
(64, 'stefania.cardamone1@gmail.com', 29, '2015-11-24 15:12:04', 'test', 'Financier', 1),
(65, 'stefania.cardamone1@gmail.com', 29, '2015-11-24 15:12:32', 'test', 'Financier', 1),
(66, 'stefania.cardamone1@gmail.com', 29, '2015-11-24 15:12:53', 'test', 'Financier', 1),
(67, 'stefania.cardamone1@gmail.com', 29, '2015-11-24 15:13:22', 'test', 'Financier', 1),
(68, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:27:56', '', 'Financier', 1),
(69, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:33:16', 'Complimenti! Hai finanziato l"idea idea9! Mettiti in contatto con l"ideatore tramite l"email: s.romano1992@gmail.com', 'Financier', 1),
(70, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:34:33', 'Complimenti! Hai finanziato la idea idea9! Mettiti in contatto con il creatore tramite email: s.romano1992@gmail.com', 'Financier', 1),
(71, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:38:20', 'Hai finanziato la idea idea9', 'Financier', 1),
(72, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:40:26', 'Hai finanziato la idea idea9', 'Financier', 1),
(73, 's.romano1992@gmail.com', 8, '2015-11-24 15:40:26', 'Complimenti! Hai ottenuto un finanziamento per la idea idea9! Mettiti in contatto con il finanziatore tramite email: stefania.cardamone1@gmail.com', 'Financier', 0),
(74, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:43:27', 'Hai finanziato la idea idea9', 'Financier', 1),
(75, 's.romano1992@gmail.com', 8, '2015-11-24 15:43:27', 'Complimenti! Hai ottenuto un finanziamento per la idea idea9! Mettiti in contatto con il finanziatore tramite email: stefania.cardamone1@gmail.com', 'Financier', 0),
(76, 'stefania.cardamone1@gmail.com', 8, '2015-11-24 15:46:21', 'Hai finanziato la idea idea9', 'Financier', 1),
(77, 's.romano1992@gmail.com', 8, '2015-11-24 15:46:21', 'Complimenti! Hai ottenuto un finanziamento per la idea idea9! Mettiti in contatto con il finanziatore tramite email: stefania.cardamone1@gmail.com', 'Financier', 0),
(78, 'stefvkg@hotmail.it', 37, '2015-11-24 21:12:33', 'Hai finanziato la idea Artkive', 'Financier', 0),
(79, 'stefania.cardamone1@gmail.com', 37, '2015-11-24 21:12:33', 'Complimenti! Hai ottenuto un finanziamento per la idea Artkive! Mettiti in contatto con il finanziatore tramite email: stefvkg@hotmail.it', 'Financier', 1),
(80, 'stefania.cardamone1@gmail.com', 37, '2015-11-28 11:27:58', 'La tua ideaArtkiveha un nuovo follower: .lele martini.', 'Follower', 1),
(81, 'stefvkg@hotmail.it', 37, '2015-11-30 09:29:36', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: Perfetta! ', 'Comment', 0),
(82, 'stefvkg@hotmail.it', 37, '2015-11-30 09:37:36', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: :/', 'Comment', 0),
(83, 'stefvkg@hotmail.it', 37, '2015-11-30 09:40:20', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: Proviamo!', 'Comment', 0),
(84, 'stefvkg@hotmail.it', 37, '2015-11-30 13:24:22', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: aaaaa', 'Comment', 0),
(85, 'stefvkg@hotmail.it', 37, '2015-11-30 13:26:15', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: ciao', 'Comment', 0),
(86, 'stefvkg@hotmail.it', 37, '2015-11-30 13:28:26', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: aaaaa', 'Comment', 0),
(87, 'stefvkg@hotmail.it', 37, '2015-11-30 13:28:37', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: aaaaahhhhh', 'Comment', 0),
(88, 'stefvkg@hotmail.it', 37, '2015-11-30 13:28:53', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: aaaa', 'Comment', 0),
(89, 'stefvkg@hotmail.it', 37, '2015-11-30 13:38:45', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: test1', 'Comment', 0),
(90, 'stefvkg@hotmail.it', 37, '2015-11-30 13:38:53', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: test2', 'Comment', 0),
(91, 'stefvkg@hotmail.it', 37, '2015-11-30 13:39:38', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: test3', 'Comment', 0),
(92, 'stefvkg@hotmail.it', 37, '2015-11-30 13:39:45', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: test4', 'Comment', 0),
(93, 's.romano1992@gmail.com', 7, '2015-12-01 08:43:16', 'La tua ideaname1ha un nuovo follower: .Stefania Cardamone.', 'Follower', 0),
(94, 'stefvkg@hotmail.it', 37, '2015-12-01 08:44:48', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: popipipÃ²', 'Comment', 0),
(95, 'stefvkg@hotmail.it', 37, '2015-12-01 08:44:57', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: popipipÃ²hghgn', 'Comment', 0),
(96, 'stefvkg@hotmail.it', 37, '2015-12-01 08:46:29', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: yuyug', 'Comment', 0),
(97, 'stefvkg@hotmail.it', 37, '2015-12-01 08:46:36', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: yuyugdfbd', 'Comment', 0),
(98, 'stefvkg@hotmail.it', 37, '2015-12-01 08:48:03', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: gdngf', 'Comment', 0),
(99, 'stefvkg@hotmail.it', 37, '2015-12-01 08:48:09', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: gdngfgngng', 'Comment', 0),
(100, 'stefvkg@hotmail.it', 37, '2015-12-01 08:48:18', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: gdngfgngnggnggngng', 'Comment', 0),
(101, 'stefvkg@hotmail.it', 37, '2015-12-01 08:48:27', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: gfnfnfnf', 'Comment', 0),
(102, 'stefvkg@hotmail.it', 37, '2015-12-01 08:55:52', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: abc', 'Comment', 0),
(103, 'stefvkg@hotmail.it', 37, '2015-12-01 08:56:04', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: abctest', 'Comment', 0),
(104, 'stefvkg@hotmail.it', 37, '2015-12-01 13:18:13', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: male male', 'Comment', 0),
(105, 'stefvkg@hotmail.it', 37, '2015-12-01 13:20:27', 'La ideaArtkive che stai seguendo ha un nuovo commento:[Stefania Cardamone]: :)', 'Comment', 0),
(106, 's.romano1992@gmail.com', 8, '2015-12-03 15:45:08', 'La tua ideaComputer Forensicsha un nuovo follower: .Stefania Cardamone.', 'Follower', 0),
(107, 'stefania.cardamone1@gmail.com', 8, '2015-12-03 15:45:10', 'Hai finanziato la idea Computer Forensics', 'Financier', 0),
(108, 's.romano1992@gmail.com', 8, '2015-12-03 15:45:10', 'Complimenti! Hai ottenuto un finanziamento per la idea Computer Forensics! Mettiti in contatto con il finanziatore tramite email: stefania.cardamone1@gmail.com', 'Financier', 0),
(109, 'pianobarsimone@hotmail.it', 9, '2015-12-03 15:47:53', 'La tua ideaWindows Forensic Analysis: Data Remanence\r\nha un nuovo follower: .Stefania Cardamone.', 'Follower', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
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
('Ciro', 'Amati', '1989-07-26', 'c.amati@gmail.com', '123', 'm', '', '2015-11-01 00:00:00', 1, '', NULL, NULL),
('pippo', 'pluto', '2015-11-12', 'email@email.it', 'pwd', 'm', '', '2015-11-10 00:00:00', 0, '', NULL, NULL),
('Luigia', 'Leo', '0000-00-00', 'luigialeo94@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 'userImg/luigialeo94@gmail.com.png', '2015-11-15 21:26:37', 1, 'cbcaf7255dcc6087410ad50a9d0abb22', '2015-11-15 16:46:24', ''),
('Luigi', 'Lomasto', '0000-00-00', 'luigilomasto@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 'userImg/luigilomasto@gmail.com.png', '2015-11-17 17:30:29', 1, '0f7288e9ec5ff129121e9197e649a7cc', '2015-11-17 15:04:26', ''),
('Simone', 'Romano', '0000-00-00', 'pianobarsimone@hotmail.it', 'fe739fc29cffe7d05559d683213fa467', '', 'userImg/pianobarsimone@hotmail.it.png', '2015-11-19 11:07:07', 1, '8873df96ff9fe44e47a69fc3acc0f89e', '2015-11-16 08:20:15', ''),
('Simone', 'Romano', '0000-00-00', 's.romano1992@gmail.com', NULL, 'm', 'https://scontent.xx.fbcdn.net/hprofile-xpt1/v/t1.0-1/p50x50/11695888_851302401625643_2317299565397082538_n.jpg?oh=a7371e28b70771b0a1c084d3cd44b0ad&oe=56F0DF68', '2015-11-19 10:46:30', 1, '', '2015-11-13 07:25:54', 'http://www.sromano.altervista.org'),
('Stefania', 'Cardamone', '1991-06-28', 'stefania.cardamone1@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'userImg/stefania.cardamone1@gmail.com.png', '2015-12-03 14:47:46', 1, 'f7f33f673c99794d1bb783dc64e56a2e', '2015-11-23 15:11:35', ''),
('lele', 'martini', '0000-00-00', 'stefvkg@hotmail.it', '202cb962ac59075b964b07152d234b70', '', 'userImg/stefvkg@hotmail.it.png', '2015-11-28 11:27:43', 1, 'd6310a1b95b93a2a4ed428161962a554', '2015-11-20 16:07:28', '');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `attachment`
--
ALTER TABLE `attachment`
  ADD KEY `idIdea` (`idIdea`);

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`date`),
  ADD KEY `idIdea` (`idIdea`),
  ADD KEY `idUser` (`idUser`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idIdea` (`idIdea`);

--
-- Indici per le tabelle `hascategory`
--
ALTER TABLE `hascategory`
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idIdea` (`idIdea`);

--
-- Indici per le tabelle `idea`
--
ALTER TABLE `idea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`,`financier`),
  ADD KEY `financier` (`financier`);

--
-- Indici per le tabelle `notice`
--
ALTER TABLE `notice`
  ADD KEY `idNotice` (`idNotice`,`idDestinatario`,`idIdea`),
  ADD KEY `idDestinatario` (`idDestinatario`),
  ADD KEY `idIdea` (`idIdea`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `idea`
--
ALTER TABLE `idea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT per la tabella `notice`
--
ALTER TABLE `notice`
  MODIFY `idNotice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
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
