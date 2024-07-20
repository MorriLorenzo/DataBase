<?php

class OrdineTabella {

    // Metodo per inserire un nuovo ordine nel database
    public static function insert(Ordine $ordine) {
        // Estrai i valori dell'oggetto Ordine
        $codice = $ordine->getCodice();
        $quantitaAcquistata = $ordine->getQuantitaAcquistata();
        $idInserzione = $ordine->getIdInserzione();
        $emailAcquirente = $ordine->getEmailAcquirente();
        $indirizzoSpedizione = $ordine->getIndirizzoSpedizione();

        // Query SQL per l'inserimento di un nuovo ordine
        $query = "INSERT INTO ORDINE ( QuantitàAcquistata, IdInserzione, EmailAcquirente, IndirizzoSpedizione)
                  VALUES ( ?, ?, ?, ?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('iisi', $quantitaAcquistata, $idInserzione, $emailAcquirente, $indirizzoSpedizione);

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

    // Metodo per aggiornare un ordine nel database
    public static function update(Ordine $ordine) {
        // Estrai i valori dell'oggetto Ordine
        $codice = $ordine->getCodice();
        $quantitaAcquistata = $ordine->getQuantitaAcquistata();
        $idInserzione = $ordine->getIdInserzione();
        $emailAcquirente = $ordine->getEmailAcquirente();
        $indirizzoSpedizione = $ordine->getIndirizzoSpedizione();

        // Query SQL per l'aggiornamento di un ordine
        $query = "UPDATE ORDINE
                  SET QuantitàAcquistata = ?, IdInserzione = ?, EmailAcquirente = ?, IndirizzoSpedizione = ?
                  WHERE Codice = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('iisii', $quantitaAcquistata, $idInserzione, $emailAcquirente, $indirizzoSpedizione, $codice);

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

    // Metodo per eliminare un ordine dal database
    public static function delete($codice) {
        // Query SQL per eliminare un ordine
        $query = "DELETE FROM ORDINE WHERE Codice = ?";

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

    // Metodo per ottenere tutti gli ordini dal database
    public static function getAll() {
        // Query SQL per ottenere tutti gli ordini
        $query = "SELECT * FROM ORDINE";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli ordini
        $ordini = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Ordine con i dati estratti
                $ordine = new Ordine(
                    $row['Codice'],
                    $row['QuantitàAcquistata'],
                    $row['IdInserzione'],
                    $row['EmailAcquirente'],
                    $row['IndirizzoSpedizione']
                );

                // Aggiungi l'ordine all'array
                $ordini[] = $ordine;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Ordine
        return $ordini;
    }

    // Metodo per ottenere gli ordini per email dell'acquirente
    public static function getByEmailAcquirente($emailAcquirente) {
        // Query SQL per ottenere gli ordini per email acquirente
        $query = "SELECT * FROM ORDINE WHERE EmailAcquirente = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $emailAcquirente);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli ordini
        $ordini = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Ordine con i dati estratti
                $ordine = new Ordine(
                    $row['Codice'],
                    $row['QuantitàAcquistata'],
                    $row['IdInserzione'],
                    $row['EmailAcquirente'],
                    $row['IndirizzoSpedizione']
                );

                // Aggiungi l'ordine all'array
                $ordini[] = $ordine;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Ordine
        return $ordini;
    }
}
?>
