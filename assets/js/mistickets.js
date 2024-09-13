$(document).ready(function () {
    inicializarFunciones();
  });
  
  // Inicializa todas las funciones necesarias
  function inicializarFunciones() {
    cargarMisTickets();
  }

  // Carga los tickets del usuario actual y los muestra en la tabla
function cargarMisTickets() {
    $.ajax({
      url: "get_mis_tickets.php",
      method: "GET",
      success: function (data) {
        $("#mis-tickets-list").html(data);
        // Si la tabla ya está inicializada, la destruye antes de volver a inicializarla
        if ($.fn.DataTable.isDataTable("#miTablaMisTickets")) {
          $("#miTablaMisTickets").DataTable().destroy();
        }
        // Inicializa o reinicializa la tabla con DataTables
        $("#miTablaMisTickets").DataTable({
          pageLength: 5,
          language: {
            sEmptyTable: "No hay datos disponibles en la tabla",
            sInfo: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            sInfoEmpty: "Mostrando 0 a 0 de 0 entradas",
            sInfoFiltered: "(filtrado de _MAX_ entradas en total)",
            sLengthMenu: "Mostrar _MENU_ entradas",
            sLoadingRecords: "Cargando...",
            sProcessing: "Procesando...",
            sSearch: "Buscar:",
            sZeroRecords: "No se encontraron resultados",
            oPaginate: {
              sFirst: "Primero",
              sLast: "Último",
              sNext: "Siguiente",
              sPrevious: "Anterior",
            },
          },
        });
      },
      error: function () {
        handleError("Error al cargar mis tickets.");
      },
    });
  }