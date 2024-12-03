<?php
    class CarritoCompraDAO{
        private $idCC;
        private $idCli;
        private $idTB;
        private $idEve;
        private $Cantidad;

        public function __construct($idCC = null, $idCli = null, $idTB = null, $idEve = null, $Cantidad = null) {
            $this->idCC = $idCC;
            $this->idCli = $idCli;
            $this->idTB = $idTB;
            $this->idEve = $idEve;
            $this->Cantidad = $Cantidad;
        }
    
        public function getIdCC() {
            return $this->idCC;
        }
    
        public function getIdCli() {
            return $this->idCli;
        }
    
        public function getIdTB() {
            return $this->idTB;
        }
    
        public function getIdEve() {
            return $this->idEve;
        }
    
        public function getCantidad() {
            return $this->Cantidad;
        }
    
        public function setIdCC($idCC) {
            $this->idCC = $idCC;
        }
    
        public function setIdCli($idCli) {
            $this->idCli = $idCli;
        }
    
        public function setIdTB($idTB) {
            $this->idTB = $idTB;
        }
    
        public function setIdEve($idEve) {
            $this->idEve = $idEve;
        }
    
        public function setCantidad($Cantidad) {
            $this->Cantidad = $Cantidad;
        }
        public function registro() {
            return"INSERT INTO 
                        carritocompra
                        (idCli,
                         idTB,
                         idEve,
                         Cantidad)
                    VALUES
                        (".$this->idCli.",
                         ".$this->idTB.",
                         ".$this->idEve.",
                         ".$this->Cantidad.")
                    ";
        }
    }
?>