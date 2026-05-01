<?php
class producto {
    protected $id;
    protected $nombre;
    protected $precio;
    protected $stock;
    protected $descripcion;

    public function __construct($id, $nombre, $precio, $stock, $descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id; return $this;}

    public function getnombre(){return $this->nombre;}
    public function setnombre($nombre){$this->nombre = $nombre; return $this;}

    public function getprecio(){return $this->precio;}
    public function setprecio($precio){$this->precio = $precio; return $this;}

    public function getstock(){return $this->stock;}
    public function setstock($stock){$this->stock = $stock; return $this;}

    public function getdescripcion(){return $this->descripcion;
    public function setdescripcion($descripcion){$this->descripcion = $descripcion; return $this;}
}
?>