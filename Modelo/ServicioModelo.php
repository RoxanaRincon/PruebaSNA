<?php

include_once "Conexion.php";

class ServicioModelo {

    public function guardarSolicitudServicio($numeroServicio, $fecha, $valor, $empresa, $tipoServicio, $automotores, $cantidadAutomotores) {
        $idServicio = null;
        $conexion = Conexion::conectar();

        try {
            // Iniciar una transacción para asegurar que los datos se guarden correctamente
            $conexion->beginTransaction();

            $stmtServicio = $conexion->prepare("INSERT INTO servicios_solicitados (numero_servicio, fecha_solicitud, valor, id_empresa) VALUES (:numeroServicio, :fecha, :valor, :empresa)");
            $stmtServicio->bindParam(":numeroServicio", $numeroServicio);
            $stmtServicio->bindParam(":fecha", $fecha);
            $stmtServicio->bindParam(":valor", $valor);
            $stmtServicio->bindParam(":empresa", $empresa);

            if ($stmtServicio->execute()) {
                $idServicio = $conexion->lastInsertId();

                $stmtDetalles = $conexion->prepare("INSERT INTO detalles_servicio (id_servicio, id_automotor, cantidad) VALUES (:idServicio, :idAutomotor, :cantidad)");

                for ($i = 0; $i < count($automotores); $i++) {
                    $stmtDetalles->bindParam(":idServicio", $idServicio);
                    $stmtDetalles->bindParam(":idAutomotor", $automotores[$i]);
                    $stmtDetalles->bindParam(":cantidad", $cantidadAutomotores[$i]);
                    $stmtDetalles->execute();
                }

                // Si todo se ha insertado correctamente, confirmamos la transacción
                $conexion->commit();
            } else {
                // Si algo falla, cancelamos la transacción y dejamos el ID del servicio como null
                $conexion->rollBack();
                $idServicio = null;
            }
        } catch (Exception $error) {
            // En caso de error, cancelamos la transacción y dejamos el ID del servicio como null
            $conexion->rollBack();
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