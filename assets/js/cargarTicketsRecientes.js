function cargarTicketsRecientes() {
    $.ajax({
        url: 'get_tickets_recientes.php',
        method: 'GET',
        success: function(data) {
            $('#tickets-recientes-list').html(data);
            $('#miTablaTickets').DataTable({
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
        },
        error: function() {
            handleError("Error al cargar los tickets recientes.");
        }
    });
}