<?php
class textil extends producto {
    private $talla;
    private $material;
    private $genero;

    public function __construct($nombre, $precio, $stock, $descripcion, $talla, $material, $genero, $id=0) {
        parent::__construct($id, $nombre, $precio, $stock, $descripcion);
        $this->talla = $talla;
        $this->material = $material;
        $this->genero = $genero;
    }
    
    public function gettalla(){return $this->talla;}
    public function settalla($talla){$this->talla = $talla; return $this;}

    public function getmaterial(){return $this->material;}
    public function setmaterial($material){$this->material = $material; return $this;}

    public function getgenero(){return $this->genero;}
    public function setgenero($genero){$this->genero = $genero; return $this;}
}
?>