<?PHP 
//llamo la clase clientes y el crud para obtener sus datos para vincularlos a el carrito de compras. 
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
    $crud_compra= new CrudCompra();
    $compra= new Compra();
    require_once('../carritoCompra/crud_carrito.php');
    require_once('../carritoCompra/carrito.php');
    $crud_carrito= new CrudCarrito();
    $carrito= new Carrito();
    $subtotal[]=0;
    $cad="";
    $bandera=0;
    $total;
    $newcarro= new Carrito();
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
    <title>Carrito de compras de Iluminaria</title>
</head>
<body>
    <header class="contenedor-header">
        <img class="logo" src="../img/logo.png">
        <div class="buscador-grid">
        <?PHP 
                    // recibo el id del usuario y lo concateno en una cadena que sera el auxiliar del folio
        //$cad es el folio
                $cad=$cad.$_GET['id_Usuario']."_";
                //Si existe el Id del usuario muestra el nombre del usuario
                if(isset($_GET['id_Usuario'])&& isset($_GET['id_prod'])&&isset($_GET['num_art'])){ 
                    //recupero la informacion que exista en el carrito de compra con el id del usuario
                    $carros=$crud_carrito->mostrar_carrito($_GET['id_Usuario']);
                    //obtengo la informacion del cliente con el id de usuario
                    $cliente=$crud_cliente->obtenerCliente($_GET['id_Usuario']);
                    //instancio un nuevo objeto carro de compra 
                    
                    $newcarro->setId_producto($_GET['id_prod']); //seteo el id del producto en los datos del carrito de compras.
                    $newcarro->setId_user($_GET['id_Usuario']); //seteo el id del usuario para el carrito
                    $newcarro->set_cantidad($_GET['num_art']);//igual la cantidad del mismo tipo de articulo que lleva en el carrito
                    //como en la linea 48 recupero datos (si es que los hay) de la tabla del carrito de compras
                    echo '<h1>Bienvenido/a '.$cliente->getNombre().' '.$cliente->getApellidos().'</h1>';
                    
                    //para evitar que se hagan inserciones y actualizaciones que no queremos, quito del url los parametros que pase desde la vista de productos
                    IF ($carros==null)$bandera=0;
                    else {
                        foreach ($carros as $carrito){
                            $producto=$crud_producto->obtenerProducto($carrito->getId_producto()); 
                            if(isset($_GET['id_prod'])){
                                if($producto->getId()==$_GET['id_prod'])
                                    $bandera=1;
                                 
                            }
                        }
                    }
                    if($bandera==1) $crud_carrito->actualizar($newcarro);                
                    elseif($bandera==0) $crud_carrito->insertar($newcarro);     
                    header("Location:index.php?id_Usuario=".$_GET['id_Usuario']);
                    }else{
                    if(isset($_GET['id_Usuario'])){ //como en la linea 66 elimine los demas parametros que pase y solo deje el id del usuario
                        //con esto solo vamos a imprimir lo que tiene la tabla carrito de compras
                        $carros=$crud_carrito->mostrar_carrito($_GET['id_Usuario']); //recupero la informacion que exista en el carrito de compra con el id del usuario
                        $cliente=$crud_cliente->obtenerCliente($_GET['id_Usuario']);  //obtengo la informacion del cliente con el id de usuario
                        echo '<h1>Bienvenido/a '.$cliente->getNombre().' '.$cliente->getApellidos().'</h1>';
                    }
                }
            ?>
        </div>
        
    </header>

    <div class="contenedor-navegacion">
        <nav class="navegacion-principal">
            <?PHP 
            
            ?>
            <a href="../index.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Inicio</a>
            <a href="../productos/interior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación interior</a>
            <a href="../productos/exterior.php<?PHP if(isset($_GET['id_Usuario'])){ echo "?id_Usuario=",$_GET['id_Usuario']; } ?>">Iluminación exterior</a>
            <?PHP 
                if(isset($_GET['id_Usuario'])) echo '<a href="../clientes/administrar_cliente.php?accion=s">Cerrar sesión</a>';
                else echo '<a href="../login/formulario.html">Iniciar sesión</a>';
            ?>
        </nav>
    </div>
    <div id="title">
        <h1>Carrito</h1>
    </div>
    <?PHP 
    //----------------  ahora en este bucle, se imprimen los datos recuperados en la linea 70 ---------------------------------------------    
    foreach ($carros as $carrito):?>
    <div class="contenedor" id="producto">
        
        <?php 
        //con el objeto carrito y la ayuda del crud de producto, en un objeto producto almacenare los datos que recupere con el id del producto almacenado en el carrito
        $producto=$crud_producto->obtenerProducto($carrito->getId_producto()); 

                //se concatena el id del producto al folio o $cad.
              $cad= $cad.$producto->getId();
              
                        
        ?>
        <div class="contenedor-img">
            <h2 id="Precio" hidden> <?php echo $producto->getId();?> </h2>
            <img class="img" src="<?php echo $producto->getURL() ?>" >
            <h3 id="Descripcion"><?php echo $producto->getNombre();?></h3>
            <h2 id="Precio"> <?php echo "$".$producto->getPrecio();?> </h2>
            <?php if($producto->getDescuento()>0){ 
                        $precioD=$producto->getPrecio()*((100-$producto->getDescuento())/100); ?> 
                        <h2 style="color:red;" id="Precio">Oferta $<?php echo $precioD; ?> </h2> 
                    <?php } ?>
            <p id="Disp"><?php if($producto->getStock()>0) echo "Disponible";else echo "No Disponible";?></p>
        </div>
        <div style="
            font-size: 120%; font-family: Arial; border: 5px outset #E2C219; background-color: white; text-align: center;"><?php echo $producto->getCaracteristicas();?></div>
        <br>
        <form method="POST">
            
            <h2> <?php echo "Cantidad: <br> ".$carrito->get_cantidad() ; ?> </h2>
            <a href="borrar.php?id_Usuario=<?php echo $_GET['id_Usuario'];?> & id_Producto=<?php echo $producto->getId();?>"><input type="button" id="eliminar" name="eliminar" class="quitarProd" value="Eliminar"></a>
        </form>
         <?php
            //se configura el funcionamiento del boton conf que confirma la cantidad de articulos que se compraran
               
    ?>
        <?php 
        if($producto->getDescuento()>0){
            $precioD=$producto->getPrecio()*((100-$producto->getDescuento())/100);
            $subtotal[]=($carrito->get_cantidad()* floatval($precioD));
        }else
        $subtotal[]=($carrito->get_cantidad()* floatval($producto->getPrecio()));//se acumula todos los costos del carrito
        ?>
        
    </div>
    <?php  endforeach;?>
    
    <div style="margin: 2px auto; text-align: center;">
         
        
        <h2 style="text-align: center;" id="subtotal">
            <?php 
                
                $total= array_sum($subtotal);
                echo "Total a pagar: <br>$".$total."<br> folio: ".$cad;//se publica el total. 
                ?>
        </h2>
        <form name="confirmar_compra" method="POST">
            
            <a href="compra_view.php?Folio=<?php echo $cad?> & id_Usuario=<?php echo $_GET['id_Usuario'];?>& total=<?php echo $total;?>">
                <!--se mandan los datos necesarios para la vista de la compra y que se procesen como el folio, el total y el id de usuario -->
                <input  type='button' name='pago' id='pago' value='Pagar'>
            </a>
        </form>
        
    </div>
</body>
</html>