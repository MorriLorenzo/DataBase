<?php

class Ordine {

    private $codice;
    private $quantitaAcquistata;
    private $idInserzione;
    private $emailAcquirente;
    private $indirizzoSpedizione;

    // Costruttore della classe
    public function __construct($codice, $quantitaAcquistata, $idInserzione, $emailAcquirente, $indirizzoSpedizione) {
        $this->codice = $codice;
        $this->quantitaAcquistata = $quantitaAcquistata;
        $this->idInserzione = $idInserzione;
        $this->emailAcquirente = $emailAcquirente;
        $this->indirizzoSpedizione = $indirizzoSpedizione;
    }

    // Getter methods
    public function getCodice() {
        return $this->codice;
    }

    public function getQuantitaAcquistata() {
        return $this->quantitaAcquistata;
    }

    public function getIdInserzione() {
        return $this->idInserzione;
    }

    public function getEmailAcquirente() {
        return $this->emailAcquirente;
    }

    public function getIndirizzoSpedizione() {
        return $this->indirizzoSpedizione;
    }

    // Setter methods
    public function setCodice($codice) {
        $this->codice = $codice;
    }

    public function setQuantitaAcquistata($quantitaAcquistata) {
        $this->quantitaAcquistata = $quantitaAcquistata;
    }

    public function setIdInserzione($idInserzione) {
        $this->idInserzione = $idInserzione;
    }

    public function setEmailAcquirente($emailAcquirente) {
        $this->emailAcquirente = $emailAcquirente;
    }

    public function setIndirizzoSpedizione($indirizzoSpedizione) {
        $this->indirizzoSpedizione = $indirizzoSpedizione;
    }
}
?>
