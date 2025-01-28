<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/FacturaVentaDAO.php");
    class FacturaVenta{
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
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $facvenDAO = new FacturaVentaDAO();
            $facvenDAO -> setIdEve($this->idEve);
            $facvenDAO -> setIdCli($this->idCli);
            $conexion -> ejecutarConsulta($facvenDAO->registrar());
            $this -> idFacturaVenta = $conexion -> obtenerLlaveAutonumerica();
            $conexion -> cerrarConexion();
            return $this -> idFacturaVenta;
        }
        public function consTod(){
            $factventas = array();
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $facvenDAO  = new FacturaVentaDAO();
            $facvenDAO -> setIdCli($this->idCli);
            $conexion -> ejecutarConsulta($facvenDAO->consTod());
        
            while($registro = $conexion -> siguienteRegistro()){
                $evento = new Evento($registro[3]);
                $evento = $evento -> consId();
                $factventa = new FacturaVenta($registro[0],$registro[1], $registro[2],$evento, $this->idCli);
                array_push( $factventas, $factventa);
            }
            return $factventas;
        }
        public function ultid(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $facvenDAO  = new FacturaVentaDAO();
            $conexion -> ejecutarConsulta($facvenDAO->ultid());
            $registro = $conexion -> siguienteRegistro();
            $evento = new Evento($registro[0]);
            return $registro[0];
        }
        public function confacId(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $facvenDAO  = new FacturaVentaDAO($this->idFacturaVenta);
            $conexion -> ejecutarConsulta($facvenDAO->confacId());
            $registro = $conexion -> siguienteRegistro();
            $evento = new Evento( $registro[2]);
            $evento = $evento -> consId();
            $facventa = new FacturaVenta($this->idFacturaVenta,$registro[0], $registro[1], $evento, $registro[2]);
            return $facventa;
        }
    }
?>