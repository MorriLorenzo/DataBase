<?php
class EffettoVisivo {

    public $Nome;
    public $Descrizione;

    function __construct($Nome,$Descrizione) {

        $this->Nome = $Nome;
        $this->Descrizione = $Descrizione;
    }

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }
    public function setDescrizione($Descrizione) {
        $this->Descrizione = $Descrizione;
    }

    public function getNome() {
        return $this->Nome;
    }
    public function getDescrizione() {
        return $this->Descrizione;
    }
}
?>

