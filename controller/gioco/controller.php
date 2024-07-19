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
        $giochi = GiocoTabella::getAll();
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/giochi.php"; //Valorizzo il nome della vista dedicata
        break;
}