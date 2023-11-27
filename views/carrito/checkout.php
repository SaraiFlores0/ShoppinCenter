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

<main class="contenedor seccion contenido-centrado">
<h1>Confirmación de Pedido</h1>
    <a href="/carrito/agregar" class="boton boton-naranja">Volver a Carrito</a><br>
<br>
    <form  method="POST" action="/carrito/datosCompra" class="formulario" novalidate>
        <fieldset>
            <legend>1. Confirmación de Datos (Datos segun tu Usuario) </legend>

            <label for="email">Nombre Completo</label>
            <input type="text" name="nombre" placeholder="" id="nombre" value="<?php echo $producto->nombres; ?>" disabled>

            <label for="email">Correo electronico</label>
            <input type="text" name="mail" placeholder="Correo" id="mail" value="<?php echo $producto->correo; ?>" disabled>

            <label for="email">Telefono</label>
            <input type="text" name="phone" placeholder="Telefono" id="phone" value="<?php echo $producto->telefono; ?>" disabled> 

            <label for="email">DUI</label>
            <input type="text" name="dui" placeholder="Dui" id="dui" value="<?php echo $producto->dui; ?>" disabled>


        </fieldset>
        <fieldset>
            <legend>2. Direccion de Envio</legend>

            <label for="direccion">Dato de Direccion</label>
            <input type="text" name="direccion" placeholder="Dirección" id="direccion" value="<?php echo $producto->direccion; ?>" disabled>

            <label for="city">Ciudad - Departamento</label>
            <input type="text" name="city" placeholder="Ciudad y Departamento" id="city" value="<?php echo $producto->departamento; ?>" disabled>
            <input type="text" name="city" placeholder="Ciudad y Departamento" id="city" value="<?php echo $producto->municipio; ?>" disabled>



        </fieldset>
        <fieldset>
            <legend>3. Forma de Entrega y Pago</legend>

            <p>Selecciona como deseas recibir tu pedido.</p>


            <input type="radio" name="rad1" placeholder="Tu Usuario" id="rad1" checked> 
            <label for="rad1">Recoger en Sucursal</label>

            <p>Selecciona Forma de Pago.</p>


            <fieldset>
                <legend>Select a maintenance drone:</legend>

                <div>
                    <input type="radio" id="tarjeta" name="drone" value="tarjeta" checked />
                    <label for="tarjeta">Tarjeta de Credito</label>
                </div>

                <div>
                    <input type="radio" id="efectivo" name="drone" value="efectivo" />
                    <label for="efectivo">Efectivo</label>
                </div>

            </fieldset>




        </fieldset>

        <fieldset>
            <legend>4. Total Final</legend>

            <p>PRODUCTOS:</p>
            <table class="productos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th style="display: none;">Quitar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($carrito)) : ?>
                <?php foreach ($carrito as $producto) : ?>
                    <tr>
                        <td><img src="/imagenes/<?php echo $producto['ImagenProducto']; ?>" class="imagen-tabla"></td>

                        <td><?php echo $producto['NombreProducto']; ?></td>
                        <td>$<?php echo $producto['PrecioProducto']; ?></td>
                        <td><?php echo $producto['DescripcionProducto']; ?></td>
                        <td>
                            <form method="GET" action="/carrito/eliminar" class="w-100">
                                <input type="hidden" name="id_carrito" value="<?php echo $producto['IdCarrito']; ?>">
                                <button style="display: none;" type="submit" class="boton-rojo-block" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hay productos en el carrito de compras.</p>
            <?php endif; ?>
        </tbody>
    </table>

    <hr class="linea-separadora">


            <div class="total-carrito">
                <p style="font-size: 1.2em;">Total: $<?php echo $total ?? 0 ?> </p>
            </div>
            <hr class="linea-separadora">

            <?php foreach ($carrito as $producto) : ?>
        <input type="hidden" name="productos[]" value="<?php echo htmlspecialchars(json_encode($producto)); ?>">
    <?php endforeach; ?>

            <input type="submit" value="Confirmar mi Pedido" class="boton boton-naranja">
        </fieldset>


    </form>





    


</main>