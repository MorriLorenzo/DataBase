<?php

//Recuperare l'action da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $action = $_GET['action'];
} else {
    $action = 'menu';  //valore di default
}

switch ($action) {
    case 'menu':
        // Comunico con il modello per la restituzione dei dati
        $setts = SettTabella::getAllByNomeGioco($_GET['nome']);
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/sett.php"; //Valorizzo il nome della vista dedicata
        break;
    case 'settCarta':
        $setts = SettTabella::getAllByCodiceCarta($_GET['codice']);
        $view_name = "./view/sett.php";
        break;

}