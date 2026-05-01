<?php
class UsuarioController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $contraseñaP = $_POST['password'];
            $contraseñaH = password_hash($contraseñaP, PASSWORD_DEFAULT);
            $nuevoUsuario = new Usuario($email, $contraseñaH);
            $this->gestor->registrarUsuario($nuevoUsuario);

            header("Location: index.php?accion=login");
            exit;
        }

        include "views/alta.php";
    }
    
//Cookie para persistencia de inicio de sesion//
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $contraseñaP = $_POST['password'];
            $recordar = isset($_POST['recordarme']); 

            $usuario = $this->gestor->buscarUsuarioPorEmail($email);

            if ($usuario && password_verify($contraseñaP, $usuario->getPassword())) {
                
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuarioEmail'] = $usuario->getEmail(); 
                $_SESSION['fondo'] = $usuario->getFondo();


                if ($recordar) {
                    $token = base64_encode($usuario->getEmail()); 
                    
                    setcookie(
                        "usuario_login", 
                        $token, 
                        [
                            'expires' => time() + (86400 * 10), 
                            'path' => '/',
                            'httponly' => true, 
                            'samesite' => 'Strict' 
                        ]
                    );
                }

                header("Location: index.php");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
            }
        }

        include "views/login.php";
    }

    public function cambiarColor() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php?accion=login");
        exit;
    }

    $id = $_SESSION['usuario_id'];
    $color = $_POST['color'];

    $this->gestor->actualizarColorUsuario($id, $color);

    $_SESSION['fondo'] = $color;

    header("Location: index.php");
    exit;
}

    
    public function logout() {
        $_SESSION = [];
                session_destroy();
                if (isset($_COOKIE['usuario_login'])) {
            setcookie('usuario_login', '', time() - 3600000, '/');
        }
        header("Location: index.php?accion=login");
        exit;
    }
}