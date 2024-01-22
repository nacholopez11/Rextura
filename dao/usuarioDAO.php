<?php
include_once 'config/DB.php';
include_once 'model/Usuario.php';

class UsuarioDAO{
    // FUNCION PARA AÑADIR UN USUARIO A LA BD
    public static function registrarUsuario($username, $password, $rol) {
        $con = DB::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $con->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $rol);
        $stmt->execute();
        $con->close();
    }

    // FUNCION PARA VERIFICAR UN USUARIO AL INICIAR SESION
    public static function verificarUsuario($username, $password) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_object();
    
            // Verificar la contraseña
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
    
        return null;
    }
    
    // FUNCION PARA OBTENER UN USUARIO POR SU NOMBRE
    public static function getUserByUsername($username) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT id, username, password, rol FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
    
        // Verifica si se encontraron resultados
        if ($result && $user = $result->fetch_object('Usuario')) {
            // Asigna el ID al objeto Usuario
            $user->setId($user->id);
            return $user;
        }
    
        return null; 
    }



    // FUNCION PARA OBTENEREL ID DE UN USUARIO QUE LE PASAS EL NOMBRE, DESPUES SE USA PARA ASIGNAR UN USUARIO A UN PEDIDO
        public static function getUserId($username) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_object();
            return $user->id;
        }
    
        return null;
    }
}
?>