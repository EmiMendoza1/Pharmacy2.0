// Validación de login y registro, + validación AJAX en tiempo real
// Este archivo contiene todas las validaciones del lado del cliente (navegador)

// Espera a que el documento HTML esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {
    // --- VALIDACIÓN LOGIN ---------------------------------------------------------------------------------------------------------------------------------
    // Busca el formulario de login en la página usando el selector de atributos
    const loginForm = document.querySelector('form[action*="login.controlador.php"]'); // Busca formulario que contenga "login.controlador.php" en su acción
    if (loginForm) { // Si encuentra el formulario de login
        // Agrega un evento que se ejecuta cuando se envía el formulario
        loginForm.addEventListener('submit', function(e) { // 'e' es el evento del formulario
            let valido = true; // Variable para controlar si el formulario es válido

            // Limpiar errores anteriores
            loginForm.querySelectorAll('.error').forEach(el => el.textContent = ''); // Limpia todos los mensajes de error
            loginForm.querySelectorAll('input').forEach(el => el.classList.remove('validation-error')); // Remueve la clase de error de todos los inputs

            // Validar usuario y contraseña - campos obligatorios
            ['nombre_usuario', 'contrasena'].forEach(campo => { // Recorre los campos requeridos
                if (!loginForm[campo].value.trim()) { // Si el campo está vacío o solo tiene espacios
                    document.getElementById(`error-${campo}`).textContent = '¡Campo requerido!'; // Muestra mensaje de error
                    loginForm[campo].classList.add('validation-error'); // Agrega clase CSS para mostrar error visual
                    valido = false; // Marca el formulario como inválido
                }
            });
            if (!valido) e.preventDefault(); // Si no es válido, previene el envío del formulario
        });
    }

    // --- VALIDACIÓN REGISTRO -------------------------------------------------------------------------------------------------------------------------------
    // Busca el formulario de registro en la página
    const registroForm = document.querySelector('form[action*="signup_admin.controlador.php"]'); // Busca formulario que contenga "signup_admin.controlador.php" en su acción
    if (registroForm) { // Si encuentra el formulario de registro
        // Agrega un evento que se ejecuta cuando se envía el formulario
        registroForm.addEventListener('submit', function(e) {
            let valido = true; // Variable para controlar si el formulario es válido

            // Limpiar errores anteriores
            registroForm.querySelectorAll('.error').forEach(el => el.textContent = ''); // Limpia todos los mensajes de error
            registroForm.querySelectorAll('input, select').forEach(el => el.classList.remove('validation-error')); // Remueve la clase de error de inputs y selects

            // Campos requeridos - lista de todos los campos obligatorios
            const campos = ['nombre', 'apellido', 'dni', 'fecha_nac', 'direccion', 'sexo', 'usuario', 'password', 'rol', 'confirm-password'];
            campos.forEach(campo => {
                if (!registroForm[campo] || !registroForm[campo].value.trim()) { // Si el campo no existe o está vacío
                    const errorEl = document.getElementById(`error-${campo}`); // Busca el elemento de error correspondiente
                    if (errorEl) errorEl.textContent = '¡Campo requerido!'; // Si existe, muestra mensaje de error
                    if (registroForm[campo]) registroForm[campo].classList.add('validation-error'); // Agrega clase de error visual
                    valido = false; // Marca el formulario como inválido
                }
            });

            // Validar campos de contacto - verifica que todos los contactos tengan valor
            registroForm.querySelectorAll('#contactos-persona .contacto-item').forEach(item => { // Recorre cada contacto agregado
                const input = item.querySelector('input[name="contacto_valor[]"]'); // Busca el input del valor del contacto
                if (input && !input.value.trim()) { // Si el input existe pero está vacío
                    let errorSpan = item.querySelector('.error'); // Busca el span de error del contacto
                    if (errorSpan) errorSpan.textContent = '¡Ingrese un valor!'; // Muestra mensaje de error
                    input.classList.add('validation-error'); // Agrega clase de error visual
                    valido = false; // Marca el formulario como inválido
                }
            });

            // Validar contraseñas iguales - verifica que la confirmación coincida con la contraseña
            if (registroForm['password'] && registroForm['confirm-password'] && registroForm['password'].value !== registroForm['confirm-password'].value) { // Compara las contraseñas
                document.getElementById('error-confirm-password').textContent = 'Las contraseñas no coinciden'; // Muestra mensaje de error
                registroForm['confirm-password'].classList.add('validation-error'); // Agrega clase de error visual
                valido = false; // Marca el formulario como inválido
            }
            if (!valido) e.preventDefault(); // Si no es válido, previene el envío del formulario
        });

        // --- VALIDACIÓN EN TIEMPO REAL (AJAX) -------------------------------------------------------------------------------------------------------------
        // Configuración de campos que se validan con AJAX (sin recargar la página)
        const camposAjax = [
            {id: 'usuario', tipo: 'usuario'}, // Valida que el nombre de usuario no exista
            {id: 'dni', tipo: 'dni'}, // Valida que el DNI no exista
            {id: 'contactos-persona', tipo: 'email'} // Valida que el email no exista
        ];

        // Usuario - validación AJAX cuando el usuario sale del campo
        const usuarioInput = registroForm['usuario'];
        if (usuarioInput) {
            usuarioInput.addEventListener('blur', function() { // Se ejecuta cuando el usuario sale del campo
                validarCampoAjax('usuario', usuarioInput.value, 'error-usuario', usuarioInput); // Llama a la función de validación AJAX
            });
        }

        // DNI - validación AJAX cuando el usuario sale del campo
        const dniInput = registroForm['dni'];
        if (dniInput) {
            dniInput.addEventListener('blur', function() { // Se ejecuta cuando el usuario sale del campo
                validarCampoAjax('dni', dniInput.value, 'error-dni', dniInput); // Llama a la función de validación AJAX
            });
        }

        // Email (en contactos) - validación AJAX para cada contacto de tipo email
        registroForm.querySelectorAll('input[name="contacto_valor[]"]').forEach(input => { // Recorre todos los inputs de contacto
            input.addEventListener('blur', function() { // Se ejecuta cuando el usuario sale del campo
                const tipoSelect = input.parentElement.querySelector('select[name="tipo_contacto[]"]'); // Busca el select del tipo de contacto
                if (tipoSelect && tipoSelect.value == '1') { // Si el tipo es 1 (Email en la base de datos)
                    validarCampoAjax('email', input.value, 'error-email', input); // Llama a la función de validación AJAX
                }
            });
        });
    }
}); 

