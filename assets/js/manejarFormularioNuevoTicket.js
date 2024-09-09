function manejarFormularioNuevoTicket() {
    $('#nueva-solicitud-form').submit(function(event) {
        // Prevenir el comportamiento por defecto del formulario
        event.preventDefault();

        // Obtener los valores del formulario
        var tipo_solicitud = $('#tipo_solicitud').val();
        var tipologia = $('#tipologia').val();
        var programa = $('#programa').val();
        var descripcion = $('#descripcion').val();
        var prioridad = $('#prioridad').val();

        // Verificar los datos antes de enviarlos
        console.log({
            tipo_solicitud: tipo_solicitud,
            tipologia: tipologia,
            programa: programa,
            descripcion: descripcion,
            prioridad: prioridad
        });

        // Enviar datos al servidor para crear el ticket
        $.ajax({
            url: '../Home/crear_ticket.php', // Ruta corregida
            method: 'POST',
            data: {
                tipo_solicitud: tipo_solicitud,
                tipologia: tipologia,
                programa: programa,
                descripcion: descripcion,
                prioridad: prioridad
            },
            success: function(response) {
                // Informar al usuario que el ticket fue creado exitosamente
                alert('Ticket creado exitosamente');

                // Resetear el formulario
                $('#nueva-solicitud-form')[0].reset();

                // Cargar los tickets recientes
                cargarTicketsRecientes();
            },
            error: function() {
                handleError("Error al crear el ticket.");
            }
        });
    });
}