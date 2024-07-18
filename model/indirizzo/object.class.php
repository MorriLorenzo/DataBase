<?php
class Indirizzo {
    public $Id;
    public $Stato;
    public $CAP;
    public $Provincia;
    public $Via;
    public $Civico;

    function __construct($Id, $Stato, $CAP, $Provincia, $Via, $Civico) {
        $this->Id = $Id;
        $this->Stato = $Stato;
        $this->CAP = $CAP;
        $this->Provincia = $Provincia;
        $this->Via = $Via;
        $this->Civico = $Civico;
    }

    // Getter methods
    public function getId() {
        return $this->Id;
    }

    public function getStato() {
        return $this->Stato;
    }

    public function getCAP() {
        return $this->CAP;
    }

    public function getProvincia() {
        return $this->Provincia;
    }

    public function getVia() {
        return $this->Via;
    }

    public function getCivico() {
        return $this->Civico;
    }

    // Setter methods
    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setStato($Stato) {
        $this->Stato = $Stato;
    }

    public function setCAP($CAP) {
        $this->CAP = $CAP;
    }

    public function setProvincia($Provincia) {
        $this->Provincia = $Provincia;
    }

    public function setVia($Via) {
        $this->Via = $Via;
    }

    public function setCivico($Civico) {
        $this->Civico = $Civico;
    }
}
?>
