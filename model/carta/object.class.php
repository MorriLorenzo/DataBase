<?php
class Carta {

    public $Codice;
    public $Lingua;
    public $Immagine;
    public $Descrizione;
    public $Quantita;

    function __construct($Codice,$Lingua,$Immagine,$Descrizione,$Quantita) {

        $this->Lingua = $Lingua;
        $this->Immagine = $Immagine;
        $this->Codice = $Codice;
        $this->Descrizione = $Descrizione;
        $this->Quantita = $Quantita;
    }

    public function setCodice($Codice) {
        $this->Codice = $Codice;
    }
    public function setLingua($Lingua) {
        $this->Lingua = $Lingua;
    }
    public function setImmagine($Immagine) {
        $this->Immagine = $Immagine;
    }
    public function setDescrizione($Descrizione) {
        $this->Descrizione = $Descrizione;
    }
    public function setQuantita($Quantita) {
        $this->Quantita = $Quantita;
    }


    public function getCodice() {
        return $this->Codice;
    }
    public function getLingua() {
        return $this->Lingua;
    }
    public function getImmagine() {
        return $this->Immagine;
    }
    public function getDescrizione() {
        return $this->Descrizione;
    }
    public function getQuantita() {
        return $this->Quantita;
    }
}
?>

