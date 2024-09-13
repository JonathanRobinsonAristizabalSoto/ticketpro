// Ruta: assets/js/app.js
$(document).ready(function () {
    // Manejar clic en el ícono de menú
    $('#menu-icon').on('click', function () {
        // Alternar clase 'active' en el menú de navegación
        $('#menu-nav').toggleClass('active');
        
        // Alternar clase 'open' para la animación del ícono
        $(this).toggleClass('open');
    });
});
