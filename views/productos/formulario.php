<!-- Información del producto -->
<fieldset>
    <legend>Información General del los productos:</legend>

    <!-- Id del producto -->
    <input type="hidden" name="producto[id]" value="<?php echo isset($producto) ? htmlspecialchars($producto->id) : ''; ?>">

    <!-- Nombre del producto -->
    <label for="nombre">Nombre del Producto: <span class="asterisco">*</span></label>
    <input type="text" id="nombre" name="producto[nombre]" placeholder="Nombre del producto" value="<?php echo htmlspecialchars($producto->nombre); ?>">

    <!-- Precio del producto -->
    <label for="precio">Precio Unitario:<span class="asterisco">*</span></label>
    <input type="number" id="precio" name="producto[precio]" placeholder="Precio Producto" value="<?php echo htmlspecialchars($producto->precio); ?>" min="4.00" step="0.01">

    <!-- Marca del producto -->
    <label for="marca">Marca:<span class="asterisco">*</span></label>
    <select name="producto[marca]" id="marca">

        <option value="SHEIN" <?php echo ($producto->marca === 'SHEIN') ? 'selected' : ''; ?>>SHEIN</option>
        <option value="ZARA" <?php echo ($producto->marca === 'ZARA') ? 'selected' : ''; ?>>ZARA</option>
        <option value="Forever 21" <?php echo ($producto->marca === 'Forever 21') ? 'selected' : ''; ?>>Forever 21</option>
        <option value="Puma" <?php echo ($producto->marca === 'Puma') ? 'selected' : ''; ?>>Puma</option>
        <option value="DISNEY" <?php echo ($producto->marca === 'DISNEY') ? 'selected' : ''; ?>>DISNEY</option>
        <option value="NEW YOURK & CO" <?php echo ($producto->marca === 'NEW YOURK & CO') ? 'selected' : ''; ?>>NEW YOURK & CO</option>
        <option value="SO" <?php echo ($producto->marca === 'SO') ? 'selected' : ''; ?>>SO</option>
        <option value="CAT & JACK">CAT & JACK</option>
        <option value="ANA" <?php echo ($producto->marca === 'ANA') ? 'selected' : ''; ?>>ANA</option>
        <option value="OLD NAVY" <?php echo ($producto->marca === 'OLD NAVY') ? 'selected' : ''; ?>>OLD NAVY</option>
        <option value="GAP" <?php echo ($producto->marca === 'GAP') ? 'selected' : ''; ?>>GAP</option>
        <option value="Levi's" <?php echo ($producto->marca === "Levi's") ? 'selected' : ''; ?>>Levi's</option>
        <option value="JUSTICE" <?php echo ($producto->marca === 'JUSTICE') ? 'selected' : ''; ?>>JUSTICE</option>
        <option value="ADORE" <?php echo ($producto->marca === 'ADORE') ? 'selected' : ''; ?>>ADORE</option>
        <option value="AMERICAN EAGLE" <?php echo ($producto->marca === 'AMERICAN EAGLE') ? 'selected' : ''; ?>>AMERICAN EAGLE</option>
        <option value="ATHLETIC" <?php echo ($producto->marca === 'ATHLETIC') ? 'selected' : ''; ?>>ATHLETIC</option>
        <option value="POLO" <?php echo ($producto->marca === 'POLO') ? 'selected' : ''; ?>>POLO</option>
        <option value="OK!E DOKIE" <?php echo ($producto->marca === 'OK!E DOKIE') ? 'selected' : ''; ?>>OK!E DOKIE</option>
        <option value="MICHAEL KORS" <?php echo ($producto->marca === 'MICHAEL KORS') ? 'selected' : ''; ?>>MICHAEL KORS</option>
        <option value="GUESS" <?php echo ($producto->marca === 'GUESS') ? 'selected' : ''; ?>>GUESS</option>
        <option value="PAPARAZZI" <?php echo ($producto->marca === 'PAPARAZZI') ? 'selected' : ''; ?>>PAPARAZZI</option>
        <option value="Sin marca" <?php echo ($producto->marca === 'Sin marca') ? 'selected' : ''; ?>>Sin marca</option>
    </select>

    <!-- Talla del producto -->
    <label for="talla">Seleccione la talla del producto:<span class="asterisco">*</span></label>
    <select name="producto[talla]" id="talla">
        <option value="XXXS" <?php echo ($producto->talla === 'XXXS') ? 'selected' : ''; ?>>XXXS</option>
        <option value="XXS" <?php echo ($producto->talla === 'XXS') ? 'selected' : ''; ?>>XXS</option>
        <option value="XS" <?php echo ($producto->talla === 'xs') ? 'selected' : ''; ?>>XS</option>
        <option value="S" <?php echo ($producto->talla === 'S') ? 'selected' : ''; ?>>S</option>
        <option value="M" <?php echo ($producto->talla === 'M') ? 'selected' : ''; ?>>M</option>
        <option value="L" <?php echo ($producto->talla === 'L') ? 'selected' : ''; ?>>L</option>
        <option value="XL" <?php echo ($producto->talla === 'XL') ? 'selected' : ''; ?>>XL</option>
        <option value="XXL" <?php echo ($producto->talla === 'XXL') ? 'selected' : ''; ?>>XXL</option>
        <option value="XXXL" <?php echo ($producto->talla === 'XXXL') ? 'selected' : ''; ?>>XXXL</option>
    </select>

    <!-- Estado del producto -->
    <label for="estado">Seleccione el estado del producto:<span class="asterisco">*</span></label>
    <select name="producto[estado]" id="estado">
        <option value="Usado" <?php echo ($producto->estado === 'Usado') ? 'selected' : ''; ?>>Usado</option>
        <option value="Semi nuevo" <?php echo ($producto->estado === 'Semi nuevo') ? 'selected' : ''; ?>>Semi nuevo</option>
        <option value="Nuevo" <?php echo ($producto->estado === 'Nuevo') ? 'selected' : ''; ?>>Nuevo</option>
    </select>

    <!-- Categorías del producto -->
    <label for="categorias">Seleccione la categoría del producto:<span class="asterisco">*</span></label>
    <select name="producto[categorias]" id="categorias">
        <option value="Premium Damas Blusas" <?php echo ($producto->categorias === 'Premium Damas Blusas') ? 'selected' : ''; ?>>Premium Damas Blusas</option>
        <option value="Super Premium Damas Blusas" <?php echo ($producto->categorias === 'Super Premium Damas Blusas') ? 'selected' : ''; ?>>Super Premium Damas Blusas</option>
        <option value="Premium Damas Chalecos y Chaquetas" <?php echo ($producto->categorias === 'Premium Damas Chalecos y Chaquetas') ? 'selected' : ''; ?>>Premium Damas Chalecos y Chaquetas</option>
        <option value="Super Premium Damas Chalecos y Chaquetas" <?php echo ($producto->categorias === 'Super Premium Damas Chalecos y Chaquetas') ? 'selected' : ''; ?>>Super Premium Damas Chalecos y Chaquetas</option>
        <option value="Premium Damas Chumpas y Suéter" <?php echo ($producto->categorias === 'Premium Damas Chumpas y Suéter') ? 'selected' : ''; ?>>Premium Damas Chumpas y Suéter</option>
        <option value="Super Premium Damas Chumpas y Suéter" <?php echo ($producto->categorias === 'Super Premium Damas Chumpas y Suéter') ? 'selected' : ''; ?>>Super Premium Damas Chumpas y Suéter</option>
        <option value="Premium Damas Pantalones" <?php echo ($producto->categorias === 'Premium Damas Pantalones') ? 'selected' : ''; ?>>Premium Damas Pantalones</option>
        <option value="Super Premium Damas Pantalones" <?php echo ($producto->categorias === 'Super Premium Damas Pantalones') ? 'selected' : ''; ?>>Super Premium Damas Pantalones</option>
        <option value="Premium Damas Ropa Interior" <?php echo ($producto->categorias === 'Premium Damas Ropa Interior') ? 'selected' : ''; ?>>Premium Damas Ropa Interior</option>
        <option value="Super Premium Damas Ropa Interior" <?php echo ($producto->categorias === 'Super Premium Damas Ropa Interior') ? 'selected' : ''; ?>>Super Premium Damas Ropa Interior</option>
        <option value="Premium Damas Short y Faldas" <?php echo ($producto->categorias === 'Premium Damas Short y Faldas') ? 'selected' : ''; ?>>Premium Damas Short y Faldas</option>
        <option value="Super Premium Damas Short y Faldas" <?php echo ($producto->categorias === 'Super Premium Damas Short y Faldas') ? 'selected' : ''; ?>>Super Premium Damas Short y Faldas</option>
        <option value="Premium Damas Vestidos" <?php echo ($producto->categorias === 'Premium Damas Vestidos') ? 'selected' : ''; ?>>Premium Damas Vestidos</option>
        <option value="Super Premium Damas Vestidos" <?php echo ($producto->categorias === 'Super Premium Damas Vestidos') ? 'selected' : ''; ?>>Super Premium Damas Vestidos</option>
        <option value="Premium Caballeros Camisas" <?php echo ($producto->categorias === 'Premium Caballeros Camisas') ? 'selected' : ''; ?>>Premium Caballeros Camisas</option>

    </select>


    <label for="imagen">Imagen:<span class="asterisco">*</span></label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="producto[imagen]">
    <?php if (!empty($producto->imagen)) { ?>
        <img src="/imagenes/<?php echo htmlspecialchars($producto->imagen); ?>" class="imagen-small">
    <?php } ?>
    <input type="hidden" name="producto[imagen]" value="<?php echo htmlspecialchars($producto->imagen); ?>">


    <!-- Descripción del producto -->
    <label for="descripcion">Descripción:<span class="asterisco">*</span></label>
    <textarea id="descripcion" name="producto[descripcion]"><?php echo htmlspecialchars($producto->descripcion); ?></textarea>

