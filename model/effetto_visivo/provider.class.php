<?php

class EffettoTabella {

    // Connessione al database e altre operazioni di gestione dei dati potrebbero essere gestite qui

    // Metodo per inserire un nuovo utente nel database
    public static function insert(EffettoVisivo $effetto) {
        // Estrai i valori dell'oggetto Utente
        $nome = $effetto->getNome();
        $descrizione = $effetto->getDescrizione();

        // Query SQL per l'inserimento di un nuovo Gioco
        $query = "INSERT INTO EFFETTO_VISIVO (Codice,Descrizione)
                  VALUES (?,?)";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('ss', $codice, $descrizione);

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
    public static function update($nome,$NuovoNome,$NuovaDescrizione) {

        // Query SQL per l'aggiornamento di un gioco
        $query = "UPDATE EFFETTO_VISIVO
                  SET Nome = ?, Descrizione = ? 
                  WHERE Nome = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('sss', $NuovoNome,$NuovaDescrizione,$nome);
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
        $query = "DELETE FROM EFFETTO_VISIVO WHERE Nome = ?";

        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s',$nome);

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
        $query = "SELECT * FROM EFFETTO_VISIVO";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $effetti = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $effetto = new EffettoVisivo(
                    $row['Nome'],
                    $row['Descrizione'],
                );

                // Aggiungi il gioco all'array
                $effetti[] = $effetto;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $effetti;
    }

    //ottengo tutti gli effetti visivi(versioni) di una singola carta dato il suo codice, 
    public static function getAllByCodiceCarta($CodiceCarta) {
        // Query SQL per ottenere l'utente
        $query = "SELECT EV.Nome, EV.Descrizione 
          FROM CARTA AS C
          JOIN RAPPRESENTAZIONE AS R ON R.CodiceCarta = C.Codice
          JOIN EFFETTO_VISIVO AS EV ON R.NomeEffetto = EV.Nome
          WHERE C.Codice = ?";
        
        // Preparazione della query utilizzando la connessione già esistente
        $stmt = Connection::getConnessione()->prepare($query);
        $stmt->bind_param('s',$CodiceCarta);

        // Esecuzione della query
        $stmt->execute();

        // Ottieni il risultato della query
        $result = $stmt->get_result();

        // Array per memorizzare gli utenti
        $effetti = array();

        // Verifica se è stato trovato un risultato
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Costruisci un oggetto Utente con i dati estratti
                $effetto = new EffettoVisivo(
                    $row['Nome'],
                    $row['Descrizione']
                );

                // Aggiungi il gioco all'array
                $effetti[] = $effetto;
            }
        }
    
        // Chiudi lo statement
        $stmt->close();

        // Ritorna array Utente
        return $effetti;
    }

    public static function getByCodiceNome($codice,$nome) {

        // Query SQL per ottenere l'utente
        $query = "SELECT * FROM EFFETTO_VISIVO WHERE Codice = ? AND Nome = ?";
        
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
            $effetto = new EffettoVisivo(
                $row['Codice'],
                $row['Nome'],
                $row['NomeGioco'],
            );

            // Chiudi lo statement
            $stmt->close();

            // Ritorna l'oggetto Utente
            return $effetto;
        } else {
            // Chiudi lo statement
            $stmt->close();

            // Ritorna NULL se l'utente non è stato trovato
            return null;
        }
    }
}
?>