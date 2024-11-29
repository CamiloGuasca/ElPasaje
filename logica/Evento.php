<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/EventoDAO.php");
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
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
}
?>
