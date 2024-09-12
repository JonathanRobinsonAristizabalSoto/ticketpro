function actualizarCamposPrograma() {
    $('#programa').change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#tipologia').val(selectedOption.data('tipo'));
        $('#modalidad').val(selectedOption.data('modalidad'));
    });
}