// Función que realiza la validación AJAX enviando datos al servidor
function validarCampoAjax(tipo, valor, errorId, inputEl) { // Recibe el tipo de validación, valor, ID del error y elemento input
    if (!valor.trim()) return; // Si el valor está vacío, no hace nada
    // Realiza una petición HTTP POST al servidor
    fetch('ajax/validar_campo.php', {
        method: 'POST', // Método HTTP POST
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}, // Tipo de contenido enviado
        body: `tipo=${encodeURIComponent(tipo)}&valor=${encodeURIComponent(valor)}` // Datos enviados al servidor
    })
    .then(res => res.json()) // Convierte la respuesta a formato JSON
    .then(data => {
        if (!data.disponible) { // Si el campo no está disponible (ya existe)
            let mensaje = data.mensaje || 'Valor no disponible'; // Obtiene el mensaje del servidor o usa uno por defecto
            let errorSpan = inputEl.parentElement.querySelector('.error'); // Busca el span de error
            if (errorSpan) errorSpan.textContent = mensaje; // Muestra el mensaje de error
            inputEl.classList.add('validation-error'); // Agrega clase de error visual
            inputEl.value = ''; // Limpia el campo
            inputEl.focus(); // Pone el foco en el campo para que el usuario lo corrija
        }
    });
}
// FIN validaciones


// Función para agregar dinámicamente nuevos campos de contacto al formulario
function agregarContacto() { // Se ejecuta cuando el usuario hace clic en "Agregar contacto"

    const div = document.createElement('div'); // Crea un nuevo elemento div
    div.className = 'input-group contacto-item'; // Asigna las clases CSS para el estilo
    let options = ''; // Variable para almacenar las opciones del select

    // Genera las opciones del select basándose en los tipos de contacto disponibles
    tiposContacto.forEach(function(contacto) { // Recorre el array de tipos de contacto
        options += `<option value="${contacto.id_tipo_contacto}">${contacto.tipo_contacto_nombre}</option>`; // Crea cada opción
    });
    
    // Crea el HTML del nuevo contacto con select, input, error span y botón de eliminar
    div.innerHTML = `
        <select name="tipo_contacto[]">${options}</select>
        <input type="text" name="contacto_valor[]" placeholder="Ingrese el valor" >
        <span class="error"></span>
        <button type="button" class="btn-contacto" title="Eliminar contacto" onclick="this.parentElement.remove()">−</button>
    `;

    document.getElementById('contactos-persona').appendChild(div); // Agrega el nuevo contacto al contenedor

    // Asignar validación AJAX al nuevo input
    const input = div.querySelector('input[name="contacto_valor[]"]'); // Busca el input del nuevo contacto
    const select = div.querySelector('select[name="tipo_contacto[]"]'); // Busca el select del nuevo contacto
    input.addEventListener('blur', function() { // Agrega evento de validación cuando el usuario sale del campo
        if (select && select.value == '1') { // Si el tipo seleccionado es email (valor 1)
            validarCampoAjax('email', input.value, 'error-email', input); // Valida el email con AJAX
        }
    });
}

// Al cargar la página, asignar validación a los contactos existentes
if (window.addEventListener) { // Verifica si el navegador soporta addEventListener
    window.addEventListener('DOMContentLoaded', function() { // Espera a que el DOM esté cargado
        document.querySelectorAll('#contactos-persona .contacto-item').forEach(function(item) { // Recorre todos los contactos existentes
            const input = item.querySelector('input[name="contacto_valor[]"]'); // Busca el input del contacto
            const select = item.querySelector('select[name="tipo_contacto[]"]'); // Busca el select del contacto
            input.addEventListener('blur', function() { // Agrega evento de validación
                if (select && select.value == '1') { // Si el tipo es email
                    validarCampoAjax('email', input.value, 'error-email', input); // Valida el email
                }
            });
        });
    });
}
