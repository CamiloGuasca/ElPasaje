<?php
   class DetalleEventoDAO{
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
        public function registroDE(){
            return "INSERT INTO
                        detalleevento (idEve, idTB, Cantidad)
                    VALUES
                        (".$this->idEve.", 
                         ".$this->idTB.",
                         ".$this->cantidad.")
                    ";
        }
        public function eliminarDE(){
            return "DELETE FROM
                        detalleevento
                    WHERE
                        idDE = ".$this -> idDE."
                    ";
        }
        public function consIdEve(){
            return "SELECT
                        idDE,
                        idTB,
                        Cantidad
                    FROM
                        detalleevento
                    WHERE
                        idEve  = ".$this -> idEve."     
                    ";
        }
   } 
?>