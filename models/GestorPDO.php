<?php

class GestorPDO{

    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConn();
    }

    public function listar() {
        $consulta="SELECT * FROM productos";
        $rtdo=$this->db->query($consulta);
        $arrayProducto=[];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)){
            if ($value['tipoProd']=="electronica"){
                $producto = new electronica ($value['nombre'], $value['precio'], $value['stock'], $value['descripcion'], $value['marca'], $value['modelo'], $value['garantia'], $value['id']);
            }else{
                $producto = new textil ($value['nombre'], $value['precio'], $value['stock'], $value['descripcion'], $value['talla'], $value['material'], $value['genero'], $value['id']);
            }
            
            $arrayProducto[]=$producto;
        }
        return $arrayProducto;
    }
    public function agregar($producto) {
        try {
            if ($producto instanceof electronica){
                $sql = "INSERT INTO productos (tipoProd, nombre, precio, stock, descripcion, marca, modelo, garantia) VALUES (:tipoProd, :nombre, :precio, :stock, :descripcion, :marca, :modelo, :garantia)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipoProd', "electronica");
                $stmt->bindValue(':nombre', $producto->getnombre());
                $stmt->bindValue(':precio', $producto->getprecio());
                $stmt->bindValue(':stock', $producto->getstock());
                $stmt->bindValue(':descripcion', $producto->getdescripcion());
                $stmt->bindValue(':marca', $producto->getmarca());
                $stmt->bindValue(':modelo', $producto->getmodelo());
                $stmt->bindValue(':garantia', $producto->getgarantia());
            }else{
                $sql = "INSERT INTO productos (tipoProd, nombre, precio, stock, descripcion, talla, material, genero) VALUES (:tipoProd, :nombre, :precio, :stock, :descripcion, :talla, :material, :genero)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipoProd', "textil");
                $stmt->bindValue(':nombre', $producto->getnombre());
                $stmt->bindValue(':precio', $producto->getprecio());
                $stmt->bindValue(':stock', $producto->getstock());
                $stmt->bindValue(':descripcion', $producto->getdescripcion());
                $stmt->bindValue(':talla', $producto->gettalla());
                $stmt->bindValue(':material', $producto->getmaterial());
                $stmt->bindValue(':genero', $producto->getgenero());
            }
            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function buscar($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql); 
        $stmt->bindValue(':id', $id);
        $stmt->execute();
 
        if ($value = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($value['tipoProd'] == "electronica") {
                return new electronica($value['nombre'], $value['precio'], $value['stock'], $value['descripcion'], $value['marca'], $value['modelo'], $value['garantia'], $value['id']);
            } else {
                return new textil($value['nombre'], $value['precio'], $value['stock'], $value['descripcion'], $value['talla'], $value['material'], $value['genero'], $value['id']);
            }
        }
        return null;
    }

    public function actualizar($producto) {
        try {
            if ($producto instanceof electronica){
                $sql="UPDATE productos SET tipoProd=:tipoProd, nombre=:nombre, precio=:precio, stock=:stock, descripcion=:descripcion, marca=:marca, modelo=:modelo, garantia=:garantia, WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $producto->getId());
                $stmt->bindValue(':tipoProd', "electronica");
                $stmt->bindValue(':nombre', $producto->getnombre());
                $stmt->bindValue(':precio', $producto->getprecio());
                $stmt->bindValue(':stock', $producto->getstock());
                $stmt->bindValue(':descripcion', $producto->getdescripcion());
                $stmt->bindValue(':marca', $producto->getmarca());
                $stmt->bindValue(':modelo', $producto->getmodelo());
                $stmt->bindValue(':garantia', $producto->getgarantia());
            }else{
                $sql="UPDATE productos SET tipoProd=:tipoProd, nombre=:nombre, precio=:precio, stock=:stock, descripcion=:descripcion, talla=:talla, material=:material, genero=:genero, WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $producto->getId());
                $stmt->bindValue(':tipoProd', "textil");
                $stmt->bindValue(':nombre', $producto->getnombre());
                $stmt->bindValue(':precio', $producto->getprecio());
                $stmt->bindValue(':stock', $producto->getstock());
                $stmt->bindValue(':descripcion', $producto->getdescripcion());
                $stmt->bindValue(':talla', $producto->gettalla());
                $stmt->bindValue(':material', $producto->getmeterial());
                $stmt->bindValue(':genero', $producto->getgenero());
            } 
            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            die("Error de la base de datos al actualizar: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        $sql="DELETE FROM productos WHERE id=:id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }

    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());

            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        return false;
    }
}