<?php
// CLASE BEBIDA
class Bebida extends Product {
    private $conAlcohol;


    public function __construct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $conAlcohol) {
        parent::__construct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id);
        $this->conAlcohol = $conAlcohol;
    }

    /**
     * Get the value of conAlcohol
     */
    public function getConAlcohol()
    {
        return $this->conAlcohol;
    }

    /**
     * Set the value of conAlcohol
     */
    public function setConAlcohol($conAlcohol): self
    {
        $this->conAlcohol = $conAlcohol;
        return $this;
    }
}
?>