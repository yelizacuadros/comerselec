<?php

class Marca{
    private $conn;
    private $nombre_tabla = "marcas";

    private $id_marca;
    private $nombre;
    private $descripcion;
    private $pais_origen;
    private $garantia;

    //el constructor de la clase recibe la conexión a la base de datos como parámetro
    public function __construct($db){
        $this->conn = $db;
    }

    // metodos geetters y setters
    public function getIdMarca(){
        return $this->id_marca;
    }
    
    public function setIdMarca($id_marca){
        $this->id_marca = $id_marca;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getPaisOrigen(){
        return $this->pais_origen;
    }


    public function setPaisOrigen($pais_origen){
        $this->pais_origen = $pais_origen;
    }

    public function getGarantia(){
        return $this->garantia;
    }

    public function setGarantia($garantia){
        $this->garantia = $garantia;
    }





}