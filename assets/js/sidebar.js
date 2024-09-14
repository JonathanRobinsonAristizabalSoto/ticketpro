// Ruta: assets/js/sidebar.js

document.querySelector('.sidebar-toggle').addEventListener('click', function() {
    // Alternar la clase 'collapsed' en el sidebar
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('collapsed');
    
    // Si el sidebar está expandido, iniciar el temporizador para ocultarlo
    if (sidebar.classList.contains('collapsed')) {
        setTimeout(function() {
            sidebar.classList.remove('collapsed');
        }, 6000); // Ocultar después de 5 segundos
    }
});
