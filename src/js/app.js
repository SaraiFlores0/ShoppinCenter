document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}

//** Carrito */
document.addEventListener('DOMContentLoaded', function() {
    obtenerCantidadEnCarrito();
    var btnCarritoList = document.querySelectorAll('.btnCarrito');

    btnCarritoList.forEach(function(btnCarrito) {
        btnCarrito.addEventListener('click', function(e) {
            e.preventDefault();

            // Obtener la información del producto del botón de carrito
            var Id_Producto = btnCarrito.getAttribute('data-id');
            var Precio_Producto = btnCarrito.getAttribute('data-precio');
            var Descripcion_Producto = btnCarrito.getAttribute('data-descripcion');
            var Imagen_Producto = btnCarrito.getAttribute('data-imagen');

            // Crear una nueva instancia de XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud
            xhr.open('POST', '/carrito/agregar', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Definir la función de devolución de llamada
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                    if (xhr.status === 200) {
                        obtenerCantidadEnCarrito();

                        // Redirigir al usuario a la vista del carrito después de completar las actualizaciones
                        window.location.href = '/carrito/agregar';
                    } else {
                        console.error('Error en la solicitud: ' + xhr.status);
                    }
                }
            };

            // Enviar la solicitud con los datos del producto
            xhr.send('Id_Producto=' + (Id_Producto || '') +
                    '&Precio_Producto=' + (Precio_Producto || '') +
                    '&Descripcion_Producto=' + (Descripcion_Producto || '') +
                    '&Imagen_Producto=' + (Imagen_Producto || ''));
        });
    });
});

function obtenerCantidadEnCarrito() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', '/carrito/cantidad', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
            } else {
                console.error('Error en la solicitud para obtener la cantidad en el carrito: ' + xhr.status);
            }
        }
    };
    xhr.send();
}

//** ---------------------- */

//** Favs */
document.addEventListener('DOMContentLoaded', function() {
    obtenerCantidadEnFav();
    var btnFavList = document.querySelectorAll('.btnFav');

    btnFavList.forEach(function(btnFav) {
        btnFav.addEventListener('click', function(e) {
            e.preventDefault();

            // Obtener la información del producto del botón de carrito
            var Id_Producto = btnFav.getAttribute('data-id');
            var Precio_Producto = btnFav.getAttribute('data-precio');
            var Descripcion_Producto = btnFav.getAttribute('data-descripcion');
            var Imagen_Producto = btnFav.getAttribute('data-imagen');

            // Crear una nueva instancia de XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud
            xhr.open('POST', '/fav/agregar', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Definir la función de devolución de llamada
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                    if (xhr.status === 200) {
                        obtenerCantidadEnFav();

                        window.location.href = '/fav/agregar';
                    } else {
                        console.error('Error en la solicitud: ' + xhr.status);
                    }
                }
            };

            // Enviar la solicitud con los datos del producto
            xhr.send('Id_Producto=' + (Id_Producto || '') +
                    '&Precio_Producto=' + (Precio_Producto || '') +
                    '&Descripcion_Producto=' + (Descripcion_Producto || '') +
                    '&Imagen_Producto=' + (Imagen_Producto || ''));
        });
    });
});

function obtenerCantidadEnFav() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', '/fav/cantidad', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
            } else {
                console.error('Error en la solicitud para obtener la cantidad en el carrito: ' + xhr.status);
            }
        }
    };
    xhr.send();
}
