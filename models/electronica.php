<?php
class electronica extends producto {
    private $marca;
    private $modelo;
    private $garantia;

    public function __construct($nombre, $precio, $stock, $descripcion, $marca, $modelo, $garantia, $id=0) {
        parent::__construct($id, $nombre, $precio, $stock, $descripcion);
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->garantia = $garantia;
    }

    public function getmarca(){return $this->marca;}
    public function setmarca($marca){$this->marca= $marca; return $this;}

    public function getmodelo(){return $this->modelo;}
    public function setmodelo($modelo){$this->modelo = $modelo;return $this;}

    public function getgarantia(){return $this->garantia;}
    public function setgarantia($garantia){$this->garantia = $garantia; return $this;}
}
?>