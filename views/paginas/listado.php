<div class="contenedor-productos">
    <?php foreach ($productos as $producto) : ?>
        <div class="producto">
            <div class="imgcont">
                <img class="productimg" loading="lazy" src="/imagenes/<?php echo $producto->imagen; ?>" alt="producto">
            </div>
            <div class="contenido-producto">
                <h3><?php echo $producto->nombre; ?></h3>
                <p><?php echo $producto->descripcion; ?></p>
                <p class="precio">$<?php echo $producto->precio; ?></p>

                <p class="talla-marca">Marca: <?php echo $producto->marca; ?></p>

                <p class="talla-marca">Talla: <?php echo $producto->talla; ?></p>
                <p class="talla-marca"><?php echo $producto->estado; ?></p>

                <div class="iconos">
                    <a href="#" class="btnCarrito" data-id="<?php echo $producto->id; ?>" data-precio="<?php echo $producto->precio; ?>" data-descripcion="<?php echo $producto->descripcion; ?>" data-imagen="<?php echo $producto->imagen; ?>">
                        <img class="icono" loading="lazy" src="/build/img/carrito.png" alt="icono carrito">

                    </a>

                    <a href="#" class="btnFav" data-id="<?php echo $producto->id; ?>" data-precio="<?php echo $producto->precio; ?>" data-descripcion="<?php echo $producto->descripcion; ?>" data-imagen="<?php echo $producto->imagen; ?>">
                        <img class="icono" loading="lazy" src="/build/img/favorito.png" alt="icono favorito">
                    </a>


                </div>

                <a href="producto?id=<?php echo $producto->id; ?>" class="boton-amarillo-block">
                    Ver Producto
                </a>
            </div><!--.contenido-producto-->
        </div><!--producto-->
    <?php endforeach; ?>
</div> <!--.contenedor-productos-->