<?PHP 
    require_once('../clientes/crud_cliente.php');
    require_once('../clientes/cliente.php');
    $crud_cliente= new CrudCliente();
    $cliente =new Cliente();
    require_once('../productos/crud_producto.php');
    require_once('../productos/producto.php');
    $crud_producto= new CrudProducto();
    $producto= new Producto();
    require_once('../carritoCompra/crud_compra.php');
    require_once('../carritoCompra/compra.php');
    require_once('../carritoCompra/crud_carrito.php');
    require_once('../carritoCompra/carrito.php');
    $crud_compra= new CrudCompra();
    $compra= new Compra();
    $crud_carrito= new CrudCarrito();
    $carrito= new Carrito();
    $crud_carrito->vaciarCarrito($_GET['id_Usuario']);    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="../css/normalize.css" as="style"> 
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preload" href="../css/style.css" as="style">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preload" href="../css/carrito.css" as="style">
    <link href="../css/carrito.css" rel="stylesheet">
    <title> Finalizar compra</title>
</head>
<body>
    <header class="contenedor-header">
        <img class="logo" src="../img/logo.png">
        <div class="buscador-grid">
        <?PHP 
                //Si existe el Id del usuario muestra el nombre del usuario
                if(isset($_GET['id_Usuario'])){ 
                    $cliente=$crud_cliente->obtenerCliente($_GET['id_Usuario']);
                    echo '<h1>Bienvenido/a '.$cliente->getNombre().' '.$cliente->getApellidos().'</h1>';
                }else{
                    echo '<h2>Inicia Sesion</h2>';
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
            <?PHP 
            
            ?>
            <a href="../index.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Inicio</a>
            <a href="../productos/interior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación interior</a>
            <a href="../productos/exterior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación exterior</a>
            <?PHP 
                if(isset($_GET['id_Usuario'])){ 
                    echo '<a href="../clientes/administrar_cliente.php?accion=s">Cerrar sesión</a>';
                }else{
                    echo '<a href="../login/formulario.html">Iniciar sesión</a>';
                }
            ?>
        </nav>
    </div>
    <div id="title">
        <h1>Compra Agendada</h1>
    </div>
    <div class="contenedor" id="producto">
       <?PHP
       //recupero el contenido del carrito con el id de usario
               $carros=$crud_carrito->mostrar_carrito($_GET['id_Usuario']);
               //por cada elemento del arreglo recuperado, se maneja en el for each
               foreach ($carros as $carrito){
                   $producto=$crud_producto->obtenerProducto($carrito->getId_producto());//con el objeto carrito recuperado, se recupera el id del producto
                   $compra->setFolio($_GET['Folio']);//se almacenan todos los datos en el objeto compra de tipo compra
                   $compra->setid_Producto($producto->getId());
                   $compra->setid_Vendedor($producto->getIdV());
                   $compra->setid_Usuario($_GET['id_Usuario']);
                   $compra->settotal($_GET['total']);
                  //con la ayuda del crud de compra y el folio que pasaron por el url, se obtienen las compras que ya existan en la tabla de la db
                   $compras=$crud_compra->obtenerCompra($_GET['Folio']);
                   if($compras->getid_Producto()==NULL) $crud_compra->insertar($compra);// verifica que haya algo en arreglo compras si no lo hay se inserta una nueva compra
                    else
                        $crud_compra->actualizar($compra); //si ya existia la compra con el mismo folio, entonces solo se actualiza la info como el total y demas. 
                }
               $compra=$crud_compra->obtenerCompra($_GET['Folio']);//y se obtiene la info para plasmarla al usuario.
       ?>
        <h1 style="color: #199FE2"><?php echo "¡Felicidades! <br> Tu compra fue agendada. <br> Ahora solo deberas depositar el monto exacto con tu numero de folio en tu banco mas cercano.";?></h3>
        <h1><?php echo "Folio: ".$compra->getFolio();?></h3>
        <h1> <?php echo "Total: $".$compra->gettotal();?> </h2>
        
        </div>

</body>
</html>