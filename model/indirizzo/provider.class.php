<?php

class IndirizzoTabella {

    // Metodo per inserire un nuovo indirizzo nel database
    public static function insert(Indirizzo $indirizzo, $email) {
        $stato = $indirizzo->getStato();
        $cap = $indirizzo->getCAP();
        $provincia = $indirizzo->getProvincia();
        $via = $indirizzo->getVia();
        $civico = $indirizzo->getCivico();

        // Verifica se l'indirizzo è già presente
        if (!self::presente($indirizzo)) {
            // Query SQL per l'inserimento di un nuovo indirizzo
            $query = "INSERT INTO INDIRIZZO (Stato, CAP, Provincia, Via, Civico) VALUES (?, ?, ?, ?, ?)";

            // Preparazione della query utilizzando la connessione già esistente
            $stmt = Connection::getConnessione()->prepare($query);
            $stmt->bind_param('sssss', $stato, $cap, $provincia, $via, $civico);

            // Esecuzione della query
            if ($stmt->execute()) {
                // Ottieni l'ID dell'indirizzo appena inserito
                $id = $stmt->insert_id;
                $indirizzo->setId($id);

                // Chiudi lo statement
                $stmt->close();
                
                // Associa l'indirizzo all'utente
                self::associaIndirizzoUtente($id, $email);
                
                return true; // Inserimento riuscito
            } else {
                // Chiudi lo statement
                $stmt->close();
                return false; // Inserimento fallito
            }
        } else {
            // L'indirizzo è già presente, associa l'indirizzo all'utente
            $id = self::getIdByIndirizzo($indirizzo);
            self::associaIndirizzoUtente($id, $email);
            return true;
        }
    }

    // Metodo per verificare se un indirizzo è già presente nel database
    private static function presente(Indirizzo $indirizzo) {
        $stato = $indirizzo->getStato();
        $cap = $indirizzo->getCAP();
        $provincia = $indirizzo->getProvincia();
        $via = $indirizzo->getVia();
        $civico = $indirizzo->getCivico();

        $query = "SELECT COUNT(*) AS count
                  FROM INDIRIZZO
                  WHERE Stato = ? AND CAP = ? AND Provincia = ? AND Via = ? AND Civico = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sssss', $stato, $cap, $provincia, $via, $civico);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        return $row['count'] > 0;
    }

    // Metodo per aggiornare un indirizzo nel database
    public static function update(Indirizzo $indirizzo) {
        $stato = $indirizzo->getStato();
        $cap = $indirizzo->getCAP();
        $provincia = $indirizzo->getProvincia();
        $via = $indirizzo->getVia();
        $civico = $indirizzo->getCivico();
        $id = $indirizzo->getId(); // Ottieni l'ID dell'indirizzo

        $query = "UPDATE INDIRIZZO
                  SET Stato = ?, CAP = ?, Provincia = ?, Via = ?, Civico = ?
                  WHERE Id = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sssssi', $stato, $cap, $provincia, $via, $civico, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Aggiornamento riuscito
        } else {
            $stmt->close();
            return false; // Aggiornamento fallito
        }
    }

    // Metodo per eliminare un indirizzo dal database
    public static function delete($id) {
        $query = "DELETE FROM INDIRIZZO WHERE Id = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Eliminazione riuscita
        } else {
            $stmt->close();
            return false; // Eliminazione fallita
        }
    }

    // Metodo per ottenere tutti gli indirizzi dal database
    public static function getAll() {
        $query = "SELECT * FROM INDIRIZZO";
        
        $stmt = Connection::getConnessione()->prepare($query);

        $stmt->execute();
        $result = $stmt->get_result();

        $indirizzi = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $indirizzo = new Indirizzo(
                    $row['Id'],
                    $row['Stato'],
                    $row['CAP'],
                    $row['Provincia'],
                    $row['Via'],
                    $row['Civico']
                );

                $indirizzi[] = $indirizzo;
            }
        }
    
        $stmt->close();

        return $indirizzi;
    }

    // Metodo per ottenere un indirizzo per ID
    public static function getById($id) {
        $query = "SELECT * FROM INDIRIZZO WHERE Id = ?";
        
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $indirizzo = new Indirizzo(
                $row['Id'],
                $row['Stato'],
                $row['CAP'],
                $row['Provincia'],
                $row['Via'],
                $row['Civico']
            );

            $stmt->close();

            return $indirizzo;
        } else {
            $stmt->close();
            return null;
        }
    }

    // Metodo per ottenere gli indirizzi di un utente dato l'email
    public static function getIndirizziByEmail($email) {
        $query = "SELECT i.*
                  FROM INDIRIZZO i
                  INNER JOIN RISIEDE r ON i.Id = r.IdIndirizzo
                  INNER JOIN UTENTE u ON r.IdUtente = u.Email
                  WHERE u.Email = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email);

        $stmt->execute();
        $result = $stmt->get_result();

        $indirizzi = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $indirizzo = new Indirizzo(
                    $row['Id'],
                    $row['Stato'],
                    $row['CAP'],
                    $row['Provincia'],
                    $row['Via'],
                    $row['Civico']
                );

                $indirizzi[] = $indirizzo;
            }
        }

        $stmt->close();

        return $indirizzi;
    }

    // Metodo per ottenere l'ID di un indirizzo dato l'oggetto Indirizzo
    public static function getIdByIndirizzo(Indirizzo $indirizzo) {
        $stato = $indirizzo->getStato();
        $cap = $indirizzo->getCAP();
        $provincia = $indirizzo->getProvincia();
        $via = $indirizzo->getVia();
        $civico = $indirizzo->getCivico();

        $query = "SELECT Id
                  FROM INDIRIZZO
                  WHERE Stato = ? AND CAP = ? AND Provincia = ? AND Via = ? AND Civico = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sssss', $stato, $cap, $provincia, $via, $civico);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $id = $row['Id'];
        } else {
            $id = null;
        }

        $stmt->close();

        return $id;
    }

    // Metodo per associare un indirizzo a un utente
    public static function associaIndirizzoUtente($idIndirizzo, $email) {
        if (!self::associazioneEsistente($idIndirizzo, $email)) {
            $query = "INSERT INTO RISIEDE (IdUtente, IdIndirizzo) VALUES (?, ?)";

            $stmt = Connection::getConnessione()->prepare($query);
            $stmt->bind_param('si', $email, $idIndirizzo);

            if ($stmt->execute()) {
                $stmt->close();
                return true; // Inserimento riuscito
            } else {
                $stmt->close();
                return false; // Inserimento fallito
            }
        } else {
            // L'associazione esiste già
            return true;
        }
    }

    // Metodo per verificare se l'associazione tra indirizzo e utente esiste già
    private static function associazioneEsistente($idIndirizzo, $email) {
        $query = "SELECT COUNT(*) AS count
                  FROM RISIEDE
                  WHERE IdUtente = ? AND IdIndirizzo = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('si', $email, $idIndirizzo);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        return $row['count'] > 0;
    }
}
?>
