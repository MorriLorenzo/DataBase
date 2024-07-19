<?php
require_once('config/config.php');
// Avvia la sessione per gestire l'autenticazione
session_start();

if (!isset($_SESSION['email'])) {
    // Se l'utente non è loggato, reindirizzalo alla pagina di login
    $_SESSION['error-message'] = '';
    include("controller/login/controller.php");
    
}else{

    // Recuperare l'azione da svolgere
    if (isset($_GET['model'])){
        $model = $_GET['model'];
    } else {
        $model = 'gioco'; // Imposta un valore predefinito se $_GET['model'] non è definito
    }

    switch ($model) {
        case 'utente':
            include("controller/utente/controller.php");
            break;
        case 'login':
            include("controller/login/controller.php");
            break;
        case 'logout':
            session_destroy();
            header("Location: index.php");
            break;
        case 'gioco':
            include("controller/gioco/controller.php");
            break;
        case 'sett':
            include("controller/sett/controller.php");
        case 'admin':
            if(UtenteTabella::isAdmin($_SESSION['email'])){
                include("controller/admin/controller.php");
            }else{
                header("Location: index.php");
            }
            break;
        case 'carrello':
            include("controller/carrello/controller.php");
            break;
        default:
            // Gestione di un caso non valido o predefinito
            // Qui potresti mostrare un errore o eseguire un'altra azione
            break;
    }
}

// Require del template base dopo aver incluso il controller appropriato
require("template/base.php");
