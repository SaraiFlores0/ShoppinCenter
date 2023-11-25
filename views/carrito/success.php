<?php

use Model\Carrito;

$totalCarrito = new Carrito;

$total = $totalCarrito->obtenerTotalCarrito(isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null);

$mensaje = "Por favor, inicie sesión antes de añadir productos al carrito.";


?>
<?php if (!isset($_SESSION['usuario'])) { ?>
    <div id='mensaje-advertencia' class="alerta advertencia">
        <img class="icono-alerta" loading="lazy" src="/build/img/peligro.png" alt="Icono Alerta">
        <p class="text-advertencia"><?php echo $mensaje; ?></p>
    </div>

<?php } ?>

<main class="contenedor seccion contenido-centrado" style="margin-top: 100px; margin-bottom: 100px;">
    <h1>Muchas Gracias por Realizar tu Pedido!</h1>
    <center>
        <a href="/" class="boton boton-naranja">Volver al Inicio</a><br>
    </center>
    <br>





</main>