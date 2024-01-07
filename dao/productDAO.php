<?php
include_once 'config/DB.php';
include_once 'model/Product.php';
include_once 'model/Plato_principal.php';
include_once 'model/Bebida.php';
include_once 'model/Postre.php';

class ProductDAO {

    // FUNCION PARA RECUPERAR TODOS LOS POSTRES
    public static function getAllPostres(){
        return ProductDAO::getAllProductsByType('Postre');
    }

    // FUNCION PARA RECUPERAR TODOS LOS PLATOS PRINCIPALES
    public static function getAllPlatosPrincipales(){
        return ProductDAO::getAllProductsByType('Plato_principal');
    }

    // FUNCION PARA RECUPERAR TODAS LAS BEBIDAS
    public static function getAllBebidas(){
        return ProductDAO::getAllProductsByType('Bebida');
    }

    // FUNCION PARA RECUPERAR TODOS LOS PRODUCTOS
    public static function getAllProducts() {
        $allproducts = array_merge(productDAO::getAllPlatosPrincipales(),productDAO::getAllBebidas(),productDAO::getAllPostres());

        return $allproducts;
    }

    // FUNCION PARA RECUPERAR TODOS LOS PRODUCTOS SEGUN LA CATEGORIA
    public static function getAllProductsByType($tipo){
        $con = DB::getConnection(); 
        $stmt = $con->prepare("SELECT * FROM products WHERE categoria=?");
        $stmt->bind_param("s",$tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
        $products = [];
    
        while ($row = $result->fetch_assoc()) {
            $product = $tipo === 'Bebida' ? new Bebida($row['id'], $row['nombre'], $row['categoria'], $row['precio'], $row['precio_premium'], $row['image'], $row['categoria_id'], $row['conAlcohol']) : new Product($row['id'], $row['nombre'], $row['categoria'], $row['precio'], $row['precio_premium'], $row['image'], $row['categoria_id']);
    
            $products[] = $product;
        }
    
        return $products;
    }
   
    // FUNCION PARA RECUPERAR UN PRODUCTO SEGUN EL ID QUE LE PASAS
    public static function getProductById($id) {
        $con = DB::getConnection();
        $query = "SELECT * FROM products WHERE id = $id";
        $result = $con->query($query);
        $row = $result->fetch_object();
    
        // Verifica si es una bebida
        if ($row->categoria_id == 3) {
            $product = new Bebida($row->id, $row->nombre, $row->categoria, $row->precio, $row->precio_premium, $row->image, $row->categoria_id, $row->conAlcohol);
        } else {
            $product = new Product($row->id, $row->nombre, $row->categoria, $row->precio, $row->precio_premium, $row->image, $row->categoria_id);
        }
    
        $con->close();
    
        return $product;
    }

    // FUNCION PARA MODIFICAR UN PRODUCTO DE LA BD
    public static function updateProduct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcohol) {
        $con = DB::getConnection();
        $stmt = $con->prepare("UPDATE products SET nombre=?, categoria=?, precio=?, precio_premium=?, image=?, categoria_id=?, conAlcohol=? WHERE id=?");
        $stmt->bind_param("sssdsiii", $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcohol, $id);
        $success = $stmt->execute();
        $stmt->close();
        $con->close();
    
        return $success;
    }

    // FUNCION PARA AÑADIR UN PRODUCTO A LA BD
    public static function addProduct($nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcohol) {
        $con = DB::getConnection();
        $stmt = $con->prepare("INSERT INTO products (nombre, categoria, precio, precio_premium, image, categoria_id, conAlcohol) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdissi", $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcohol);
        $success = $stmt->execute();
    
        $stmt->close();
        $con->close();
    
        return $success;
    }

    // FUNCION PARA ELIMINAR UN PRODUCTO DE LA BD
    public static function deleteProduct($id) {
        $con = DB::getConnection();
        $stmt = $con->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
    
        $stmt->close();
        $con->close();
    
        return $success;
    }

    // FUNCION PARA OBTENER TAN SOLO LOS ÚLTIMOS 4 PRODUCTOS
    public static function getFourProducts() {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 4");
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();
    
        $products = [];
        while ($row = $result->fetch_assoc()) {
            // Verifica si es una bebida
            $product = $row['categoria'] === 'Bebida' ? new Bebida($row['id'], $row['nombre'], $row['categoria'], $row['precio'], $row['precio_premium'], $row['image'], $row['categoria_id'], $row['conAlcohol']) : new Product($row['id'], $row['nombre'], $row['categoria'], $row['precio'], $row['precio_premium'], $row['image'], $row['categoria_id']);
            
            $products[] = $product;
        }
    
        return $products;
    }
}
?>