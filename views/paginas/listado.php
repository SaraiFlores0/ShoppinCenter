<div class="contenedor-anuncios">
    <?php foreach ($productos as $producto) : ?>
        <div class="anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $producto->imagen; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $producto->nombre; ?></h3>
                <p><?php echo $producto->descripcion; ?></p>
                <p class="precio">$<?php echo $producto->precio; ?></p>

                <p class="talla-marca">Marca: <?php echo $producto->marca; ?></p>

                <p class="talla-marca">Talla: <?php echo $producto->talla; ?></p>

                <div class="iconos-caracteristicas">
                    <a href="#">
                        <img class="icono" loading="lazy" src="build/img/carrito.png" alt="icono habitaciones">
                     </a>  
                    
                    <a href="#">
                        <img class="icono" loading="lazy" src="build/img/favorito.png" alt="icono habitaciones">
                    </a>
                
                
                </div>

                <a href="producto?id=<?php echo $producto->id; ?>" class="boton-amarillo-block">
                    Ver Producto
                </a>
            </div><!--.contenido-anuncio-->
        </div><!--anuncio-->
    <?php endforeach; ?>
</div> <!--.contenedor-anuncios-->