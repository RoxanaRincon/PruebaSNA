<?php

include_once "Conexion.php";

class EmpresasModelo {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::conectar();
    }

    public function listarEmpresas() {
        try {
            $query = "SELECT id_empresa, nombre FROM empresas";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores en caso de que la consulta falle
            // Puedes personalizar este manejo de errores según tus necesidades
            return array();
        }
    }
}