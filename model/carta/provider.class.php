<?php

class CartaTabella {

    // Connessione al database e altre operazioni di gestione dei dati potrebbero essere gestite qui

    // Metodo per inserire un nuovo utente nel database
    public static function insert(Carta $carta) {
        // Estrai i valori dell'oggetto Utente
        $codice = $carta->getCodice();
        $lingua = $carta->getLingua();
        $immagine = $carta->getImmagine();
        $descrizione = $carta->getDescrizione();
        $quantita = $carta->getQuantita();

        // Query SQL per l'inserimento di un nuovo Gioco
        $query = "INSERT INTO CARTA (Codice,Lingua,Immagine,Descrizione,QuantitàVenduta)
                  VALUES (?,?,?,?,?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('isssi', $codice, $lingua, $immagine,$descrizione,$quantita);

        // Esecuzione della query
        if ($stmt->execute()) {
            // Chiudi lo statement
            $stmt->close();
            return true; // Inserimento riuscito
        } else {
            // Chiudi lo statement
            $stmt->close();
            return false; // Inserimento fallito
        }
    }

    // Metodo per aggiornare un utente nel database
    public static function update($codice,$nuovoCodice,$NuovaLingua,$NuovaImmagine,$NuovaDescrizione) {

        // Query SQL per l'aggiornamento di un gioco
        $query = "UPDATE CARTA
                  SET Codice = ?, Lingua = ?, Immagine = ?, Descrizione = ?
                  WHERE Codice = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('isssi', $nuovoCodice, $NuovaLingua,$NuovaImmagine,$NuovaDescrizione,$codice);
        // Esecuzione della query
        if ($stmt->execute()) {
            // Chiudi lo statement
            $stmt->close();
            return true; // Aggiornamento riuscito
        } else {
            // Chiudi lo statement
            $stmt->close();
            return false; // Aggiornamento fallito
        }
    }

    // Metodo per eliminare un utente dal database
    public static function delete($codice) {
        // Query SQL per eliminare un utente
        $query = "DELETE FROM CARTA WHERE Codice = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $codice);

        // Esecuzione della query
        if ($stmt->execute()) {
            // Chiudi lo statement
            $stmt->close();
            return true; // Eliminazione riuscita
        } else {
            // Chiudi lo statement
            $stmt->close();
            return false; // Eliminazione fallita
        }
    }

    // Metodo per ottenere tutti gli utenti dal database
    public static function getAll() {
        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM CARTA";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $carte = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $carta = new Carta(
                    $row['Codice'],
                    $row['Lingua'],
                    $row['Immagine'],
                    $row['Descrizione'],
                    $row['QuantitàVenduta'],
                );

                // Aggiungi il gioco all'array
                $carte[] = $carta;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $carte;
    }

    public static function getById($codice) {
        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM CARTA WHERE Codice = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $codice);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            $carta = new Carta(
                $row['Codice'],
                $row['Lingua'],
                $row['Immagine'],
                $row['Descrizione'],
                (int)$row['QuantitàVenduta'],
            );
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $carta;
    }

    public static function getAllBySett($nomeSet,$codiceSet) {
        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM CARTA AS C 
          JOIN APPARTIENE AS AP ON C.Codice = AP.CodiceCarta 
          WHERE AP.CodiceSet = ? AND AP.NomeSet = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('is',$codiceSet,$nomeSet);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $carte = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $carta = new Carta(
                    $row['Codice'],
                    $row['Lingua'],
                    $row['Immagine'],
                    $row['Descrizione'],
                    $row['Quantita'],
                );

                // Aggiungi il gioco all'array
                $carte[] = $carta;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $carte;
    }
/*
    public static function getByGioco($nome) {
    //viva le donne!     
    }
*/

    public static function getCartaPiuVenduta() {
        // Connessione al database (assicurati di sostituire con le tue credenziali)
        $conn = Connection::getConnessione();

        // Query SQL per ottenere la carta più venduta
        $query = "SELECT Codice, Lingua, Immagine, Descrizione, QuantitàVenduta
                FROM CARTA
                ORDER BY QuantitàVenduta DESC
                LIMIT 1";

        // Esecuzione della query
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Recupera la riga dei risultati
            $row = $result->fetch_assoc();

            // Crea e restituisce un oggetto Carta
            return new Carta(
                $row['Codice'],
                $row['Lingua'],
                $row['Immagine'],
                $row['Descrizione'],
                $row['QuantitàVenduta']
            );
        } else {
            return null; // Nessuna carta trovata
        }
    }
}
?>