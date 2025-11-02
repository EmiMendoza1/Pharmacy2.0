/**
 * Funciones comunes para tablas maestras
 * - Usando IDs del HTML
 */


function inicializarTablaMaestra(config) {  // -> Inicializa una tabla maestra (carga datos y registra eventos)

    // Extraemos la configuración con nombres claros (ej: 'config.endpointUrl')

    const { // -> Endpoints y campos que el backend espera
        
        endpointUrl,      // URL del controlador AJAX (por ej: 'controllers/ajax/categoria.php')
        campoId,          // Nombre del campo ID en la respuesta (ej: 'id_categoria')
        campoDescripcion, // Nombre del campo descripción en la respuesta (ej: 'categoria_descri')
        nombreCampo,      // Nombre del campo que enviamos para crear/editar (ej: 'nombre_categoria')

        // IDs de elementos del DOM (tal cual aparecen en el HTML)
        formBuscarId,     // ID del formulario de búsqueda (ej: 'form-categoria')
        inputBuscarId,    // ID del input de texto para buscar (ej: 'inputBuscarCategoria')
        tablaId,          // ID de la tabla donde se muestran los datos (ej: 'tabla-categoria')
        alertId,          // ID del contenedor de alertas (ej: 'alert-categoria')
        formCrearId,      // ID del formulario para crear nuevo (ej: 'form-nueva-categoria')
        inputNombreId,    // ID del input donde se escribe el nombre nuevo (ej: 'nombre_categoria')

        // Textos para confirmar o pedir datos al usuario
        textoConfirmEliminar,
        textoPromptEditar
    } = config;

    // 1) Cargar datos al iniciar
    cargarDatos(config, '');

    // 2) Registrar evento de búsqueda (si existe el formulario de buscar)
    const formBuscar = document.getElementById(formBuscarId);
    const inputBuscar = document.getElementById(inputBuscarId);
    if (formBuscar && inputBuscar) {
        formBuscar.addEventListener('submit', function (e) {
            e.preventDefault();
            cargarDatos(config, inputBuscar.value);
        });
    }

    // 3) Registrar evento de crear/guardar (si existe el formulario de crear)
    const formCrear = document.getElementById(formCrearId);
    const inputNombre = document.getElementById(inputNombreId);
    if (formCrear && inputNombre) {
        formCrear.addEventListener('submit', function (e) {
            e.preventDefault();
            const nombre = inputNombre.value.trim();
            if (!nombre) return;
            guardarRegistro(config, nombre);
        });
    }
}


