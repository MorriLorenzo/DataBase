-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 20, 2024 alle 19:46
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardmarket`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratore`
--

CREATE TABLE `amministratore` (
  `CodiceFiscale` varchar(16) NOT NULL,
  `EmailUtente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `amministratore`
--

INSERT INTO `amministratore` (`CodiceFiscale`, `EmailUtente`) VALUES
('MRRLNZ03A07G479I', 'logamorri@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `appartiene`
--

CREATE TABLE `appartiene` (
  `CodiceSet` varchar(255) NOT NULL,
  `NomeSet` varchar(255) NOT NULL,
  `CodiceCarta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `appartiene`
--

INSERT INTO `appartiene` (`CodiceSet`, `NomeSet`, `CodiceCarta`) VALUES
('01', 'Legend_of_Blue-Eyes_White_Dragon', '89631139');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Id` int(11) NOT NULL,
  `EmailUtente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`Id`, `EmailUtente`) VALUES
(2, 'email@provider.com'),
(1, 'logamorri@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `carta`
--

CREATE TABLE `carta` (
  `Codice` varchar(255) NOT NULL,
  `Lingua` varchar(255) DEFAULT NULL,
  `Immagine` text DEFAULT NULL,
  `Descrizione` text DEFAULT NULL,
  `QuantitàVenduta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `carta`
--

INSERT INTO `carta` (`Codice`, `Lingua`, `Immagine`, `Descrizione`, `QuantitàVenduta`) VALUES
('89631139', 'ita', './static/image/drago.jpg', 'Drago Bianco Occhi Blu', 8000);

-- --------------------------------------------------------

--
-- Struttura della tabella `contenere`
--

CREATE TABLE `contenere` (
  `IdCarrello` int(11) NOT NULL,
  `IdInserzione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `effetto_visivo`
--

CREATE TABLE `effetto_visivo` (
  `Nome` varchar(255) NOT NULL,
  `Descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `effetto_visivo`
--

INSERT INTO `effetto_visivo` (`Nome`, `Descrizione`) VALUES
('Comune', 'Normale');

-- --------------------------------------------------------

--
-- Struttura della tabella `gioco`
--

CREATE TABLE `gioco` (
  `Nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `gioco`
--

INSERT INTO `gioco` (`Nome`) VALUES
('Pokèmon'),
('Yu-Gi-Oh');

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `Id` int(11) NOT NULL,
  `Stato` varchar(255) DEFAULT NULL,
  `CAP` varchar(10) DEFAULT NULL,
  `Provincia` varchar(255) DEFAULT NULL,
  `Via` varchar(255) DEFAULT NULL,
  `Civico` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`Id`, `Stato`, `CAP`, `Provincia`, `Via`, `Civico`) VALUES
(6, 'Italia', '61122', 'PU', 'gg', '44'),
(14, 'Italia', '9090', 'PP', 'Bianchi', '10'),
(15, 'dfsdf', 'afssafaf', 'fsddsda', 'adfdadfd', '66'),
(16, 'Italia', '61122', 'PU', 'Mare', '33');

-- --------------------------------------------------------

--
-- Struttura della tabella `inserzione`
--

CREATE TABLE `inserzione` (
  `Id` int(11) NOT NULL,
  `Informazione` text DEFAULT NULL,
  `Prezzo` decimal(10,2) DEFAULT NULL,
  `Quantità` int(11) DEFAULT NULL,
  `CodiceCarta` varchar(255) DEFAULT NULL,
  `EmailVenditore` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `inserzione`
--

INSERT INTO `inserzione` (`Id`, `Informazione`, `Prezzo`, `Quantità`, `CodiceCarta`, `EmailVenditore`) VALUES
(7, 'perfetto', 55.00, 10, '89631139', 'logamorri@gmail.com'),
(8, 'sconto!!!!', 66.00, 120, '89631139', 'email@provider.com'),
(9, 'accidenti sono troppe', 55.00, 0, '89631139', 'email@provider.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `Codice` int(11) NOT NULL,
  `QuantitàAcquistata` int(11) DEFAULT NULL,
  `IdInserzione` int(11) DEFAULT NULL,
  `EmailAcquirente` varchar(255) DEFAULT NULL,
  `IndirizzoSpedizione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`Codice`, `QuantitàAcquistata`, `IdInserzione`, `EmailAcquirente`, `IndirizzoSpedizione`) VALUES
(17, 6780, 8, 'email@provider.com', 16),
(18, 8000, 9, 'email@provider.com', 16),
(19, 8000, 9, 'email@provider.com', 16),
(20, 8000, 9, 'email@provider.com', 16),
(21, 8000, 9, 'email@provider.com', 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `rappresentazione`
--

CREATE TABLE `rappresentazione` (
  `CodiceCarta` varchar(255) NOT NULL,
  `NomeEffetto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `rappresentazione`
--

INSERT INTO `rappresentazione` (`CodiceCarta`, `NomeEffetto`) VALUES
('89631139', 'Comune');

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

CREATE TABLE `recensione` (
  `IdMittente` varchar(255) NOT NULL,
  `IdDestinatario` varchar(255) NOT NULL,
  `valutazione` int(11) DEFAULT NULL,
  `commento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`IdMittente`, `IdDestinatario`, `valutazione`, `commento`) VALUES
('email@provider.com', 'email@provider.com', 1, 'scadenti!'),
('logamorri@gmail.com', 'logamorri@gmail.com', 4, 'bubugaga');

-- --------------------------------------------------------

--
-- Struttura della tabella `risiede`
--

CREATE TABLE `risiede` (
  `IdUtente` varchar(255) NOT NULL,
  `IdIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `risiede`
--

INSERT INTO `risiede` (`IdUtente`, `IdIndirizzo`) VALUES
('ciao@ciao.com', 6),
('email@provider.com', 16),
('logamorri@gmail.com', 6),
('logamorri@gmail.com', 14),
('logamorri@gmail.com', 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `sett`
--

CREATE TABLE `sett` (
  `Nome` varchar(255) NOT NULL,
  `Codice` varchar(255) NOT NULL,
  `NomeGioco` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `sett`
--

INSERT INTO `sett` (`Nome`, `Codice`, `NomeGioco`) VALUES
('Legend_of_Blue-Eyes_White_Dragon', '01', 'Yu-Gi-Oh');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Email` varchar(255) NOT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Cognome` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Bloccato` tinyint(1) DEFAULT NULL,
  `ValutazioneTotale` int(11) DEFAULT NULL,
  `NumeroRecensioni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Email`, `Nome`, `Cognome`, `Password`, `Bloccato`, `ValutazioneTotale`, `NumeroRecensioni`) VALUES
('ciao@ciao.com', 'c', 'c', 'c', 0, 0, 0),
('email@provider.com', 'Nome', 'Cognome', 'ciao', 0, 1, 1),
('logamorri@gmail.com', 'Lorenzo', 'Morri', 'ciao', 0, 27, 15),
('mattia@mencaccini.com', 'Mattia', 'Mencaccini', 'ciao', 0, 0, 0),
('pop@invio.com', 'Lorenzo', 'Morri', 'lol', 0, 0, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`CodiceFiscale`,`EmailUtente`),
  ADD KEY `EmailUtente` (`EmailUtente`);

--
-- Indici per le tabelle `appartiene`
--
ALTER TABLE `appartiene`
  ADD PRIMARY KEY (`CodiceSet`,`NomeSet`,`CodiceCarta`),
  ADD KEY `NomeSet` (`NomeSet`,`CodiceSet`),
  ADD KEY `CodiceCarta` (`CodiceCarta`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `EmailUtente` (`EmailUtente`);

--
-- Indici per le tabelle `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `contenere`
--
ALTER TABLE `contenere`
  ADD PRIMARY KEY (`IdCarrello`,`IdInserzione`),
  ADD KEY `IdInserzione` (`IdInserzione`);

--
-- Indici per le tabelle `effetto_visivo`
--
ALTER TABLE `effetto_visivo`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `gioco`
--
ALTER TABLE `gioco`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `inserzione`
--
ALTER TABLE `inserzione`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CodiceCarta` (`CodiceCarta`),
  ADD KEY `EmailVenditore` (`EmailVenditore`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Codice`),
  ADD KEY `IdInserzione` (`IdInserzione`),
  ADD KEY `EmailAcquirente` (`EmailAcquirente`),
  ADD KEY `fk_indirizzo_spedizione` (`IndirizzoSpedizione`);

--
-- Indici per le tabelle `rappresentazione`
--
ALTER TABLE `rappresentazione`
  ADD PRIMARY KEY (`CodiceCarta`,`NomeEffetto`),
  ADD KEY `NomeEffetto` (`NomeEffetto`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`IdMittente`,`IdDestinatario`),
  ADD KEY `IdDestinatario` (`IdDestinatario`);

--
-- Indici per le tabelle `risiede`
--
ALTER TABLE `risiede`
  ADD PRIMARY KEY (`IdUtente`,`IdIndirizzo`),
  ADD KEY `IdIndirizzo` (`IdIndirizzo`);

--
-- Indici per le tabelle `sett`
--
ALTER TABLE `sett`
  ADD PRIMARY KEY (`Nome`,`Codice`),
  ADD KEY `NomeGioco` (`NomeGioco`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `inserzione`
--
ALTER TABLE `inserzione`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `Codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `amministratore`
--
ALTER TABLE `amministratore`
  ADD CONSTRAINT `amministratore_ibfk_1` FOREIGN KEY (`EmailUtente`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `appartiene`
--
ALTER TABLE `appartiene`
  ADD CONSTRAINT `appartiene_ibfk_1` FOREIGN KEY (`NomeSet`,`CodiceSet`) REFERENCES `sett` (`Nome`, `Codice`),
  ADD CONSTRAINT `appartiene_ibfk_2` FOREIGN KEY (`CodiceCarta`) REFERENCES `carta` (`Codice`);

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`EmailUtente`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `contenere`
--
ALTER TABLE `contenere`
  ADD CONSTRAINT `contenere_ibfk_1` FOREIGN KEY (`IdCarrello`) REFERENCES `carrello` (`Id`),
  ADD CONSTRAINT `contenere_ibfk_2` FOREIGN KEY (`IdInserzione`) REFERENCES `inserzione` (`Id`);

--
-- Limiti per la tabella `inserzione`
--
ALTER TABLE `inserzione`
  ADD CONSTRAINT `inserzione_ibfk_1` FOREIGN KEY (`CodiceCarta`) REFERENCES `carta` (`Codice`),
  ADD CONSTRAINT `inserzione_ibfk_2` FOREIGN KEY (`EmailVenditore`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `fk_indirizzo_spedizione` FOREIGN KEY (`IndirizzoSpedizione`) REFERENCES `indirizzo` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`IdInserzione`) REFERENCES `inserzione` (`Id`),
  ADD CONSTRAINT `ordine_ibfk_2` FOREIGN KEY (`EmailAcquirente`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `rappresentazione`
--
ALTER TABLE `rappresentazione`
  ADD CONSTRAINT `rappresentazione_ibfk_1` FOREIGN KEY (`CodiceCarta`) REFERENCES `carta` (`Codice`),
  ADD CONSTRAINT `rappresentazione_ibfk_2` FOREIGN KEY (`NomeEffetto`) REFERENCES `effetto_visivo` (`Nome`);

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `recensione_ibfk_1` FOREIGN KEY (`IdMittente`) REFERENCES `utente` (`Email`),
  ADD CONSTRAINT `recensione_ibfk_2` FOREIGN KEY (`IdDestinatario`) REFERENCES `utente` (`Email`);

--
-- Limiti per la tabella `risiede`
--
ALTER TABLE `risiede`
  ADD CONSTRAINT `risiede_ibfk_1` FOREIGN KEY (`IdUtente`) REFERENCES `utente` (`Email`),
  ADD CONSTRAINT `risiede_ibfk_2` FOREIGN KEY (`IdIndirizzo`) REFERENCES `indirizzo` (`Id`);

--
-- Limiti per la tabella `sett`
--
ALTER TABLE `sett`
  ADD CONSTRAINT `sett_ibfk_1` FOREIGN KEY (`NomeGioco`) REFERENCES `gioco` (`Nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
