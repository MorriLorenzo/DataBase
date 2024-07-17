<?php
// Connessione al database
$servername = "localhost";
$username = "utente"; // Inserisci il tuo username di MySQL
$password = "utente"; // Inserisci la tua password di MySQL
$dbname = "cardmarket"; // Inserisci il nome del tuo database

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prendi i dati dal form di registrazione
$email = $_POST['email'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$password = $_POST['password'];

// Prendi i dati dell'indirizzo
$stato = $_POST['stato'];
$cap = $_POST['cap'];
$provincia = $_POST['provincia'];
$via = $_POST['via'];
$civico = $_POST['civico'];

// Valori di default per i nuovi campi
$bloccato = 0;
$valutazioneTotale = 0;
$numeroRecensioni = 0;

try {
    // Inizio transazione
    $conn->begin_transaction();

    // Esegui la query per inserire l'utente nel database
    $stmt = $conn->prepare("INSERT INTO UTENTE (Email, Nome, Cognome, Password, Bloccato, ValutazioneTotale, NumeroRecensioni) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        throw new Exception("Errore nella preparazione della query UTENTE: " . $conn->error);
    }
    $stmt->bind_param("ssssiis", $email, $nome, $cognome, $password, $bloccato, $valutazioneTotale, $numeroRecensioni);
    if (!$stmt->execute()) {
        throw new Exception("Errore nell'esecuzione della query UTENTE: " . $stmt->error);
    }

    // Controlla se l'indirizzo esiste già
    $stmt = $conn->prepare("SELECT Id FROM INDIRIZZO WHERE Stato = ? AND CAP = ? AND Provincia = ? AND Via = ? AND Civico = ?");
    if ($stmt === false) {
        throw new Exception("Errore nella preparazione della query INDIRIZZO: " . $conn->error);
    }
    $stmt->bind_param("sssss", $stato, $cap, $provincia, $via, $civico);
    if (!$stmt->execute()) {
        throw new Exception("Errore nell'esecuzione della query INDIRIZZO: " . $stmt->error);
    }
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // L'indirizzo esiste già, ottieni il suo ID
        $stmt->bind_result($indirizzo_id);
        $stmt->fetch();
    } else {
        // L'indirizzo non esiste, inseriscilo nel database
        $stmt = $conn->prepare("INSERT INTO INDIRIZZO (Stato, CAP, Provincia, Via, Civico) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception("Errore nella preparazione della query di inserimento INDIRIZZO: " . $conn->error);
        }
        $stmt->bind_param("sssss", $stato, $cap, $provincia, $via, $civico);
        if (!$stmt->execute()) {
            throw new Exception("Errore nell'esecuzione della query di inserimento INDIRIZZO: " . $stmt->error);
        }
        $indirizzo_id = $stmt->insert_id;
    }

    // Esegui la query per inserire il record nella tabella RISIEDE
    $stmt = $conn->prepare("INSERT INTO RISIEDE (IdUtente, IdIndirizzo) VALUES (?, ?)");
    if ($stmt === false) {
        throw new Exception("Errore nella preparazione della query RISIEDE: " . $conn->error);
    }
    $stmt->bind_param("si", $email, $indirizzo_id);
    if (!$stmt->execute()) {
        throw new Exception("Errore nell'esecuzione della query RISIEDE: " . $stmt->error);
    }

    // Commit della transazione
    $conn->commit();

    echo "Registrazione avvenuta con successo. <a href='login.php'>Accedi</a>";
}catch (Exception $e) {
    // Rollback della transazione in caso di errore
    $conn->rollback();
    echo "Errore durante la registrazione: " . $e->getMessage();
}
$stmt->close();
$conn->close();
?>
