function cargarProgramas() {
    $.ajax({
        url: 'get_programas.php',
        method: 'GET',
        success: function(data) {
            var response = JSON.parse(data);
            if (response.error) {
                handleError(response.error);
            } else {
                $('#programas-list').html(response.lista);
                var opciones = '<option value="" disabled selected>Seleccione un programa</option>';
                opciones += response.opciones;
                $('#programa').html(opciones);
                $('#miTablaProgramas').DataTable({
                    destroy: true, // Agregar esta línea para evitar errores de inicialización múltiple
                    pageLength: 5,
                    language: {
                        "sEmptyTable": "No hay datos disponibles en la tabla",
                        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                        "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                        "sInfoFiltered": "(filtrado de _MAX_ entradas en total)",
                        "sLengthMenu": "Mostrar _MENU_ entradas",
                        "sLoadingRecords": "Cargando...",
                        "sProcessing": "Procesando...",
                        "sSearch": "Buscar:",
                        "sZeroRecords": "No se encontraron resultados",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        }
                    }
                });
            }
        },
        error: function() {
            handleError("Error al cargar los programas.");
        }
    });
}

function actualizarCamposPrograma() {
    $('#programa').change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#modalidad').val(selectedOption.data('modalidad'));
    });
}

function handleError(message) {
    alert(message);
}

// Llamar a las funciones al cargar la página
$(document).ready(function() {
    cargarProgramas();
    actualizarCamposPrograma();
});