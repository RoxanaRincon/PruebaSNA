

<!DOCTYPE html>
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


   


    <script src="js/solicitud_servicio.js"></script>

    
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

    <div class="container">
    <h2 class="mb-4">Formulario de Solicitud de Servicio</h2>
        <form id="formularioServicio">
            <div class="form-group">
                <label for="numeroServicio">Número de servicio:</label>
                <input type="text" class="form-control" id="numeroServicio" name="numeroServicio" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="number" class="form-control" id="valor" name="valor" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="empresa">Empresa:</label>
                <input type="text" class="form-control" id="empresa" name="empresa" required>
            </div>
            <div class="form-group">
                <label for="tipoServicio">Tipo de Servicio:</label>
                <select class="form-control" id="tipoServicio" name="tipoServicio" required>
                    <option value="">Seleccione un tipo de servicio</option>
                    <option value="Carga">Carga</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="automotores">Automotores:</label>
                <select multiple class="form-control" id="automotores" name="automotores[]" required>
                    <!-- Aquí puedes cargar dinámicamente los automotores desde la base de datos si es necesario -->
                </select>
            </div>
            <div class="form-group">
                <label for="cantidadAutomotores">Cantidad de Automotores:</label>
                <input type="number" class="form-control" id="cantidadAutomotores" name="cantidadAutomotores[]" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
        </form>
    </div>
    </div>
</body>
</html>

