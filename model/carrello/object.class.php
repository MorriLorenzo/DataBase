<?php
class Carrello {

    private $Id;
    private $EmailUtente;

    // Costruttore della classe
    public function __construct($Id, $EmailUtente) {
        $this->Id = $Id;
        $this->EmailUtente = $EmailUtente;
    }

    // Getter per Id
    public function getId() {
        return $this->Id;
    }

    // Setter per Id
    public function setId($Id) {
        $this->Id = $Id;
    }

    // Getter per EmailUtente
    public function getEmailUtente() {
        return $this->EmailUtente;
    }

    // Setter per EmailUtente
    public function setEmailUtente($EmailUtente) {
        $this->EmailUtente = $EmailUtente;
    }
}
?>
