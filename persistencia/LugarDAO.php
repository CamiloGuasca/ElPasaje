<?php
    class LugarDAO{
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
        public function consTod() {
            return "SELECT 
                        idLug,
                        capacidadLug,
                        direccionLug,
                        nombreLug,
                        Ciudades_idCiudades
                    FROM
                        lugares
                    ";
        }
        public function consId(){
            return "SELECT
                        capacidadLug,
                        direccionLug,
                        nombreLug,
                        Ciudades_idCiudades 
                    FROM
                        lugares
                    WHERE
                        idLug = ".$this->idLug."
            ";
        }
    }
?>