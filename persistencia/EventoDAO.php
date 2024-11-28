<?php
    class EventoDAO{
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
        public function consTod(){
            return "SELECT
                        idEve, nombreEve, fechIniEve, fechFinEve, precioEve, Lugares_idLug, imagenEve
                    FROM
                        Eventos
                    ";
        }
    }
?>