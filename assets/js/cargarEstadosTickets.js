function cargarEstadosTickets() {
    $.ajax({
        url: 'get_estados.php',
        method: 'GET',
        success: function(data) {
            $('#estados-container').html(data);
        },
        error: function() {
            handleError("Error al cargar los estados de los tickets.");
        }
    });
}