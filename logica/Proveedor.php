<?php
    require_once("./persistencia/Conexion.php");
    require("./persistencia/ProveedorDAO.php");
    require_once("Persona.php");
    class Proveedor extends Persona{

        public function __construct($idPersona = null, $nombrePersona = null, $naciPersona = null, $correoPersona = null, $clavePersona = null, $cedulaPersona = null) {
            parent::__construct($idPersona, $nombrePersona, $naciPersona, $correoPersona, $clavePersona, $cedulaPersona);
        }
        public function consTod(){
            $proveedores = array();
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $proveedorDAO = new ProveedorDAO();
            $conexion -> ejecutarConsulta($proveedorDAO -> consTod()); 
            while($registro = $conexion -> siguienteRegistro()){
                $proveedor = new Proveedor($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5]);
                echo $proveedor -> getNombrePersona();
                array_push($proveedores, $proveedor);
            }
            return $proveedores;
        }
        public function autenticar(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $proveedorDAO = new ProveedorDAO(null, null, null, $this -> correoPersona, $this -> clavePersona, null);
            $conexion -> ejecutarConsulta($proveedorDAO -> autenticar());
            echo $proveedorDAO -> autenticar();
            if($conexion -> numeroFilas() == 0){
                $conexion -> cerrarConexion();
                return false;
            }else{
                $registro = $conexion -> siguienteRegistro();
                $this -> idPersona = $registro[0];
                $conexion -> cerrarConexion();
                return true;
            }
        }
        public function registro(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $proveedorDAO = new ProveedorDAO($this -> idPersona, $this -> nombrePersona, $this -> naciPersona, $this -> correoPersona, $this -> clavePersona, $this ->cedulaPersona);
            $conexion -> ejecutarConsulta($proveedorDAO -> registro());
            $this -> idPersona = $conexion -> obtenerLlaveAutonumerica();
            $conexion -> cerrarConexion();
        }

        public function consId(){
            $conexion = new Conexion();
            $conexion -> abrirConexion();
            $proveedorDAO = new ProveedorDAO($this -> getIdPersona());
            $conexion -> ejecutarConsulta($proveedorDAO -> consId()); 
            $registro = $conexion -> siguienteRegistro();
            $proveedor = new Proveedor($this -> getIdPersona(),$registro[0], $registro[1], $registro[2], $registro[3], $registro[4]);
            return $proveedor;
        }
    }
?>