<?php

// Recupero dell'azione da svolgere
if (isset($_GET['action'])) {
    $azione = $_GET['action'];
} else {
    $azione = 'login'; // Valore di default se non specificato
}

$default=0;

switch ($azione) {
    case 'login':
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
        case 'register':
            //form registrazione
            $view_name = "./view/register.php";
            break;
        case 'insert':
            //inserimento utente
            // Assegna le variabili dai dati inviati tramite POST
            $email = $_POST['email'];
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $password = $_POST['password'];

            // Crea l'oggetto Utente passando le variabili
            $utente = new Utente(
                $email,
                $nome,
                $cognome,
                $password,
                $default,
                $default,
                $default
            );

            // Assegna le variabili dai dati inviati tramite POST per Indirizzo
            $id = $default; // Può essere un valore predefinito o null se non è necessario immediatamente
            $stato = $_POST['stato'];
            $cap = $_POST['cap'];
            $provincia = $_POST['provincia'];
            $via = $_POST['via'];
            $civico = $_POST['civico'];

            // Crea l'oggetto Indirizzo passando le variabili
            $indirizzo = new Indirizzo(
                $id,
                $stato,
                $cap,
                $provincia,
                $via,
                $civico
            );
    
            UtenteTabella::insert($utente);
            IndirizzoTabella::insert($indirizzo,$email);
            header("Location: index.php");
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
