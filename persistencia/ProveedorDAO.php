<?php
    class ProveedorDAO{
        private $idProv;
        private $nombreProv;
        private $naciProv;
        private $correoProv;
        private $claveProv;
        private $cedulaProv;
    
        public function __construct($idProv = null, $nombreProv = null, $naciProv = null, $correoProv = null, $claveProv = null, $cedulaProv = null) {
            $this->idProv = $idProv;
            $this->nombreProv = $nombreProv;
            $this->naciProv = $naciProv;
            $this->correoProv = $correoProv;
            $this->claveProv = $claveProv;
            $this->cedulaProv = $cedulaProv;
        }
        public function consTod(){
            return "SELECT
                        idProv,
                        nombreProv,
                        naciProv,
                        correoProv,
                        claveProv,
                        cedulaProv
                    FROM
                        proveedores
            ";
        }
        public function consId(){
            return "SELECT
                        nombreProv,
                        naciProv,
                        correoProv,
                        claveProv,
                        cedulaProv
                    FROM
                        proveedores
                    WHERE
                        idProv = ".$this -> idProv."
            ";
        }
    }
?>