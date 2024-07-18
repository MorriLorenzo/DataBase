<?php
session_start(); // Avviare la sessione qui

if (isset($_GET['azione'])) {
    $azione = $_GET['azione'];
} else {
    $azione = 'insert';
}

switch ($azione) {
    case 'insert':
        $view_name = 'view/login.php'; // Corretto il percorso del file
        break;
    case 'process':
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($utente = login($email, $password)) {
                $_SESSION['email'] = $email;
                header("Location: /static/image/ok.jpg");
                exit;
            } else {
                $error_msg = "Email o password non validi.";
                $_SESSION['error_msg'] = $error_msg;
                $view_name = 'view/login.php'; // Corretto il percorso del file
            }
        } else {
            $error_msg = "Email e password sono richiesti.";
            $_SESSION['error_msg'] = $error_msg;
            $view_name = 'view/login.php'; // Corretto il percorso del file
        }
        break;
}

include($view_name);

function login($email, $password) {
    $conn = Connection::getConnessione(); // Ottenere la connessione

    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $query = "SELECT * FROM UTENTE WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $utente = new Utente(
                $row['Email'],
                $row['Nome'],
                $row['Cognome'],
                $row['Password'],
                (bool)$row['Bloccato'],
                (int)$row['ValutazioneTotale'],
                (int)$row['NumeroRecensioni']
            );
            $stmt->close();
            return $utente;
        }
    }
    $stmt->close();
    return null;
}
?>
