$(document).ready(function () {
    inicializarFunciones();
  });
  
  // Inicializa todas las funciones necesarias
  function inicializarFunciones() {
    manejarFormularioNuevoTicket();
    cargarEstadosTickets();
    cargarTicketsRecientes();
    cargarMisTickets();
    cargarProgramas();
    cargarTipologiasYSubtipologias();
    actualizarCamposPrograma();
  }
  
  // Carga los tickets recientes y los muestra en la tabla
  function cargarTicketsRecientes() {
    $.ajax({
      url: "get_tickets_recientes.php",
      method: "GET",
      success: function (data) {
        $("#tickets-recientes-list").html(data);
        // Si la tabla ya está inicializada, la destruye antes de volver a inicializarla
        if ($.fn.DataTable.isDataTable("#miTablaTickets")) {
          $("#miTablaTickets").DataTable().destroy();
        }
        // Inicializa o reinicializa la tabla con DataTables
        $("#miTablaTickets").DataTable({
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
        handleError("Error al cargar los tickets recientes.");
      },
    });
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
  
  // Maneja el envío del formulario para crear un nuevo ticket
  function manejarFormularioNuevoTicket() {
    $("#nueva-solicitud-form").submit(function (event) {
      event.preventDefault();
  
      var tipologia = $("#tipologia").val();
      var subtipologia = $("#subtipologia").val();
      var programa = $("#programa").val();
      var descripcion = $("#descripcion").val();
      var prioridad = $("#prioridad").val();
  
      // Verifica que todos los campos estén llenos
      if (!tipologia || !subtipologia || !programa || !descripcion || !prioridad) {
        alert("Por favor, complete todos los campos del formulario.");
        return;
      }
  
      $.ajax({
        url: "crear_ticket.php",
        method: "POST",
        data: {
          tipologia: tipologia,
          subtipologia: subtipologia,
          programa: programa,
          descripcion: descripcion,
          prioridad: prioridad,
        },
        success: function (response) {
          alert("Ticket creado exitosamente");
          $("#nueva-solicitud-form")[0].reset();
          cargarTicketsRecientes();
          cargarMisTickets();
        },
        error: function (xhr, status, error) {
          console.error("Error al crear el ticket:", status, error);
          alert("Error al crear el ticket. Por favor, intente de nuevo.");
        },
      });
    });
  }
  
  // Carga los estados de los tickets y los muestra en la interfaz
  function cargarEstadosTickets() {
    $.ajax({
      url: "get_estados.php",
      method: "GET",
      success: function (data) {
        $("#estados-container").html(data);
        inicializarFuncionesEstados();
      },
      error: function () {
        handleError("Error al cargar los estados de los tickets.");
      },
    });
  }
  
  // Función placeholder para inicializar funciones relacionadas con los estados
  function inicializarFuncionesEstados() {
    console.log("Estados de tickets cargados y funciones adicionales inicializadas.");
  }
  
  // Muestra un mensaje de error
  function handleError(message) {
    alert(message);
  }
  