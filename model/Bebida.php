<?php
class Bebida extends Product {
    private $conAlcohol;

    public function __construct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $conAlcohol) {
        parent::__construct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id);
        $this->conAlcohol = $conAlcohol;
    }

    public function getConAlcohol()
    {
        return $this->conAlcohol;
    }

    public function setConAlcohol($conAlcohol): self
    {
        $this->conAlcohol = $conAlcohol;
        return $this;
    }
}
?>