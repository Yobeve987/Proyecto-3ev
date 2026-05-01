<?php
class Usuario{
    private $id;
    private $email;
    private $password;
    private $fondo;

    public function __construct($email, $password, $id=0, $fondo=null){
        $this->id=$id;
        $this->email=$email;
        $this->password=$password;
        $this->fondo=$fondo;
    }


    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;return $this;}

    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;return $this;}

    public function getPassword(){return $this->password;}
    public function setPassword($password){$this->password = $password;return $this;}

    public function getFondo(){ return $this->fondo;}
    public function setFondo($fondo){ $this->fondo = $fondo; return $this;}

}