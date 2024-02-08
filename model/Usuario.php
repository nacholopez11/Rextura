<?php
// CLASE USUARIO
class Usuario {
    public $id;
    public $username;
    public $password;
    public $rol;
    public $puntos_fidelidad;
    
    
    public function __construct() {
        
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
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     */
    public function setRol($rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of puntos_fidelidad
     */
    public function getPuntosFidelidad()
    {
        return $this->puntos_fidelidad;
    }

    /**
     * Set the value of puntos_fidelidad
     */
    public function setPuntosFidelidad($puntos_fidelidad): self
    {
        $this->puntos_fidelidad = $puntos_fidelidad;

        return $this;
    }
}