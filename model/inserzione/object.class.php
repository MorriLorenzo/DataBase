<?php
class Inserzione {
    private $Id;
    private $Informazione;
    private $Prezzo;
    private $Quantita;
    private $CodiceCarta;
    private $EmailVenditore;

    function __construct($Id, $Informazione, $Prezzo, $Quantita, $CodiceCarta, $EmailVenditore) {
        $this->Id = $Id;
        $this->Informazione = $Informazione;
        $this->Prezzo = $Prezzo;
        $this->Quantita = $Quantita;
        $this->CodiceCarta = $CodiceCarta;
        $this->EmailVenditore = $EmailVenditore;
    }

    // Getter methods
    public function getId() {
        return $this->Id;
    }

    public function getInformazione() {
        return $this->Informazione;
    }

    public function getPrezzo() {
        return $this->Prezzo;
    }

    public function getQuantita() {
        return $this->Quantita;
    }

    public function getCodiceCarta() {
        return $this->CodiceCarta;
    }

    public function getEmailVenditore() {
        return $this->EmailVenditore;
    }

    // Setter methods
    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setInformazione($Informazione) {
        $this->Informazione = $Informazione;
    }

    public function setPrezzo($Prezzo) {
        $this->Prezzo = $Prezzo;
    }

    public function setQuantita($Quantita) {
        $this->Quantita = $Quantita;
    }

    public function setCodiceCarta($CodiceCarta) {
        $this->CodiceCarta = $CodiceCarta;
    }

    public function setEmailVenditore($EmailVenditore) {
        $this->EmailVenditore = $EmailVenditore;
    }
}
?>
