function cargarTipologiasYSubtipologias() {
    $.ajax({
        url: 'get_tipologias.php',
        method: 'GET',
        success: function(data) {
            var response = JSON.parse(data);
            var tipologias = response.tipologias;
            var subtipologias = response.subtipologias;

            // Cargar tipologías
            var opcionesTipologias = '<option value="" disabled selected>Seleccione una opción</option>';
            tipologias.forEach(function(tipologia) {
                opcionesTipologias += '<option value="' + tipologia + '">' + tipologia + '</option>';
            });
            $('#tipologia').html(opcionesTipologias);

            // Manejar el cambio de tipología
            $('#tipologia').change(function() {
                var tipologiaSeleccionada = $(this).val();
                var opcionesSubtipologias = '<option value="" disabled selected>Seleccione una subtipología</option>';
                if (subtipologias[tipologiaSeleccionada]) {
                    subtipologias[tipologiaSeleccionada].forEach(function(subtipologia) {
                        opcionesSubtipologias += '<option value="' + subtipologia.id + '">' + subtipologia.nombre + '</option>';
                    });
                }
                $('#subtipologia').html(opcionesSubtipologias);
            });

            // Inicializar el cambio de tipología si ya hay un valor seleccionado
            var tipologiaSeleccionadaInicial = $('#tipologia').val();
            if (tipologiaSeleccionadaInicial) {
                $('#tipologia').trigger('change');
            }
        },
        error: function() {
            handleError("Error al cargar las tipologías y subtipologías.");
        }
    });
}