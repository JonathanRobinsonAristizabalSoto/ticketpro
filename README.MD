# TicketPro+

TicketPro+ es una plataforma para gestionar solicitudes y tickets de manera eficiente. Nuestra aplicación está diseñada para facilitar la comunicación entre usuarios y administradores, ofreciendo una solución integral para el soporte técnico.

## Estructura del Proyecto

```plaintext
assets/                                      # Archivos estáticos utilizados en la aplicación
├── css/                                     # Hojas de estilo CSS
│   ├── home.css                             # Estilos específicos para la página home
│   └── styles.css                           # Estilos generales de la aplicación
├── images/                                  # Imágenes usadas en la aplicación
│   ├── logoticket.png                       # Imagen del logo principal
│   └── logoticket2.png                      # Imagen del logo secundario
├── js/                                      # Archivos JavaScript para la lógica del cliente
│   ├── actualizarCamposPrograma.js          # Script para actualizar campos de programa
│   ├── cargarEstadosTickets.js              # Script para cargar estados de tickets
│   ├── cargarProgramas.js                   # Script para cargar programas
│   ├── cargarTicketsRecientes.js            # Script para cargar tickets recientes
│   ├── cargarTiposSolicitudYTipologias.js   # Script para cargar tipos y tipologías
│   ├── handleError.js                       # Script para manejar errores
│   ├── inicializarFunciones.js              # Inicialización de funciones de la app
│   ├── jquery.min.js                        # Biblioteca jQuery
│   ├── manejarFormularioNuevoTicket.js      # Script para manejar el formulario de nuevo ticket
│   └── sweetalert2.js                       # Biblioteca SweetAlert2 para mostrar alertas

config/                                      # Archivos de configuración
├── config.php                               # Configuración general del proyecto (DB, rutas)

db/                                          # Base de datos y scripts relacionados
├── ticketpro.sql                            # Archivo con el esquema de la base de datos

logs/                                        # Archivos de registro para errores y eventos
├── app.log                                  # Registro de errores y eventos de la aplicación

src/                                         # Código fuente PHP
├── connections/                             # Conexiones a la base de datos
│   └── config.php                           # Configuración de conexión a la base de datos
├── includes/                                # Archivos comunes para reusabilidad
│   ├── departamentos.php                    # Script que carga los departamentos
│   ├── footer.php                           # Pie de página común para todas las páginas
│   └── header.php                           # Cabecera común para todas las páginas
├── pages/                                   # Páginas PHP para las funcionalidades principales
│   ├── About/                               # Página sobre la aplicación o empresa
│   │   └── about.php                        # Información sobre la aplicación o empresa
│   ├── Auth/                                # Páginas relacionadas con la autenticación y gestión de usuarios
│   │   ├── login.php                        # Página de inicio de sesión
│   │   ├── password_recovery.php            # Página para recuperación de contraseña
│   │   ├── register.php                     # Página de registro de usuarios
│   │   └── session_user.php                 # Manejo de la sesión de usuario
│   ├── Contact/                             # Página de contacto para los usuarios
│   │   └── contact.php                      # Formulario o información de contacto
│   ├── Error/                               # Páginas de error
│   │   └── 404.php                          # Página de error 404 para páginas no encontradas
│   ├── Home/                                # Páginas relacionadas con la vista principal y gestión de tickets
│   │   ├── crear_ticket.php                 # Formulario para crear nuevos tickets
│   │   ├── get_estados.php                  # Endpoint para obtener estados de tickets
│   │   ├── get_programas.php                # Endpoint para obtener programas
│   │   ├── get_tipo_de_solicitud.php        # Endpoint para obtener tipos de solicitud
│   │   ├── get_tickets_recientes.php        # Endpoint para obtener tickets recientes
│   │   ├── get_tipologias.php               # Endpoint para obtener tipologías
│   │   └── home.php                         # Página principal (dashboard)

README.md                                    # Archivo de descripción del proyecto
index.php                                    # Punto de entrada principal de la aplicación

