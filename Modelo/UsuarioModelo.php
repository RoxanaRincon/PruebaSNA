<?php

include_once "Conexion.php";

class mdlUsuario {

// Función para listar la tabla de usuarios
public static function mdlListarUsuario(){
    $listarUsuario = "";

    try {
        $respuestaUsuario = Conexion::conectar()->prepare("SELECT * FROM usuarios");
        $respuestaUsuario->execute();
        $listarUsuario = $respuestaUsuario->fetchAll();
        $respuestaUsuario = null;

    } catch (Exception $error) {
        $listarUsuario = $error;
    }

    return $listarUsuario;
}


public static function mdlGuardarUsuario($Correo, $Password, $TipoUsuario) {
    $mensaje = "";  
    try {
        // Cifrar la contraseña antes de guardarla en la base de datos
        $password_cifrado = password_hash($Password, PASSWORD_DEFAULT);

        $respuestaUsuario = Conexion::conectar()->prepare("INSERT INTO usuarios(correo_electronico, contrasena, tipo_usuario) VALUES(:Correo, :Password, :TipoUsuario)"); // Agregar :TipoUsuario a la consulta SQL

        $respuestaUsuario->bindParam(":Correo", $Correo);
        $respuestaUsuario->bindParam(":Password", $password_cifrado);
        $respuestaUsuario->bindParam(":TipoUsuario", $TipoUsuario); // Pasar el nuevo campo TipoUsuario

     

        if ($respuestaUsuario->execute()) {
            $mensaje = "ok";
        } else {
            $mensaje = "Error al registrar el usuario";
        }
        
    } catch(Exception $error){
        $mensaje = $error;
    }

    return $mensaje;
}

// Funcion editar usuario
public static function mdlUpdateUsuario($Correo, $Password, $TipoUsuario, $idUsuario) {
    $mensaje = "";
    try {
        // Resto del código...

        $objRespuesta = Conexion::conectar()->prepare("UPDATE usuarios SET correo_electronico = :Correo, contrasena = :Password, tipo_usuario = :TipoUsuario WHERE id_usuario = :id");
        $objRespuesta->bindParam(":Correo", $Correo);
        $objRespuesta->bindParam(":Password", $password_cifrado);
        $objRespuesta->bindParam(":TipoUsuario", $TipoUsuario); // Agregar el tipo de usuario al query
        $objRespuesta->bindParam(":id", $idUsuario);
        $objRespuesta->execute();

        $mensaje = "ok";

    } catch (Exception $e) {
        $mensaje = $e;
    }
    return $mensaje;
}

// Función eliminar usuario
public static function mdlEliminarUsuario($idUsuario){
    $mensaje = "";  
    try {
        $respuestaUsuario = Conexion::conectar()->prepare("DELETE FROM usuarios WHERE id_usuario = :idUsuario");
        $respuestaUsuario->bindParam(":idUsuario", $idUsuario);
        if($respuestaUsuario->execute()){
            $mensaje = "ok";
        } else {
            $mensaje = "Error al eliminar el usuario";
        }
        
    } catch(Exception $error){
        $mensaje = $error;
    }

    return $mensaje;
}



// Función para iniciar sesión
public static function mdlIniciarSesion($correo, $password) {
    try {
        $consulta = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo_electronico = :correo");
        $consulta->bindParam(":correo", $correo);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['contrasena'])) {
            return $usuario;
        } else {
            return false;
        }
    } catch (Exception $error) {
        return false;
    }
}

}