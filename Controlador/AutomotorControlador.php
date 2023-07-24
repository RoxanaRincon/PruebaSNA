<?php

include_once "../Modelo/AutomotorModelo.php";

class CtrAutomotor {
        public function ctrListarAutomotores() {
            try {
                // Llamamos al modelo para obtener la lista de automotores
                $modeloAutomotor = new AutomotorModelo();
                $automotores = $modeloAutomotor->listarAutomotores();
    
                // Enviamos la lista de automotores como respuesta al cliente
                echo json_encode($automotores);
            } catch (PDOException $e) {
                // Capturamos la excepción y mostramos el mensaje de error en la respuesta JSON
                echo json_encode(array("error" => "Error al cargar los automotores: " . $e->getMessage()));
            }
        }
    }
// Verificar si se ha enviado la solicitud para listar los automotores
if (isset($_POST["listarAutomotores"]) && $_POST["listarAutomotores"] === "ok") {
    $objAutomotor = new CtrAutomotor();
    $objAutomotor->ctrListarAutomotores();
}