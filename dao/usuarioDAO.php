<?php
include_once 'config/DB.php';
include_once 'model/Usuario.php';

class UsuarioDAO{

    public static function registrarUsuario($username, $password, $rol) {
        $con = DB::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $con->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $rol);
        $stmt->execute();
        $con->close();
    }

    public static function verificarUsuario($username, $password) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return null;
    }
    
    public static function getUserByUsername($username) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
        return $result->fetch_assoc();
    }

    //Obtiene el ID del usuario que le pasas (utilizado para asignar un usuario a cada pedido)
    public static function getUserId($username) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user['id'];
        }

        return null;
    }

}
?>