<?php

class ProductosController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $producto = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio']; 
            $stock = $_POST['stock'];
            $descripcion = $_POST['descripcion'];
            if ($_POST['tipo']=="electronica"){
                $marca = $_POST['marca']; 
                $modelo = $_POST['modelo']; 
                $garantia = $_POST['garantia'];
                $producto = new electronica ($nombre, $precio, $stock, $descripcion, $marca, $modelo, $garantia);
            }else{
                $talla = $_POST['talla'];
                $material = $_POST['material'];
                $genero = $_POST['genero'];
                $producto = new textil ($nombre, $precio, $stock, $descripcion, $talla, $material, $genero);
            }
            $this->gestor->agregar($producto);

            header("Location: index.php");
            exit;
        }

        include "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $producto=($this->gestor->buscar($id));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto->setnombre($_POST['nombre']);
            $producto->setprecio($_POST['precio']);
            $producto->setstock($_POST['stock']);
            $producto->setdescripcion($_POST['descripcion']);
            if ($producto instanceof electronica){
                $producto->setmarca($_POST['marca']);
                $producto->setmodelo($_POST['modelo']);
                $producto->setgarantia($_POST['garantia']);
            }else{
                $producto->settalla($_POST['talla']);
                $producto->setmaterial($_POST['material']);
                $producto->setgenero($_POST['genero']);
            }
            

            $this->gestor->actualizar($producto);
            header("Location: index.php");
            exit;
        }

        include "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}
