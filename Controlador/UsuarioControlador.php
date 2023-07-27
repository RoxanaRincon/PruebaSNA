<?php

include_once "../Modelo/UsuarioModelo.php";

class CtrUsuario {

    public $idUsuario;
    public $Nombres;
    public $Apellidos;
    public $Correo;
    public $Password; // Nuevo campo para la contraseña

    public function ctrListarUsuario() {
        $respuestaUsuarioM = mdlUsuario::mdlListarUsuario();
        echo json_encode($respuestaUsuarioM);
    }

    public function ctrGuardarUsuario() {
        $respuestaUsuarioM = mdlUsuario::mdlGuardarUsuario($this->Correo, $this->Password, $this->TipoUsuario); // Pasar el nuevo campo guardarTipoUsuario
        echo json_encode($respuestaUsuarioM);
    }

   
    public function ctrUpdateUsuario() {
        $respuestaUsuarioM = mdlUsuario::mdlUpdateUsuario($this->Correo, $this->Password, $this->TipoUsuario, $this->idUsuario); // Ajuste para recibir el tipo de usuario
        echo json_encode($respuestaUsuarioM);
    }

    public function ctrEliminarUsuario() {
        $respuestaUsuarioM = mdlUsuario::mdlEliminarUsuario($this->idUsuario);
        echo json_encode($respuestaUsuarioM);
    }
    public function ctrIniciarSesion($correo, $password) {
        // Lógica para implementar el inicio de sesión
        $usuario = MdlUsuario::mdlIniciarSesion($correo, $password);
        if ($usuario) {
            // Inicio de sesión exitoso, guardar información del usuario en la sesión
            session_start();
            $_SESSION['loggedin'] = true; // Variable que indica que el usuario ha iniciado sesión
            $_SESSION['idUsuario'] = $usuario['id_usuario']; // Solo almacenar el ID del usuario en la sesión
            // Aquí puedes guardar más información del usuario en la sesión si lo necesitas
            echo json_encode("ok");
        } else {
            echo json_encode("Usuario o contraseña incorrectos");
        }
    }
}

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST["correo"], $_POST["password"])) {
    $objUsuario = new CtrUsuario();
    $objUsuario->ctrIniciarSesion($_POST["correo"], $_POST["password"]);
}


if(isset($_POST["listarDatosUsuario"]) && $_POST["listarDatosUsuario"] == "ok"){

    $objUsuario = new ctrUsuario();
    $objUsuario -> ctrListarUsuario();

}

if (isset($_POST["guardarCorreo"], $_POST["guardarPassword"], $_POST["guardarTipoUsuario"])) {
    $objUsuario = new ctrUsuario();
    $objUsuario->Correo = $_POST["guardarCorreo"];
    $objUsuario->Password = $_POST["guardarPassword"];
    $objUsuario->TipoUsuario = $_POST["guardarTipoUsuario"]; // Agregar el nuevo campo guardarTipoUsuario
    $objUsuario->ctrGuardarUsuario();
}

if(isset($_POST["eliminarUsuario"])){
    $objUsuario = new ctrUsuario();
    $objUsuario -> idUsuario = $_POST["eliminarUsuario"];
    $objUsuario -> ctrEliminarUsuario();
}


if (isset($_POST["updateCorreo"], $_POST["updatePassword"], $_POST["updateIdUsuario"], $_POST["updateTipoUsuario"])) {
    $objPersonaje = new ctrUsuario();
    $objPersonaje->Correo = $_POST["updateCorreo"];
    $objPersonaje->idUsuario = $_POST["updateIdUsuario"];
    $objPersonaje->Password = $_POST["updatePassword"];
    $objPersonaje->TipoUsuario = $_POST["updateTipoUsuario"]; // Agregar el campo guardarTipoUsuario
    $objPersonaje->ctrUpdateUsuario();
}
