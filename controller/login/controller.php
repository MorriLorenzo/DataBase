<?php

// Recupero dell'azione da svolgere
if (isset($_GET['action'])) {
    $azione = $_GET['action'];
} else {
    $azione = 'insert'; // Valore di default se non specificato
}

switch ($azione) {
    case 'insert':
        $view_name = "./view/login.php";
        break;
    case 'process':
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $utente = login($email, $password);

            if ($utente) {
                $_SESSION['email'] = $email;
                header("Location: index.php");//torna a index -> scheda di default
                exit; // Esco dopo il login riuscito
            } else {
                $error_msg = "Email o password non validi.";
            }
        } else {
            $error_msg = "Email e password sono richiesti.";
        }

        // In entrambi i casi di errore, imposto il messaggio di errore e reindirizzo alla pagina di login
        $_SESSION['error_msg'] = $error_msg;
        $view_name = "./view/login.php";
        break;
}

function login($email, $password) {
    $conn = Connection::getConnessione(); // Ottenere la connessione

    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $query = "SELECT * FROM UTENTE WHERE Email = ? AND Password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
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

    $stmt->close();
    return null;
}
?>
