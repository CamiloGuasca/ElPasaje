<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/DetalleFacturaDAO.php");
    class DetalleFactura{
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
        public function registrar(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $detfacDAO = new DetalleFacturaDAO(null, $this->idFacturaVenta, $this->idTB, $this->cantidad);
            $conexion -> ejecutarConsulta($detfacDAO -> registrar());
            echo $detfacDAO -> registrar();
            $this -> idDF = $conexion -> obtenerLlaveAutonumerica();
            $conexion -> cerrarConexion();
        }
        public function consIdFac(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $detfacDAO = new DetalleFacturaDAO();
            $detfacDAO -> setIdFacturaVenta($this -> idFacturaVenta);
            $conexion -> ejecutarConsulta($detfacDAO -> consIdFac());
            $registro = $conexion -> siguienteRegistro();
            $tipbol = new TipoBoleta($registro[1]);
            $tipobol = $tipbol -> conTipBol();
            $detfac = new DetalleFactura($registro[0],$this->idFacturaVenta, $tipobol, $registro[2]);
            $conexion  -> cerrarConexion();
            return $detfac;
        }
    }
?>