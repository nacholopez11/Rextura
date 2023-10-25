<?php
abstract class Productos{

const PRECIOPOSTRE = 3;
const PRECIOBEBIDA = 2;
const PRECIOENTRANTE = 4;


protected $producto_id;
protected $nombre_producto;
protected $descripcion;
protected $precio_normal;
protected $precio_premium;
protected $categoria_id;

public function __construct($producto_id, $nombre_producto,$descripcion,$precio_normal,$precio_premium,$categoria_id){
    $this-> producto_id = $producto_id;
    $this-> nombre_producto = $nombre_producto;
    $this-> descripcion = $descripcion;
    $this-> precio_normal = $precio_normal;
    $this-> precio_premium = $precio_premium;
    $this-> categoria_id = $categoria_id;

}


public abstract function calculaPrecioTotal($numDias);
public abstract function devuelvePrecioDia();





/**
 * Get the value of producto_id
 */
public function getProductoId()
{
return $this->producto_id;
}

/**
 * Set the value of producto_id
 */
public function setProductoId($producto_id): self
{
$this->producto_id = $producto_id;

return $this;
}

/**
 * Get the value of nombre_producto
 */
public function getNombreProducto()
{
return $this->nombre_producto;
}

/**
 * Set the value of nombre_producto
 */
public function setNombreProducto($nombre_producto): self
{
$this->nombre_producto = $nombre_producto;

return $this;
}

/**
 * Get the value of descripcion
 */
public function getDescripcion()
{
return $this->descripcion;
}

/**
 * Set the value of descripcion
 */
public function setDescripcion($descripcion): self
{
$this->descripcion = $descripcion;

return $this;
}

/**
 * Get the value of precio_normal
 */
public function getPrecioNormal()
{
return $this->precio_normal;
}

/**
 * Set the value of precio_normal
 */
public function setPrecioNormal($precio_normal): self
{
$this->precio_normal = $precio_normal;

return $this;
}

/**
 * Get the value of precio_premium
 */
public function getPrecioPremium()
{
return $this->precio_premium;
}

/**
 * Set the value of precio_premium
 */
public function setPrecioPremium($precio_premium): self
{
$this->precio_premium = $precio_premium;

return $this;
}

/**
 * Get the value of categoria_id
 */
public function getCategoriaId()
{
return $this->categoria_id;
}

/**
 * Set the value of categoria_id
 */
public function setCategoriaId($categoria_id): self
{
$this->categoria_id = $categoria_id;

return $this;
}
}