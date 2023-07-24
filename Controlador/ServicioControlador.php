<?php

include_once "../Modelo/ServicioModelo.php";

class CtrServicio {

    public function ctrGuardarSolicitudServicio() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Aquí obtienes los datos del formulario de solicitud de servicio
            $numeroServicio = $_POST["numeroServicio"];
            $fecha = $_POST["fecha"];
            $valor = $_POST["valor"];
            $empresa = $_POST["empresa"];
            $tipoServicio = $_POST["tipoServicio"];
            $automotores = $_POST["automotores"];
            $cantidadAutomotores = $_POST["cantidadAutomotores"];

            // Realizamos alguna validación adicional si es necesario

            // Llamamos al modelo para guardar la solicitud de servicio
            $modeloServicio = new ServicioModelo();
            $idServicio = $modeloServicio->guardarSolicitudServicio($numeroServicio, $fecha, $valor, $empresa, $tipoServicio, $automotores, $cantidadAutomotores);

            // Enviamos una respuesta al cliente (por ejemplo, un mensaje de éxito o un ID de servicio generado)
            echo json_encode(array("idServicio" => $idServicio));
        }
    }

    public function ctrListarServiciosSolicitados() {
        // Aquí puedes implementar la lógica para listar los servicios solicitados
        // Llamamos al modelo para obtener la lista de servicios solicitados
        $modeloServicio = new ServicioModelo();
        $serviciosSolicitados = $modeloServicio->listarServiciosSolicitados();

        // Enviamos la lista de servicios solicitados como respuesta al cliente
        echo json_encode($serviciosSolicitados);
    }

    public function ctrListarAutomotores() {
        // Llamamos al modelo para obtener la lista de automotores
        $modeloAutomotor = new AutomotorModelo();
        $automotores = $modeloAutomotor->listarAutomotores();

        // Enviamos la lista de automotores como respuesta al cliente
        echo json_encode($automotores);
    }

}

// Verificar si se ha enviado el formulario de solicitud de servicio
if (isset($_POST["numeroServicio"], $_POST["fecha"], $_POST["valor"], $_POST["empresa"], $_POST["tipoServicio"], $_POST["automotores"], $_POST["cantidadAutomotores"])) {
    $objServicio = new CtrServicio();
    $objServicio->ctrGuardarSolicitudServicio();
}

// Verificar si se ha enviado la solicitud para listar los servicios solicitados
if (isset($_POST["listarServiciosSolicitados"]) && $_POST["listarServiciosSolicitados"] === "ok") {
    $objServicio = new CtrServicio();
    $objServicio->ctrListarServiciosSolicitados();
}


// Verificar si se ha enviado la solicitud para listar los automotores
if (isset($_POST["listarAutomotores"]) && $_POST["listarAutomotores"] === "ok") {
    $objAutomotor = new CtrAutomotor();
    $objAutomotor->ctrListarAutomotores();
}