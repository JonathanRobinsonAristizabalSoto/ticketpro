function actualizarCamposPrograma() {
    $('#programa').change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#tipo_de_formacion').val(selectedOption.data('tipo'));
        $('#modalidad').val(selectedOption.data('modalidad'));
    });
}