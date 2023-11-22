<main class="contenedor seccion">
    <h1>Actualizar Producto </h1>

    <?php
    $mensaje = mostrarNotificacion(intval($resultado));
    if ($mensaje) { ?>
        <p id='mensaje-exito' class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php }
    ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST"  enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Actualizar Producto" class="boton boton-verde">
    </form>
</main>