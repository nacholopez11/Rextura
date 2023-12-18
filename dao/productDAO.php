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
        // $con = DB::getConnection(); 
        $allproducts = array_merge(productDAO::getAllProductsByType('Plato_principal'),productDAO::getAllProductsByType('Bebida'),productDAO::getAllProductsByType('Postre'));

        return $allproducts;
    }

    // FUNCION PARA RECUPERAR TODOS LOS PRODUCTOS SEGUN LA CATEGORIA
    public static function getAllProductsByType($tipo){
        $con = DB::getConnection(); 
        // $query = "SELECT products.id, products.nombre, products.categoria, products.precio, products.precio_premium, products.image, products.categoria_id FROM products JOIN categorias ON products.categoria_id = categorias.categoria_id WHERE categorias.nombre_categoria = ?;";
        // $stmt = $con->prepare($query);
        $stmt = $con->prepare("SELECT * FROM products WHERE categoria=?");
        $stmt->bind_param("s",$tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        $con ->close();
        $products = [];
        while ($row = $result->fetch_object($tipo)) {
            // $product = new Product($row->id, $row->nombre, $row->categoria, $row->precio, $row->precio_premium, $row->image, $row->categoria_id);
            $products[] = $row;
        }
        return $products;
    }
   

    public static function getProductById($id) {
        $con = DB::getConnection();

        $query = "SELECT * FROM products WHERE id = $id";
        $result = $con->query($query);

        $row = $result->fetch_object();
        $product = new Product($row->id, $row->nombre, $row->categoria, $row->precio, $row->precio_premium, $row->image, $row->categoria_id);

        $con->close();

        return $product;
    }

    public static function getPostreById($id){
        $con = DB::getConnection(); 

        $stmt = $con->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param("i",$id);


        $stmt->execute();
        $result = $stmt->get_result();

        $con->close();

        return $result->fetch_object('Postre');
    }

    public static function getPlatoPrincipalById($id){
        $con = DB::getConnection(); 

        $stmt = $con->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param("i",$id);


        $stmt->execute();
        $result = $stmt->get_result();

        $con->close();

        return $result->fetch_object('Plato_principal');
    }

    public static function getBebidaById($id){
        $con = DB::getConnection(); 

        $stmt = $con->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param("i",$id);


        $stmt->execute();
        $result = $stmt->get_result();

        $con->close();

        return $result->fetch_object('Bebidas');
    }

















    

    // FALTA IMPLEMENTAR CODIGO
    public static function editProductById($id){
        $con = DB::getConnection(); 
    }

    public static function deleteProduct($id){
        $con = DB::getConnection();  

        $stmt = $con->prepare("DELETE FROM products WHERE id=?");
        $stmt ->bind_param("i",$id);


        $stmt->execute();
        $result = $stmt->get_result();

        $con->close();
        return $result;

    }

    public static function updateProduct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id){
        $con = DB::getConnection();  

        $stmt = $con->prepare("UPDATE products SET nombre =?, categoria=?, precio =?, precio_premium =?, image =?, categoria_id =? WHERE id=?");
        $stmt->bind_param("ssissii", $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $id);


        $stmt->execute();
        $result = $stmt->get_result();

        $con->close();
        return $result;
    }

}
?>