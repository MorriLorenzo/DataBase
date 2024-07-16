BLOCCO QUERY PER CREARE DB
-- Create tables

CREATE TABLE UTENTE (
    Email VARCHAR(255) PRIMARY KEY,
    Nome VARCHAR(255),
    Cognome VARCHAR(255),
    Password VARCHAR(255),
    Bloccato BOOLEAN,
    ValutazioneTotale INT,
    NumeroRecensioni INT
);

CREATE TABLE RECENSIONE (
    IdMittente VARCHAR(255),
    IdDestinatario VARCHAR(255),
    valutazione INT,
    commento TEXT,
    PRIMARY KEY (IdMittente, IdDestinatario),
    FOREIGN KEY (IdMittente) REFERENCES UTENTE(Email),
    FOREIGN KEY (IdDestinatario) REFERENCES UTENTE(Email)
);

CREATE TABLE AMMINISTRATORE (
    CodiceFiscale VARCHAR(16),
    EmailUtente VARCHAR(255),
    PRIMARY KEY (CodiceFiscale, EmailUtente),
    FOREIGN KEY (EmailUtente) REFERENCES UTENTE(Email)
);

CREATE TABLE INDIRIZZO (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Stato VARCHAR(255),
    CAP VARCHAR(10),
    Provincia VARCHAR(255),
    Via VARCHAR(255),
    Civico VARCHAR(10)
);

CREATE TABLE RISIEDE (
    IdUtente VARCHAR(255),
    IdIndirizzo INT,
    PRIMARY KEY (IdUtente, IdIndirizzo),
    FOREIGN KEY (IdUtente) REFERENCES UTENTE(Email),
    FOREIGN KEY (IdIndirizzo) REFERENCES INDIRIZZO(Id)
);

CREATE TABLE GIOCO (
    Nome VARCHAR(255) PRIMARY KEY
);

CREATE TABLE SETT (
    Nome VARCHAR(255),
    Codice VARCHAR(255),
    NomeGioco VARCHAR(255),
    PRIMARY KEY (Nome, Codice),
    FOREIGN KEY (NomeGioco) REFERENCES GIOCO(Nome)
);

CREATE TABLE CARTA (
    Codice VARCHAR(255) PRIMARY KEY,
    Lingua VARCHAR(255),
    Immagine TEXT,
    Descrizione TEXT,
    QuantitàVenduta INT
);

CREATE TABLE EFFETTO_VISIVO (
    Nome VARCHAR(255) PRIMARY KEY,
    Descrizione TEXT
);

CREATE TABLE APPARTIENE (
    CodiceSet VARCHAR(255),
    NomeSet VARCHAR(255),
    CodiceCarta VARCHAR(255),
    PRIMARY KEY (CodiceSet, NomeSet, CodiceCarta),
    FOREIGN KEY (CodiceSet, NomeSet) REFERENCES SETT(Nome, Codice),
    FOREIGN KEY (CodiceCarta) REFERENCES CARTA(Codice)
);

CREATE TABLE RAPPRESENTAZIONE (
    CodiceCarta VARCHAR(255),
    NomeEffetto VARCHAR(255),
    PRIMARY KEY (CodiceCarta, NomeEffetto),
    FOREIGN KEY (CodiceCarta) REFERENCES CARTA(Codice),
    FOREIGN KEY (NomeEffetto) REFERENCES EFFETTO_VISIVO(Nome)
);

CREATE TABLE INSERZIONE (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Informazione TEXT,
    Prezzo DECIMAL(10, 2),
    Quantità INT,
    CodiceCarta VARCHAR(255),
    EmailVenditore VARCHAR(255),
    FOREIGN KEY (CodiceCarta) REFERENCES CARTA(Codice),
    FOREIGN KEY (EmailVenditore) REFERENCES UTENTE(Email)
);

CREATE TABLE ORDINE (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    Lingua VARCHAR(255),
    Immagine TEXT,
    Descrizione TEXT,
    QuantitàVenduta INT,
    IdInserzione INT,
    EmailAcquirente VARCHAR(255),
    FOREIGN KEY (IdInserzione) REFERENCES INSERZIONE(Id),
    FOREIGN KEY (EmailAcquirente) REFERENCES UTENTE(Email)
);

CREATE TABLE CARRELLO (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    EmailUtente VARCHAR(255),
    FOREIGN KEY (EmailUtente) REFERENCES UTENTE(Email)
);

CREATE TABLE CONTENERE (
    IdCarrello INT,
    IdInserzione INT,
    PRIMARY KEY (IdCarrello, IdInserzione),
    FOREIGN KEY (IdCarrello) REFERENCES CARRELLO(Id),
    FOREIGN KEY (IdInserzione) REFERENCES INSERZIONE(Id)
);
