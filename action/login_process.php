<?php
session_start();

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

// Prendi i dati dal form di login
$email = $_POST['email'];
$password = $_POST['password'];

// Esegui la query per verificare le credenziali dell'utente
$stmt = $conn->prepare("SELECT * FROM UTENTE WHERE Email = ? AND Password = ?");
$stmt->bind_param("ss", $email, $password);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Utente autenticato correttamente
    $_SESSION['email'] = $email;
    header("Location: ok.jpg");
} else {
    // Login fallito
    $_SESSION['error_msg'] = "Email o password non validi.";
    header("Location: login.php"); // Redirect alla pagina di login
}

$stmt->close();
$conn->close();
?>
