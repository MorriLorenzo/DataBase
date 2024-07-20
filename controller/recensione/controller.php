<?php

//Recuperare l'action da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $action = $_GET['action'];
} else {
    $action = 'visualizza';  //valore di default
}

switch ($action) {
    case 'visualizza':
        $email=$_SESSION['email'];
        $recensioni=RecensioneTabella::getByEmailDestinatario($email);
        $view_name="./view/recensione.php";
        break;
    case 'scrivi':
        $inserzione=$_GET['inserzione'];
        $destinatario=InserzioneTabella::getById($inserzione)->getEmailVenditore();
        $view_name="./view/scrivi.php";
        break;
    case 'insert':
        $inserzione=$_GET['inserzione'];
        $destinatario=InserzioneTabella::getById($inserzione)->getEmailVenditore();
        
        $mittente=$_SESSION['email'];
        
        $valutazione=$_POST['valutazione'];
        $commento=$_POST['commento'];
        
        $recensione=new Recensione($mittente,$destinatario,$valutazione,$commento);
        RecensioneTabella::insert($recensione);
        UtenteTabella::updateRec($destinatario,$valutazione);
        $ordini=OrdineTabella::getByEmailAcquirente($mittente);
        $view_name="./view/ordine.php";
        break;
}