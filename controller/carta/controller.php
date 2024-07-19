<?php

//Recuperare l'action da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $action = $_GET['action'];
} else {
    $action = 'visual';  //valore di default
}

switch ($action) {
    case 'visual':
        // Comunico con il modello per la restituzione dei dati
        $carta = CartaTabella::getById("diobastardo");
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/carta.php"; //Valorizzo il nome della vista dedicata
        break;
}