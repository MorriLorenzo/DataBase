<?php

//Recuperare l'azione da svolgere
if (isset($_GET['azione'])){  //controlla se è una variabile e diversa da null
    $azione = $_GET['azione'];
} else {
    $azione = 'profilo';  //valore di default
}

switch ($azione) {
    case 'profilo':
        // Comunico con il modello per la restituzione dei dati
        $utente = UtenteTabella::getByEmail('logamorri@gmail.com');
        $indirizzi = IndirizzoTabella::getIndirizziByEmail('logamorri@gmail.com');
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/profile.php"; //Valorizzo il nome della vista dedicata
        printf($view_name);
        break;
}