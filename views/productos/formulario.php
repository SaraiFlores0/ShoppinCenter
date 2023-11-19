<!-- Información del producto -->
<fieldset>
    <legend>Información General del los productos:</legend>

    <!-- Nombre del producto -->
    <label for="nombre">Nombre del Producto: <span class="asterisco">*</span></label>
    <input type="text" id="nombre" name="producto[nombre]" placeholder="Nombre del producto" value="<?php echo htmlspecialchars($producto->nombre); ?>">

    <!-- Precio del producto -->
    <label for="precio">Precio Unitario:<span class="asterisco">*</span></label>
    <input type="number" id="precio" name="producto[precio]" placeholder="Precio Producto" value="<?php echo htmlspecialchars($producto->precio); ?>" min="5.00">

    <!-- Marca del producto -->
    <label for="marca">Marca:<span class="asterisco">*</span></label>
    <select name="producto[marca]" id="marca">

        <option value="SHEIN">SHEIN</option>
        <option value="ZARA">ZARA</option>
        <option value="Forever 21">Forever 21</option>
        <option value="Puma">Puma</option>
        <option value="DISNEY">DISNEY</option>
        <option value="NEW YOURK & CO">NEW YOURK & CO</option>
        <option value="SO">SO</option>
        <option value="CAT & JACK">CAT & JACK</option>
        <option value="ANA">ANA</option>
        <option value="OLD NAVY">OLD NAVY</option>
        <option value="GAP">GAP</option>
        <option value="Levi's">Levi's</option>
        <option value="JUSTICE">JUSTICE</option>
        <option value="ADORE">ADORE</option>
        <option value="AMERICAN EAGLE">AMERICAN EAGLE</option>
        <option value="ATHLETIC">ATHLETIC</option>
        <option value="POLO">POLO</option>
        <option value="OK!E DOKIE">OK!E DOKIE</option>
        <option value="MICHAEL KORS">MICHAEL KORS</option>
        <option value="GUESS">GUESS</option>
        <option value="PAPARAZZI">PAPARAZZI</option>
        <option value="Sin marca">Sin marca</option>
    </select>

    <!-- Talla del producto -->
    <label for="talla">Seleccione la talla del producto:<span class="asterisco">*</span></label>
    <select name="producto[talla]" id="talla">
        <option value="XXXS">XXXS</option>
        <option value="XXS">XXS</option>
        <option value="XS">XS</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
        <option value="XXXL">XXXL</option>
    </select>

    <!-- Estado del producto -->
    <label for="estado">Seleccione el estado del producto:<span class="asterisco">*</span></label>
    <select name="producto[estado]" id="estado">
        <option value="Usado">Usado</option>
        <option value="Semi nuevo">Semi nuevo</option>
        <option value="Nuevo">Nuevo</option>
    </select>

    <!-- Categorías del producto -->
    <label for="categorias">Seleccione la categoría del producto:<span class="asterisco">*</span></label>
    <select name="producto[categorias]" id="categorias">
        <option value="Premium Damas Blusas">Premium Damas Blusas</option>
        <option value="Super Premium Damas Blusas">Super Premium Damas Blusas</option>
        <option value="Premium Damas Chalecos y Chaquetas">Premium Damas Chalecos y Chaquetas</option>
        <option value="Super Premium Damas Chalecos y Chaquetas">Super Premium Damas Chalecos y Chaquetas</option>
        <option value="Premium Damas Chumpas y Suéter">Premium Damas Chumpas y Suéter</option>
        <option value="Super Premium Damas Chumpas y Suéter">Super Premium Damas Chumpas y Suéter</option>
        <option value="Premium Damas Pantalones">Premium Damas Pantalones</option>
        <option value="Super Premium Damas Pantalones">Super Premium Damas Pantalones</option>
        <option value="Premium Damas Ropa Interior">Premium Damas Ropa Interior</option>
        <option value="Super Premium Damas Ropa Interior">Super Premium Damas Ropa Interior</option>
        <option value="Premium Damas Short y Faldas">Premium Damas Short y Faldas</option>
        <option value="Super Premium Damas Short y Faldas">Super Premium Damas Short y Faldas</option>
        <option value="Premium Damas Vestidos">Premium Damas Vestidos</option>
        <option value="Super Premium Damas Vestidos">Super Premium Damas Vestidos</option>
        <option value="Premium Caballeros Camisas">Premium Caballeros Camisas</option>
        <!-- Agrega más opciones si es necesario -->
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
        <option value="Fardos de Ropa Americana">Fardos de Ropa Americana</option>
        <option value="Distribuidora Pretty Cheap">Distribuidora Pretty Cheap</option>
        <option value="Distribuidora LEYLA">Distribuidora LEYLA</option>
        <option value="PINK CLOTHES">PINK CLOTHES</option>
        <option value="CANADIAN CL">CANADIAN CL</option>
        <!-- Agrega más opciones si es necesario -->
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