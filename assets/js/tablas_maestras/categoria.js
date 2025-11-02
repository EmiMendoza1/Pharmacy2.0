
//JS de Categoría para crear la configuración con IDs(de los elementos del HTML) y llamar a las funciones comunes en tablas_maestras.js


document.addEventListener('DOMContentLoaded', function () { // -> Espera a que el DOM esté cargado, y luego ejecuta lo que está dentro de la función.

    const config = { // -> Configuración de la tabla maestra, para inicializarla luego con estos parameteos (llamando a estos datos desde el archivo tablas_maestras.js).

        // Backend
        endpointUrl: 'controllers/ajax/categoria.php',  // -> URL del controlador AJAX (donde se hacen las peticiones).
        campoId: 'id_categoria',                       // -> Nombre del campo ID que se obtiene en la respuesta de la petición AJAX
        campoDescripcion: 'categoria_descri',         // -> Nombre del campo descripción que se obtiene, este se define en la base de datos y en models/Categoria.php.
        nombreCampo: 'nombre_categoria',             // -> Nombre del campo que enviamos para crear/editar.

        // IDs del HTML
        formBuscarId: 'form-categoria',           // -> ID del formulario de búsqueda
        inputBuscarId: 'inputBuscarCategoria',   // -> ID del input de texto para buscar
        tablaId: 'tabla-categoria',             // -> ID de la tabla donde se muestran los datos
        alertId: 'alert-categoria',            // -> ID del contenedor de alertas
        formCrearId: 'form-nueva-categoria',  // -> ID del formulario para crear nuevo
        inputNombreId: 'nombre_categoria',   // -> ID del input donde se escribe el nombre nuevo

        // Textos
        textoConfirmEliminar: '¿Seguro que deseas borrar esta categoría?',
        textoPromptEditar: 'Editar nombre de categoría:'
    };

    inicializarTablaMaestra(config);
});