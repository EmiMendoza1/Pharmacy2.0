/**
 * Conf. de Droga
 */
document.addEventListener('DOMContentLoaded', function () {
    const config = {
        endpointUrl: 'controllers/ajax/droga.php',
        campoId: 'id_droga',
        campoDescripcion: 'droga_descri',
        nombreCampo: 'nombre_droga',

        formBuscarId: 'form-droga',
        inputBuscarId: 'inputBuscarDroga',
        tablaId: 'tabla-droga',
        alertId: 'alert-droga',
        formCrearId: 'form-nueva-droga',
        inputNombreId: 'nombre_droga',

        textoConfirmEliminar: '¿Seguro que deseas borrar esta droga?',
        textoPromptEditar: 'Editar nombre de droga:'
    };

    inicializarTablaMaestra(config);
});