$(document).ready(function() {
    // Cargar automotores desde la base de datos (puedes hacer una petición AJAX si es necesario)

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
});