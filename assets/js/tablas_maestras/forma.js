/**
 * Conf. de Forma
 */
document.addEventListener('DOMContentLoaded', function () {
    const config = {
        endpointUrl: 'controllers/ajax/forma.php',
        campoId: 'id_forma',
        campoDescripcion: 'forma_descri',
        nombreCampo: 'nombre_forma',

        formBuscarId: 'form-forma',
        inputBuscarId: 'inputBuscarForma',
        tablaId: 'tabla-forma',
        alertId: 'alert-forma',
        formCrearId: 'form-nueva-forma',
        inputNombreId: 'nombre_forma',

        textoConfirmEliminar: '¿Seguro que deseas borrar esta forma?',
        textoPromptEditar: 'Editar nombre de forma:'
    };

    inicializarTablaMaestra(config);
});