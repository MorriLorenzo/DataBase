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
$default=0;

// Esegui la query per inserire l'utente nel database
$stmt = $conn->prepare("INSERT INTO UTENTE (Email, Nome, Cognome, Password, Bloccato, ValutazioneTotale, NumeroRecensioni) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiii", $email, $nome, $cognome, $password, $default, $default, $default);

if ($stmt->execute()) {
    echo "Registrazione avvenuta con successo. <a href='login.php'>Accedi</a>";
} else {
    echo "Errore durante la registrazione: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
