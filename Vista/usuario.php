!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Evaluacion</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel='stylesheet' type='text/css' media='screen' href=''>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Empresa Carga</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="FormularioSolicitud.php">Solicitud de Servicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listadoServicios.php">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usuario.php">Gestion de usuarios</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cerrarsesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">



    <div class="row">
        <div class="mb-3 mt-3">
            <button id="btnUsuario" type="button" class="btn btn-primary">Registrar Usuario</button>
        </div>
    </div>



        <div class="row">
            <div class="col-sm-4" id="contenedorFormularios" style="display: none;">
                <div class="container">
                    <form method="post" class="needs-validation">
                        <div class="mb-3 mt-3">
                            <label for="uname" class="form-label">Correo Electrónico:</label>
                            <input type="text" class="form-control" id="txt_correo" placeholder="Ingrese el correo electrónico" name="guardarCorreo" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="txt_password" placeholder="Ingrese la contraseña" name="guardarPassword" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button type="button" id="btnGuardarUsuario" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>

            <div class="col-sm-12" id="contenedorTablaUsuario">
                <table id="tablaUsuario" class="table">
                    <thead class="table-primary">
                        <tr>
                        <th>id</th>
                            <th>Correo Electrónico</th>
                            <th>Tipo de Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="datosTablaUsuario">

                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script src='js/usuario.js'></script>
</body>

</html>