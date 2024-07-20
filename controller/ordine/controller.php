<?php
$default=0;
//Recuperare l'action da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $action = $_GET['action'];
} else {
    $action = 'visual';  //valore di default
}

switch ($action) { 
    case 'aggiungi':
        $idInserzione=$_GET['inserzione'];
        $max=InserzioneTabella::getById($idInserzione)->getQuantita();
        $email=$_SESSION['email'];
        $indirizzi=IndirizzoTabella::getIndirizziByEmail($email);
        $view_name="./view/aggiungi_ordine.php";
        break;
    
    case 'insert':
        //acquista
        $email=$_SESSION['email'];
        //form
        $quantita=$_POST['quantitaAcquistata'];
        $indirizzo=$_POST['indirizzoId'];
        $idInserzione=$_GET['inserzione'];
        $inserzione=InserzioneTabella::getById($idInserzione)->getCodiceCarta();
        $carta=CartaTabella::getById($inserzione);
        $ordine=new Ordine($default,$quantita,$idInserzione,$email,$indirizzo);
        OrdineTabella::insert($ordine);
        CartaTabella::update($carta->getCodice(),$carta->getLingua(),$carta->getImmagine(),$carta->getDescrizione(),$carta->getQuantita()+$quantita);
        $nuova= InserzioneTabella::getById($idInserzione)->getQuantita() - $quantita;
        InserzioneTabella::updateQuantita($idInserzione,$nuova);
        $ordini=OrdineTabella::getByEmailAcquirente($email);
        
        $view_name="./view/ordine.php";
        break;
    
    
    case 'utente':
        $email=$_SESSION['email'];
        $ordini=OrdineTabella::getByEmailAcquirente($email);
        $view_name="./view/ordine.php";
        break;
}