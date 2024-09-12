function inicializarFunciones() {
    // Otras inicializaciones
    manejarFormularioNuevoTicket();
    cargarEstadosTickets();
    cargarTicketsRecientes();
    cargarProgramas();
    cargarTipologiasYSubtipologias(); // Corregido el nombre de la función
    actualizarCamposPrograma();
}

$(document).ready(function() {
    inicializarFunciones();
});