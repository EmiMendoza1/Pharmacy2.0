document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formUsuario');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        let valid = true;
        let mensaje = '';

        const nombre = form['nombre_usuario'].value.trim();
        const contrasena = form['contrasena'].value.trim();
        const persona = form['rela_persona'].value.trim();
        const rol = form['rela_rol'].value.trim();

        if (nombre.length < 4) {
            valid = false;
            mensaje += '- El nombre de usuario debe tener al menos 4 caracteres.\n';
        }
        if (contrasena.length < 6) {
            valid = false;
            mensaje += '- La contraseña debe tener al menos 6 caracteres.\n';
        }
        if (!persona || isNaN(persona)) {
            valid = false;
            mensaje += '- Debe seleccionar una persona válida.\n';
        }
        if (!rol || isNaN(rol)) {
            valid = false;
            mensaje += '- Debe seleccionar un rol válido.\n';
        }

        if (!valid) {
            e.preventDefault();
            alert(mensaje);
        }
    });
});
