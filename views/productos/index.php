<?php
// Verificar si la sesión está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Verificar si el usuario está autenticado
$auth = $_SESSION['loginAdmin'] ?? false;

$nombreUsuario = $_SESSION['nombreUsuario'] ?? '';
?>

<main class="contenedor seccion">
    <?php if ($auth) {
        echo "<h1>Bienvenido/a, $nombreUsuario</h1>";
    } ?>
    <h1>Administrador/a de Shopping Center</h1>




    <?php include __DIR__ . '/../navegacion.php'; ?>

    <h2>Productos</h2>
    <table class="productos">
        <thead>
            <tr>
                <th>N°</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los Resultados -->
            <?php $contador = 1 ?>
            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $contador;
                        $contador++; ?></td>
                    <td><?php echo $producto->nombre; ?></td>
                    <td><img src="/imagenes/<?php echo $producto->imagen; ?>" class="imagen-tabla"> </td>
                    <td>$ <?php echo $producto->precio; ?></td>
                    <td>
                        <form method="POST" action="productos/eliminar" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                            <input type="hidden" name="tipo" value="producto">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="producto/actualizar?id=<?php echo $producto->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>