function cargarEstadosTickets() {
    $.ajax({
        url: 'get_estados.php',
        method: 'GET',
        success: function(data) {
            $('#estados-container').html(data);
            // Inicializar cualquier funcionalidad adicional después de cargar los estados
            inicializarFuncionesEstados();
        },
        error: function() {
            handleError("Error al cargar los estados de los tickets.");
        }
    });
}

function inicializarFuncionesEstados() {
    // Aquí puedes agregar cualquier funcionalidad adicional que necesites
    // por ejemplo, inicializar tooltips, eventos de clic, etc.
    console.log("Estados de tickets cargados y funciones adicionales inicializadas.");
}