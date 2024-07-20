<?php

class SettTabella {

    // Connessione al database e altre operazioni di gestione dei dati potrebbero essere gestite qui

    // Metodo per inserire un nuovo utente nel database
    public static function insert(Sett $sett) {
        // Estrai i valori dell'oggetto Utente
        $nome = $sett->getNome();
        $codice = $sett->getCodice();
        $nomeGioco = $sett->getNomeGioco();

        // Query SQL per l'inserimento di un nuovo Gioco
        $query = "INSERT INTO SETT (Codice,Nome,NomeGioco)
                  VALUES (?,?,?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('iss', $codice, $nome, $nomeGioco);

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
    public static function update($codice,$nome,$nuovoCodice,$NuovoNome,$NuovoNomeGioco) {

        // Query SQL per l'aggiornamento di un gioco
        $query = "UPDATE Sett
                  SET Codice = ?, Nome = ?, NomeGioco = ? 
                  WHERE Codice = ? AND Nome = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('issis', $nuovoCodice, $NuovoNome,$NuovoNomeGioco,$codice,$nome);
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
    public static function delete($codice,$nome) {
        // Query SQL per eliminare un utente
        $query = "DELETE FROM SETT WHERE Codice = ? AND Nome = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('is', $codice,$nome);

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
        $query = "SELECT * FROM SETT";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $setts = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $sett = new Sett(
                    $row['Codice'],
                    $row['Nome'],
                    $row['NomeGioco'],
                );

                // Aggiungi il gioco all'array
                $setts[] = $sett;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $setts;
    }

    public static function getAllByCodiceCarta($codiceCarta) {
        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM SETT AS S JOIN APPARTIENE AS AP ON S.Codice = AP.CodiceSet AND S.Nome = AP.NomeSet
        JOIN CARTA AS C ON C.Codice = AP.CodiceCarta 
        WHERE C.Codice = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $codiceCarta);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $setts = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $sett = new Sett(
                    $row['CodiceSet'],
                    $row['NomeSet'],
                    $row['NomeGioco']
                );

                // Aggiungi il gioco all'array
                $setts[] = $sett;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $setts;
    }

    public static function getAllByNomeGioco($nomeGioco) {
        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM SETT WHERE NomeGioco = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s',$nomeGioco);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $setts = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $sett = new Sett(
                    $row['Codice'],
                    $row['Nome'],
                    $row['NomeGioco'],
                );

                // Aggiungi il gioco all'array
                $setts[] = $sett;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $setts;
    }

    public static function getByCodiceNome($codice,$nome) {

        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM SETT WHERE Codice = ? AND Nome = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('is',$codice, $nome); // 's' indica il tipo di parametro (stringa)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            // Estrai i dati dell'utente
            $row = $result->fetch_assoc();

            // Costruisci un oggetto Gioco con i dati estratti
            $sett = new Sett(
                $row['Codice'],
                $row['Nome'],
                $row['NomeGioco'],
            );

            // Chiudi lo statement
            $stmt->close();

            // Ritorna l'oggetto Utente
            return $sett;
        } else {
            // Chiudi lo statement
            $stmt->close();

            // Ritorna NULL se l'utente non è stato trovato
            return null;
        }
    }
}
?>