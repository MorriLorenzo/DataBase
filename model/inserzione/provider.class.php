<?php
class InserzioneTabella {

    // Metodo per inserire una nuova inserzione nel database
    public static function insert(Inserzione $inserzione) {
        // Estrai i valori dell'oggetto Inserzione
        $informazione = $inserzione->getInformazione();
        $prezzo = $inserzione->getPrezzo();
        $quantita = $inserzione->getQuantita();
        $codiceCarta = $inserzione->getCodiceCarta();
        $emailVenditore = $inserzione->getEmailVenditore();

        // Query SQL per l'inserimento di una nuova inserzione
        $query = "INSERT INTO INSERZIONE (Informazione, Prezzo, Quantità, CodiceCarta, EmailVenditore)
                VALUES (?, ?, ?, ?, ?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sdiss', $informazione, $prezzo, $quantita, $codiceCarta, $emailVenditore);

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

    // Metodo per aggiornare un'inserzione nel database
    public static function update(Inserzione $inserzione) {
        // Estrai i valori dell'oggetto Inserzione
        $id = $inserzione->getId();
        $informazione = $inserzione->getInformazione();
        $prezzo = $inserzione->getPrezzo();
        $quantita = $inserzione->getQuantita();
        $codiceCarta = $inserzione->getCodiceCarta();
        $emailVenditore = $inserzione->getEmailVenditore();

        // Query SQL per l'aggiornamento di un'inserzione
        $query = "UPDATE INSERZIONE
                SET Informazione = ?, Prezzo = ?, Quantità = ?, CodiceCarta = ?, EmailVenditore = ?
                WHERE Id = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sdissi', $informazione, $prezzo, $quantita, $codiceCarta, $emailVenditore, $id);

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

    // Metodo per eliminare un'inserzione dal database
    public static function delete($id) {
        // Query SQL per eliminare un'inserzione
        $query = "DELETE FROM INSERZIONE WHERE Id = ?";

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

    // Metodo per ottenere tutte le inserzioni dal database
    public static function getAll() {
        // Query SQL per ottenere tutte le inserzioni
        $query = "SELECT * FROM INSERZIONE";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare le inserzioni
        $inserzioni = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Inserzione con i dati estratti
                $inserzione = new Inserzione(
                    $row['Id'],
                    $row['Informazione'],
                    $row['Prezzo'],
                    $row['Quantità'],
                    $row['CodiceCarta'],
                    $row['EmailVenditore']
                );

                // Aggiungi l'inserzione all'array
                $inserzioni[] = $inserzione;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Inserzione
        return $inserzioni;
    }

    // Metodo per ottenere un'inserzione dal database per ID
    public static function getById($id) {
        // Query SQL per ottenere l'inserzione
        $query = "SELECT * FROM INSERZIONE WHERE Id = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $id);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            // Estrai i dati dell'inserzione
            $row = $result->fetch_assoc();

            // Costruisci un oggetto Inserzione con i dati estratti
            $inserzione = new Inserzione(
                $row['Id'],
                $row['Informazione'],
                $row['Prezzo'],
                $row['Quantità'],
                $row['CodiceCarta'],
                $row['EmailVenditore']
            );

            // Chiudi lo statement
            $stmt->close();

            // Ritorna l'oggetto Inserzione
            return $inserzione;
        } else {
            // Chiudi lo statement
            $stmt->close();

            // Ritorna NULL se l'inserzione non è stata trovata
            return null;
        }
    }

    // Metodo per ottenere tutte le inserzioni dal database per CodiceCarta
    public static function getByCodiceCarta($codiceCarta) {
        // Query SQL per ottenere le inserzioni
        $query = "SELECT * FROM INSERZIONE WHERE CodiceCarta = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $codiceCarta);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare le inserzioni
        $inserzioni = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Inserzione con i dati estratti
                $inserzione = new Inserzione(
                    $row['Id'],
                    $row['Informazione'],
                    $row['Prezzo'],
                    $row['Quantità'],
                    $row['CodiceCarta'],
                    $row['EmailVenditore']
                );

                // Aggiungi l'inserzione all'array
                $inserzioni[] = $inserzione;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Inserzione
        return $inserzioni;
    }

    // Metodo per ottenere tutte le inserzioni associate a un particolare indirizzo email del venditore
    public static function getByEmail($email) {
        // Query SQL per ottenere le inserzioni con l'email del venditore specificato
        $query = "SELECT * FROM INSERZIONE WHERE EmailVenditore = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email); // 's' indica il tipo di parametro (stringa)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare le inserzioni
        $inserzioni = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Inserzione con i dati estratti
                $inserzione = new Inserzione(
                    $row['Id'],
                    $row['Informazione'],
                    $row['Prezzo'],
                    $row['Quantità'],
                    $row['CodiceCarta'],
                    $row['EmailVenditore']
                );

                // Aggiungi l'inserzione all'array
                $inserzioni[] = $inserzione;
            }
        }

        // Chiudi lo statement
        $stmt->close();

        // Ritorna array di Inserzioni
        return $inserzioni;
    }
}
?>