<!-- Formulario de Nueva Venta -->
<div class="form-producto-container">
    <h2 class="mb-4" style="text-align:center;">Registrar Venta</h2>
    <form id="formVenta" method="post" action="index.php?page=venta&action=guardar" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
        <div class="mb-3">
            <label for="mediopago_id" class="form-label">Medio de Pago</label>
            <select class="form-control" id="mediopago_id" name="mediopago_id" required>
                <option value="">-- Seleccione medio de pago --</option>
                <?php if (isset($mediopagos) && $mediopagos): ?>
                    <?php $mediopagos->data_seek(0); while($mp = $mediopagos->fetch_assoc()): ?>
                        <option value="<?= $mp['id_mediopago'] ?>">
                            <?= htmlspecialchars($mp['mediopago_tipo']) ?>
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required value="<?php if(isset($venta)) echo $venta['fecha']; ?>">
        </div>
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <div class="input-group">
                <select class="form-control" id="cliente_id" name="cliente_id">
                    <option value="">-- Seleccione cliente --</option>
                    <?php if (isset($clientes) && $clientes): ?>
                        <?php $clientes->data_seek(0); while($cli = $clientes->fetch_assoc()): ?>
                            <option value="<?= $cli['id_cliente'] ?>" <?php if(isset($venta) && $venta['cliente_id'] == $cli['id_cliente']) echo 'selected'; ?>>
                                <?= htmlspecialchars($cli['persona_nombre'] . ' ' . $cli['persona_apellido']) ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
                <button type="button" class="btn btn-outline-secondary" id="btnClienteManual">Cliente no registrado</button>
            </div>
            <input type="text" class="form-control mt-2" id="cliente_manual" name="cliente_manual" placeholder="Nombre del cliente" style="display:none;">
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" required value="<?php if(isset($venta)) echo $venta['total']; ?>">
        </div>
        <h4>Detalle de Venta</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="producto_id" class="form-label">Producto</label>
                <select class="form-control" id="producto_id" name="producto_id">
                    <option value="">Seleccione...</option>
                    <?php if (isset($productos) && $productos): ?>
                        <?php $productos->data_seek(0); while($prod = $productos->fetch_assoc()): ?>
                            <option value="<?= $prod['id_producto'] ?>" data-precio="<?= isset($prod['producto_preciounitario']) ? $prod['producto_preciounitario'] : 0 ?>">
                                <?= htmlspecialchars($prod['producto_nombre']) ?> (<?= isset($prod['producto_preciounitario']) ? '$' . $prod['producto_preciounitario'] : 'Sin precio' ?>)
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" min="1" value="1">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="button" class="btn btn-primary w-100" id="agregarProducto">Agregar</button>
            </div>
        </div>
        <table class="table table-bordered" id="tablaDetalle">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Detalle dinámico -->
            </tbody>
        </table>
            <input type="hidden" id="detalleVenta" name="detalleVenta">
            <button type="submit" class="btn btn-success">Guardar Venta</button>
            <a href="?page=venta" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="assets/js/tablas_maestras.js"></script>
<script>
const selectProducto = document.getElementById('producto_id');
let detalle = [];
const tablaDetalle = document.querySelector('#tablaDetalle tbody');

function renderDetalle() {
    tablaDetalle.innerHTML = '';
    let total = 0;
    detalle.forEach((item, idx) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.nombre}</td>
            <td>${item.cantidad}</td>
            <td>$${item.precio.toFixed(2)}</td>
            <td>$${item.subtotal.toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarDetalle(${idx})">Eliminar</button></td>
        `;
        tablaDetalle.appendChild(tr);
        total += item.subtotal;
    });
    document.getElementById('total').value = total.toFixed(2);
    document.getElementById('detalleVenta').value = JSON.stringify(detalle);
}

function eliminarDetalle(idx) {
    detalle.splice(idx, 1);
    renderDetalle();
}

document.getElementById('agregarProducto').addEventListener('click', function() {
    const prodId = parseInt(selectProducto.value);
    const cantidad = parseInt(document.getElementById('cantidad').value);
    const selectedOption = selectProducto.options[selectProducto.selectedIndex];
    const nombre = selectedOption ? selectedOption.textContent : '';
    const precio = parseFloat(selectedOption.getAttribute('data-precio')) || 0;
    if (!prodId || cantidad < 1) {
        alert('Seleccione un producto y cantidad válida');
        return;
    }
    // Evitar duplicados: si el producto ya está en el detalle, sumar cantidad
    const existente = detalle.find(item => item.id === prodId);
    if (existente) {
        existente.cantidad += cantidad;
        existente.subtotal = existente.precio * existente.cantidad;
    } else {
        detalle.push({
            id: prodId,
            nombre: nombre,
            precio: precio,
            cantidad: cantidad,
            subtotal: precio * cantidad
        });
    }
    renderDetalle();
    // Resetear selección y cantidad
    selectProducto.value = '';
    document.getElementById('cantidad').value = 1;
});

// Mostrar input manual si el cliente no está registrado
const btnManual = document.getElementById('btnClienteManual');
const inputManual = document.getElementById('cliente_manual');
const selectCliente = document.getElementById('cliente_id');
btnManual.addEventListener('click', function() {
    selectCliente.value = '';
    selectCliente.disabled = true;
    inputManual.style.display = 'block';
    inputManual.required = true;
});
selectCliente.addEventListener('change', function() {
    if (this.value) {
        inputManual.style.display = 'none';
        inputManual.required = false;
        selectCliente.disabled = false;
    }
});

document.getElementById('formVenta').addEventListener('submit', function(e) {
    document.getElementById('detalleVenta').value = JSON.stringify(detalle);
});
</script>
