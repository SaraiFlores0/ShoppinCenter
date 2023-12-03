<?php

use Model\Carrito;
use Model\Favoritos;

if (!isset($_SESSION)) {
    session_start();
}

// Verificar si el usuario está autenticado
$auth = isset($_SESSION['loginUsuario']) || isset($_SESSION['loginAdmin']);

$nombreUsuario = $_SESSION['nombreUsuario'] ?? '';

// Inicializar la variable $inicio
$inicio = isset($inicio) ? $inicio : false;

$carrito = new Carrito();

// Obtener la cantidad de productos en el carrito
$cantidadProductosEnCarrito = $carrito->obtenerCantidadProductosEnCarrito($nombreUsuario);

$fav = new Favoritos();

// Obtener la cantidad de productos en el carrito
$cantidadProductosEnFav = $fav->obtenerCantidadProductosEnFavs($nombreUsuario);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

    <header class="header efecto-oscuro <?php echo $inicio  ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/" class="logo">
                    <h1>Shopping Center</h1>
                </a>
                <br>

                <div class="mobile-menu">
                    <img src="../build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <div>
                        <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                        <div class="contenedor-carrito">
                            <a href="/fav/agregar">
                                <img class="boton-carrito" src="/build/img/fav.png" alt="Productos Fav">
                                <div class="texto-carrito"><?php echo $cantidadProductosEnFav ?? 0; ?></div>
                            </a>
                        </div>

                        <div class="contenedor-carrito">
                            <a href="/carrito/agregar">
                                <img class="boton-carrito" src="/build/img/carrito.svg" alt="Carrito de compras">
                                <div class="texto-carrito"><?php echo $cantidadProductosEnCarrito ?? 0; ?></div>
                            </a>
                        </div>


                        <nav class="navegacion">
                            <a href="/Registrousuario">Registrarse</a>
                            <a href="/loginUsuario">Iniciar Sesión</a>
                            <a href="/productos/premium-damas">Premium Damas</a>
                            <a href="/productos/super-premium-damas">Super Premium Damas</a>
                            <a href="/productos/premium-chaquetas">Premium Damas Chalecos y Chaquetas</a>
                            <a href="/productos/super-premium-chaquetas">Super Premium Damas Chalecos y Chaquetas</a>
                            <a href="/productos/premium-pantalon">Premium Damas Pantalones</a>
                            <a href="/productos/premium-interior">Premium Damas Ropa Interior</a>
                            <a href="/productos/premium-vestidos">Premium Damas Vestidos</a>

                            <?php if ($auth) : ?>
                                <a href="/logout">Cerrar Sesión</a>
                            <?php endif; ?>
                        </nav>
                    </div>

                </div> <!--.barra-->

                <?php if (!$auth) {
                    echo $inicio ? "" : '';
                } else {
                    echo $inicio ? "<h2>Bienvenido/a, $nombreUsuario</h2>" : '';
                } ?>
            </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/Registrousuario">Registrarse</a>
                <a href="/loginUsuario">Iniciar Sesión</a>
                <a href="/productos/premium-damas">Premium Damas</a>
                <a href="/productos/super-premium-damas">Super Premium Damas</a>
                <a href="/productos/premium-chaquetas">Premium Damas Chalecos y Chaquetas</a>
                <a href="/productos/super-premium-chaquetas">Super Premium Damas Chalecos y Chaquetas</a>
                <a href="/productos/premium-pantalon">Premium Damas Pantalones</a>
                <a href="/productos/premium-interior">Premium Damas Ropa Interior</a>
                <a href="/productos/premium-vestidos">Premium Damas Vestidos</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ec52bebc8a.js" crossorigin="anonymous"></script>
</body>

</html>