function cargarDatos(config, busqueda) { // -> Esta función llamará al backend para obtener y agregar los datos de la tabla
    const { endpointUrl, tablaId, campoId, campoDescripcion, textoConfirmEliminar, textoPromptEditar } = config;

    // cuando use esto "// ->" es para al lado explicar para que sirve esa línea o que hace.
    const qs = new URLSearchParams({ busqueda: busqueda || '' }); // -> Parámetros de consulta (query string). Ej: ?busqueda=hola. Si no hay parámetros, se usa el valor por defecto. 
    fetch(endpointUrl + '?' + qs.toString()) // -> Envía la consulta al backend
        .then(respuesta => respuesta.json()) // -> Convierte el resultado en JSON
        .then(data => { // -> Si la petición es correcta...:

            const tabla = document.getElementById(tablaId); // -> Obtenemos la tabla del DOM. Ej: document.getElementById('tabla-categoria'). (El DOM es el documento HTML, se le dice DOM porque es una estructura de objetos, su sigla significa Document Object Model)
            if (!tabla) return; // -> Si no hay tabla, no hacemos nada.
            const cuerpo = tabla.querySelector('tbody'); // -> Obtenemos el cuerpo de la tabla. Ej: document.getElementById('tabla-categoria').querySelector('tbody'). (El cuerpo es el contenido de la tabla, es donde se colocan los datos)
            if (!cuerpo) return;

            cuerpo.innerHTML = ''; // -> Limpiamos el contenido actual de la tabla (si hay algo)

            if (data.success && Array.isArray(data.data) && data.data.length > 0) { // -> Si la respuesta es exitosa y hay datos...

                data.data.forEach(item => { // -> Recorremos cada item (registro) en los datos recibidos
                    const fila = document.createElement('tr'); // -> Creamos una fila (registro) en la tabla
                    fila.innerHTML =  // -> Colocamos el HTML en la fila
                        
                        '<td>' + // ->  td es una celda de la tabla, y "+" se usa para #
                        '  <span class="nombre-item" data-id="' + item[campoId] + '">' + (item[campoDescripcion] ?? '') + '</span>' + // -> aquí lo que se hace es mostrar el nombre del item (registro) y se usa ?? para evitar que si el valor es null o undefined, se muestre vacío en lugar de esos valores.
                        '</td>' +
                        '<td>' +
                        '  <div class="row g-1">' + // -> g-1 es una clase de bootstrap que agrega un pequeño espacio entre los botones
                        '    <div class="col-auto">' + // -> col-auto es otra clase que hace que el contenido se alinee a la izquierda
                        '      <button class="btn btn-success btn-editar" data-id="' + item[campoId] + '" data-nombre="' + (item[campoDescripcion] ?? '') + '" type="button">Editar <i class="fas fa-edit"></i></button>' + 
                        '    </div>' +
                        '    <div class="col-auto">' +
                        '      <button class="btn btn-danger btn-borrar" data-id="' + item[campoId] + '" type="button">Eliminar <i class="fas fa-trash"></i></button>' +
                        '    </div>' +
                        '  </div>' +
                        '</td>';
                    cuerpo.appendChild(fila);
                });
            } else {
                cuerpo.innerHTML = '<tr><td colspan="2">No hay resultados</td></tr>';
            }

            // Registrar eventos de editar y eliminar en los botones recién creados
            document.querySelectorAll('.btn-borrar').forEach(boton => {
                boton.onclick = function () {
                    if (confirm(textoConfirmEliminar)) {
                        eliminarRegistro(config, this.dataset.id);
                    }
                };
            });

            document.querySelectorAll('.btn-editar').forEach(boton => {
                boton.onclick = function () {
                    const id = this.dataset.id; // -> #
                    const nombreActual = this.dataset.nombre; // -> #
                    const nuevoNombre = prompt(textoPromptEditar, nombreActual); // -> #
                    if (nuevoNombre && nuevoNombre.trim() && nuevoNombre !== nombreActual) { // -> #
                        editarRegistro(config, id, nuevoNombre); // -> #
                    }
                };
            });
        });
}


function guardarRegistro(config, nombre) { // -> Envía al backend para guardar un nuevo registro
    const { endpointUrl, formCrearId, inputNombreId, nombreCampo } = config;

    const body = new URLSearchParams(); // -> #
    body.append('accion', 'guardar'); // -> #
    body.append(nombreCampo, nombre); // -> #
    fetch(endpointUrl, { // -> #
        method: 'POST', // -> #
        body
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            mostrarAlerta(config, data.mensaje, data.success); // -> #
            if (data.success) {
                const formCrear = document.getElementById(formCrearId);
                const inputNombre = document.getElementById(inputNombreId);
                if (formCrear) formCrear.reset(); // -> #
                if (inputNombre) inputNombre.blur(); // -> #
                cargarDatos(config, ''); // -> #
            }
        });
}

// Envía al backend para editar un registro existente
function editarRegistro(config, id, nuevoNombre) {
    const { endpointUrl, campoId, nombreCampo } = config;

    const body = new URLSearchParams();
    body.append('accion', 'editar');
    body.append(campoId, id);
    body.append(nombreCampo, nuevoNombre);
    fetch(endpointUrl, {
        method: 'POST',
        body
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            mostrarAlerta(config, data.mensaje, data.success); // -> #
            cargarDatos(config, ''); // -> #
        });
}

// Envía al backend para eliminar un registro
function eliminarRegistro(config, id) {
    const { endpointUrl, campoId } = config;

    const body = new URLSearchParams();
    body.append('accion', 'eliminar');
    body.append(campoId, id);
    fetch(endpointUrl, {
        method: 'POST',
        body
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            mostrarAlerta(config, data.mensaje, data.success); // -> #
            cargarDatos(config, '');
        });
}

// Muestra un mensaje de éxito o error arriba de la tabla
function mostrarAlerta(config, mensaje, exito) {
    const { alertId } = config; // -> #
    const contenedorAlertas = document.getElementById(alertId);
    if (!contenedorAlertas) return;
    contenedorAlertas.innerHTML = '<div class="alert alert-' + (exito ? 'success' : 'danger') + '" role="alert">' + (mensaje || '') + '</div>'; // -> #
    setTimeout(() => { contenedorAlertas.innerHTML = ''; }, 2500); // -> #
}
