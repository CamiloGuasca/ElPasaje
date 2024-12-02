<?php 
    class TipoBoletaDAO{
        
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
           return "SELECT
                        idTB,
                        nombreTB,
                        porcentajeTB
                    FROM
                        tipoboleta
                    WHERE
                        Proveedores_idProv = ".$this->Proveedores_idProv."
                    ";
        }
        public function conTipBol(){
            return "SELECT
                        nombreTB,
                        porcentajeTB
                    FROM
                        tipoboleta
                    WHERE
                        idTB = ".$this -> getIdTB()."
                    ";
        }
        public function registrar(){
            return "INSERT INTO
                        tipoboleta
                        (nombreTB,
                         porcentajeTB,
                         Proveedores_idProv)
                    VALUES
                        ('".$this -> nombreTB."',
                         '".$this -> porcentajeTB."',
                         '".$this -> Proveedores_idProv."')
                    ";
        }
        public function actualizar(){
            return "UPDATE
                        tipoboleta
                    SET
                        nombreTB = '".$this -> nombreTB."',
                        porcentajeTB = '".$this -> porcentajeTB."'
                    WHERE
                        idTB = '".$this -> idTB."'
                    ";
        }
        public function eliminar(){
            return "DELETE FROM
                        tipoboleta
                    WHERE
                        idtb = ".$this->idTB."

            ";
        }
    }
?>