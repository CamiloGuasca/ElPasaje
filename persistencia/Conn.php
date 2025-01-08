<?php
class Conn {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=el_pasaje", 
                "root", 
                "",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Error al conectar: " . $e->getMessage());
        }
    }

    public static function getInstance(): Conn {
        if (self::$instance === null) {
            self::$instance = new Conn();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>