<?php
require_once('config/config.php');
// Avvia la sessione per gestire l'autenticazione
/*session_start();

if (!isset($_SESSION['email'])) {
    // Se l'utente non è loggato, reindirizzalo alla pagina di login
    includeController('login');
    exit; 
}
*/
// Recuperare l'azione da svolgere
if (isset($_GET['model'])){
    $model = $_GET['model'];
} else {
    $model = 'utente'; // Imposta un valore predefinito se $_GET['model'] non è definito
}

switch ($model) {
    case 'utente':
        include("controller/utente/controller.php");
        break;
	case 'login':
		includeController('login');
		break;
    default:
        // Gestione di un caso non valido o predefinito
        // Qui potresti mostrare un errore o eseguire un'altra azione
        break;
}

// Funzione per includere e eseguire un controller
function includeController($modelName) {
    include("controller/{$modelName}/controller.php");
}


// Require del template base dopo aver incluso il controller appropriato
require("template/base.php");