</fieldset>

<!-- Información del inventario -->
<fieldset>
    <legend>Información para Inventario</legend>

    <!-- Proveedor del producto -->
    <label for="proveedor">Seleccione el proveedor:<span class="asterisco">*</span></label>
    <select name="producto[proveedor]" id="proveedor">
        <option value="Fardos de Ropa Americana" <?php echo ($producto->proveedor === 'Fardos de Ropa Americana') ? 'selected' : ''; ?>>Fardos de Ropa Americana</option>
        <option value="Distribuidora Pretty Cheap" <?php echo ($producto->proveedor === 'Distribuidora Pretty Cheap') ? 'selected' : ''; ?>>Distribuidora Pretty Cheap</option>
        <option value="Distribuidora LEYLA" <?php echo ($producto->proveedor === 'Distribuidora LEYLA') ? 'selected' : ''; ?>>Distribuidora LEYLA</option>
        <option value="PINK CLOTHES" <?php echo ($producto->proveedor === 'PINK CLOTHES') ? 'selected' : ''; ?>>PINK CLOTHES</option>
        <option value="CANADIAN CL"><?php echo ($producto->proveedor === 'CANADIAN CL') ? 'selected' : ''; ?> CANADIAN CL</option>
    </select>

    <!-- Entradas del producto -->
    <label for="entradas">Cantidad de ingreso de producto:<span class="asterisco">*</span></label>
    <input type="number" id="entradas" name="producto[entradas]" placeholder="Ingresos de Producto" value="<?php echo htmlspecialchars($producto->entradas); ?>" min="1">

    <!-- Salidas del producto -->
    <label for="salidas">Cantidad de salidas de producto:<span class="asterisco">*</span></label>
    <input type="number" id="salidas" name="producto[salidas]" placeholder="Salidas de Producto" value="<?php echo htmlspecialchars($producto->salidas); ?>" min="0">

    <!-- Devolución del producto -->
    <label for="devolucion">Cantidad de producto devuelto:</label>
    <input type="number" id="devolucion" name="producto[devolucion]" placeholder="Devolucion del Producto" value="<?php echo htmlspecialchars($producto->devolucion); ?>" min="0">

    <!-- Fecha de ingreso del producto -->
    <label for="fecha">Fecha de ingreso:</label>
    <input type="date" id="fecha" name="producto[fecha]" min="2023-01-01" max="<?php echo date('Y-m-d'); ?>" placeholder="Formato: AAAA-MM-DD" value="<?php echo htmlspecialchars($producto->fecha); ?>">
</fieldset>