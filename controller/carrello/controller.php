<?php

//Recuperare l'azione da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $azione = $_GET['action'];
} else {
    $azione = 'visualizza';  //valore di default
}

switch ($azione) {
    case 'visualizza':
        $utente=UtenteTabella::getByEmail($_SESSION['email']);
        $carrello=CarrelloTabella::getByEmail($_SESSION['email']);
        $inserzioni=CarrelloTabella::getInserzioniSalvate($carrello);
        $view_name = "./view/carrello.php"; //Valorizzo il nome della vista dedicata
        break;
}