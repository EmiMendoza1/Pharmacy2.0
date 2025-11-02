<?php
// Formulario apertura de caja
?>
<div class="container mt-4">
    <h2 class="mb-4">Abrir Caja</h2>
    <form method="post" action="?page=caja&action=guardar" style="max-width:480px;">
        <div class="mb-3">
            <label for="caja_nombre" class="form-label">Nombre de la caja</label>
            <input type="text" id="caja_nombre" name="caja_nombre" class="form-control" value="Caja Principal">
        </div>
        <div class="mb-3">
            <label for="apertura_monto" class="form-label">Monto inicial</label>
            <input type="number" step="0.01" id="apertura_monto" name="apertura_monto" class="form-control" value="0">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-success" type="submit">Abrir</button>
            <a href="?page=caja&action=index" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
