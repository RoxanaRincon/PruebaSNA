$(document).ready(function() {
    // Cargar automotores desde la base de datos (puedes hacer una petición AJAX si es necesario)
 cargarAutomotores();
 cargarEmpresas();
    // Enviar el formulario mediante AJAX
    $("#formularioServicio").submit(function(event) {
        event.preventDefault();

        // Obtener los datos del formulario
        let numeroServicio = $("#numeroServicio").val();
        let fecha = $("#fecha").val();
        let valor = $("#valor").val();
        let empresa = $("#empresa").val();
        let tipoServicio = $("#tipoServicio").val();
        let automotores = $("#automotores").val();
        let cantidadAutomotores = $("#cantidadAutomotores").val();

        // Convertir la cantidad de automotores a un array si se seleccionó más de uno
        if (!Array.isArray(cantidadAutomotores)) {
            cantidadAutomotores = [cantidadAutomotores];
        }

        // Enviar los datos del formulario al controlador mediante AJAX
        $.ajax({
            url: "../Controlador/ServicioControlador.php", // Reemplaza esto con la ruta a tu controlador de servicio
            type: "POST",
            dataType: "json",
            data: {
                numeroServicio: numeroServicio,
                fecha: fecha,
                valor: valor,
                empresa: empresa,
                tipoServicio: tipoServicio,
                automotores: automotores,
                cantidadAutomotores: cantidadAutomotores
            },
            success: function(response) {
                // Procesar la respuesta del controlador
                if (response && response.idServicio) {
                    alert("Solicitud de servicio enviada correctamente. ID del servicio: " + response.idServicio);
                    // Aquí puedes redirigir a otra página si es necesario
                } else {
                    alert("Error al enviar la solicitud de servicio.");
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert("Error en la solicitud AJAX. Por favor, inténtelo nuevamente.");
            }
        });
    });



// Función para cargar los automotores desde el servidor
function cargarAutomotores() {
    $.ajax({
        url: "../Controlador/AutomotorControlador.php", // Reemplaza esto con la ruta a tu controlador de automotores
        type: "POST",
        dataType: "json",
        data: {
            listarAutomotores: "ok"
        },
        success: function(response) {

            console.log(response);
            // Procesar la respuesta del controlador y llenar el select con los automotores
            if (response && response.length > 0) {
                let selectAutomotores = $("#automotores");
                selectAutomotores.empty();

                response.forEach(function(automotor) {
                    let option = "<option value='" + automotor.id_automotor + "'>" + automotor.placa + "</option>";
                    selectAutomotores.append(option);
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert("Error al cargar los automotores. Por favor, inténtelo nuevamente.");
        }
    });
}

function cargarEmpresas() {
    $.ajax({
        url: "../Controlador/EmpresasControlador.php", // Reemplaza con la ruta a tu controlador que obtiene la lista de empresas
        type: "POST",
        dataType: "json",
        data: {
            obtenerEmpresas: "ok"
        },
        success: function(response) {
            // Procesar la respuesta del servidor y agregar las opciones al campo de selección
            if (response && response.length > 0) {
                let campoEmpresas = $("#empresa");
                response.forEach(function(empresa) {
                    campoEmpresas.append("<option value='" + empresa.id_empresa + "'>" + empresa.nombre + "</option>");
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert("Error al cargar las empresas. Por favor, inténtelo nuevamente.");
        }
    });
}

});