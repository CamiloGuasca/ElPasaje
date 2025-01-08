<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/DetalleEventoDAO.php");
    class DetalleEvento{
        private $idDE;
        private $idEve;
        private $idTB;
        private $cantidad;
        public function __construct($idDE = null, $idEve = null, $idTB = null, $cantidad = null) {
            $this->idDE = $idDE;
            $this->idEve = $idEve;
            $this->idTB = $idTB;
            $this->cantidad = $cantidad;
        }
    
        public function getIdDE() {
            return $this->idDE;
        }
    
        public function setIdDE($idDE) {
            $this->idDE = $idDE;
        }
    
        public function getIdEve() {
            return $this->idEve;
        }
    
        public function setIdEve($idEve) {
            $this->idEve = $idEve;
        }
    
        public function getIdTB() {
            return $this->idTB;
        }
    
        public function setIdTB($idTB) {
            $this->idTB = $idTB;
        }
        public function getCantidad(){
            return $this->cantidad;
        }
        public function setCantidada($cantidad) {
            $this->cantidad = $cantidad;
        }
        public function registro(){
            $conexion = new conexion();
            $conexion -> abrirConexion();
            $detalleeventodao = new DetalleEventoDAO(null, $this -> idEve, $this -> idTB, $this -> cantidad);
            $conexion -> ejecutarConsulta($detalleeventodao -> registroDE());
            $conexion -> cerrarConexion();
        }
        public function eliminar() {
            $conexion = new conexion();
            $conexion -> abrirConexion();
            $detalleeventodao = new DetalleEventoDAO($this -> idDE);
            echo $detalleeventodao ->registroDE();
            $conexion -> ejecutarConsulta($detalleeventodao ->registroDE());
        }
        public function consIdEve(){
            $detallesevento  = array();
            $conexion = new conexion();
            $conexion -> abrirConexion();
            $detalleDAO = new DetalleEventoDAO(null,$this->idEve, null, null);
            $conexion -> ejecutarConsulta($detalleDAO -> consIdEve());
            while($registro = $conexion -> siguienteRegistro()){
                $detalleeve = new DetalleEvento($registro[0], $this -> idEve, $registro[1], $registro[2]);
                array_push( $detallesevento, $detalleeve);
            }
            return $detallesevento;
        }
        public function eliminarIdEve(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $detalleDAO = new DetalleEventoDAO();
            $detalleDAO -> setIdEve($this -> idEve);
    
            $conexion -> ejecutarConsulta($detalleDAO->eliminarIdEve());
            $conexion -> cerrarConexion();
        }
    }

?>