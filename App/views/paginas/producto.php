<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $producto->nombre; ?></h1>

    
    <img loading="lazy" src="/imagenes/<?php echo $producto->imagen; ?>" alt="imagen del producto">

    <div class="resumen-producto">
                <p><?php echo $producto->descripcion; ?></p>
                <p class="precio">$<?php echo $producto->precio; ?></p>

                <p class="talla-marca">Marca: <?php echo $producto->marca; ?></p>

                <p class="talla-marca">Talla: <?php echo $producto->talla; ?></p>

                <div class="iconos">
                    <a href="#">
                        <img class="icono" loading="lazy" src="build/img/carrito.png" alt="icono carrito">
                     </a>  
                    
                    <a href="#">
                        <img class="icono" loading="lazy" src="build/img/favorito.png" alt="icono fav">
                    </a>
                
                
                </div>
    </div>
</main>