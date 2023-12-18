<?php
class Bebida extends Product {
    protected $alcoholic;

    // $id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id, $alcoholic
    public function __construct() {
        // parent::__construct($id, $nombre, $categoria, $precio, $precio_premium, $image, $categoria_id);
        // $this->alcoholic = $alcoholic;
        }

    /**
     * Get the value of alcoholic
     */
    public function getAlcoholic()
    {
        return $this->alcoholic;
    }

    /**
     * Set the value of alcoholic
     */
    public function setAlcoholic($alcoholic): self
    {
        $this->alcoholic = $alcoholic;

        return $this;
    }
}
?>