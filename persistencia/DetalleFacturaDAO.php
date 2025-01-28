<?php
    class DetalleFacturaDAO{
        private $idDF;
        private $idFacturaVenta;
        private $idTB;
        private $cantidad;

        public function __construct($idDF = null, $idFacturaVenta = null, $idTB = null, $cantidad = null) {
            $this->idDF = $idDF;
            $this->idFacturaVenta = $idFacturaVenta;
            $this->idTB = $idTB;
            $this->cantidad = $cantidad;
        }
    
        public function getIdDF() {
            return $this->idDF;
        }
    
        public function getIdFacturaVenta() {
            return $this->idFacturaVenta;
        }
    
        public function getIdTB() {
            return $this->idTB;
        }
    
        public function getCantidad() {
            return $this->cantidad;
        }
    
        public function setIdDF($idDF) {
            $this->idDF = $idDF;
        }
    
        public function setIdFacturaVenta($idFacturaVenta) {
            $this->idFacturaVenta = $idFacturaVenta;
        }
    
        public function setIdTB($idTB) {
            $this->idTB = $idTB;
        }
    
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
        }
        public function registrar() {
            return "INSERT INTO 
                        detallefacturaventa
                        (idFacturaVenta,
                         idTB,
                         cantidadDFV)
                    VALUES
                        (".$this -> idFacturaVenta.",
                         ".$this -> idTB.",
                         ".$this -> cantidad.")
                    ";
        }
        public function consIdFac(){
            return "SELECT
                        idDF,
                        idTB,
                        cantidadDFV
                    FROM
                        detallefacturaventa
                    ";
        }
        public function consDetFacFV(){
            return "SELECT
                        idDF,
                        idTB,
                        cantidadDFV
                    FROM
                        detallefacturaventa
                    WHERE
                        idFacturaVenta = ".$this->getIdFacturaVenta()."
                    ";
        }
    }
?>