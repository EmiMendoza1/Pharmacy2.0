<?php
// Vista para editar un producto existente
$esEdicion = isset($producto);
?>

<h2>Editar Producto</h2>

<form action="index.php?page=producto&action=actualizar" method="POST" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

    <div>
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="producto_nombre" value="<?php echo $producto['producto_nombre']; ?>" required>
    </div>

    <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="producto_descripcion" rows="3"><?php echo $producto['producto_descripcion']; ?></textarea>
    </div>

    <div>
        <label for="codigobarra">Código de barra:</label>
        <input type="text" id="codigobarra" name="producto_codigobarra" value="<?php echo $producto['producto_codigobarra']; ?>" required>
    </div>

    <div>
        <label for="preciounitario">Precio unitario:</label>
        <input type="number" step="0.01" id="preciounitario" name="producto_preciounitario" value="<?php echo $producto['producto_preciounitario']; ?>" required>
    </div>

    <div>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="producto_cantidad" value="<?php echo $producto['producto_cantidad']; ?>" required>
    </div>

    <div>
        <label for="cantidadmin">Cantidad mínima:</label>
        <input type="number" id="cantidadmin" name="producto_cantidadmin" value="<?php echo $producto['producto_cantidadmin']; ?>" required>
    </div>
    
    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="producto_estado" required>
            <option value="activo" <?php echo ($producto['producto_estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
            <option value="inactivo" <?php echo ($producto['producto_estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
        </select>
    </div>

    <div>
        <label for="tipoproducto">Tipo de producto:</label>
        <input type="number" id="tipoproducto" name="rela_tipoproducto" value="<?php echo $producto['rela_tipoproducto']; ?>" required>
    </div>

    <div>
        <label for="tipoventa">Tipo de venta:</label>
        <input type="number" id="tipoventa" name="rela_tipoventa" value="<?php echo $producto['rela_tipoventa']; ?>" required>
    </div>

    <div>
        <label for="alfabeta">Alfabeta:</label>
        <input type="number" id="alfabeta" name="rela_alfabeta" value="<?php echo $producto['rela_alfabeta']; ?>" required>
    </div>

    <div>
        <button type="submit">Actualizar</button>
        <a href="index.php?page=producto">Cancelar</a>
    </div>
</form>
