/**
 * Conf. de Marca
 */
document.addEventListener('DOMContentLoaded', function () {
    const config = {
        endpointUrl: 'controllers/ajax/marca.php',
        campoId: 'id_marca',
        campoDescripcion: 'marca_descri',
        nombreCampo: 'nombre_marca',

        formBuscarId: 'form-marca',
        inputBuscarId: 'inputBuscarMarca',
        tablaId: 'tabla-marca',
        alertId: 'alert-marca',
        formCrearId: 'form-nueva-marca',
        inputNombreId: 'nombre_marca',

        textoConfirmEliminar: '¿Seguro que deseas borrar esta marca?',
        textoPromptEditar: 'Editar nombre de marca:'
    };

    inicializarTablaMaestra(config);
});