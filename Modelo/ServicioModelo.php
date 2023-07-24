<?php

include_once "Conexion.php";

class ServicioModelo {

    public function guardarSolicitudServicio($numeroServicio, $fecha, $valor, $empresa, $tipoServicio, $automotores, $cantidadAutomotores) {
        $idServicio = null;
        try {
            // Iniciar una transacción para asegurar que los datos se guarden correctamente
            Conexion::conectar()->beginTransaction();

            // Primero, insertamos los datos principales del servicio en la tabla servicios_solicitados
            $stmtServicio = Conexion::conectar()->prepare("INSERT INTO servicios_solicitados (numero_servicio, fecha_solicitud, valor, id_empresa) VALUES (:numeroServicio, :fecha, :valor, :empresa)");
            $stmtServicio->bindParam(":numeroServicio", $numeroServicio);
            $stmtServicio->bindParam(":fecha", $fecha);
            $stmtServicio->bindParam(":valor", $valor);
            $stmtServicio->bindParam(":empresa", $empresa);

            if ($stmtServicio->execute()) {
                // Obtenemos el ID del servicio que se acaba de insertar
                $idServicio = Conexion::conectar()->lastInsertId();

                // Luego, insertamos los detalles del servicio en la tabla detalles_servicio
                $stmtDetalles = Conexion::conectar()->prepare("INSERT INTO detalles_servicio (id_servicio, id_automotor, cantidad) VALUES (:idServicio, :idAutomotor, :cantidad)");

                // Recorremos los arrays de automotores y cantidadAutomotores para insertar los detalles uno por uno
                for ($i = 0; $i < count($automotores); $i++) {
                    $stmtDetalles->bindParam(":idServicio", $idServicio);
                    $stmtDetalles->bindParam(":idAutomotor", $automotores[$i]);
                    $stmtDetalles->bindParam(":cantidad", $cantidadAutomotores[$i]);
                    $stmtDetalles->execute();
                }

                // Si todo se ha insertado correctamente, confirmamos la transacción
                Conexion::conectar()->commit();
            } else {
                // Si algo falla, cancelamos la transacción y dejamos el ID del servicio como null
                Conexion::conectar()->rollback();
                $idServicio = null;
            }
        } catch (Exception $error) {
            // En caso de error, cancelamos la transacción y dejamos el ID del servicio como null
            Conexion::conectar()->rollback();
            $idServicio = null;
        }

        return $idServicio;
    }

    public function listarServiciosSolicitados() {
        $serviciosSolicitados = array();
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM servicios_solicitados");
            $stmt->execute();
            $serviciosSolicitados = $stmt->fetchAll();
        } catch (Exception $error) {
            $serviciosSolicitados = array();
        }
        return $serviciosSolicitados;
    }
}