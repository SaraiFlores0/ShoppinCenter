<?php

use Model\Usuario;
    // Verificar si la sesión está iniciada
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verificar si el usuario está autenticado
    $auth = isset($_SESSION['loginUsuario']) || isset($_SESSION['loginAdmin']);
   
    $nombreUsuario = $_SESSION['nombreUsuario'] ?? '';

    // Inicializar la variable $inicio
    $inicio = isset($inicio) ? $inicio : false;

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
                <a href="/">
                    <h1>Shopping Center</h1>
                </a>

                <div class="mobile-menu">
                    <img src="../build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/loginUsuario">Iniciar Sesión</a>
                        <a href="/">Premium Damas</a>
                        <a href="/">Super Premium Damas</a>
                        <a href="/">Premium Caballeros</a>
                        <a href="/">Super Premium Caballeros</a>
                        <?php if ($auth) : ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>

            </div> <!--.barra-->

            <?php if (!$auth) {
                echo $inicio ? "" : '';
            } else {
                echo $inicio ? "<h1>Bienvenido/a, $nombreUsuario</h1>" : '';
            } ?>
        </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
        <nav class="navegacion">
                        <a href="/loginUsuario">Iniciar Sesión</a>
                        <a href="/">Premium Damas</a>
                        <a href="/">Super Premium Damas</a>
                        <a href="/">Premium Caballeros</a>
                        <a href="/">Super Premium Caballeros</a>
                    </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
</body>

</html>