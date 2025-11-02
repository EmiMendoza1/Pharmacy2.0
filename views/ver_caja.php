<?php
// Vista de una caja (detalle y movimientos)
?>
<div class="container mt-4">
    <h2 class="mb-4">Caja #<?= $caja['id_caja'] ?> - <?= htmlspecialchars($caja['caja_nombre']) ?></h2>
    <?php if (!empty($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <p>Apertura: <?= $caja['apertura_fecha'] ?> - Monto inicial: <?= number_format($caja['apertura_monto'], 2) ?></p>
    <input type="hidden" id="apertura_monto" value="<?= number_format($caja['apertura_monto'], 2, '.', '') ?>">
    <p>Estado: <?= $caja['estado'] ?> <?php if ($caja['estado'] == 'cerrada'): ?> | Cierre: <?= $caja['cierre_fecha'] ?> - Monto cierre: <?= number_format($caja['cierre_monto'],2) ?><?php endif; ?></p>

    <h4>Agregar movimiento</h4>
    <form id="movimiento_form" method="post" action="index.php?page=caja&action=movimientoGuardar" style="max-width:600px;">
        <input type="hidden" name="rela_caja" value="<?= $caja['id_caja'] ?>">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label>Tipo</label>
                <select id="mov_tipo" name="tipo" class="form-control">
                    <option value="ingreso">Ingreso</option>
                    <option value="egreso">Egreso</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Monto</label>
                <input id="mov_monto" type="number" step="0.01" name="monto" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label>Forma pago</label>
                <input type="text" name="forma_pago" class="form-control" value="efectivo">
            </div>
            <div class="col-md-3 mb-3">
                <label>Descripción</label>
                <input type="text" name="descripcion" class="form-control">
            </div>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Agregar</button>
            <a href="?page=caja&action=index" class="btn btn-secondary">Volver</a>
        </div>
    </form>

    <hr>
    <h4>Movimientos</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Forma</th>
                <th>Descripción</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($movimientos) && count($movimientos) > 0): foreach($movimientos as $m): ?>
            <tr class="mov-row" data-tipo="<?= $m['tipo'] ?>" data-monto="<?= $m['monto'] ?>">
                <td><?= $m['id_movimiento'] ?></td>
                <td><?= $m['creado_en'] ?></td>
                <td><?= $m['tipo'] ?></td>
                <td><?= number_format($m['monto'],2) ?></td>
                <td><?= htmlspecialchars($m['forma_pago']) ?></td>
                <td><?= htmlspecialchars($m['descripcion']) ?></td>
                <td><?= htmlspecialchars(($m['persona_apellido'] ?? '') . ' ' . ($m['persona_nombre'] ?? '')) ?></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="7" class="text-center">No hay movimientos.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($caja['estado'] === 'abierta'): ?>
    <hr>
    <h4>Cerrar caja</h4>
    <div class="mb-3" style="max-width:320px;">
        <label>Saldo final previsto</label>
        <input id="saldo_prev" type="text" class="form-control" readonly style="background:#f8f9fa;">
    </div>
    <form method="post" action="index.php?page=caja&action=cerrar" style="max-width:320px;">
        <input type="hidden" name="id_caja" value="<?= $caja['id_caja'] ?>">
        <div class="mb-3">
            <label>Monto contado</label>
            <input id="cierre_monto" type="number" step="0.01" name="cierre_monto" class="form-control" required>
        </div>
        <button class="btn btn-danger" type="submit">Cerrar caja</button>
    </form>
    <?php endif; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    function parseNumber(v){
        var n = parseFloat(v);
        return isNaN(n) ? 0 : n;
    }

    var apertura = parseNumber(document.getElementById('apertura_monto')?.value || 0);

    function computeMovementsSum(){
        var rows = document.querySelectorAll('.mov-row');
        var sum = 0;
        rows.forEach(function(r){
            var tipo = r.getAttribute('data-tipo') || 'ingreso';
            var monto = parseNumber(r.getAttribute('data-monto'));
            if (tipo === 'ingreso') sum += monto; else sum -= monto;
        });
        return sum;
    }

    function formatTwo(v){
        return Math.round(v * 100) / 100;
    }

    function updateCierreWith(value){
        var input = document.getElementById('cierre_monto');
        if (!input) return;
        input.value = formatTwo(value).toFixed(2);
        // actualizar vista previa
        var preview = document.getElementById('saldo_prev');
        if (preview) preview.value = formatTwo(value).toFixed(2);
    }

    // initial compute from apertura + movimientos
    var movimientosSum = computeMovementsSum();
    var saldoActual = apertura + movimientosSum;
    updateCierreWith(saldoActual);

    // live preview when user fills the movimiento form
    var movForm = document.getElementById('movimiento_form');
    if (movForm){
        var movMonto = document.getElementById('mov_monto');
        var movTipo = document.getElementById('mov_tipo');

        function previewUpdate(){
            var nueva = parseNumber(movMonto?.value || 0);
            var tipo = movTipo?.value || 'ingreso';
            var delta = tipo === 'ingreso' ? nueva : -nueva;
            updateCierreWith(saldoActual + delta);
        }

        movMonto?.addEventListener('input', previewUpdate);
        movTipo?.addEventListener('change', previewUpdate);
    }
});
</script>
