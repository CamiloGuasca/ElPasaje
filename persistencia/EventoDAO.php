<?php
    class EventoDAO{
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
    
        public function consTod(){
            return "SELECT
                        idEve, nombreEve, fechIniEve, fechFinEve, precioEve, imagenEve, idLug, dProv
                    FROM
                        Eventos
                    ";
        }
    }
?>