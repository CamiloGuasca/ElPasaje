<?php
require_once("./logica/Persona.php");
    class ProveedorDAO extends Persona{
        public function consTod(){
            return "SELECT
                        idProv,
                        nombreProv,
                        naciProv,
                        correoProv,
                        claveProv,
                        cedulaProv
                    FROM
                        proveedores
            ";
            }   
        public function autenticar(){
            return "SELECT 
                        idProv
                    FROM
                        proveedores 
                    WHERE 
                        correoProv = '" . $this -> correoPersona. "' and claveProv= '" . $this -> clavePersona . "'";
        }
        public function registro(){
            return "INSERT INTO 
                        proveedores (nombreProv, naciProv, correoProv, claveProv, cedulaProv)
                    VALUES
                        ('".$this -> nombrePersona."',
                         '".$this -> naciPersona."',
                         '".$this -> correoPersona."',
                         '".$this -> clavePersona."',
                         '".$this -> cedulaPersona."')
            ";

        }
        public function consId(){
            return "SELECT
                        nombreProv,
                        naciProv,
                        correoProv,
                        claveProv,
                        cedulaProv
                    FROM
                        proveedores
                    WHERE
                        idProv = ".$this -> getIdPersona()."
            ";
        }
    }
?>