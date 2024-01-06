<?php
// CLASE PRODUCTO
class Product {
    protected $id;
    protected $nombre;
    protected $categoria;
    protected $precio;
    protected $precio_premium;
    protected $image;
    protected $categoria_id;
    

    public function __construct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id) {
        $this->id = $id; 
        $this->nombre = $nombre;
        $this->categoria = $categoria; 
        $this->precio = $precio; 
        $this->precio_premium = $precio_premium; 
        $this->image = $image;
        $this->categoria_id = $categoria_id;
    }
    
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     */
    public function setCategoria($categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

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
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

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
?>