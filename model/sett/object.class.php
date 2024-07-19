<?php
class Sett {

    public $Codice;
    public $Nome;
    public $NomeGioco;

    function __construct($Codice,$Nome,$NomeGioco) {

        $this->Nome = $Nome;
        $this->NomeGioco = $NomeGioco;
        $this->Codice = $Codice;
    }

    public function setCodice($Codice) {
        $this->Codice = $Codice;
    }
    public function setNome($Nome) {
        $this->Nome = $Nome;
    }
    public function setNomeGioco($NomeGioco) {
        $this->NomeGioco = $NomeGioco;
    }

    public function getCodice() {
        return $this->Codice;
    }
    public function getNome() {
        return $this->Nome;
    }
    public function getNomeGioco() {
        return $this->NomeGioco;
    }
}
?>

