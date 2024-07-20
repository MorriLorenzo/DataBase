<?php

//Recuperare l'azione da svolgere
if (isset($_GET['action'])){  //controlla se è una variabile e diversa da null
    $azione = $_GET['action'];
} else {
    $azione = 'azioni';  //valore di default
}

if (isset($_GET['operazione'])){  //controlla se è una variabile e diversa da null
    $operazione = $_GET['operazione'];
} else {
    $operazione = '';  //valore di default
}

switch ($azione) {
    case 'azioni':
        
        $view_name = "./view/azioni.php"; //Valorizzo il nome della vista dedicata
        break;
    case 'gioco':
        
        switch($operazione){
            case 'modifica':
                $nome=$_GET['nome'];
                $gioco=GiocoTabella::getByNome($nome);
                $view_name="./view/gioco_admin_md.php";
                break;
            case 'elimina':
                $nome=$_GET['nome'];
                GiocoTabella::delete($nome);
                
                $giochi=GiocoTabella::getAll();
                $view_name="./view/gioco_admin.php";
                break;
            case 'update':
                $nome=$_GET['nome'];
                $nuovoNome=$_POST['nuovoNome'];
                GiocoTabella::update($nome,$nuovoNome);
                $giochi=GiocoTabella::getAll();
                $view_name="./view/gioco_admin.php";
                break;
            case 'aggiungi':
                $view_name="./view/aggiungi_gioco.php";
                break;
            case 'insert':
                $nome=$_POST['nome'];
                $gioco=new Gioco($nome);
                GiocoTabella::insert($gioco);
                $giochi=GiocoTabella::getAll();
                $view_name="./view/gioco_admin.php";
                break;
            default:
                $giochi=GiocoTabella::getAll();
                $view_name="./view/gioco_admin.php";
                break;
        }
        break;
        case 'sett':
        
            switch($operazione){
                case 'modifica':
                    $nome=$_GET['nome'];
                    $codice=$_GET['codice'];
                    $sett=SettTabella::getByCodiceNome($codice,$nome);
                    $giochi=GiocoTabella::getAll();
                    $view_name="./view/sett_admin_md.php";
                    break;
                case 'elimina':
                    $nome=$_GET['nome'];
                    $codice=$_GET['codice'];
                    SettTabella::delete($codice,$nome);
                    
                    $setts=SettTabella::getAll();
                    $view_name="./view/sett_admin.php";
                    break;
                case 'update':
                    $nome=$_GET['nome'];
                    $nuovoNome=$_POST['nuovoNome'];
                    $codice=$_GET['codice'];
                    $nuovoCodice=$_POST['nuovoCodice'];
                    $nuovoNomeGioco=$_POST['nuovoNomeGioco'];
                    SettTabella::update($codice,$nome,$nuovoCodice,$nuovoNome,$nuovoNomeGioco);
                    $setts=SettTabella::getAll();
                    $view_name="./view/sett_admin.php";
                    break;
                case 'aggiungi':
                    $giochi=GiocoTabella::getAll();
                    $view_name="./view/aggiungi_sett.php";
                    
                    break;
                case 'insert':
                    $nome=$_POST['nome'];
                    $codice=$_POST['codice'];
                    $nomeGioco=$_POST['nomeGioco'];
                    $giochi=GiocoTabella::getAll();
                    $sett=new Sett($codice,$nome,$nomeGioco);
                    SettTabella::insert($sett);
                    $setts=SettTabella::getAll();
                    $view_name="./view/sett_admin.php";
                    break;
                default:
                    $setts=SettTabella::getAll();
                    $view_name="./view/sett_admin.php";
                    break;
            }
        break;
}