/**
 * Conf. de Método de Administración
 */
document.addEventListener('DOMContentLoaded', function () {
    const config = {
        endpointUrl: 'controllers/ajax/metodo_administracion.php',
        campoId: 'id_metodo',
        campoDescripcion: 'metodo_descri',
        nombreCampo: 'nombre_metodo',

        formBuscarId: 'form-metodo',
        inputBuscarId: 'inputBuscarMetodo',
        tablaId: 'tabla-metodo',
        alertId: 'alert-metodo',
        formCrearId: 'form-nuevo-metodo',
        inputNombreId: 'nombre_metodo',

        textoConfirmEliminar: '¿Seguro que deseas borrar este método?',
        textoPromptEditar: 'Editar nombre de método:'
    };

    inicializarTablaMaestra(config);
});