<?php
include_once './model/Usuario.php';
include_once './dao/usuarioDAO.php';

class UsuarioController {
    public function index() {       
        //Habría que incluir el register o login 
        include_once 'view\register.php'; 
    }


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rol = 'user';  
            UsuarioDAO::registrarUsuario($username, $password, $rol);
        }
    
        // Puedes pasar el mensaje como parámetro en la redirección
        header("Location: index.php?controller=product&action=panelHome");
    }


    public function login() {
        // Verificar si se ha enviado el formulario de login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Obtener el usuario de la base de datos
            $user = UsuarioDAO::getUserByUsername($username);

            // Verificar las credenciales
            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sesión y redirigir según el rol
                session_start();
                $_SESSION['user'] = $user;

                header("Location: index.php?controller=product&action=panelHome");
                
            } else {
                // Credenciales incorrectas
                echo "Credenciales incorrectas";
            }
        }

        // Mostrar el formulario de login
        // include_once 'view/register.php';
    }

    public function logout() {
        session_start();
        // Cerrar sesión y redirigir al inicio
        session_destroy();
        header("Location: index.php?controller=product&action=panelHome");
    }
}
?>