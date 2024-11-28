<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/EventoDAO.php");
class Evento {
    private $idEve;
    private $nombreEve;
    private $fechIniEve;
    private $fechFinEve;
    private $precioEve;
    private $Lugares_idLug;
    private $imagenEve;

    public function __construct($idEve = null, $nombreEve = null, $fechIniEve = null, $fechFinEve = null, $precioEve = null, $Lugares_idLug = null, $imagenEve = null) {
        $this->idEve = $idEve;
        $this->nombreEve = $nombreEve;
        $this->fechIniEve = $fechIniEve;
        $this->fechFinEve = $fechFinEve;
        $this->precioEve = $precioEve;
        $this->Lugares_idLug = $Lugares_idLug;
        $this->imagenEve = $imagenEve;
    }

    public function getIdEve() {
        return $this->idEve;
    }

    public function setIdEve($idEve) {
        $this->idEve = $idEve;
    }

    public function getNombreEve() {
        return $this->nombreEve;
    }

    public function setNombreEve($nombreEve) {
        $this->nombreEve = $nombreEve;
    }

    public function getFechIniEve() {
        return $this->fechIniEve;
    }

    public function setFechIniEve($fechIniEve) {
        $this->fechIniEve = $fechIniEve;
    }

    public function getFechFinEve() {
        return $this->fechFinEve;
    }

    public function setFechFinEve($fechFinEve) {
        $this->fechFinEve = $fechFinEve;
    }

    public function getPrecioEve() {
        return $this->precioEve;
    }

    public function setPrecioEve($precioEve) {
        $this->precioEve = $precioEve;
    }

    public function getLugaresIdLug() {
        return $this->Lugares_idLug;
    }

    public function setLugaresIdLug($Lugares_idLug) {
        $this->Lugares_idLug = $Lugares_idLug;
    }

    public function getImagenEve() {
        return $this->imagenEve;
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
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6]);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
}
?>
