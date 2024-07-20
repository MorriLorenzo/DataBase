<?php

class RecensioneTabella {

    // Metodo per inserire una nuova recensione nel database
    public static function insert(Recensione $recensione) {
        // Estrai i valori dell'oggetto Recensione
        $idMittente = $recensione->getIdMittente();
        $idDestinatario = $recensione->getIdDestinatario();
        $valutazione = $recensione->getValutazione();
        $commento = $recensione->getCommento();

        // Query SQL per l'inserimento di una nuova recensione
        $query = "INSERT INTO RECENSIONE (IdMittente, IdDestinatario, valutazione, commento)
                  VALUES (?, ?, ?, ?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('ssis', $idMittente, $idDestinatario, $valutazione, $commento);

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

    // Metodo per aggiornare una recensione nel database
    public static function update(Recensione $recensione) {
        // Estrai i valori dell'oggetto Recensione
        $idMittente = $recensione->getIdMittente();
        $idDestinatario = $recensione->getIdDestinatario();
        $valutazione = $recensione->getValutazione();
        $commento = $recensione->getCommento();

        // Query SQL per l'aggiornamento di una recensione
        $query = "UPDATE RECENSIONE
                  SET Valutazione = ?, Commento = ?
                  WHERE IdMittente = ? AND IdDestinatario = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('iiss', $valutazione, $commento, $idMittente, $idDestinatario);

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

    // Metodo per eliminare una recensione dal database
    public static function delete($idMittente, $idDestinatario) {
        // Query SQL per eliminare una recensione
        $query = "DELETE FROM RECENSIONE
                  WHERE IdMittente = ? AND IdDestinatario = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('ss', $idMittente, $idDestinatario);

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

    // Metodo per ottenere tutte le recensioni dove l'email del destinatario corrisponde all'email fornita
    public static function getByEmailDestinatario($email) {
        // Query SQL per ottenere le recensioni
        $query = "SELECT * FROM RECENSIONE
                  WHERE IdDestinatario = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email); // 's' indica il tipo di parametro (stringa)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare le recensioni
        $recensioni = array();

        // Verifica se sono stati trovati dei risultati
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Recensione con i dati estratti
                $recensione = new Recensione(
                    $row['IdMittente'],
                    $row['IdDestinatario'],
                    $row['valutazione'],
                    $row['commento']
                );

                // Aggiungi la recensione all'array
                $recensioni[] = $recensione;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna l'array di recensioni
        return $recensioni;
    }
}

?>
