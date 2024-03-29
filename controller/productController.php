<?php
include_once './model/Pedido.php';
include_once './model/Product.php';
include_once './dao/productDAO.php';

class ProductController {
    // FUNCION PRINCIPAL
    public function index() {
                
        $products = ProductDAO::getFourProducts();
        include_once 'view\panelHome.php'; 
    }

    // FUNCION PARA AÑADIR UN PRODUCTO AL CARRITO
    public function añadirCarrito() {
        session_start();
    
        // Verifica si el usuario ha iniciado sesión
        if (!isset($_SESSION['user'])) {
            // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
            header("Location: index.php?controller=usuario&action=index");
            exit();
        }
    
        // Continúa con el código solo si el usuario ha iniciado sesión
        if (!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array();
        }
    
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $existing_key = null;
    
            // Busca si el producto ya está en el carrito
            foreach ($_SESSION['selecciones'] as $key => $pedido) {
                if ($pedido->getProducto()->getId() == $id) {
                    $existing_key = $key;
                    break;
                }
            }
    
            if ($existing_key !== null) {
                // Si el producto ya está en el carrito, incrementa la cantidad
                $_SESSION['selecciones'][$existing_key]->setCantidad($_SESSION['selecciones'][$existing_key]->getCantidad() + 1);
            } else {
                // Si el producto no está en el carrito, añade un nuevo pedido
                $product = ProductDAO::getProductById($id);
                $pedido = new Pedido($product);
                array_push($_SESSION['selecciones'], $pedido);
            }
        }
    
