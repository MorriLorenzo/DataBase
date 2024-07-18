<?php
class Utente {
    public $Email;
    public $Nome;
    public $Cognome;
    public $Password;
    public $Bloccato;
    public $ValutazioneTotale;
    public $NumeroRecensioni;

    function __construct($Email, $Nome, $Cognome, $Password, $Bloccato, $ValutazioneTotale, $NumeroRecensioni) {
        $this->Email = $Email;
        $this->Nome = $Nome;
        $this->Cognome = $Cognome;
        $this->Password = $Password;
        $this->Bloccato = $Bloccato;
        $this->ValutazioneTotale = $ValutazioneTotale;
        $this->NumeroRecensioni = $NumeroRecensioni;
    }

    // Getter methods
    public function getEmail() {
        return $this->Email;
    }

    public function getNome() {
        return $this->Nome;
    }

    public function getCognome() {
        return $this->Cognome;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function isBloccato() {
        return $this->Bloccato;
    }

    public function getValutazioneTotale() {
        return $this->ValutazioneTotale;
    }

    public function getNumeroRecensioni() {
        return $this->NumeroRecensioni;
    }

    // Setter methods
    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function setCognome($Cognome) {
        $this->Cognome = $Cognome;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function setBloccato($Bloccato) {
        $this->Bloccato = $Bloccato;
    }

    public function setValutazioneTotale($ValutazioneTotale) {
        $this->ValutazioneTotale = $ValutazioneTotale;
    }

    public function setNumeroRecensioni($NumeroRecensioni) {
        $this->NumeroRecensioni = $NumeroRecensioni;
    }
}
?>

