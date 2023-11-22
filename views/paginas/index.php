<img src="build/img/ban1.jpg" alt="">
<main class="contenedor seccion">
    
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>La mejor seguridad en tu proceso de compra web!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Los mejores precios, la mejor Ropa.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>A Tiempo</h3>
            <p>Entregas a domicilio en tiempo record!</p>
        </div>
    </div>
</main>

<section class="seccion contenedor">
    <h2><strong>Productos en venta</strong></h2>

    <?php 
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/productos" class="boton-verde">Ver Todas</a>
    </div>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="#">
                    <h4>Blog 1</h4>
                    <p class="informacion-meta">Escrito el: <span>11/11/2023</span> por: <span>Admin</span> </p>

                    <p>
                        Consejos para cuidar tu ropa.
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="#">
                    <h4>Blog 2</h4>
                    <p class="informacion-meta">Escrito el: <span>11/11/2023</span> por: <span>Admin</span> </p>

                    <p>
                        Consejos para cuidar tu ropa.
                    </p>
                </a>
            </div>
        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y los productos son de muy buena calidad y a bajos precios.
            </blockquote>
            <p>- Anónimo</p>
        </div>
    </section>
</div>