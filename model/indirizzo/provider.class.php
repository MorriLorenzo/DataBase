<?php

class IndirizzoTabella {

    // Metodo per inserire un nuovo indirizzo nel database
    public static function insert($stato, $cap, $provincia, $via, $civico) {
        // Query SQL per l'inserimento di un nuovo indirizzo
        $query = "INSERT INTO INDIRIZZO (Stato, CAP, Provincia, Via, Civico)
                  VALUES (?, ?, ?, ?, ?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sssss', $stato, $cap, $provincia, $via, $civico);

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

    // Metodo per aggiornare un indirizzo nel database
    public static function update($id, $stato, $cap, $provincia, $via, $civico) {
        // Query SQL per l'aggiornamento di un indirizzo
        $query = "UPDATE INDIRIZZO
                  SET Stato = ?, CAP = ?, Provincia = ?, Via = ?, Civico = ?
                  WHERE Id = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sssssi', $stato, $cap, $provincia, $via, $civico, $id);

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

    // Metodo per eliminare un indirizzo dal database
    public static function delete($id) {
        // Query SQL per eliminare un indirizzo
        $query = "DELETE FROM INDIRIZZO WHERE Id = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $id);

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

    // Metodo per ottenere tutti gli indirizzi dal database
    public static function getAll() {
        // Query SQL per ottenere gli indirizzi
        $query = "SELECT * FROM INDIRIZZO";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli indirizzi
        $indirizzi = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Indirizzo con i dati estratti
                $indirizzo = new Indirizzo(
                    $row['Id'],
                    $row['Stato'],
                    $row['CAP'],
                    $row['Provincia'],
                    $row['Via'],
                    $row['Civico']
                );

                // Aggiungi l'indirizzo all'array
                $indirizzi[] = $indirizzo;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Indirizzo
        return $indirizzi;
    }

    public static function getById($id) {
        // Query SQL per ottenere un indirizzo
        $query = "SELECT * FROM INDIRIZZO WHERE Id = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $id); // 'i' indica il tipo di parametro (intero)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            // Estrai i dati dell'indirizzo
            $row = $result->fetch_assoc();

            // Costruisci un oggetto Indirizzo con i dati estratti
            $indirizzo = new Indirizzo(
                $row['Id'],
                $row['Stato'],
                $row['CAP'],
                $row['Provincia'],
                $row['Via'],
                $row['Civico']
            );

            // Chiudi lo statement
            $stmt->close();

            // Ritorna l'oggetto Indirizzo
            return $indirizzo;
        } else {
            // Chiudi lo statement
            $stmt->close();

            // Ritorna NULL se l'indirizzo non è stato trovato
            return null;
        }
    }

    // Metodo per ottenere gli indirizzi di un utente dato l'email
    public static function getIndirizziByEmail($email) {
        // Query SQL per ottenere gli indirizzi di un utente
        $query = "SELECT i.*
                  FROM INDIRIZZO i
                  INNER JOIN RISIEDE r ON i.Id = r.IdIndirizzo
                  INNER JOIN UTENTE u ON r.IdUtente = u.Email
                  WHERE u.Email = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email); // 's' indica il tipo di parametro (stringa)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli indirizzi
        $indirizzi = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Indirizzo con i dati estratti
                $indirizzo = new Indirizzo(
                    $row['Id'],
                    $row['Stato'],
                    $row['CAP'],
                    $row['Provincia'],
                    $row['Via'],
                    $row['Civico']
                );

                // Aggiungi l'indirizzo all'array
                $indirizzi[] = $indirizzo;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Indirizzo
        return $indirizzi;
    }
}
?>

