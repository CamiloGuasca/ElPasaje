<?php
class CiudadDAO{
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
        return "SELECT
                    idCiudades, 
                    NombreCiu
                FROM 
                    ciudades
                ";
    }
    public function consId(){
        return "SELECT
                    NombreCiu
                FROM
                    ciudades
                WHERE 
                    idCiudades = ".$this->idCiudades."
                ";
    }
}
?>
