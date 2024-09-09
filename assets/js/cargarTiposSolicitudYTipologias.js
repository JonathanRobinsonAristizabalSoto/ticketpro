function cargarTiposSolicitudYTipologias() {
    $.ajax({
        url: 'get_tipo_de_solicitud.php',
        method: 'GET',
        success: function(data) {
            var response = JSON.parse(data);
            var tiposSolicitud = response.tipos_solicitud;
            var tipologias = response.tipologias;

            // Cargar tipos de solicitud
            var opcionesTiposSolicitud = '<option value="" disabled selected>Seleccione una opción</option>';
            tiposSolicitud.forEach(function(tipo) {
                opcionesTiposSolicitud += '<option value="' + tipo + '">' + tipo + '</option>';
            });
            $('#tipo_solicitud').html(opcionesTiposSolicitud);

            // Manejar el cambio de tipo de solicitud
            $('#tipo_solicitud').change(function() {
                var tipoSeleccionado = $(this).val();
                var opcionesTipologias = '<option value="" disabled selected>Seleccione una tipología</option>';
                if (tipologias[tipoSeleccionado]) {
                    tipologias[tipoSeleccionado].forEach(function(tipologia) {
                        opcionesTipologias += '<option value="' + tipologia.id + '">' + tipologia.nombre + '</option>';
                    });
                }
                $('#tipologia').html(opcionesTipologias);
            });
        },
        error: function() {
            handleError("Error al cargar los tipos de solicitud y las tipologías.");
        }
    });
}