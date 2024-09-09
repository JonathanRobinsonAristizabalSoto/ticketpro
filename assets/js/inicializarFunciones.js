function inicializarFunciones() {
    // Otras inicializaciones
    manejarFormularioNuevoTicket();
    cargarEstadosTickets();
    cargarTicketsRecientes();
    cargarProgramas();
    cargarTiposSolicitudYTipologias();
    actualizarCamposPrograma();
}

$(document).ready(function() {
    inicializarFunciones();
});