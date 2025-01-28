<?php
    class EventoDAO{
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
        
        public function setDProv($dProv){
            $this -> dProv = $dProv;
        }
        public function consTod(){
            return "SELECT
                        idEve, nombreEve, fechIniEve, fechFinEve, precioEve, imagenEve, idLug, dProv
                    FROM
                        Eventos
                    ";
        }
        public function consIdProv(){
            return"SELECT
                        idEve, 
                        nombreEve, 
                        fechIniEve, 
                        fechFinEve, 
                        precioEve, 
                        imagenEve, 
                        idLug
                   FROM
                        eventos
                   WHERE
                        dProv = ".$this -> dProv."
            ";      
        }
        public function registrar(){
          /*  return "INSERT INTO
                        eventos
                        (nombreEve, 
                        fechIniEve, 
                        fechFinEve, 
                        precioEve, 
                        imagenEve, 
                        idLug, 
                        dProv)
                    VALUES
                        ('".$this -> nombreEve."',
                         '".$this -> fechIniEve."',
                         '".$this -> fechFinEve."',
                         '".$this -> precioEve."',
                         ".$this -> imagenEve.",
                         '".$this -> idLug."',
                         '".$this -> dProv."')
            ";*/
            return "INSERT INTO 
                        eventos 
                            (nombreEve, 
                            fechIniEve, 
                            fechFinEve, 
                            precioEve, 
                            imagenEve, 
                            idLug, 
                            dProv)
                    VALUES (:nombreEve, 
                            :fechIniEve, 
                            :fechFinEve, 
                            :precioEve, 
                            :imagenEve, 
                            :idLug, 
                            :dProv)
                    ";
        }
        public function actualizar(){
            return "UPDATE 
                        eventos
                    SET
                        nombreEve = :nombreEve,
                        fechIniEve = :fechIniEve,
                        fechFinEve = :fechFinEve,
                        precioEve = :precioEve,
                        imagenEve = :imagenEve,
                        idLug = :idLug,
                        dProv = :dProv
                    WHERE idEve = :idEve
                    ";
            /*
            return "UPDATE
                        eventos
                    SET
                        nombreEVE = '".$this -> nombreEve."',
                        fechIniEve = '".$this -> fechIniEve."',
                        fechFinEve = '".$this -> fechFinEve."',
                        precioEve = '".$this -> precioEve."',
                        imagenEve = ".$this -> imagenEve.",
                        idLug = ".$this -> idLug.",
                        dProv = ".$this -> dProv."
                    WHERE
                        idEve = ".$this -> idEve."
                    ";
            */
        }
        public function actualizarSIM(){
            return "UPDATE
                        eventos
                    SET
                        nombreEVE = '".$this -> nombreEve."',
                        fechIniEve = '".$this -> fechIniEve."',
                        fechFinEve = '".$this -> fechFinEve."',
                        precioEve = '".$this -> precioEve."',
                        idLug = ".$this -> idLug.",
                        dProv = ".$this -> dProv."
                    WHERE
                        idEve = ".$this -> idEve."
                    ";
        }
        public function eliminar(){
            return "DELETE FROM
                        eventos
                    WHERE
                        idEve = ".$this->idEve."
            ";
        }
        public function consId(){
            return"SELECT
                        nombreEve,
                        fechIniEve,
                        fechFinEve,
                        precioEve,
                        imagenEve,
                        idLug,
                        dProv
                    FROM
                        eventos
                    WHERE
                        idEve = ".$this -> idEve."
            ";
        }
        public function conPN($filtro){
            return "SELECT 
                        idEve,
                        nombreEve,
                        fechIniEve,
                        fechFinEve,
                        precioEve,
                        imagenEve,
                        idLug,
                        dProv
                    FROM 
                        eventos 
                    WHERE nombreEve 
                        LIKE '%".$filtro."%'
                        AND
                        dProv = ".$this -> dProv."  
                    ";
        }
        public function conPNS($filtro){
            return "SELECT 
                        idEve,
                        nombreEve,
                        fechIniEve,
                        fechFinEve,
                        precioEve,
                        imagenEve,
                        idLug,
                        dProv
                    FROM 
                        eventos 
                    WHERE nombreEve 
                        LIKE '%".$filtro."%'
                    ";
        }

    }
?>