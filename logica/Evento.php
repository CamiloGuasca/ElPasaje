<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/Conn.php");
if (!class_exists('Conn')) {
    die("La clase Conn no está cargada correctamente.");
}
require_once("./persistencia/EventoDAO.php");
require("Lugar.php");
require("Proveedor.php");
class Evento {
    private $idEve;
    private $nombreEve;
    private $fechIniEve;
    private $fechFinEve;
    private $precioEve;
    private $imagenEve;
    private $idLug;
    private $dProv;

    // Constructor
    public function __construct($idEve = null, $nombreEve = null, $fechIniEve = null, $fechFinEve = null, $precioEve = null, $imagenEve = null, $idLug = null, $dProv = null) {
        $this->idEve = $idEve;
        $this->nombreEve = $nombreEve;
        $this->fechIniEve = $fechIniEve;
        $this->fechFinEve = $fechFinEve;
        $this->precioEve = $precioEve;
        $this->imagenEve = $imagenEve;
        $this->idLug = $idLug;
        $this->dProv = $dProv;
    }

    // Getters
    public function getIdEve() {
        return $this->idEve;
    }

    public function getNombreEve() {
        return $this->nombreEve;
    }

    public function getFechIniEve() {
        return $this->fechIniEve;
    }

    public function getFechFinEve() {
        return $this->fechFinEve;
    }

    public function getPrecioEve() {
        return $this->precioEve;
    }

    public function getImagenEve() {
        return $this->imagenEve;
    }

    public function getIdLug() {
        return $this->idLug;
    }

    public function getDProv() {
        return $this->dProv;
    }

    // Setters
    public function setIdEve($idEve) {
        $this->idEve = $idEve;
    }

    public function setNombreEve($nombreEve) {
        $this->nombreEve = $nombreEve;
    }

    public function setFechIniEve($fechIniEve) {
        $this->fechIniEve = $fechIniEve;
    }

    public function setFechFinEve($fechFinEve) {
        $this->fechFinEve = $fechFinEve;
    }

    public function setPrecioEve($precioEve) {
        $this->precioEve = $precioEve;
    }
    public function setIdLug($idLug) {
        $this->idLug = $idLug;
    }

    public function setDProv($dProv) {
        $this->dProv = $dProv;
    }
    public function setImagenEve($imagenEve) {
        $this->imagenEve = $imagenEve;
    }

    public function consTod() {
        $eventos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new eventoDAO();
        $conexion -> ejecutarConsulta($eventoDAO -> consTod());
        while ($registro = $conexion -> siguienteRegistro()) {
            $lugar = new Lugar($registro[6]);
            $lugar = $lugar->consId();
            $proveedor = new Proveedor($registro[7]);
            $proveedor = $proveedor->consId();
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $lugar, $proveedor);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
    
    public function consIdProv(){
        $eventos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO(null,null,null,null,null,null,null,$this->dProv);
        $conexion -> ejecutarConsulta($eventoDAO -> consIdProv());
        while ($registro = $conexion -> siguienteRegistro()) {
            $lugar = new Lugar($registro[6]);
            $lugar = $lugar->consId();
            $proveedor = new Proveedor($this -> dProv);
            $proveedor = $proveedor->consId();
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $lugar, $proveedor);
            array_push($eventos, $evento);
        }
        return $eventos;
    }
    public function registro(){
        /*
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO(null, $this -> nombreEve, $this -> fechIniEve, $this -> fechFinEve, $this -> precioEve, $this -> imagenEve, $this -> idLug, $this -> dProv);
        $conexion -> ejecutarConsulta($eventoDAO -> registrar());
        $this -> idEve = $conexion -> obtenerLlaveAutonumerica();
        $conexion -> cerrarConexion();
        return $this -> idEve;*/
        try {
            $conexion = Conn::getInstance()->getConnection();
            $eventoDAO = new EventoDAO(
                idEve: null,
                nombreEve: $this->nombreEve,
                fechIniEve: $this->fechIniEve,
                fechFinEve: $this->fechFinEve,
                precioEve: $this->precioEve,
                imagenEve: $this->imagenEve,
                idLug: $this->idLug,
                dProv: $this->dProv
            );
        
            $stmt = $conexion->prepare($eventoDAO->registrar());
            $stmt->bindParam(':nombreEve', $this->nombreEve);
            $stmt->bindParam(':fechIniEve', $this->fechIniEve);
            $stmt->bindParam(':fechFinEve', $this->fechFinEve);
            $stmt->bindParam(':precioEve', $this->precioEve);
            $stmt->bindParam(':imagenEve', $this->imagenEve);
            $stmt->bindParam(':idLug', $this->idLug);
            $stmt->bindParam(':dProv', $this->dProv);
        
            $stmt->execute();
            return $conexion->lastInsertId();
        } catch (Exception $e) {
            die("Error en el registro: " . $e->getMessage());
        }
    }
    public function actualizar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO($this -> idEve, $this -> nombreEve, $this -> fechIniEve, $this -> fechFinEve, $this -> precioEve, $this -> imagenEve, $this -> idLug, $this -> dProv);
        if($this -> imagenEve != null){
            try{
                $con = Conn::getInstance()->getConnection();
                $stmt = $con->prepare($eventoDAO->actualizar());
                $stmt->bindParam(':nombreEve', $this->nombreEve,  PDO::PARAM_STR);
                $stmt->bindParam(':fechIniEve', $this->fechIniEve,  PDO::PARAM_STR);
                $stmt->bindParam(':fechFinEve', $this->fechFinEve,  PDO::PARAM_STR);
                $stmt->bindParam(':precioEve', $this->precioEve,  PDO::PARAM_STR);
                $stmt->bindParam(':imagenEve', $this->imagenEve,  PDO::PARAM_STR);
                $stmt->bindParam(':idLug', $this->idLug,  PDO::PARAM_STR);
                $stmt->bindParam(':dProv', $this->dProv,  PDO::PARAM_STR);
                $stmt->bindParam(':idEve', $this->idEve,  PDO::PARAM_STR);
                $stmt->execute();
            }catch  (Exception $e){
                die("Error en el registro: " . $e->getMessage());
            }
        }else{
            $conexion -> ejecutarConsulta($eventoDAO -> actualizarSIM());
        }
        $conexion -> cerrarConexion();
    }
    public function eliminar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO($this->idEve);
        $conexion -> ejecutarConsulta($eventoDAO -> eliminar());
        $conexion -> cerrarConexion();
    }
    public function consId(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO($this -> idEve,null,null,null,null,null,null,null);
        $conexion -> ejecutarConsulta($eventoDAO -> consId());
        $registro = $conexion -> siguienteRegistro();
        $lugar = new Lugar($registro[5]);
        $lugar = $lugar = $lugar->consId();
        $proveedor = new Proveedor($registro[6]);
        $proveedor = $proveedor = $proveedor->consId();
        $evento = new Evento($this -> idEve, $registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $lugar, $proveedor);
        $conexion -> cerrarConexion();
        return $evento;
    }
    public function conPN($filtro){
        $eventos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $eventoDAO = new EventoDAO();
        $eventoDAO -> setDProv($this->dProv);
        $conexion -> ejecutarConsulta($eventoDAO -> conPN($filtro));
        while ($registro = $conexion -> siguienteRegistro()) {
            $lugar = new Lugar($registro[6]);
            $lugar = $lugar->consId();
            $proveedor = new Proveedor($registro[7]);
            $proveedor = $proveedor->consId();
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $lugar, $proveedor);
            array_push($eventos, $evento);
        }

        return $eventos;
    }
}
?>
