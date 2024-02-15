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
    // public static function getUserByUsername($username) {
    //     $con = DB::getConnection();
    //     $stmt = $con->prepare("SELECT id, username, password, rol FROM usuarios WHERE username = ?");
    //     $stmt->bind_param("s", $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $con->close();
    
    //     // Verifica si se encontraron resultados
    //     if ($result && $user = $result->fetch_object('Usuario')) {
    //         // Asigna el ID al objeto Usuario
    //         $user->setId($user->id);
    //         return $user;
    //     }
    
    //     return null; 
    // }


    public static function getUserByUsername($username) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT id, username, password, rol, puntos_fidelidad FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
    
        // Verifica si se encontraron resultados
        if ($result && $user = $result->fetch_object('Usuario')) {
            // Asigna el ID al objeto Usuario
            $user->setId($user->id);
            $user->setPuntosFidelidad($user->puntos_fidelidad); // Añade los puntos al objeto Usuario
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

    // FUNCION PARA AÑADIR PUNTOS AL USUARIO DESPUÉS DE TRAMITAR PEDIDO
    public static function actualizarPauntosFidelidad($usuarioId, $puntos) {
        $con = DB::getConnection();
        $stmt = $con->prepare("UPDATE usuarios SET puntos_fidelidad = puntos_fidelidad + ? WHERE id = ?");
        $stmt->bind_param("ii", $puntos, $usuarioId);
        $resultado = $stmt->execute();
        $con->close();
    
        return $resultado;
    }

    // FUNCION PARA MOSTRAR LOS PUNTOS DE UN USUARIO
    public static function obtenerPuntosFidelidad($usuarioId) {
        $con = DB::getConnection();
    
        $stmt = $con->prepare("SELECT puntos_fidelidad FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $stmt->bind_result($puntos);
        $stmt->fetch();
        $con->close();

        return $puntos;
    }


    public static function restarPuntosFidelidad($usuarioId, $puntos) {
        $con = DB::getConnection();
        $stmt = $con->prepare("UPDATE usuarios SET puntos_fidelidad = puntos_fidelidad - ? WHERE id = ?");
        $stmt->bind_param("ii", $puntos, $usuarioId);
        $resultado = $stmt->execute();
        $con->close();
        return $resultado;
    }




    public static function obtenerUltimoPedidoPorUsuarioId($usuarioId) {
        $con = DB::getConnection();
        $query = "SELECT MAX(id) as ultimo_pedido FROM pedidos WHERE usuario_id = ?"; 
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $pedidoId = null;
        if ($row = $result->fetch_assoc()) {
            $pedidoId = $row['ultimo_pedido'];
        }
        
        $stmt->close();
        $con->close();
        
        return $pedidoId;
    }
    
    public static function obtenerPedidoPorId($pedidoId) {
        $con = DB::getConnection();
        $query = "SELECT * FROM productos_pedido WHERE pedido_id = ?"; 
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $pedidoId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $pedido = array();
        while ($row = $result->fetch_assoc()) {
            $producto = array(
                'id' => $row['producto_id'],
                'cantidad' => $row['cantidad'],
            );
            $pedido[] = $producto;
        }
        
        $stmt->close();
        $con->close();
        
        return $pedido;
    }



}
?>