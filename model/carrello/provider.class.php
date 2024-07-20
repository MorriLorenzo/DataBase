<?php

class CarrelloTabella {

    // Metodo per inserire un nuovo carrello nel database
    public static function insert($emailUtente) {
        // Query SQL per l'inserimento di un nuovo carrello
        $query = "INSERT INTO CARRELLO (EmailUtente) VALUES (?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $emailUtente);

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

    // Metodo per ottenere un carrello per un utente specifico
    public static function getByEmail($emailUtente) {
        // Query SQL per ottenere il carrello
        $query = "SELECT * FROM CARRELLO WHERE EmailUtente = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $emailUtente); // 's' indica il tipo di parametro (stringa)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            // Estrai i dati del carrello
            $row = $result->fetch_assoc();

            // Costruisci un array con i dati estratti
            $carrello = new Carrello(
                $row['Id'],
                $row['EmailUtente']
            );

            // Chiudi lo statement
            $stmt->close();

            // Ritorna l'array del carrello
            return $carrello;
        } else {
            // Chiudi lo statement
            $stmt->close();

            // Ritorna NULL se il carrello non è stato trovato
            return null;
        }
    }

    // Metodo per eliminare un carrello dal database
    public static function delete($emailUtente) {
        // Query SQL per eliminare un carrello
        $query = "DELETE FROM CARRELLO WHERE EmailUtente = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $emailUtente);

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

    // Metodo per ottenere tutti i carrelli
    public static function getAll() {
        // Query SQL per ottenere tutti i carrelli
        $query = "SELECT * FROM CARRELLO";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare i carrelli
        $carrelli = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un array con i dati estratti
                $carrello = array(
                    'Id' => $row['Id'],
                    'EmailUtente' => $row['EmailUtente']
                );

                // Aggiungi il carrello all'array
                $carrelli[] = $carrello;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna l'array dei carrelli
        return $carrelli;
    }

    // Metodo per verificare se esiste un carrello per un utente specifico
    public static function exists($emailUtente) {
        // Query SQL per verificare l'esistenza di un carrello
        $query = "SELECT COUNT(*) AS count FROM CARRELLO WHERE EmailUtente = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $emailUtente);

        // Esecuzione della query
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Chiudi lo statement
        $stmt->close();

        // Restituisce vero se il conteggio è maggiore di 0, altrimenti falso
        return $row['count'] > 0;
    }

    public static function getInserzioniSalvate($idCarrello) {
        // Array per memorizzare le inserzioni trovate
        $inserzioni = array();

        // Query SQL per ottenere gli ID delle inserzioni salvate nel carrello specificato
        $query = "SELECT IdInserzione FROM CONTENERE WHERE IdCarrello = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $idCarrello); // 'i' indica il tipo di parametro (intero)
        
        // Esecuzione della query
        if ($stmt->execute()) {
            // Ottieni il risultato della query
            $result = $stmt->get_result();

            // Verifica se è stato trovato un risultato
            if ($result->num_rows > 0) {
                // Itera attraverso i risultati e ottieni i dettagli delle inserzioni
                while ($row = $result->fetch_assoc()) {
                    $idInserzione = $row['IdInserzione'];

                    $inserzione=InserzioneTabella::getById($idInserzione);

                    // Aggiungi l'inserzione all'array
                    $inserzioni[] = $inserzione;
                }
            }
        }

        // Chiudi lo statement per CONTENERE
        $stmt->close();

        // Ritorna l'array delle inserzioni
        return $inserzioni;
    }
    public static function insertIns($idCarrello, $idInserzione) {
        // Query SQL per l'inserimento di una nuova riga nella tabella CONTENERE
        $query = "INSERT INTO CONTENERE (IdCarrello, IdInserzione) VALUES (?, ?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('ii', $idCarrello, $idInserzione); // 'ii' indica due parametri interi

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

    // Funzione per eliminare una riga dalla tabella CONTENERE
    public static function deleteIns($idCarrello, $idInserzione) {
        // Query SQL per l'eliminazione di una riga dalla tabella CONTENERE
        $query = "DELETE FROM CONTENERE WHERE IdCarrello = ? AND IdInserzione = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('ii', $idCarrello, $idInserzione); // 'ii' indica due parametri interi

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
}

?>
