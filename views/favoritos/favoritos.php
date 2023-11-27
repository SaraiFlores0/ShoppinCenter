<?php


$mensaje = "Por favor, inicie sesión antes de añadir productos a favoritos.";
?>

<main class="contenedor seccion">
    <h2>Productos Favoritos</h2>
    <a href="/" class="boton boton-naranja">Volver</a>

    <?php if (!isset($_SESSION['usuario'])) { ?>
        <div id='mensaje-advertencia' class="alerta advertencia">
            <img class="icono-alerta" loading="lazy" src="/build/img/peligro.png" alt="Icono Alerta">
            <p class="text-advertencia"><?php echo $mensaje; ?></p>
        </div>
        <?php }?>

    <table class="productos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Quitar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fav)) : ?>
                <?php foreach ($fav as $producto) : ?>
                    <tr>
                        <td><img src="/imagenes/<?php echo $producto['ImagenProducto']; ?>" class="imagen-tabla"></td>

                        <td><?php echo $producto['NombreProducto']; ?></td>
                        <td>$<?php echo $producto['PrecioProducto']; ?></td>
                        <td><?php echo $producto['DescripcionProducto']; ?></td>
                        <td>
                            <form method="GET" action="/fav/eliminar" class="w-100">
                                <input type="hidden" name="id_fav" value="<?php echo $producto['IdFavorito']; ?>">
                                <button type="submit" class="boton-rojo-block" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hay productos favoritos.</p>
            <?php endif; ?>
        </tbody>
    </table>
</main>