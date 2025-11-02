<?php
// Si viene un id por GET, significa que estamos editando un producto
$esEdicion = isset($producto);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $esEdicion ? "Editar Producto" : "Nuevo Producto"; ?></title>
    <link rel="stylesheet" href="styles/formulario_producto.css">
    <style>
        .titulo-formulario {
            text-align: center;
            margin-bottom: 18px;
            font-size: 2rem;
            color: #01552e;
            font-weight: bold;
        }
    </style>
</head>
<body class="form-producto-page">
<div class="form-producto-container">
    <h2 class="mb-4 text-success text-center"><?php echo $esEdicion ? "Editar Producto" : "Nuevo Producto"; ?></h2>
    <form action="index.php?page=producto&action=guardar" method="POST" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
        <?php if ($esEdicion): ?>
            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="codigobarra" class="form-label">Código de barra</label>
            <input type="text" class="form-control" id="codigobarra" name="producto_codigobarra" value="<?php echo $esEdicion ? $producto['producto_codigobarra'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="producto_nombre" value="<?php echo $esEdicion ? $producto['producto_nombre'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="producto_descripcion" rows="3"><?php echo $esEdicion ? $producto['producto_descripcion'] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="preciounitario" class="form-label">Precio unitario</label>
            <input type="number" step="0.01" class="form-control" id="preciounitario" name="producto_preciounitario" value="<?php echo $esEdicion ? $producto['producto_preciounitario'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="producto_cantidad" value="<?php echo $esEdicion ? $producto['producto_cantidad'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="cantidadmin" class="form-label">Cantidad mínima</label>
            <input type="number" class="form-control" id="cantidadmin" name="producto_cantidadmin" value="<?php echo $esEdicion ? $producto['producto_cantidadmin'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="producto_estado" required>
                <option value="activo" <?php echo ($esEdicion && $producto['producto_estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                <option value="inactivo" <?php echo ($esEdicion && $producto['producto_estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>
        <div class="input-group">
            <label for="tipoproducto">Tipo de producto:</label>
            <input type="number" id="tipoproducto" name="rela_tipoproducto" value="<?php echo $esEdicion ? $producto['rela_tipoproducto'] : ''; ?>" required>
        </div>
        <div class="input-group">
            <label for="tipoventa">Tipo de venta:</label>
            <input type="number" id="tipoventa" name="rela_tipoventa" value="<?php echo $esEdicion ? $producto['rela_tipoventa'] : ''; ?>" required>
        </div>
            <div class="mb-3">
                <label for="preciocompra" class="form-label">Precio de compra</label>
                <input type="number" class="form-control" id="preciocompra" name="producto_precio_compra" value="<?php echo $esEdicion ? $producto['producto_precio_compra'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precioventa" class="form-label">Precio de venta</label>
                <input type="number" class="form-control" id="precioventa" name="producto_precio_venta" value="<?php echo $esEdicion ? $producto['producto_precio_venta'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="producto_stock" value="<?php echo $esEdicion ? $producto['producto_stock'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="number" class="form-control" id="categoria" name="rela_categoria" value="<?php echo $esEdicion ? $producto['rela_categoria'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="droga" class="form-label">Droga</label>
                <input type="number" class="form-control" id="droga" name="rela_droga" value="<?php echo $esEdicion ? $producto['rela_droga'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="forma" class="form-label">Forma</label>
                <input type="number" class="form-control" id="forma" name="rela_forma" value="<?php echo $esEdicion ? $producto['rela_forma'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="number" class="form-control" id="marca" name="rela_marca" value="<?php echo $esEdicion ? $producto['rela_marca'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="metodo" class="form-label">Método de administración</label>
                <input type="number" class="form-control" id="metodo" name="rela_metodo_administracion" value="<?php echo $esEdicion ? $producto['rela_metodo_administracion'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipoproducto" class="form-label">Tipo de producto</label>
                <input type="number" class="form-control" id="tipoproducto" name="rela_tipoproducto" value="<?php echo $esEdicion ? $producto['rela_tipoproducto'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipoventa" class="form-label">Tipo de venta</label>
                <input type="number" class="form-control" id="tipoventa" name="rela_tipoventa" value="<?php echo $esEdicion ? $producto['rela_tipoventa'] : ''; ?>" required>
            </div>
        <div class="mb-3">
            <label for="alfabeta" class="form-label">Alfabeta</label>
            <select class="form-control" id="alfabeta" name="rela_alfabeta" required>
                <option value="">Seleccione...</option>
                <option value="1" <?php echo ($esEdicion && $producto['rela_alfabeta'] == 1) ? 'selected' : ''; ?>>1</option>
                <option value="0" <?php echo ($esEdicion && $producto['rela_alfabeta'] == 0) ? 'selected' : ''; ?>>0</option>
            </select>
        </div>
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-success"><?php echo $esEdicion ? "Actualizar" : "Guardar"; ?></button>
            <a href="index.php?page=producto" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>