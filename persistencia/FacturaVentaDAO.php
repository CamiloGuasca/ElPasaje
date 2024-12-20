<?php
        class FacturaVentaDAO{
            private $idFacturaVenta;
            private $fechaFV;
            private $horaFV;
            private $idEve;
            private $idCli;
            public function __construct($idFacturaVenta = null, $fechaFV = null, $horaFV = null, $idEve = null, $idCli = null) {
                $this->idFacturaVenta = $idFacturaVenta;
                $this->fechaFV = $fechaFV;
                $this->horaFV = $horaFV;
                $this->idEve = $idEve;
                $this->idCli = $idCli;
            }
        
            public function getIdFacturaVenta() {
                return $this->idFacturaVenta;
            }
        
            public function getFechaFV() {
                return $this->fechaFV;
            }
        
            public function getHoraFV() {
                return $this->horaFV;
            }
        
            public function getIdEve() {
                return $this->idEve;
            }
        
            public function getIdCli() {
                return $this->idCli;
            }
        
            public function setIdFacturaVenta($idFacturaVenta) {
                $this->idFacturaVenta = $idFacturaVenta;
            }
        
            public function setFechaFV($fechaFV) {
                $this->fechaFV = $fechaFV;
            }
        
            public function setHoraFV($horaFV) {
                $this->horaFV = $horaFV;
            }
        
            public function setIdEve($idEve) {
                $this->idEve = $idEve;
            }
        
            public function setIdCli($idCli) {
                $this->idCli = $idCli;
            }
            public function registrar(){
                return"INSERT INTO
                            facturaventa
                            (fechaFV,
                            horaFV,
                            idEve,
                            idCli)
                        VALUES
                            (CURDATE(),
                             CURTIME(),
                             '".$this->idEve."',
                             '".$this->idCli."')
                ";
            }
            public function consTod(){
                return "SELECT
                            idFacturaVenta,
                            fechaFV,
                            horaFV,
                            idEve
                        FROM
                            facturaventa
                        WHERE
                            idCli = ".$this -> idCli."
                ";
            }
        }
?>