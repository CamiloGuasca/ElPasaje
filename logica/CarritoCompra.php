<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/CarritoCompraDAO.php");
    require_once("TipoBoleta.php");
    require_once("Evento.php");
    class CarritoCompra{
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
        public function registrar() {
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $carricomDAO = new CarritoCompraDAO(null, $this->idCli,$this->idTB,$this->idEve,$this->Cantidad);
            $conexion -> ejecutarConsulta($carricomDAO -> registro());
            $this->idCC = $conexion -> obtenerLlaveAutonumerica();
            $conexion -> cerrarConexion();
        }
        public function consIdCli() {
            $carritos = array();
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $carricomDAO = new CarritoCompraDAO();
            $carricomDAO -> setIdCli($this->idCli);
            $conexion -> ejecutarConsulta($carricomDAO -> consIdCli());
            while($registro = $conexion -> siguienteRegistro()){
               
                $tipoBoleta = new TipoBoleta($registro[1]);
                $tipoBoleta = $tipoBoleta -> conTipBol();
                $evento = new Evento($registro[2]);
                $evento = $evento = $evento -> consId();
                $carritocom = new CarritoCompra($registro[0],$this->idCli,$tipoBoleta,$evento,$registro[3]);
                array_push($carritos, $carritocom);
            }
            return $carritos;
        }
        public function eliminarPID(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $carricomDAO = new CarritoCompraDAO($this->idCC);
            $conexion -> ejecutarConsulta($carricomDAO -> eliminarPID());
            $conexion -> cerrarConexion();
        }
    }
?>