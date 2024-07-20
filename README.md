Per questo progetto è stato utilizzato xampp. inserisci i file nella cartella c:/xampp/htdocs/ per essere visualizzabili una volta attivato apache e mysql dal terminale.
per far funzionare correttamente è necessario istanziare nella pagina di admin del mysql inserire un account utente con password utente.
di seguito le query per costruire il database.

--BLOCCO QUERY PER CREARE DB

CREATE DATABASE cardmarket;

USE cardmarket;

-- Tabella UTENTE
CREATE TABLE UTENTE (
    Email VARCHAR(255) PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Cognome VARCHAR(100) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Bloccato BOOLEAN DEFAULT FALSE,
    ValutazioneTotale DECIMAL(3,2) DEFAULT 0.00,
    NumeroRecensioni INT DEFAULT 0
);

-- Tabella RECENSIONE
CREATE TABLE RECENSIONE (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    IdMittente VARCHAR(255),
    IdDestinatario VARCHAR(255),
    Valutazione INT CHECK (Valutazione BETWEEN 1 AND 5),
    Commento TEXT,
    FOREIGN KEY (IdMittente) REFERENCES UTENTE(Email),
    FOREIGN KEY (IdDestinatario) REFERENCES UTENTE(Email)
);

-- Tabella AMMINISTRATORE
CREATE TABLE AMMINISTRATORE (
    CodiceFiscale VARCHAR(16) PRIMARY KEY,
    EmailUtente VARCHAR(255),
    FOREIGN KEY (EmailUtente) REFERENCES UTENTE(Email)
);

-- Tabella INDIRIZZO
CREATE TABLE INDIRIZZO (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Stato VARCHAR(50) NOT NULL,
    CAP VARCHAR(10) NOT NULL,
    Provincia VARCHAR(50) NOT NULL,
    Via VARCHAR(100) NOT NULL,
    Civico VARCHAR(10) NOT NULL
);

-- Tabella RISIEDE
CREATE TABLE RISIEDE (
    IdUtente VARCHAR(255),
    IdIndirizzo INT,
    PRIMARY KEY (IdUtente, IdIndirizzo),
    FOREIGN KEY (IdUtente) REFERENCES UTENTE(Email),
    FOREIGN KEY (IdIndirizzo) REFERENCES INDIRIZZO(Id)
);

-- Tabella GIOCO
CREATE TABLE GIOCO (
    Nome VARCHAR(100) PRIMARY KEY
);

-- Tabella SET
CREATE TABLE SET (
    Nome VARCHAR(100),
    Codice VARCHAR(10),
    NomeGioco VARCHAR(100),
    PRIMARY KEY (Nome, Codice),
    FOREIGN KEY (NomeGioco) REFERENCES GIOCO(Nome)
);

-- Tabella CARTA
CREATE TABLE CARTA (
    Codice VARCHAR(10) PRIMARY KEY,
    Lingua VARCHAR(50) NOT NULL,
    Immagine VARCHAR(255),
    Descrizione TEXT,
    QuantitaVenduta INT DEFAULT 0
);

-- Tabella APPARTIENE
CREATE TABLE APPARTIENE (
    CodiceSet VARCHAR(10),
    NomeSet VARCHAR(100),
    CodiceCarta VARCHAR(10),
    PRIMARY KEY (CodiceSet, NomeSet, CodiceCarta),
    FOREIGN KEY (CodiceSet, NomeSet) REFERENCES SET(Nome, Codice),
    FOREIGN KEY (CodiceCarta) REFERENCES CARTA(Codice)
);

-- Tabella EFFETTO_VISIVO
CREATE TABLE EFFETTO_VISIVO (
    Nome VARCHAR(100) PRIMARY KEY,
    Descrizione TEXT
);

-- Tabella RAPPRESENTAZIONE
CREATE TABLE RAPPRESENTAZIONE (
    CodiceCarta VARCHAR(10),
    NomeEffetto VARCHAR(100),
    PRIMARY KEY (CodiceCarta, NomeEffetto),
    FOREIGN KEY (CodiceCarta) REFERENCES CARTA(Codice),
    FOREIGN KEY (NomeEffetto) REFERENCES EFFETTO_VISIVO(Nome)
);

-- Tabella INSERZIONE
CREATE TABLE INSERZIONE (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Informazione TEXT,
    Prezzo DECIMAL(10, 2) NOT NULL,
    Quantita INT NOT NULL,
    CodiceCarta VARCHAR(10),
    EmailVenditore VARCHAR(255),
    FOREIGN KEY (CodiceCarta) REFERENCES CARTA(Codice),
    FOREIGN KEY (EmailVenditore) REFERENCES UTENTE(Email)
);

-- Tabella ORDINE
CREATE TABLE ORDINE (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    QuantitaAcquistata INT NOT NULL,
    IdInserzione INT,
    EmailAcquirente VARCHAR(255),
    IndirizzoSpedizione INT,
    FOREIGN KEY (IdInserzione) REFERENCES INSERZIONE(Id),
    FOREIGN KEY (EmailAcquirente) REFERENCES UTENTE(Email),
    FOREIGN KEY (IndirizzoSpedizione) REFERENCES INDIRIZZO(Id)
);

-- Tabella CARRELLO
CREATE TABLE CARRELLO (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    EmailUtente VARCHAR(255),
    FOREIGN KEY (EmailUtente) REFERENCES UTENTE(Email)
);

-- Tabella CONTENERE
CREATE TABLE CONTENERE (
    IdCarrello INT,
    IdInserzione INT,
    PRIMARY KEY (IdCarrello, IdInserzione),
    FOREIGN KEY (IdCarrello) REFERENCES CARRELLO(Id),
    FOREIGN KEY (IdInserzione) REFERENCES INSERZIONE(Id)
);
