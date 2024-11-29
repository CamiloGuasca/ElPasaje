<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/ClienteDAO.php");
require_once("Persona.php");
class Cliente extends Persona{
    public function __construct($idPersona = null, $nombrePersona = null, $naciPersona = null, $correoPersona = null, $clavePersona = null, $cedulaPersona = null) {
        parent::__construct($idPersona, $nombrePersona, $naciPersona, $correoPersona, $clavePersona, $cedulaPersona);
    }
    public function consTod(){
        $clientes = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ProveedorDAO();
        $conexion -> ejecutarConsulta($clienteDAO -> consTod()); 
        while($registro = $conexion -> siguienteRegistro()){
            $cliente = new Cliente($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5]);
            echo $cliente -> getNombrePersona();
            array_push($clientes, $cliente);
        }
        return $clientes;
    }
    public function autenticar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO(null, null, null, $this -> correoPersona, $this -> clavePersona, null);
        $conexion -> ejecutarConsulta($clienteDAO -> autenticar());
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
        $clienteDAO = new ClienteDAO($this -> idPersona, $this -> nombrePersona, $this -> naciPersona, $this -> correoPersona, $this -> clavePersona, $this ->cedulaPersona);
        $conexion -> ejecutarConsulta($clienteDAO -> registro());
        $this -> idPersona = $conexion -> obtenerLlaveAutonumerica();
        $conexion -> cerrarConexion();
    }
    public function consId(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO($this -> getIdPersona());
        $conexion -> ejecutarConsulta($clienteDAO -> consId()); 
        $registro = $conexion -> siguienteRegistro();
        $cliente = new Cliente($this -> getIdPersona(),$registro[0], $registro[1], $registro[2], $registro[3], $registro[4]);
        return $cliente;
    }
}
?>