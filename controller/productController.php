<?php
include_once './model/Pedido.php';
include_once './model/Product.php';
include_once './dao/productDAO.php';

class ProductController {
    public function index() {
                
        $products = ProductDAO::getAllProducts();
       
        // include_once 'view\products.php'; 
        include_once 'view\panelHome.php'; 
    }


    public function añadirCarrito() {
    session_start();

    if (!isset($_SESSION['selecciones'])) {
        $_SESSION['selecciones'] = array();
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $existing_key = null;

        // Buscar si el producto ya está en el carrito
        foreach ($_SESSION['selecciones'] as $key => $pedido) {
            if ($pedido->getProducto()->getId() == $id) {
                $existing_key = $key;
                break;
            }
        }

        if ($existing_key !== null) {
            // Si el producto ya está en el carrito, incrementar la cantidad
            $_SESSION['selecciones'][$existing_key]->setCantidad($_SESSION['selecciones'][$existing_key]->getCantidad() + 1);
        } else {
            // Si el producto no está en el carrito, agregar un nuevo pedido
            $product = ProductDAO::getProductById($id);
            $pedido = new Pedido($product);
            array_push($_SESSION['selecciones'], $pedido);
        }
    }

        // Redirigir a la página de productos o a donde desees
        header("Location: index.php?controller=product&action=products");
    }


    public function products() {
        session_start();
        $products = ProductDAO::getAllProducts();
        include_once 'view/header.php';
        include_once 'view/products.php';
        include_once 'view/footer.php';
    }


    public function panelCompra() {
        session_start();
        include_once 'view/header.php';
        include_once 'view/panelCompra.php';
        include_once 'view/footer.php';
    }


    public function panelHome() {
        session_start();
        $products = ProductDAO::getAllProducts();
        include_once 'view/header.php';
        include_once 'view/panelHome.php';
        include_once 'view/footer.php';
    }


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


    public function confirmar() {
        session_start();
    
        // Verifica si hay productos en el carrito
        if (isset($_SESSION['selecciones']) && !empty($_SESSION['selecciones'])) {
            // Obtén la información del carrito
            $carritoInfo = array();
            $totalPedido = 0; // Inicializa el total del pedido
    
            foreach ($_SESSION['selecciones'] as $pedido) {
                $productoInfo = array(
                    'id' => $pedido->getProducto()->getId(),
                    'nombre' => $pedido->getProducto()->getNombre(),
                    'precio' => $pedido->getProducto()->getPrecio(),
                    'cantidad' => $pedido->getCantidad(),
                    'subtotal' => $pedido->devuelvePrecioTotal()
                );
                $carritoInfo[] = $productoInfo;
    
                // Suma al total del pedido
                $totalPedido += $pedido->devuelvePrecioTotal();
            }
    
            // Obtén el nombre de usuario del usuario actual desde la sesión
            $username = $_SESSION['user']['username'];
    
            // Obtén el id del usuario actual usando la función getUserId de UsuarioDAO
            $usuario_id = UsuarioDAO::getUserId($username);
    
            // Inserta el pedido en la tabla pedidos
            $con = DB::getConnection();
            $stmt = $con->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)");
            $stmt->bind_param("id", $usuario_id, $totalPedido);
            $stmt->execute();
            $pedido_id = $stmt->insert_id; // Obtiene el ID del pedido recién insertado
    
            // Inserta los productos del carrito en la tabla productos_pedido
            foreach ($carritoInfo as $producto) {
                $stmt = $con->prepare("INSERT INTO productos_pedido (pedido_id, producto_id, precio, cantidad, subtotal) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iisid", $pedido_id, $producto['id'], $producto['precio'], $producto['cantidad'], $producto['subtotal']);
                $stmt->execute();
            }
    
            // Limpia el carrito en la sesión
            unset($_SESSION['selecciones']);
    
            // Si el usuario actual es el que creó el carrito, configura la cookie
            $carritoJson = json_encode($carritoInfo);
            setcookie('carrito', $carritoJson, time() + (30 * 1), "/"); // Cookie válida por 30 días
    
            $con->close();
    
            // Redirige a la página de visualización de pedidos o a donde desees
            header("Location: index.php?controller=product&action=panelHome");
            exit();
        } else {
            // No hay productos en el carrito, puedes manejar esto de acuerdo a tus necesidades
            echo "No hay productos en el carrito.";
            exit();
        }
    }












    public function edit(){
        echo 'Pagina de editar';
        if($_POST['categoria'] == 'Bebida'){
            $product = ProductDAO::getBebidaById($_POST['id']);
        }elseif($_POST['categoria'] == 'Postre'){
            $product = ProductDAO::getPostreById($_POST['id']);
        }else{
            $product = ProductDAO::getPlatoPrincipalById($_POST['id']);
        }

        // REVISAR QUE ARCHIVO PONER EN EL INCLUDE
        include_once 'view/panelEditProduct.php';
    }

    public function editProduct(){

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        ProductDAO::editProductById();

    }






    // MIRAR EN QUE ARCHIVO PONER
    // public function eliminar(){
    //     $id_product = $_POST['id'];
    //     ProductDAO::deleteProduct($id_product);
    //     header("Location: ".url.'?controller=product');
    // }

    // public function editar(){
    //     $id = $_POST['id'];
    //     $product = ProductDAO::getProductById($id);
    //     include_once 'view/editarPedido.php';
    // }

    // public function actualizar(){
    //     $id = $_POST['id']; 
    //     $nombre = $_POST['nombre'];
    //     $categoria = $_POST['categoria'];
    //     $precio = $_POST['precio'];
    //     $precio_premium = $_POST['precio_premium'];
    //     $image = $_POST['image'];
    //     $categoria_id = $_POST['categoria_id'];

    //     ProductDAO::updateProduct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id);
    //     header("Location: ".url.'?controller=product');
    // }

}
?>