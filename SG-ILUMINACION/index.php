<?PHP 
    require_once('clientes/crud_cliente.php');
    require_once('clientes/cliente.php');
    $crud= new CrudCliente();
    $cliente =new Cliente();
	
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="preload" href="css/normalize.css" as="style"> 
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="preload" href="css/style.css" as="style">
        <link href="css/style.css" rel="stylesheet">
        
        <title>Proyecto</title>
    </head>

    <body>
        <header class="contenedor-header">
            <img class="logo" src="img/logo.png">
            <div class="buscador-grid">
            <?PHP 
                //Si existe el Id del usuario muestra el nombre del usuario
                if(isset($_GET['id_Usuario'])){ 
                    $cliente=$crud->obtenerCliente($_GET['id_Usuario']);
                    echo '<h1>Bienvenido/a '.$cliente->getNombre().' '.$cliente->getApellidos().'</h1>';
                }else{
                    echo '<h1>Bienvenido</h1>';
                }
            ?>
            </div>
            
            <a href="<?PHP if(isset($_GET['id_Usuario'])){?>carritoCompra/index.php<?PHP  echo "?id_Usuario=",$_GET['id_Usuario']; } else{ echo 'login/formulario.html'; } ?>" class="carrito-icono">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="6" cy="19" r="2" />
                <circle cx="17" cy="19" r="2" />
                <path d="M17 17h-11v-14h-2" />
                <path d="M6 5l14 1l-1 7h-13" />
              </svg>
            </a>
        </header>

        <div class="contenedor-navegacion">
            <nav class="navegacion-principal">
                <a class="boton-activo">Inicio</a>
                <a href="productos/interior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación interior</a>
                <a href="productos/exterior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación exterior</a>
                <?PHP 
                    if(isset($_GET['id_Usuario'])){ 
                        echo '<a href="clientes/administrar_cliente.php?accion=s">Cerrar sesión</a>';
                    }else{
                        echo '<a href="login/formulario.html">Iniciar sesión</a>';
                    }
                ?>
            
            </nav>
        </div>

        <section class="inicio">
            <div class="contenido-inicio">
                <h1>Los mejores productos al mejor precio</h1>
            </div>

        </section>
        <main class="contenedor sombra">
            <div class="contenedor nosotros">
                <div class="nosotros-contenido">
                    <h2>¿Por qué es importante una buena iluminación?</h2>
                    <p>La iluminación es de suma importancia a la hora de crear nuevos espacios. La luz juega un papel muy importante en nuestra percepción del entorno y cómo nos relacionamos con él. Es capaz de cambiar nuestra forma de ver un espacio. Por ejemplo, al entrar en una tienda la focalización en un objeto y no en otro dependerá en gran medida de cómo esté iluminado. En un restaurante, una luz cálida hará que estemos más cómodos, con mayor apetito y que comamos más despacio. Por el contrario, una luz blanca hará que comamos más rápido.</p>
                </div>
                <img class="nosotros-img" src="img/nosotros.png">
            </div>
            <div class="contenedor nosotros">
                <div>
                    
                </div>
            </div>

        </main>
        <footer class="contenedor footer">
            <p>Todos los derechos reservados. SG ILUMINACIÓN</p>
        </footer>
    </body>
</html>