
<div class="contenedor-anuncios">
    <?php foreach($productos as $producto): ?>
    <div class="anuncio">
        <img loading="lazy" src="/imagenes/<?php echo $producto->imagen; ?>" alt="anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $producto->nombre; ?></h3>
            <p><?php echo $producto->descripcion; ?></p>
            <p class="precio">$<?php echo $producto->precio; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                <p class="talla-marca"><?php echo $producto->marca; ?></p>
                </li>
                <li>
                <p class="talla-marca"><?php echo $producto->talla; ?></p>
                </li>
                <p class="talla-marca"><?php echo $producto->estado; ?></p>
                </li>
            </ul>

            <!-- <ul>
            <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                </li>
            <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                </li>
            </ul> -->

            <a href="producto?id=<?php echo $producto->id; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!--.contenido-anuncio-->
    </div><!--anuncio-->
    <?php endforeach; ?>
</div> <!--.contenedor-anuncios-->
