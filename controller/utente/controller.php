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
    case 'indirizzo':
        $view_name = "./view/indirizzo.php";
        break;
    case 'indirizzoi':
        $email = $_SESSION['email'];
        // Assegna le variabili dai dati inviati tramite POST per Indirizzo
        $id = 0; // Può essere un valore predefinito o null se non è necessario immediatamente
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

        IndirizzoTabella::insert($indirizzo,$email);
        
        $utente = UtenteTabella::getByEmail($_SESSION['email']);
        $indirizzi = IndirizzoTabella::getIndirizziByEmail($_SESSION['email']);
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/profile.php"; //Valorizzo il nome della vista dedicata
        break;
    case 'migliori':
        $utenti = UtenteTabella::getMigliori();
        $view_name = "./view/listaUtenti2.php";
        break;
    case 'peggiori':
        $utenti = UtenteTabella::getPeggioriInf();
        $view_name = "./view/listaUtenti2.php";
        break;
}