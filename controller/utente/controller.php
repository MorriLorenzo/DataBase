<?php

//Recuperare l'azione da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $azione = $_GET['action'];
} else {
    $azione = 'profile';  //valore di default
}

switch ($azione) {
    case 'profile':
        // Comunico con il modello per la restituzione dei dati
        $utente = UtenteTabella::getByEmail($_SESSION['email']);
        $indirizzi = IndirizzoTabella::getIndirizziByEmail($_SESSION['email']);
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/profile.php"; //Valorizzo il nome della vista dedicata
        break;
}