        header("Location: index.php?controller=product&action=products");
    }

    // FUNCION PARA AÑADIR UN PRODUCTO AL CARRITO DESDE LA PAGINA DE CARRITO (CAMBIA EL HEADER FINAL, PARA MENTENER LA MISMA PAGINA)
    public function añadirCarritoDesdeCarrito() {
        session_start();
    
        if (!isset($_SESSION['selecciones'])) {
            $_SESSION['selecciones'] = array();
        }
    
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $existing_key = null;
    
            // Busca si el producto ya está en el carrito
            foreach ($_SESSION['selecciones'] as $key => $pedido) {
                if ($pedido->getProducto()->getId() == $id) {
                    $existing_key = $key;
                    break;
                }
            }
    
            if ($existing_key !== null) {
                // Si el producto ya está en el carrito, incrementa la cantidad
                $_SESSION['selecciones'][$existing_key]->setCantidad($_SESSION['selecciones'][$existing_key]->getCantidad() + 1);
            } else {
                // Si el producto no está en el carrito, añade un nuevo pedido
                $product = ProductDAO::getProductById($id);
                $pedido = new Pedido($product);
                array_push($_SESSION['selecciones'], $pedido);
            }
        }
    
        header("Location: index.php?controller=product&action=panelCompra");
    }

    // FUNCION PARA IR A PAGINA DE CARTA
    public function products() {
        session_start();
        $products = ProductDAO::getAllProducts();
        include_once 'view/header.php';
        include_once 'view/products.php';
        include_once 'view/footer.php';
    }

    // FUNCION PARA IR A PAGINA DE EDITAR PRODUCTO (ADMIN)
    public function panelEditProduct() {
        session_start();
        include_once 'view/header.php';
        include_once 'view/panelEditProduct.php';
        include_once 'view/footer.php';
    }

    // FUNCION PARA IR A PAGINA DE CARRITO
    public function panelCompra() {
        session_start();
        $products = ProductDAO::getFourProducts();
        include_once 'view/header.php';
        include_once 'view/panelCompra.php';
        include_once 'view/footer.php';
    }

    // FUNCION PARA IR A PAGINA PRINCIPAL
    public function panelHome() {
        session_start();
        $products = ProductDAO::getFourProducts();
        include_once 'view/header.php';
        include_once 'view/panelHome.php';
        include_once 'view/footer.php';
    }

    // FUNCION PARA MODIFICAR CANTIDAD DE UN PRODUCTO EN EL CARRITO
    public function funcionalidadesCarrito(){
        session_start();
    
        if (isset($_POST['pos'])) {
            $pos = $_POST['pos'];
            
            if (isset($_POST['Add'])) {
                $pedido = $_SESSION['selecciones'][$pos];
                $pedido->setCantidad($pedido->getCantidad() + 1);
            } elseif (isset($_POST['Del'])) {
                $pedido = $_SESSION['selecciones'][$pos];
                if ($pedido->getCantidad() == 1) {
                    unset($_SESSION['selecciones'][$pos]);
                    // Reindexar el array
                    $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
                } else {
                    $pedido->setCantidad($pedido->getCantidad() - 1);
                }
            }
        }
        header("Location: index.php?controller=product&action=panelCompra");
    }

    // FUNCION PARA GUARDAR DATOS DELL CARRITO EN LA BASE DE DATOS Y EN UNA COOKIE
    public function confirmar() {
        session_start();
        // Verifica si el usuario está autenticado
        if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Usuario) {
            // Verifica si hay productos en el carrito
            if (isset($_SESSION['selecciones']) && !empty($_SESSION['selecciones'])) {
                // Obtiene la información del carrito
                $carritoInfo = array();
                $totalPedido = 0;
    
                foreach ($_SESSION['selecciones'] as $pedido) {
                    if ($pedido->getCantidad() > 0) {
                        $productoInfo = array(
                            'id' => $pedido->getProducto()->getId(),
                            'nombre' => $pedido->getProducto()->getNombre(),
                            'precio' => $pedido->getProducto()->getPrecio(),
                            'cantidad' => $pedido->getCantidad(),
                            'subtotal' => $pedido->devuelvePrecioTotal()
                        );
                        $carritoInfo[] = $productoInfo;
                        $totalPedido += $pedido->devuelvePrecioTotal();
                    }
                }
                $user = $_SESSION['user'];
                $usuario_id = $user->getId();
                $descuento = isset($_POST['descuento']) ? floatval($_POST['descuento']) : 0;
                $puntosUsados = isset($_POST['puntosUsados']) ? intval($_POST['puntosUsados']) : 0;
                // Obtiene la propina desde el formulario
                $propinaPorcentaje = isset($_POST['propina']) ? floatval($_POST['propina']) : 0;
                $aplicarPropinas = isset($_POST['aplicarPropinas']) ? $_POST['aplicarPropinas'] : 'off';

                if ($aplicarPropinas == 'off') {
                    $propinaPorcentaje = 0;
                }
    
                // Resta los puntos usados de los puntos totales del usuario
                UsuarioDAO::restarPuntosFidelidad($usuario_id, $puntosUsados);
    
                // Calcula los puntos ganados por el total del pedido
                $totalPuntos = $totalPedido - $puntosUsados;
                $puntosGanados = floor($totalPuntos / 10);
    
                // Suma los puntos ganados a los puntos totales del usuario
                UsuarioDAO::actualizarPauntosFidelidad($usuario_id, $puntosGanados);
    
                $totalPedido -= $descuento;


                // Calcula la propina en base al total del pedido después de aplicar los puntos
                $propina = ($totalPedido /100 ) * $propinaPorcentaje;

                // Añade la propina al total del pedido
                $totalPedido += $propina;

                

                $con = DB::getConnection();
                $stmt = $con->prepare("INSERT INTO pedidos (usuario_id, total, propina, puntos_usados, puntos_ganados) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iddii", $usuario_id, $totalPedido, $propina, $puntosUsados, $puntosGanados);
                $stmt->execute();
                $pedido_id = $stmt->insert_id; 
                foreach ($carritoInfo as $producto) {
                    $stmt = $con->prepare("INSERT INTO productos_pedido (pedido_id, producto_id, precio, cantidad, subtotal) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("iisid", $pedido_id, $producto['id'], $producto['precio'], $producto['cantidad'], $producto['subtotal']);
                    $stmt->execute();
                }
                unset($_SESSION['selecciones']);

                // Después de insertar el pedido en la tabla pedidos
                $pedido_id = $stmt->insert_id;

                // Actualiza la cookie para incluir el ID del usuario y el ID del pedido
                $carritoInfo['usuario_id'] = $usuario_id;
                $carritoInfo['pedido_id'] = $pedido_id;
                $carritoJson = json_encode($carritoInfo);
                setcookie('carrito', $carritoJson, time() + (30 * 1), "/"); // Cookie válida por 30 días

                $con->close();

                header('Content-Type: application/json');
                echo json_encode(['pedido_id' => $pedido_id]);
                exit();    
            }
        } else {
            // Redirige al usuario a la página de inicio de sesión si no está autenticado
            header("Location: index.php?controller=usuario&action=index");
            exit();
        }
    }
    
    // FUNCION PARA MOSTRAR INFORMACION DEL PEDIDO CON QR
    public function mostrarPedido() {
        // Obtiene el ID del usuario de la URL
        $usuarioId = $_GET['usuarioId'];
    
        // Obtiene el último pedido del usuario
        $pedidoId = UsuarioDAO::obtenerUltimoPedidoPorUsuarioId($usuarioId);
    
        // Obtiene la información del pedido
        $pedido = UsuarioDAO::obtenerPedidoPorId($pedidoId);
    
        // Carga la vista con la información del pedido
        include_once 'view/panelInfoPedido.php';
    }



    // FUNCION PARA RECUPERAR ÚLTIMO PEDIDO DE CADA USUARIO
        public function recuperarUltimoPedido() {
        session_start();
        // Verifica si hay un usuario activo
        if (isset($_SESSION['user'])) {
            // Obtiene el usuario actual
            $user = $_SESSION['user'];

            // Obtiene el id del usuario actual
            $usuario_id = $user->getId();
    
            // Consulta el último pedido del usuario
            $con = DB::getConnection();
            $stmt = $con->prepare("SELECT MAX(id) as ultimo_pedido_id FROM pedidos WHERE usuario_id = ?");
            $stmt->bind_param("i", $usuario_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
    
            // Verifica si se hay el último pedido
            if ($result && $row = $result->fetch_object()) {
                $ultimoPedidoID = $row->ultimo_pedido_id;
    
                // Consulta los productos asociados al último pedido
                $stmt = $con->prepare("SELECT * FROM productos_pedido WHERE pedido_id = ?");
                $stmt->bind_param("i", $ultimoPedidoID);
                $stmt->execute();
                $productosPedido = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                $con->close();
    
                // Verifica si hay productos asociados al último pedido
                if ($productosPedido) {
                    // Añade los productos del último pedido al carrito de la sesión
                    foreach ($productosPedido as $producto) {
                        $product = ProductDAO::getProductById($producto['producto_id']);
                        $pedido = new Pedido($product);
                        $pedido->setCantidad($producto['cantidad']);
                        $_SESSION['selecciones'][] = $pedido;
                    }
                    header("Location: index.php?controller=product&action=panelCompra");
                    exit();
                }
            }
        }
    }

    // FUNCION PARA IR A PANEL DE EDICION DE UN PRODUCTO (ADMIN)
    public function edit() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
            $id = $_POST['id'];
            $product = ProductDAO::getProductById($id);
    
            // Renderiza la vista de edición con los detalles del producto
            include_once 'view/header.php';
            include_once 'view/panelEditProduct.php';
            include_once 'view/footer.php';
        }
    }

    // FUNCION PARA EDITAR DATOS DE UN PRODUCTO EN BD (ADMIN)
    public function editProductById() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibe los datos del formulario
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $precio_premium = $_POST['precio_premium'];
            $image = $_POST['image'];
            $categoria_id = $_POST['categoria_id'];
            $alcohol = $_POST['alcohol'];
    
            // Realiza la actualización en la base de datos
            $success = ProductDAO::updateProduct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcohol);
    
            if ($success) {
                // Redirige o muestra un mensaje de éxito
                header("Location: index.php?controller=product&action=products");
                exit();
            } 
        } 
    }

    // FUNCION PARA IR A PAGINA DE AÑADIR PRODUCTO (ADMIN)
    public function panelAñadirProducto() {
        session_start();
        include_once 'view/header.php';
        include_once 'view/panelAñadirProducto.php';
        include_once 'view/footer.php';
    }

    // FUNCION PARA AÑADIR PRODUCTO A BD (ADMIN)
    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtén los datos del formulario
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $precio_premium = isset($_POST['precio_premium']) ? $_POST['precio_premium'] : null;
            $image = isset($_POST['image']) ? $_POST['image'] : null;
            $categoria_id = $_POST['categoria_id'];
            $alcohol = $_POST['alcohol'];
    
            // Llama a la función en el DAO para añadir el nuevo producto
            $success = ProductDAO::addProduct($nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcohol);
    
            if ($success) {
                // Redirige o muestra un mensaje de éxito
                header("Location: index.php?controller=product&action=products");
                exit();
            }
        }
    }

    // FUNCION PARA ELIMINAR PRODUCTO DE BD (ADMIN)
    public function eliminarProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $success = ProductDAO::deleteProduct($id);
    
            if ($success) {
                header("Location: index.php?controller=product&action=products");
                exit();
            }
        }
    }


    // FUNCION PARA ELIMINAR PRODUCTO (DA IGUAL LA CANTIDAD) DE UN PEDIDO
    public function eliminarProductoCarritoEntero() {
        session_start();
    
        if (isset($_POST['pos'])) {
            $pos = $_POST['pos'];
    
            // Verifica si la posición es válida en el array de selecciones
            if (isset($_SESSION['selecciones'][$pos])) {
                // Elimina el producto de la sesión utilizando unset
                unset($_SESSION['selecciones'][$pos]);
    
                // Reindexar el array
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
            }
        }
        // Redirige de vuelta a la página del carrito
        header("Location: index.php?controller=product&action=panelCompra");
    }
}
?>