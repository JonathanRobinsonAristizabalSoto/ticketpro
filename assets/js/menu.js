// Ruta: assets/js/app.js
$(document).ready(function () {
    // Manejar clic en el ícono de menú
    $('#menu-icon').on('click', function () {
        // Alternar clase 'active' en el menú de navegación
        $('#menu-nav').toggleClass('active');
        
        // Alternar clase 'open' para la animación del ícono
        $(this).toggleClass('open');
        
        // Si el menú está activo, establecer un temporizador para ocultarlo
        if ($('#menu-nav').hasClass('active')) {
            setTimeout(function () {
                $('#menu-nav').removeClass('active');
                $('#menu-icon').removeClass('open');
            }, 5000); // 5000 milisegundos = 5 segundos
        }
    });
});
