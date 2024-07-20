<?php

class UtenteTabella {

    // Connessione al database e altre operazioni di gestione dei dati potrebbero essere gestite qui

    // Metodo per inserire un nuovo utente nel database
    public static function insert(Utente $utente) {
        // Estrai i valori dell'oggetto Utente
        $email = $utente->getEmail();
        $nome = $utente->getNome();
        $cognome = $utente->getCognome();
        $password = $utente->getPassword();
        $bloccato = $utente->isBloccato() ? 1 : 0; // Converte booleano in intero
        $valutazioneTotale = $utente->getValutazioneTotale();
        $numeroRecensioni = $utente->getNumeroRecensioni();
        if(!self::presente($utente)){
            // Query SQL per l'inserimento di un nuovo utente
            $query = "INSERT INTO UTENTE (Email, Nome, Cognome, Password, Bloccato, ValutazioneTotale, NumeroRecensioni)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Preparazione della query utilizzando la connessione già esistente
            $stmt = Connection::getConnessione()->prepare($query);
            $stmt->bind_param('ssssiii', $email, $nome, $cognome, $password, $bloccato, $valutazioneTotale, $numeroRecensioni);

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
        }else{
            return false;
        }
    }

    // Metodo per verificare se un utente è già presente nel database
    private static function presente(Utente $utente) {
        $email = $utente->getEmail();

        $query = "SELECT COUNT(*) AS count
                  FROM UTENTE
                  WHERE Email = ?";

        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        return $row['count'] > 0;
    }

    // Metodo per aggiornare un utente nel database
    public static function update(Utente $utente) {
        // Estrai i valori dell'oggetto Utente
        $email = $utente->getEmail();
        $nome = $utente->getNome();
        $cognome = $utente->getCognome();
        $password = $utente->getPassword();
        $bloccato = $utente->isBloccato() ? 1 : 0; // Converte booleano in intero
        $valutazioneTotale = $utente->getValutazioneTotale();
        $numeroRecensioni = $utente->getNumeroRecensioni();

        // Query SQL per l'aggiornamento di un utente
        $query = "UPDATE UTENTE
                  SET Nome = ?, Cognome = ?, Password = ?, Bloccato = ?, ValutazioneTotale = ?, NumeroRecensioni = ?
                  WHERE Email = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sssiiss', $nome, $cognome, $password, $bloccato, $valutazioneTotale, $numeroRecensioni, $email);

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
    public static function delete($email) {
        // Query SQL per eliminare un utente
        $query = "DELETE FROM UTENTE WHERE Email = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email);

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
        $query = "SELECT * FROM UTENTE";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $utenti = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $utente = new Utente(
                    $row['Email'],
                    $row['Nome'],
                    $row['Cognome'],
                    $row['Password'],
                    (bool) $row['Bloccato'],
                    (int) $row['ValutazioneTotale'],
                    (int) $row['NumeroRecensioni']
                );

                // Aggiungi l'utente all'array
                $utenti[] = $utente;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $utenti;
    }

    public static function getPeggiori() {
        // Query SQL per ottenere l'utente
        $query = "SELECT *,
        (ValutazioneTotale / NumeroRecensioni) AS ValutazioneMedia
        FROM UTENTE WHERE NumeroRecensioni >= 15 HAVING Valutazionemedia<= 2
        ORDER BY ValutazioneMedia ASC
        LIMIT 10";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $utenti = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $utente = new Utente(
                    $row['Email'],
                    $row['Nome'],
                    $row['Cognome'],
                    $row['Password'],
                    (bool) $row['Bloccato'],
                    (int) $row['ValutazioneTotale'],
                    (int) $row['NumeroRecensioni']
                );

                // Aggiungi l'utente all'array
                $utenti[] = $utente;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $utenti;
    }

    public static function getMigliori() {
        // Query SQL per ottenere l'utente
        $query = "SELECT *,
        (ValutazioneTotale / NumeroRecensioni) AS ValutazioneMedia
        FROM UTENTE WHERE NumeroRecensioni >= 10 HAVING Valutazionemedia>=4
        ORDER BY ValutazioneMedia DESC
        LIMIT 10";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $utenti = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $utente = new Utente(
                    $row['Email'],
                    $row['Nome'],
                    $row['Cognome'],
                    $row['Password'],
                    (bool) $row['Bloccato'],
                    (int) $row['ValutazioneTotale'],
                    (int) $row['NumeroRecensioni']
                );

