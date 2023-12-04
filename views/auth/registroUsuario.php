<main class="contenedor seccion contenido-centrado">
    <h1>Registrarse</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>Datos Personales</legend>

            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" placeholder="Tus Nombres" id="nombres" required>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" placeholder="Tus Apellidos" id="apellidos" required>

            <label for="dui">DUI</label>
            <input type="text" name="dui" placeholder="Formato: 01234567-8" id="dui" required>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" placeholder="Tu Dirección" id="direccion" required>

            <label for="departamento">Departamento</label>
            <select name="departamento" id="departamento" required>
                <option value="" selected disabled>Selecciona un departamento</option>
                <?php foreach ($departamentos as $departamento) : ?>
                    <option value="<?php echo $departamento['ID_Departamento']; ?>"><?php echo $departamento['Nombre_Departamento']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="municipio">Municipio</label>
            <select name="municipio" id="municipio" required>
                <option value="" selected disabled>Selecciona un municipio</option>
                <?php foreach ($municipios as $municipio) : ?>
                    <option value="<?php echo $municipio['ID_Municipio']; ?>"><?php echo $municipio['Nombre_Municipio']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" placeholder="Formato: 7777-0000" id="telefono" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" min="1923-01-01" max="2005-01-01" required>

            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </fieldset>
        <fieldset>
            <legend>Email y Contraseña</legend>

            <label for="correo">E-mail</label>
            <input type="email" name="correo" placeholder="Tu Correo Electrónico" id="correo" required>

            <label for="password">Contraseña</label>
            <div class="contrasena-container">
                <input type="password" name="password" placeholder="Tu Contraseña" id="password" required>
                <div class="ver-contrasena">
                    <span toggle="#password" class="mostrar-contrasena ojo">&#128065;</span>
                    <span class="texto-ver-contrasena">Ver Contraseña</span>
                </div>
            </div>

            <label for="password_confirmacion">Confirmar Contraseña</label>
            <input type="password" name="password_confirmacion" placeholder="Confirmar Contraseña" id="password_confirmacion" required>
        </fieldset>

        <input type="submit" value="Registrarse" class="boton boton-naranja">
    </form>
   
</main>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        const mostrarContrasena = $('.mostrar-contrasena');
        const contrasenaInput = $('#password');

        mostrarContrasena.click(function() {
            const tipo = contrasenaInput.attr('type') === 'password' ? 'text' : 'password';
            contrasenaInput.attr('type', tipo);
            this.innerHTML = tipo === 'password' ? '&#128065;' : '&#128064;';
        });
    });
</script>



<style>
    .ver-contrasena {
        display: flex;
        align-items: center;
    }

    .mensaje-exito {
        color: green;
    }

    .mensaje-error {
        color: red;
    }

    /* .texto-ver-contrasena {
        margin-left: 8px cursor: pointer;
    }*/
</style>
