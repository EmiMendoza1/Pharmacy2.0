<?php
// Vista de registro de administradores - Solo muestra los datos proporcionados por el controlador
// No contiene lógica de negocio ni consultas a la base de datos

// Los datos vienen del controlador
$tipos_contacto = $viewData['tipos_contacto'] ?? [];
$roles = $viewData['roles'] ?? [];
?>

<div class="login-container">
    <div class="logo">
        <img src="assets/Pharmacy_logo.jpg" alt="Pharmacy Logo">
        <h1>Pharmacy</h1>
    </div>

    <div class="login-box">
<!-- Modal para registrar nueva persona -->
<div class="modal fade" id="modalPersona" tabindex="-1" aria-labelledby="modalPersonaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPersonaLabel">Registrar Nueva Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formPersonaModal">
                    <div class="mb-3">
                        <label for="modal_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="modal_nombre" name="modal_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="modal_apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="modal_apellido" name="modal_apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="modal_dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="modal_dni" name="modal_dni" required>
                    </div>
                    <div class="mb-3">
                        <label for="modal_direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="modal_direccion" name="modal_direccion">
                    </div>
                    <div class="mb-3">
                        <label for="modal_fecha_nac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="modal_fecha_nac" name="modal_fecha_nac">
                    </div>
                    <div class="mb-3">
                        <label for="modal_sexo" class="form-label">Sexo</label>
                        <select class="form-control" id="modal_sexo" name="modal_sexo">
                            <option value="">Seleccione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar Persona</button>
                </form>
            </div>
        </div>
    </div>
</div>
        <h2>Registro de Usuario</h2>
        <form action="controllers/signup_admin.controlador.php" method="POST">
            <input type="hidden" name="action" value="registrar">
            <div class="form-grid">

                <!-- Datos de Persona -->
                <div class="input-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" >
                    <span class="error" id="error-nombre"></span>
                    <button type="button" class="btn btn-link" id="btnNuevaPersona" style="padding-left:8px;">Registrar nueva persona</button>
                </div>
                <div class="input-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido" >
                    <span class="error" id="error-apellido"></span>
                </div>
                <div class="input-group">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" placeholder="Ingrese su DNI" >
                    <span class="error" id="error-dni"></span>
                </div>
                <div class="input-group">
                    <label for="fecha_nac">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nac" name="fecha_nac" >
                    <span class="error" id="error-fecha_nac"></span>
                </div>
                <div class="input-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Ingrese su dirección" >
                    <span class="error" id="error-direccion"></span>
                </div>
                <div class="input-group">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo">
                        <option value="">Seleccione la opción deseada</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    <span class="error" id="error-sexo"></span>
                </div>

                <!-- Datos de Usuario -->
                <div class="input-group">
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Crea un nombre de usuario" >
                    <span class="error" id="error-usuario"></span>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Crea una contraseña" >
                    <span class="error" id="error-password"></span>
                </div>
                <div class="input-group">
                    <label for="rol">Seleccionar Rol</label>
                    <select id="rol" name="rol" >
                        <option value="">Selecciona un rol</option>
                        <?php foreach($roles as $rol): ?>
                            <option value="<?php echo $rol['id_rol']; ?>"><?php echo htmlspecialchars($rol['nombre_rol']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error" id="error-rol"></span>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirmar Contraseña</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Repite la contraseña" >
                    <span class="error" id="error-confirm-password"></span>
                </div>
            </div>
            <!-- Contactos -->
            <div id="contactos-persona">
                <div class="input-group contacto-item">
                    <select name="tipo_contacto[]" >
                        <?php foreach($tipos_contacto as $tipo): ?>
                            <option value="<?php echo $tipo['id_tipo_contacto']; ?>"><?php echo htmlspecialchars($tipo['tipo_contacto_nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="contacto_valor[]" placeholder="Ingrese el valor" >
                    <span class="error"></span>
                    <button type="button" class="btn-contacto" title="Agregar contacto" onclick="agregarContacto()">+</button>
                </div>
            </div>
            <button type="submit">Registrar</button>
        </form>
    </div>
</div>
<script>
// Manejar el envío del formulario de persona (AJAX real)
document.getElementById('formPersonaModal').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = this;
    var datos = new FormData(form);
    fetch('ajax/registrar_persona.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalPersona'));
        if (data.success) {
            modal.hide();
            alert('Persona registrada correctamente.');
            // Autocompletar campos en el formulario principal
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('apellido').value = data.apellido;
            document.getElementById('dni').value = data.dni;
        } else {
            alert('Error: ' + (data.error || 'No se pudo registrar la persona.'));
        }
    })
    .catch(() => {
        alert('Error de conexión al registrar persona.');
    });
});
// Mostrar el modal al hacer clic en el botón
document.getElementById('btnNuevaPersona').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('modalPersona'));
    modal.show();
});

// Manejar el envío del formulario de persona (AJAX ejemplo)
document.getElementById('formPersonaModal').addEventListener('submit', function(e) {
    e.preventDefault();
    // Aquí deberías enviar los datos por AJAX al backend para registrar la persona
    // Por ahora solo cierra el modal y muestra un mensaje
    var modal = bootstrap.Modal.getInstance(document.getElementById('modalPersona'));
    modal.hide();
    alert('Persona registrada correctamente (simulado).');
    // Puedes actualizar el formulario principal con los datos ingresados si lo deseas
});
const tiposContacto = <?php echo json_encode($tipos_contacto); ?>;
function agregarContacto() {
    const div = document.createElement('div');
    div.className = 'input-group contacto-item';
    let options = '';
    tiposContacto.forEach(function(contacto) {
        options += `<option value="${contacto.id_tipo_contacto}">${contacto.tipo_contacto_nombre}</option>`;
    });
    div.innerHTML = `
        <select name="tipo_contacto[]">${options}</select>
        <input type="text" name="contacto_valor[]" placeholder="Ingrese el valor" >
        <span class="error"></span>
        <button type="button" class="btn-contacto" title="Eliminar contacto" onclick="this.parentElement.remove()">−</button>
    `;
    document.getElementById('contactos-persona').appendChild(div);
    // Asignar validación AJAX al nuevo input
    const input = div.querySelector('input[name="contacto_valor[]"]');
    const select = div.querySelector('select[name="tipo_contacto[]"]');
    input.addEventListener('blur', function() {
        if (select && select.value == '1') {
            validarCampoAjax('email', input.value, 'error-email', input);
        }
    });
}
</script>
<script src="assets/js/validaciones.js"></script>