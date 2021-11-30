<?php

    $idP=$_GET['id_prod'];
    $tipo=$_GET['t'];
    /*Clases del cliente*/
    require_once('../clientes/crud_cliente.php');
    require_once('../clientes/cliente.php');
    $crud= new CrudCliente();
    $cliente =new Cliente();
    /*Clases de Proveedor*/
    require_once('../proveedores/crud_proveedor.php');
    require_once('../proveedores/proveedor.php');
    $crudProv= new CrudProveedor();
    $proveedor =new Proveedor();
    /*Clases del producto*/
    require_once('crud_producto.php');
    require_once('producto.php');
    $crudP= new CrudProducto();
    $producto= new Producto();
    $producto=$crudP->obtenerProducto($idP);
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
            <a href="../carritoCompra/index.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>" class="carrito-icono">
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
                <a <?php if($tipo=='interior'){  echo 'class="boton-activo"';}else{ ?>href="interior.php<?php if(isset($_GET['id_Usuario'])){ echo '?id_Usuario='.$_GET['id_Usuario']; }else ?>"<?php } ?>>Iluminación interior</a>
                <a <?php if($tipo=='exterior'){  echo 'class="boton-activo"';}else{ ?>href="exterior.php<?php if(isset($_GET['id_Usuario'])){ echo '?id_Usuario='.$_GET['id_Usuario']; }else ?>"<?php } ?>>Iluminación exterior</a>
                <?PHP 
                    if(isset($_GET['id_Usuario'])){ 
                        echo '<a href="../clientes/administrar_cliente.php?accion=s">Cerrar sesión</a>';
                    }else{
                        echo '<a href="../login/formulario.html">Iniciar sesión</a>';
                    }
                ?>
            </nav>
        </div>

        <main class="contenedor">
            <h2><?php echo $producto->getNombre(); ?></h2>
            <div class="compra-producto"> 
            <img class="producto-imagen-vista" src="<?php echo $producto->getURL(); ?>">
                <div class="compra-producto-contenido">
                    <p><b>Caracteristicas</b><br><?php echo $producto->getCaracteristicas(); ?>
                    <div style="font-size: 1.5rem;"><b>Precio </b>$<?php echo $producto->getPrecio(); if($producto->getDescuento()>0){ echo '<b style="color: red;">  Aproveche el descueto del '.$producto->getDescuento().'% </b>'; ?> 
                    <b style="color: red;">Usted solo paga: $</b>
                        <?php echo $precioD=$producto->getPrecio()*((100-$producto->getDescuento())/100); }?></div>
                    <p><b>Marca:</b>
                        <?php 
                        $proveedor=$crudProv->obtenerProveedor($producto->getIdV());
                        echo $proveedor->getMarca();?>
                    
                    <p>
                    <br>
                    
                    <form class="formulario"  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?t=<?php echo $tipo.'&id_prod='.$idP.'&id_Usuario='.$_GET["id_Usuario"]; ?>" >
                        <input id="numero_articulos" name="numero_articulos"class="formulario__campo" type="number" value="<?php if (isset($_POST["numero_articulos"])) echo $_POST["numero_articulos"]; else echo 1; ?>" min="1">  
                        <input id="confirmar"class="formulario__submit" type="submit" value="confirmar" >
                        <a class="formulario__submit" href="../carritoCompra/index.php?num_art=<?php 
                                                                    //se manda la informacion del cliente
                                                                    if (isset($_POST["numero_articulos"])) 
                                                                        echo $_POST["numero_articulos"]; 
                                                                        else 
                                                                            echo 1;
                                        
                                                                    ?>&id_Usuario=<?php
                                                                                if(isset($_GET["id_Usuario"])){
                                                                                    echo $_GET["id_Usuario"];}
                                                                                
                                                                            ?>&id_prod=<?php echo $idP;
                                                                               
                                                                            ?>"><!--input class="formulario__submit" type="button" value="Agregar al Carrito" -->Agregar al Carrito </a>
                    </form>
                </div>
            </div>
                
        </main>
        <footer class="contenedor footer">
            <p>Todos los derechos reservados. SG ILUMINACIÓN</p>
        </footer>
    </body>
</html>