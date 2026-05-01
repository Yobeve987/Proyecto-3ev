<?php
require_once "autoload.php";
session_start();

$gestor=new GestorPDO();
$controller = new ProductosController($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {
    
    $emailRecuperado = base64_decode($_COOKIE['usuario_login']);

    $usuario = $gestor->buscarUsuarioPorEmail($emailRecuperado);
    
    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuarioEmail'] = $usuario->getEmail();
    } else {

        setcookie('usuario_login', '', time() - 3600, '/');
    }
}
// ------------------------------------------------------

switch ($accion) {
    case 'login':
        $usuarioController->login();
        break;
    case 'alta':
        $usuarioController->alta();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    case 'crear':
    case 'editar':
    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        if ($accion === 'crear') $controller->crear();
        if ($accion === 'editar') $controller->editar();
        if ($accion === 'eliminar') $controller->eliminar();
        break;
    default:
        $controller->index();
}