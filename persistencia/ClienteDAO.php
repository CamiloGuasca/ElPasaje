<?php
require_once("./logica/Persona.php");
class ClienteDAO  extends Persona{
    public function consTod(){
        return "SELECT
                    idCli,
                    nombreCli,
                    naciCli,
                    correoCli,
                    claveCli,
                    cedulaCli
                FROM
                    clientes
        ";
    }
    public function autenticar(){
        return "SELECT 
                    idCli
                FROM
                    clientes 
                WHERE 
                    correoCli = '" . $this -> correoPersona. "' and claveCli= '" . $this -> clavePersona . "'";
    }
    public function registro(){
        return "INSERT INTO 
                    clientes (nombreCli, naciCli, correoCli, claveCli, cedulaCli)
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
                    nombreCli,
                    naciCli,
                    correoCli,
                    claveCli,
                    cedulaCli
                FROM
                    clientes
                WHERE
                    idCli = ".$this -> getIdPersona()."
        ";
    }

}
?>