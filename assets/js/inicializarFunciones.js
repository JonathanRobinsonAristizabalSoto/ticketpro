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

function manejarFormularioNuevoTicket() {
    // Lógica para manejar el formulario de nuevo ticket
    console.log("Manejando formulario de nuevo ticket...");
}

function cargarEstadosTickets() {
    // Lógica para cargar los estados de los tickets
    console.log("Cargando estados de tickets...");
}

function cargarTicketsRecientes() {
    // Lógica para cargar los tickets recientes
    console.log("Cargando tickets recientes...");
}

function cargarProgramas() {
    // Lógica para cargar los programas
    console.log("Cargando programas...");
}