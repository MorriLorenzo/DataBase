<?php

//Recuperare l'azione da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $azione = $_GET['action'];
} else {
    $azione = 'azioni';  //valore di default
}

switch ($azione) {
    case 'azioni':
        
        $view_name = "./view/azioni.php"; //Valorizzo il nome della vista dedicata
        break;
}