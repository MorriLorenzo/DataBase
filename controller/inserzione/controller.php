<?php
$default=0;
//Recuperare l'action da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $action = $_GET['action'];
} else {
    $action = 'visual';  //valore di default
}

switch ($action) {
    case 'visual':
        $id=$_GET['id'];
        // Comunico con il modello per la restituzione dei dati
        $inserzione = InserzioneTabella::getById($id);
        // Ottenuti i dati li passo alla vista che li rappresenta
        $view_name = "./view/inserzione.php"; //Valorizzo il nome della vista dedicata
        break;
    case 'elimina':
        $id=$_GET['id'];
        InserzioneTabella::delete($id);
        $email=$_SESSION['email'];
        $inserzioni=InserzioneTabella::getByEmail($email);
        $view_name="./view/inserzione.php";
        break;  
    case 'aggiungi':
        $carta=$_GET['carta'];
        $view_name="./view/aggiungi_inserzione.php";
        break;
    case 'insert':
        $carta=$_GET['carta'];
        $email=$_SESSION['email'];
        $informazione=$_POST['informazione'];
        $prezzo=$_POST['prezzo'];
        $quantita=$_POST['quantita'];
        $inserzione=new Inserzione($default,$informazione,$prezzo, $quantita, $carta, $email);
        InserzioneTabella::insert($inserzione);
        $inserzioni=InserzioneTabella::getByCodiceCarta($carta);
        $carta=CartaTabella::getById($carta);
        $view_name="./view/carta.php";
        break;
    case 'utente':
        $email=$_SESSION['email'];
        $inserzioni=InserzioneTabella::getByEmail($email);
        $view_name="./view/inserzione.php";
        break;
}