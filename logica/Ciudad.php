<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/CiudadDAO.php");    
class Ciudad {
    private $idCiudades;
    private $NombreCiu;

    public function __construct($idCiudades = null, $NombreCiu = null) {
        $this->idCiudades = $idCiudades;
        $this->NombreCiu = $NombreCiu;
    }

    public function getIdCiudades() {
        return $this->idCiudades;
    }

    public function setIdCiudades($idCiudades) {
        $this->idCiudades = $idCiudades;
    }

    public function getNombreCiu() {
        return $this->NombreCiu;
    }

    public function setNombreCiu($NombreCiu) {
        $this->NombreCiu = $NombreCiu;
    }
    public function consTod(){
        $ciudades = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $ciudadDAO = new CiudadDAO();
        $conexion -> ejecutarConsulta($ciudadDAO -> consTod());
        while($registro = $conexion -> siguienteRegistro()) {
            $ciudad = new Ciudad($registro[0], $registro[1]);
            array_push($ciudades, $ciudad);
        }
        return $ciudades;

    }
    public function consId(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $ciudadDAO = new CiudadDAO($this->idCiudades);
        $conexion -> ejecutarConsulta($ciudadDAO -> consId());
        $registro = $conexion -> siguienteRegistro();
        $ciudad = new Ciudad($this->idCiudades,$registro[0]);
        return $ciudad;
    }
}
?>