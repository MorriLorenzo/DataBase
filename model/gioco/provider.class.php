<?php

class GiocoTabella {

    // Connessione al database e altre operazioni di gestione dei dati potrebbero essere gestite qui

    // Metodo per inserire un nuovo utente nel database
    public static function insert(Gioco $gioco) {
        // Estrai i valori dell'oggetto Utente
        $nome = $gioco->getNome();

        // Query SQL per l'inserimento di un nuovo Gioco
        $query = "INSERT INTO GIOCO (Nome)
                  VALUES (?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $nome);

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
    public static function update($nome, $nuovoNome) {

        // Query SQL per l'aggiornamento di un gioco
        $query = "UPDATE GIOCO
                  SET Nome = ?
                  WHERE Nome = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('ss', $nuovoNome, $nome);
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
    public static function delete($nome) {
        // Query SQL per eliminare un utente
        $query = "DELETE FROM GIOCO WHERE Nome = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $nome);

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
        $query = "SELECT * FROM GIOCO";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $giochi = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $gioco = new Gioco(
                    $row['Nome'],
                );

                // Aggiungi il gioco all'array
                $giochi[] = $gioco;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $giochi;
    }

    public static function getByNome($nome) {

        // Query SQL per ottenere il gioco
        $query = "SELECT * FROM GIOCO WHERE Nome = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $nome); // 's' indica il tipo di parametro (stringa)
    
        // Esecuzione della query
        $stmt->execute();
    
        // Ottieni il risultato della query
        $result = $stmt->get_result();
    
        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            // Estrai i dati del gioco
            $row = $result->fetch_assoc();
    
            // Costruisci un oggetto Gioco con i dati estratti
            $gioco = new Gioco(
                $row['Nome']
            );
    
            // Chiudi lo statement
            $stmt->close();
    
            // Ritorna l'oggetto Gioco
            return $gioco;
        } else {
            // Chiudi lo statement
            $stmt->close();
    
            // Ritorna NULL se il gioco non è stato trovato
            return null;
        }
    }
    
}
?>