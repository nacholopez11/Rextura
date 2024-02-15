<?php
// CLASE PEDIDO
Class Pedido{
    private $producto;
    private $cantidad = 1;
    
    private $id;
    private $usuario_id;
    private $fecha_pedido;
    private $total;
    private $propina;
    private $puntos_usados;
    private $puntos_ganados;
    private $productos;


    public function __construct($producto){
        $this->producto =$producto;
    }

    public function devuelvePrecioTotal() {
        return $this->producto->getPrecio() * $this->cantidad;
    }

    /**
     * Get the value of producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set the value of producto
     */
    public function setProducto($producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get the value of cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     */
    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }
    // FUNCION PARA CALCULAR PRECIO TOTAL DE UN PRODUCTO
    public function calculaPrecioTotal(){
        return $this->product->getPrecio()*$this->product->getCantidad();
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsuarioId() {
        return $this->id;
    }

    public function setUsuarioId($id) {
        $this->id = $id;
    }

    public function getFechaPedido() {
        return $this->id;
    }

    public function setFechaPedido($id) {
        $this->id = $id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getPropina() {
        return $this->id;
    }

    public function setPropina($id) {
        $this->id = $id;
    }

    public function getPuntosUsados() {
        return $this->id;
    }

    public function setPuntosUsados($id) {
        $this->id = $id;
    }

    public function getPuntosGanados() {
        return $this->id;
    }

    public function setPuntosGanados($id) {
        $this->id = $id;
    }

    public function getProductos() {
        return $this->productos;
    }

    public function addProducto($producto) {
        $this->productos[] = $producto;
    }
}
?>