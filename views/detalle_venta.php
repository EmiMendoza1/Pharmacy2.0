<!-- Detalle de Venta -->
<div class="container mt-4">
    <h2 class="mb-4">Detalle de Venta</h2>
    <div id="infoVenta">
        <!-- Aquí se muestra la información de la venta -->
    </div>
    <table class="table table-striped table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody id="tablaDetalleVenta">
            <!-- Aquí se cargan los detalles desde el controlador -->
        </tbody>
    </table>
    <a href="?pagina=venta" class="btn btn-secondary">Volver al listado</a>
</div>
<script src="assets/js/tablas_maestras.js"></script>
<script>
    document.getElementById('buscadorDetalleVenta')?.addEventListener('keyup', function() {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaDetalleVenta tr');
        filas.forEach(fila => {
            fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });
</script>
