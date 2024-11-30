<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/LugarDAO.php");
require("Ciudad.php");
class Lugar {
    private $idLug;
    private $capacidadLug;
    private $direccionLug;
    private $nombreLug;
    private $Ciudades_idCiudades;

    public function __construct($idLug = null, $capacidadLug = null, $direccionLug = null, $nombreLug = null, $Ciudades_idCiudades = null) {
        $this->idLug = $idLug;
        $this->capacidadLug = $capacidadLug;
        $this->direccionLug = $direccionLug;
        $this->nombreLug = $nombreLug;
        $this->Ciudades_idCiudades = $Ciudades_idCiudades;
    }

    public function getIdLug() {
        return $this->idLug;
    }

    public function setIdLug($idLug) {
        $this->idLug = $idLug;
    }

    public function getCapacidadLug() {
        return $this->capacidadLug;
    }

    public function setCapacidadLug($capacidadLug) {
        $this->capacidadLug = $capacidadLug;
    }

    public function getDireccionLug() {
        return $this->direccionLug;
    }

    public function setDireccionLug($direccionLug) {
        $this->direccionLug = $direccionLug;
    }

    public function getNombreLug() {
        return $this->nombreLug;
    }

    public function setNombreLug($nombreLug) {
        $this->nombreLug = $nombreLug;
    }

    public function getCiudades_idCiudades() {
        return $this->Ciudades_idCiudades;
    }

    public function setCiudades_idCiudades($Ciudades_idCiudades) {
        $this->Ciudades_idCiudades = $Ciudades_idCiudades;
    }
    public function consTod(){
        $lugares = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $lugarDAO = new LugarDAO(); 
        $conexion -> ejecutarConsulta($lugarDAO -> consTod());
        while($registro = $conexion -> siguienteRegistro()){
            $ciudad = new Ciudad($registro[4]);
            $ciudad = $ciudad -> consId();
            $lugar = new Lugar($registro[0], $registro[1], $registro[2], $registro[3], $ciudad);
            array_push($lugares, $lugar);
        }
        return $lugares;
    }
    public function consId(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $lugarDAO = new LugarDAO($this -> idLug);
        $conexion -> ejecutarConsulta($lugarDAO -> consId());
        $registro = $conexion -> siguienteRegistro();
        $ciudad = new Ciudad($registro[3]);
        $ciudad = $ciudad -> consId();
        $lugar = new Lugar($this->idLug,$registro[0], $registro[1], $registro[2], $ciudad);
        return $lugar;
    }
}

?>