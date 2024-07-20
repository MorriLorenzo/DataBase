<?php

class Recensione {
    private $idMittente;
    private $idDestinatario;
    private $valutazione;
    private $commento;

    // Costruttore
    public function __construct($idMittente, $idDestinatario, $valutazione, $commento) {
        $this->idMittente = $idMittente;
        $this->idDestinatario = $idDestinatario;
        $this->valutazione = $valutazione;
        $this->commento = $commento;
    }

    // Getter methods
    public function getIdMittente() {
        return $this->idMittente;
    }

    public function getIdDestinatario() {
        return $this->idDestinatario;
    }

    public function getValutazione() {
        return $this->valutazione;
    }

    public function getCommento() {
        return $this->commento;
    }

    // Setter methods
    public function setIdMittente($idMittente) {
        $this->idMittente = $idMittente;
    }

    public function setIdDestinatario($idDestinatario) {
        $this->idDestinatario = $idDestinatario;
    }

    public function setValutazione($valutazione) {
        $this->valutazione = $valutazione;
    }

    public function setCommento($commento) {
        $this->commento = $commento;
    }

    // Metodo toString per rappresentare l'oggetto come una stringa
    public function toString() {
        return "Recensione: [Mittente: {$this->idMittente}, Destinatario: {$this->idDestinatario}, Valutazione: {$this->valutazione}, Commento: {$this->commento}]";
    }
}