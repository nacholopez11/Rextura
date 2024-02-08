<?php
include_once './model/Usuario.php';
include_once './dao/usuarioDAO.php';

class UsuarioController {
    // FUNCION PRINCIPAL
    public function index() {  
        include_once 'view\register.php'; 
    }

    // FUNCION PARA REGISTRAR UN USUARIO 
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rol = 'user';  
            UsuarioDAO::registrarUsuario($username, $password, $rol);
        }
        header("Location: index.php?controller=product&action=panelHome");
    }

    // FUNCION PARA INICIAR SESION
    public function login() {
        // Verifica si se ha enviado el formulario de login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Obtiene el usuario de la base de datos
            $user = UsuarioDAO::getUserByUsername($username);
    
            // Verifica las credenciales
            if ($user && password_verify($password, $user->getPassword())) {
                session_start();

                // Crea un objeto Usuario y almacena información esencial en la sesión
                $usuario = new Usuario();
                $usuario->setId($user-> getId());
                $usuario->setUsername($user-> getUsername());
                $usuario->setRol($user-> getRol());
                $usuario->setPuntosFidelidad($user->getPuntosFidelidad());

                $_SESSION['user'] = $usuario;

                header("Location: index.php?controller=product&action=panelHome");
            }
        }
    }

    // FUNCION PARA CERRAR SESION
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=product&action=panelHome");
    }
}
?>