$(document).ready(function() {
    // Cargar los servicios desde la base de datos al cargar la página
    cargarServicios();

    // Función para cargar los servicios desde la base de datos
    function cargarServicios() {
        $.ajax({
            url: "../Controlador/ServicioControlador.php", // Reemplaza esto con la ruta a tu controlador de servicios
            type: "POST",
            dataType: "json",
            data: {
                listarServiciosSolicitados: "ok"
            },
            success: function(response) {

                console.log(response);
                // Procesar la respuesta del controlador y mostrar los datos en la tabla
                if (response && response.length > 0) {
                    let tablaServicios = $("#tablaServicios");
                    tablaServicios.DataTable().clear().destroy();
    
                    response.forEach(function(servicio) {
                        let fila = "<tr>";
                        fila += "<td>" + servicio.id_servicio + "</td>";
                        fila += "<td>" + servicio.fecha_solicitud + "</td>";
                        fila += "<td>" + servicio.valor + "</td>";
                        // Aquí puedes agregar más campos si los necesitas
                        fila += "<td>";
                        fila += "<button class='btn btn-danger btn-sm btnEliminar' data-id='" + servicio.id_servicio + "'>Eliminar</button>";
                        fila += "</td>";
                        fila += "</tr>";
                        tablaServicios.append(fila);
                    });
    
                    // Inicializar la tabla de datos con DataTables
                    tablaServicios.DataTable();
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert("Error al cargar los servicios. Por favor, inténtelo nuevamente.");
            }
        });
    }

    // Evento click para el botón de eliminar servicio
    $(document).on("click", ".btnEliminar", function() {
        let idServicio = $(this).data("id");

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará el servicio seleccionado.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarServicio(idServicio);
            }
        });
    });

    // Función para eliminar un servicio
    function eliminarServicio(idServicio) {
        $.ajax({
            url: "../Controlador/ServicioControlador.php", // Reemplaza esto con la ruta a tu controlador de servicios
            type: "POST",
            dataType: "json",
            data: {
                eliminarServicio: idServicio
            },
            success: function(response) {
                // Procesar la respuesta del controlador y mostrar mensaje de confirmación
                if (response && response === "ok") {
                    Swal.fire({
                        title: 'Eliminado',
                        text: 'El servicio ha sido eliminado correctamente.',
                        icon: 'success'
                    }).then(function() {
                        // Recargar la tabla de servicios después de eliminar un servicio
                        cargarServicios();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al eliminar el servicio. Por favor, inténtelo nuevamente.',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert("Error al eliminar el servicio. Por favor, inténtelo nuevamente.");
            }
        });
    }
});