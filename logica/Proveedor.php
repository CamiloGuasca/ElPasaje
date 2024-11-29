<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/ProveedorDAO.php");
    class Proveedor{
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
    
        public function getIdProv() {
            return $this->idProv;
        }
    
        public function setIdProv($idProv) {
            $this->idProv = $idProv;
        }
    
        public function getNombreProv() {
            return $this->nombreProv;
        }
    
        public function setNombreProv($nombreProv) {
            $this->nombreProv = $nombreProv;
        }
    
        public function getNaciProv() {
            return $this->naciProv;
        }
    
        public function setNaciProv($naciProv) {
            $this->naciProv = $naciProv;
        }
    
        public function getCorreoProv() {
            return $this->correoProv;
        }
    
        public function setCorreoProv($correoProv) {
            $this->correoProv = $correoProv;
        }
    
        public function getClaveProv() {
            return $this->claveProv;
        }
    
        public function setClaveProv($claveProv) {
            $this->claveProv = $claveProv;
        }
    
        public function getCedulaProv() {
            return $this->cedulaProv;
        }
    
        public function setCedulaProv($cedulaProv) {
            $this->cedulaProv = $cedulaProv;
        }

        public function consTod(){
            $proveedores = array();
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $proveedorDAO = new ProveedorDAO();
            $conexion -> ejecutarConsulta($proveedorDAO -> consTod()); 
            while($registro = $conexion -> siguienteRegistro()){
                $proveedor = new Proveedor($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5]);
                array_push($proveedores, $proveedor);
            }
            return $proveedores;
        }

        public function consId(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $proveedorDAO = new ProveedorDAO($this -> getIdProv());
            $conexion -> ejecutarConsulta($proveedorDAO -> consId()); 
            $registro = $conexion -> siguienteRegistro();
            $proveedor = new Proveedor($this -> getIdProv(),$registro[0], $registro[1], $registro[2], $registro[3], $registro[4]);
            return $proveedor;
        }
    }
?>