<?php
$default = 0;
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

    case 'carta':
    
        switch($operazione){
            case 'modifica':
                $codice=$_GET['codice'];
                $carta=CartaTabella::getById($codice);
                $setts=SettTabella::getAll();
                $view_name="./view/carta_admin_md.php";
                break;
            case 'elimina':
                $codice=$_GET['codice'];
                CartaTabella::delete($codice);
                
                $carte=CartaTabella::getAll();
                $view_name="./view/carta_admin.php";
                break;
            case 'update':
                $codice=$_GET['codice'];
                $nuovoCodice=$_POST['nuovoCodice'];
                $nuovaLingua = $_POST['nuovaLingua'];
                $nuovaImmagine = $_POST['nuovaImmagine'];
                $nuovaDescrizione = $_POST['nuovaDescrizione'];
                CartaTabella::update($codice,$nuovoCodice,$nuovaLingua,$nuovaImmagine,$nuovaDescrizione, $default);
                $carte=CartaTabella::getAll();
                $view_name="./view/carta_admin.php";
                break;
            case 'aggiungi':
                $setts=SettTabella::getAll();
                $effetti=EffettoTabella::getAll();
                $view_name="./view/aggiungi_carta.php";
                
                break;
            case 'insert':
                $lingua=$_POST['lingua'];
                $codice=$_POST['codice'];
                $immagine=$_POST['immagine'];
                $descrizione=$_POST['descrizione'];
                $nomeEffetto=$_POST['nomeEffetto'];
                list($codiceSet, $nomeSet) = explode(',', $_POST['sett']);

                $carta=new Carta($codice,$lingua,$immagine, $descrizione,$default);
                CartaTabella::insert($carta,$nomeEffetto,$codiceSet,$nomeSet);
                $carte=CartaTabella::getAll();
                $view_name="./view/carta_admin.php";
                break;
            default:
                $carte=CartaTabella::getAll();
                $view_name="./view/carta_admin.php";
                break;
        }
        break;
    case 'peggiori':
            $utenti=UtenteTabella::getPeggiori();
            $view_name="./view/listaUtenti.php";

        break;
}