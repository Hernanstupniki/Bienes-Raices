<?php

    require 'includes/funciones.php';


    incluirTemplate('header');
    ?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenedor contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit laoreet integer, porta dis molestie convallis lacinia et hac iaculis. Lectus tellus ligula eu viverra vivamus venenatis arcu, malesuada nostra pellentesque ullamcorper magna platea blandit ut, class scelerisque netus mauris inceptos accumsan. Ad quis fames sagittis sollicitudin tincidunt placerat semper dictumst neque senectus sociis malesuada commodo, vivamus suspendisse elementum nec torquent luctus est dui pretium leo rhoncus.
                </p>
                <p>
                    Aliquet augue dis purus convallis scelerisque aenean suscipit nulla pharetra, praesent nullam dictumst feugiat integer est quisque eleifend a pulvinar, sociosqu suspendisse class vestibulum risus gravida himenaeos non. Velit et vehicula venenatis cum eget, primis litora mattis orci morbi urna, per facilisi lacinia mus.
                </p>

        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
        </div>
    </section>
    

    <?php
    incluirTemplate ('footer');
    ?>
</html>