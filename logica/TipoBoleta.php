<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/TipoBoletaDAO.php   ");
    class TipoBoleta{
        private $idTB;
        private $nombreTB;
        private $porcentajeTB;
        private $Proveedores_idProv;
        public function __construct($idTB = null, $nombreTB = null, $porcentajeTB = null, $Proveedores_idProv = null) {
            $this->idTB = $idTB;
            $this->nombreTB = $nombreTB;
            $this->porcentajeTB = $porcentajeTB;
            $this->Proveedores_idProv = $Proveedores_idProv;
        }
        public function getIdTB() {
            return $this->idTB;
        }
    
        public function setIdTB($idTB) {
            $this->idTB = $idTB;
        }
    
        public function getNombreTB() {
            return $this->nombreTB;
        }
    
        public function setNombreTB($nombreTB) {
            $this->nombreTB = $nombreTB;
        }
    
        public function getPorcentajeTB() {
            return $this->porcentajeTB;
        }
    
        public function setPorcentajeTB($porcentajeTB) {
            $this->porcentajeTB = $porcentajeTB;
        }
    
        public function getProveedoresIdProv() {
            return $this->Proveedores_idProv;
        }
    
        public function setProveedoresIdProv($Proveedores_idProv) {
            $this->Proveedores_idProv = $Proveedores_idProv;
        }
        public function consId(){
            $tipoboletas = array();
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $tipoboletadao = new TipoBoletaDAO();
            $tipoboletadao -> setProveedoresIdProv($this->Proveedores_idProv);
            $conexion -> ejecutarConsulta($tipoboletadao->consId());
            while($registro = $conexion -> siguienteRegistro()){
                $tipoboleta = new TipoBoleta($registro[0], $registro[1], $registro[2], $this->Proveedores_idProv);
                array_push($tipoboletas, $tipoboleta);
            }
            return $tipoboletas;
        }
        public function conTipBol(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $tipoboletadao = new TipoBoletaDAO($this -> idTB);
            $conexion -> ejecutarConsulta($tipoboletadao -> conTipBol());
            $registro = $conexion -> siguienteRegistro();
            $tipoboleta = new TipoBoleta($this -> idTB, $registro[0], $registro[1]);
            $conexion -> cerrarConexion();
            return $tipoboleta;
        }
        public function registrar(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $tipobolDAO = new TipoBoletaDAO(null, $this -> nombreTB, $this -> porcentajeTB,$this -> Proveedores_idProv);
            $conexion -> ejecutarConsulta($tipobolDAO -> registrar());
            $conexion -> cerrarConexion();
        }
        public function actualizar(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $tipobolDAO = new TipoBoletaDAO($this -> idTB, $this -> nombreTB, $this -> porcentajeTB, null);
            $conexion -> ejecutarConsulta($tipobolDAO -> actualizar());
            $conexion -> cerrarConexion();
        }
        public function eliminar(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $tipobolDAO = new TipoBoletaDAO($this -> idTB) ;
            $conexion -> ejecutarConsulta($tipobolDAO -> eliminar());
            $conexion -> cerrarConexion();
        }
    }
?>