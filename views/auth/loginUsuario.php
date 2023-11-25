<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>Email y Password</legend>

            <label for="usuario">E-mail</label>
            <input type="text" name="usuario" placeholder="Tu Usuario" id="usuario">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password">
        </fieldset>
    
        <input type="submit" value="Iniciar Sesión" class="boton boton-naranja">
    </form>
</main>