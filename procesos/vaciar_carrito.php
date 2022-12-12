<?php 
require_once('../config/config.php');
require_once('../config/funciones.php');

//dd($_REQUEST);

if(isset($_REQUEST['item'])) {
    $id_producto = $_REQUEST['item'];
    unset($_SESSION['carrito'][$id_producto]);

    header('Location:../index.php?seccion=carrito&status=ok');
    exit;
            
}
else {
    header('Location:../index.php?seccion=carrito&status=error');
}

if(isset($_REQUEST['vaciar'])) {         
    unset($_SESSION['carrito']);  
       
    header('Location:../index.php?seccion=carrito');
    exit;
}


else {
    header('Location:../index.php?seccion=carrito&status=error');
}
   

?>