<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Intervention\Image\ImageManagerStatic as Image;

class ProductoController
{

    //** Función que muestra todos los productos. */
    public static function index(Router $router)
    {
        $productos = Producto::Allproductos();

        //** Muestra mensaje condicional. */ 
        $resultado = $_GET['resultado'] ?? null;

        //** Muanda los productos a la vista. */
        $router->render('productos/index', [
            'productos' => $productos,
            'resultado' => $resultado
        ]);
    }

    //** --------------------------------------------------------- */

    //** Función que crea los productos. */
    public static function crear(Router $router)
    {
        $errores = Producto::getErrores();
        $producto = new Producto();
        $resultado = '';
        $image = null;

        //** Ejecutar el código después de que el usuario envía el formulario.*/ 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //** Obtener los datos del formulario. */
            $productoDato = $_POST['producto'];

            //** Generar un nombre único a la imagen. */
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //** Asingar lo ingresado en el formulario. */
            $producto->nombre = $productoDato['nombre'];
            $producto->precio = $productoDato['precio'];
            $producto->marca = $productoDato['marca'];
            $producto->talla = $productoDato['talla'];
            $producto->estado = $productoDato['estado'];
            $producto->categorias = $productoDato['categorias'];
            $producto->descripcion = $productoDato['descripcion'];
            $producto->proveedor = $productoDato['proveedor'];
            $producto->entradas = $productoDato['entradas'];
            $producto->salidas = $productoDato['salidas'];
            $producto->devolucion = $productoDato['devolucion'];
            $producto->fecha = $productoDato['fecha'];

            //** Realizar resize a la imagen con Intervention */ 
            if ($_FILES['producto']['tmp_name']['imagen']) {

                //** Inicializar $image */ 
                $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800, 600);

                //** Setear la imagen. */ 
                $producto->setImagen($nombreImagen);
            }

            //** Validar los campos y obtener errores si los hay. */ 
            $errores = $producto->validar();

            //** Si no hay errores, crear producto. */ 
            if (empty($errores)) {

                //** Crear la carpeta para subir imagenes. */
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //** Guardar la imagen en el servidor. */
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //** Crear producto. */
                $resultado = $producto->crear();

                //** Muestra mensaje condicional. */
                if ($resultado === 0) {
                    $errores[] = 'Error al crear el producto. ';
                } else {
                    mostrarNotificacion($resultado);
                    //** Mostrar mensaje de éxito y redirigir al admin. */
                    echo "<script>
                    setTimeout(function() {
                        var mensajeExito = document.getElementById('mensaje-exito');
                        if (mensajeExito) {
                            mensajeExito.style.display = 'none'; // Oculta el mensaje
                        }
                        window.location.href = '/admin'; // Redirige a /admin
                    }, 1500);
                    </script>";
                }
            }
        }

        //** Mostrar en la vista. */
        $router->render('productos/crear', [
            'errores' => $errores,
            'producto' => $producto,
            'resultado' => $resultado
        ]);
    }

    //** --------------------------------------------------------- */

    //** Actualiza la información del producto. */
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $errores = Producto::getErrores();
        $producto = Producto::find($id);
        $resultado = '';

        //** Ejecutar el código después de que el usuario envía el formulario.*/ 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['producto'];
            $argsProducto = (array)$producto;
            $producto->sincronizar($args + $argsProducto);

            //** Generar un nombre único a la imagen. */
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //** Realizar resize a la imagen con Intervention */
            if ($_FILES['producto']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800, 600);
                $producto->setImagen($nombreImagen);
            }

            //** Validar los campos. */
            $errores = $producto->validar();

            //** Si no hay errores, actualizar producto. */
            if (empty($errores)) {
                if ($_FILES['producto']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                //* Actualiza en la base de datos.
                $resultado = $producto->actualizar();

                if ($resultado === 0) {
                    $errores[] = 'Error al actualizar el producto. ';
                } else {
                    //** Mostrar mensaje de éxito y redirigir al admin. */
                    mostrarNotificacion($resultado);
                    echo "<script>
                    setTimeout(function() {
                        var mensajeExito = document.getElementById('mensaje-exito');
                        if (mensajeExito) {
                            mensajeExito.style.display = 'none'; // Oculta el mensaje
                        }
                        window.location.href = '/admin'; // Redirige a /admin
                    }, 1500);
                    </script>";
                }
            }
        }

        $router->render('productos/actualizar', [
            'errores' => $errores,
            'producto' => $producto,
            'resultado' => $resultado
        ]);
    }

    //** --------------------------------------------------------- */

    //** Elimina la información del producto. */
    public static function eliminar()
    {

        //** Ejecutar el código después del POST.*/ 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];

            //** Peticiones validas
            if (validarTipoContenido($tipo)) {
                //** Leer el id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                //** Encontrar y eliminar la propiedad
                $producto = Producto::find($id);
                $resultado = $producto->eliminar();

                //** Redireccionar
                if ($resultado) {
                    header('location: /productos');
                }
            }
        }
    }
}
