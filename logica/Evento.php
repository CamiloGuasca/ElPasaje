<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/EventoDAO.php");
require("Lugar.php");
require("Proveedor.php");
class Evento {
    private $idEve;
    private $nombreEve;
    private $fechIniEve;
    private $fechFinEve;
    private $precioEve;
    private $imagenEve;
    private $idLug;
    private $dProv;

    // Constructor
    public function __construct($idEve = null, $nombreEve = null, $fechIniEve = null, $fechFinEve = null, $precioEve = null, $imagenEve = null, $idLug = null, $dProv = null) {
        $this->idEve = $idEve;
        $this->nombreEve = $nombreEve;
        $this->fechIniEve = $fechIniEve;
        $this->fechFinEve = $fechFinEve;
        $this->precioEve = $precioEve;
        $this->imagenEve = $imagenEve;
        $this->idLug = $idLug;
        $this->dProv = $dProv;
    }

    // Getters
    public function getIdEve() {
        return $this->idEve;
    }

    public function getNombreEve() {
        return $this->nombreEve;
    }

    public function getFechIniEve() {
        return $this->fechIniEve;
    }

    public function getFechFinEve() {
        return $this->fechFinEve;
    }

    public function getPrecioEve() {
        return $this->precioEve;
    }

    public function getImagenEve() {
        return $this->imagenEve;
    }

    public function getIdLug() {
        return $this->idLug;
    }

    public function getDProv() {
        return $this->dProv;
    }

    // Setters
    public function setIdEve($idEve) {
        $this->idEve = $idEve;
    }

    public function setNombreEve($nombreEve) {
        $this->nombreEve = $nombreEve;
    }

    public function setFechIniEve($fechIniEve) {
        $this->fechIniEve = $fechIniEve;
    }

    public function setFechFinEve($fechFinEve) {
        $this->fechFinEve = $fechFinEve;
    }

    public function setPrecioEve($precioEve) {
        $this->precioEve = $precioEve;
    }
    public function setIdLug($idLug) {
        $this->idLug = $idLug;
    }

    public function setDProv($dProv) {
        $this->dProv = $dProv;
    }
    public function setImagenEve($imagenEve) {
        $this->imagenEve = $imagenEve;
    }

    public function consTod() {
        $eventos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new eventoDAO();
        $conexion -> ejecutarConsulta($eventoDAO -> consTod());
        while ($registro = $conexion -> siguienteRegistro()) {
            $lugar = new Lugar($registro[6]);
            $lugar = $lugar->consId();
            $proveedor = new Proveedor($registro[7]);
            $proveedor = $proveedor->consId();
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $lugar, $proveedor);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
    
    public function consIdProv(){
        $eventos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO(null,null,null,null,null,null,null,$this->dProv);
        $conexion -> ejecutarConsulta($eventoDAO -> consIdProv());
        while ($registro = $conexion -> siguienteRegistro()) {
            $lugar = new Lugar($registro[6]);
            $lugar = $lugar->consId();
            $proveedor = new Proveedor($this -> dProv);
            $proveedor = $proveedor->consId();
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $lugar, $proveedor);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
}
?>
