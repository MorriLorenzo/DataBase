<?php

//Recuperare l'action da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $action = $_GET['action'];
} else {
    $action = 'venduta';  //valore di default
}

switch ($action) {
    case 'visual':
        // Comunico con il modello per la restituzione dei dati
        $carta = CartaTabella::getById($_GET['codice']);
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/carta.php"; //Valorizzo il nome della vista dedicata
        break;
    case 'venduta':
        $carta = CartaTabella::getCartaPiuVenduta();
        $codiceCarta=$carta->getCodice();
        $inserzioni=InserzioneTabella::getByCodiceCarta($codiceCarta);
        $view_name= "./view/carta.php";
        break;
    case 'visualSett':
        $carte = CartaTabella::getAllBySett($_GET['codice'],$_GET['nome']);
        $view_name= "./view/elencoCarte.php";
        break;
}