<?php
// Vista simple de auditoría
?>
<div class="container mt-4">
    <h2 class="mb-4">Auditorías</h2>
    <p>Últimos registros de auditoría (entidad, acción, detalle, usuario y fecha).</p>
    <a href="index.php?page=inicio" class="btn btn-secondary mb-3">Volver</a>

    <form method="get" class="row g-2 mb-3" action="index.php">
        <input type="hidden" name="page" value="auditoria">
        <div class="col-auto">
            <input type="text" name="entidad" class="form-control" placeholder="Entidad" value="<?= htmlspecialchars($filters['entidad'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <input type="text" name="accion" class="form-control" placeholder="Acción" value="<?= htmlspecialchars($filters['accion'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <input type="number" name="usuario_id" class="form-control" placeholder="Usuario ID" value="<?= htmlspecialchars($filters['usuario_id'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <input type="date" name="fecha_from" class="form-control" placeholder="Desde" value="<?= htmlspecialchars($filters['fecha_from'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <input type="date" name="fecha_to" class="form-control" placeholder="Hasta" value="<?= htmlspecialchars($filters['fecha_to'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" type="submit">Filtrar</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
    
            <?php if (isset($pagination) && $pagination['total_pages'] > 1): ?>
            <nav aria-label="Paginación auditoría">
                <ul class="pagination">
                    <?php $qbase = $_GET; ?>
                    <?php $cur = $pagination['page']; $last = $pagination['total_pages']; ?>
                    <li class="page-item <?= $cur <= 1 ? 'disabled' : '' ?>">
                            <?php $qbase['page'] = $cur-1; ?>
                            <a class="page-link" href="?<?= http_build_query($qbase) ?>">Anterior</a>
                    </li>
                    <?php
                    $start = max(1, $cur - 3);
                    $end = min($last, $cur + 3);
                    for ($p = $start; $p <= $end; $p++):
                            $qbase['page'] = $p;
                    ?>
                    <li class="page-item <?= $p == $cur ? 'active' : '' ?>"><a class="page-link" href="?<?= http_build_query($qbase) ?>"><?= $p ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item <?= $cur >= $last ? 'disabled' : '' ?>">
                            <?php $qbase['page'] = $cur+1; ?>
                            <a class="page-link" href="?<?= http_build_query($qbase) ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
                        if (json_last_error() === JSON_ERROR_NONE && is_array($maybe)) {
                            $isJson = true;
                            $decoded = $maybe;
                        }
                    }
                    if ($isJson && is_array($decoded)){
                        echo '<pre style="margin:0;">'.htmlspecialchars(json_encode($decoded, JSON_PRETTY_PRINT)).'</pre>';
                    } else {
                        echo nl2br(htmlspecialchars($det));
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars(($a['persona_apellido'] ?? '') . ' ' . ($a['persona_nombre'] ?? '')) ?></td>
                <td><?= $a['creado_en'] ?></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="7" class="text-center">No hay registros de auditoría.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>