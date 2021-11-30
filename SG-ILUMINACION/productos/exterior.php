<?PHP
    /*Clases del cliente*/
    require_once('../clientes/crud_cliente.php');
    require_once('../clientes/cliente.php');


    /*Clases del producto*/
    require_once('crud_producto.php');
    require_once('producto.php');

    $crud= new CrudCliente();
    $cliente =new Cliente();

    $crudP= new CrudProducto();
    $producto= new Producto();

?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="preload" href="../css/normalize.css" as="style">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="preload" href="../css/style.css" as="style">
        <link href="../css/style.css" rel="stylesheet">

        <title>Proyecto</title>
    </head>

    <body>
        <header class="contenedor-header">
            <img class="logo" src="../img/logo.png">
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
            <a href="<?PHP if(isset($_GET['id_Usuario'])){?>../carritoCompra/index.php<?PHP  echo "?id_Usuario=",$_GET['id_Usuario']; } else{ echo "../login/formulario.html"; }?>" class="carrito-icono">
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
                <a href="../index.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Inicio</a>
                <a href="interior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación interior</a>
                <a class="boton-activo">Iluminación exterior</a>
                <?PHP
                    if(isset($_GET['id_Usuario'])){
                        echo '<a href="../clientes/administrar_cliente.php?accion=s">Cerrar sesión</a>';
                    }else{
                        echo '<a href="../login/formulario.html">Iniciar sesión</a>';
                    }
                ?>
            </nav>
        </div>

        <main style="min-height: 25rem;" class="contenedor">
            <section class="contenedor" >
                <h1>ILUMINACION EXTERIOR</h1>
                <div class="grid">
                <?PHP
                    $listaProductos=$crudP->mostrar();
                    foreach($listaProductos as $producto){
                        if(strcmp($producto->getTipo(),'Exterior')==0 || strcmp($producto->getTipo(),'exterior')==0){
                            if($producto->getDescuento()>0){
                    ?>

                    <div class="producto">
                        <a href="<?PHP if(isset($_GET['id_Usuario'])){?>producto_vista.php?t=interior&id_prod=<?PHP echo $producto->getId(); echo "&id_Usuario=",$_GET['id_Usuario']; } else{ echo "../login/formulario.html"; } ?>">
                            <img class="producto-imagen" src="<?php echo $producto->getURL(); ?>">
                            <div class="producto-informacion">
                                <p class="producto-nombre"><?php echo $producto->getNombre(); ?></p>
                                <p class="producto-nombre">Descuento del %<?php echo $producto->getDescuento().' '; ?> de <strike>$<?php echo $producto->getPrecio(); ?></strike></p>
                                <p style="color:red;" class="producto-precio">a $<?php echo $precioD=$producto->getPrecio()*((100-$producto->getDescuento())/100);  ?></p>
                            </div>
                        </a>
                    </div>
                <?php } }//IF
                    }//foreach ?>
                </div>
            </section>
            <br>
            <section class="contenedor">
                <div class="grid">
                <?PHP foreach($listaProductos as $producto){
                    if(strcmp($producto->getTipo(),'Exterior')==0 || strcmp($producto->getTipo(),'exterior')==0){
                        if($producto->getDescuento()==0){
                ?>
                    <div class="producto">
                        <a href="<?PHP if(isset($_GET['id_Usuario'])){?>producto_vista.php?t=interior&id_prod=<?PHP echo $producto->getId(); echo "&id_Usuario=",$_GET['id_Usuario']; } else{ echo "../login/formulario.html"; } ?>">
                            <img class="producto-imagen" src="<?php echo $producto->getURL(); ?>">
                            <div class="producto-informacion">
                                <p class="producto-nombre"><?php echo $producto->getNombre(); ?></p>
                                <p class="producto-precio">$<?php echo $producto->getPrecio(); ?></p>
                            </div>
                        </a>
                    </div>
                <?php }//IF
                    } }//foreach ?>
                </div>
            </section>

        </main>
        <footer class="contenedor footer">
            <p>Todos los derechos reservados. SG ILUMINACIÓN</p>
        </footer>
    </body>
</html>