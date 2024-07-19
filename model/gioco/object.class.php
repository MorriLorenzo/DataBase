<?php
class Gioco {

    public $Nome;

    function __construct($Nome) {

        $this->Nome = $Nome;
    }

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function getNome() {
        return $this->Nome;
    }
}
?>

