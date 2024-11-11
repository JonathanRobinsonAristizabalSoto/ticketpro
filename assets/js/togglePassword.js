// Script para alternar la visibilidad de la contraseña y confirmar contraseña
document.querySelectorAll('.password-container i').forEach(toggleIcon => {
    toggleIcon.addEventListener('click', function (e) {
        const passwordField = this.previousElementSibling;
        // Alternar el tipo de input entre password y text
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        // Alternar el ícono
        this.classList.toggle('fa-eye-slash');
    });
});