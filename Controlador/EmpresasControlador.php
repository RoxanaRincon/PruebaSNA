<?php

include_once "../Modelo/EmpresasModelo.php";

class EmpresasControlador {

    public function listarEmpresas() {
        // Llamamos al modelo para obtener la lista de empresas
        $modeloEmpresas = new EmpresasModelo();
        $empresas = $modeloEmpresas->listarEmpresas();

        // Enviamos la lista de empresas como respuesta al cliente
        echo json_encode($empresas);
    }
}

// Verificar si se ha enviado la solicitud para listar las empresas
if (isset($_POST["obtenerEmpresas"]) && $_POST["obtenerEmpresas"] === "ok") {
    $objEmpresas = new EmpresasControlador();
    $objEmpresas->listarEmpresas();
}