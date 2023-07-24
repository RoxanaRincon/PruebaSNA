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

public static function mdlGuardarUsuario($Correo,$Password){
    $mensaje = "";  
    try {
        // Cifrar la contraseña antes de guardarla en la base de datos
        $password_cifrado = password_hash($Password, PASSWORD_DEFAULT);

        $respuestaUsuario = Conexion::conectar()->prepare("INSERT INTO usuarios(correo_electronico, contrasena) VALUES(:Correo,:Password)");
    
        $respuestaUsuario->bindParam(":Correo", $Correo);
        $respuestaUsuario->bindParam(":Password", $password_cifrado);
        
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
public static function mdlUpdateUsuario($Correo, $Password, $idUsuario){
    $mensaje = "";
    try {
        // Cifrar la contraseña antes de guardarla en la base de datos
        $password_cifrado = password_hash($Password, PASSWORD_DEFAULT);

        $objRespuesta = Conexion::conectar()->prepare("UPDATE usuarios SET Correo = :Correo, contrasena = :Password WHERE id_usuario = :id"); 
        $respuestaUsuario->bindParam(":Correo", $Correo);
        $respuestaUsuario->bindParam(":Password", $password_cifrado);
        $objRespuesta->bindParam(":id", $idUsuario);
        $objRespuesta->execute();

        $mensaje = "ok";

    } catch(Exception $e){
        $mensaje = $e;
    }
    return $mensaje;
}

// Función eliminar usuario
public static function mdlEliminarUsuario($idUsuario){
    $mensaje = "";  
    try {
        $respuestaUsuario = Conexion::conectar()->prepare("DELETE FROM usuarios WHERE idUsuario = :idUsuario");
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
            // La contraseña coincide, el usuario existe
            return $usuario;
        } else {
            // El usuario o contraseña son incorrectos
            return false;
        }
    } catch (Exception $error) {
        return false;
    }
}

}