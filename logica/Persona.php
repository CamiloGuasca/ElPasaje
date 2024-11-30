<?php

//require("./persistencia/ProveedorDAO.php");
class Persona{
    protected $idPersona;
    protected $nombrePersona;
    protected $naciPersona;
    protected $correoPersona;
    protected $clavePersona;
    protected $cedulaPersona;

    public function __construct($idPersona = null, $nombrePersona = null, $naciPersona = null, $correoPersona = null, $clavePersona = null, $cedulaPersona = null) {
        $this->idPersona = $idPersona;
        $this->nombrePersona = $nombrePersona;
        $this->naciPersona = $naciPersona;
        $this->correoPersona = $correoPersona;
        $this->clavePersona = $clavePersona;
        $this->cedulaPersona = $cedulaPersona;
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    public function setIdPersona($idPersona) {
        $this->idPersona = $idPersona;
    }

    public function getNombrePersona() {
        return $this->nombrePersona;
    }

    public function setNombrePersona($nombrePersona) {
        $this->nombrePersona = $nombrePersona;
    }

    public function getNaciPersona() {
        return $this->naciPersona;
    }

    public function setNaciPersona($naciPersona) {
        $this->naciPersona = $naciPersona;
    }

    public function getCorreoPersona() {
        return $this->correoPersona;
    }

    public function setCorreoPersona($correoPersona) {
        $this->correoPersona = $correoPersona;
    }

    public function getClavePersona() {
        return $this->clavePersona;
    }

    public function setClavePersona($clavePersona) {
        $this->clavePersona = $clavePersona;
    }

    public function getCedulaPersona() {
        return $this->cedulaPersona;
    }

    public function setCedulaPersona($cedulaPersona) {
        $this->cedulaPersona = $cedulaPersona;
    }
}
?>