                // Aggiungi l'utente all'array
                $utenti[] = $utente;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $utenti;
    }

    public static function getPeggioriInf() {
        // Query SQL per ottenere l'utente
        $query = "SELECT *,
        (ValutazioneTotale / NumeroRecensioni) AS ValutazioneMedia
        FROM UTENTE WHERE NumeroRecensioni >= 10 HAVING Valutazionemedia<= 2
        ORDER BY ValutazioneMedia ASC";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $utenti = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $utente = new Utente(
                    $row['Email'],
                    $row['Nome'],
                    $row['Cognome'],
                    $row['Password'],
                    (bool) $row['Bloccato'],
                    (int) $row['ValutazioneTotale'],
                    (int) $row['NumeroRecensioni']
                );

                // Aggiungi l'utente all'array
                $utenti[] = $utente;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $utenti;
    }

    public static function getByEmail($email) {

        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM UTENTE WHERE Email = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s', $email); // 's' indica il tipo di parametro (stringa)

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows == 1) {
            // Estrai i dati dell'utente
            $row = $result->fetch_assoc();

            // Costruisci un oggetto Utente con i dati estratti
            $utente = new Utente(
                $row['Email'],
                $row['Nome'],
                $row['Cognome'],
                $row['Password'],
                (bool) $row['Bloccato'],
                (int) $row['ValutazioneTotale'],
                (int) $row['NumeroRecensioni']
            );

            // Chiudi lo statement
            $stmt->close();

            // Ritorna l'oggetto Utente
            return $utente;
        } else {
            // Chiudi lo statement
            $stmt->close();

            // Ritorna NULL se l'utente non è stato trovato
            return null;
        }
    }

    public static function isAdmin($email) {
        // Preparare la query SQL
        $query = "SELECT COUNT(*) AS count
                  FROM AMMINISTRATORE
                  WHERE EmailUtente = ?";
    
        // Preparare la dichiarazione
        $stmt = Connection::getConnessione()->prepare($query);
    
        // Associare il parametro
        $stmt->bind_param('s', $email);
    
        // Eseguire la dichiarazione
        $stmt->execute();
        
        // Ottenere il risultato
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        // Chiudere la dichiarazione
        $stmt->close();
    
        // Restituire vero se il conteggio è maggiore di 0, altrimenti falso
        return $row['count'] > 0;
    }

    // Metodo per aggiornare la valutazione totale e il numero di recensioni di un utente
    public static function updateRec($destinatario, $valutazione) {
        // Estrai l'email del destinatario
        $email = $destinatario;

        // Recupera i dati attuali dell'utente
        $conn = Connection::getConnessione();
        $query = "SELECT ValutazioneTotale, NumeroRecensioni FROM UTENTE WHERE Email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se l'utente esiste
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $valutazioneTotale = $row['ValutazioneTotale'];
            $numeroRecensioni = $row['NumeroRecensioni'];

            // Calcola i nuovi valori
            $nuovaValutazioneTotale = $valutazioneTotale + $valutazione;
            $nuovoNumeroRecensioni = $numeroRecensioni + 1;

            // Aggiorna l'utente nel database
            $updateQuery = "UPDATE UTENTE
                            SET ValutazioneTotale = ?, NumeroRecensioni = ?
                            WHERE Email = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('iis', $nuovaValutazioneTotale, $nuovoNumeroRecensioni, $email);

            // Esecuzione della query di aggiornamento
            if ($updateStmt->execute()) {
                // Chiudi lo statement
                $updateStmt->close();
                return true; // Aggiornamento riuscito
            } else {
                // Chiudi lo statement
                $updateStmt->close();
                return false; // Aggiornamento fallito
            }
        } else {
            // Chiudi lo statement
            $stmt->close();
            return false; // Utente non trovato
        }
    }

    /**
     * Blocca un utente impostando il campo Bloccato a 1.
     *
     * @param string $email L'email dell'utente da bloccare.
     * @return bool True se l'operazione è riuscita, altrimenti false.
     */
    public static function blocca($email) {
        // Query SQL per bloccare l'utente
        $query = "UPDATE UTENTE SET Bloccato = 1 WHERE Email = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        
        // Associa il parametro
        $stmt->bind_param('s', $email);

        // Esecuzione della query
        $success = $stmt->execute();

        // Chiudi lo statement
        $stmt->close();

        // Restituisce true se l'operazione è riuscita, altrimenti false
        return $success;
    }

    /**
     * Blocca un utente impostando il campo Bloccato a 1.
     *
     * @param string $email L'email dell'utente da bloccare.
     * @return bool True se l'operazione è riuscita, altrimenti false.
     */
    public static function sblocca($email) {
        // Query SQL per bloccare l'utente
        $query = "UPDATE UTENTE SET Bloccato = 0 WHERE Email = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        
        // Associa il parametro
        $stmt->bind_param('s', $email);

        // Esecuzione della query
        $success = $stmt->execute();

        // Chiudi lo statement
        $stmt->close();

        // Restituisce true se l'operazione è riuscita, altrimenti false
        return $success;
    }
    
}
?>