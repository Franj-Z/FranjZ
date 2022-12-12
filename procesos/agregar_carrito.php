<?php 
require_once('../config/config.php');
require_once('../config/funciones.php');
//dd($_POST);
$errores_validacion = [];

if(empty($_POST['id'])){
    $errores_validacion['id'] = 'No se puede enviar un producto sin id';
}
if(empty($_POST['nombre'])){
    $errores_validacion['nombre'] = 'No se puede enviar un producto sin nombre';
}
if(empty($_POST['precio'])){
    $errores_validacion['precio'] = 'No se puede enviar un producto sin precio';
}
if(empty($_POST['portada'])){
    $errores_validacion['portada'] = 'No se puede enviar un producto sin portada';
}
if(empty($_POST['cantidad'])){
    $errores_validacion['cantidad'] = 'No se puede enviar un producto sin cantidad';
}
elseif ($_POST['cantidad'] <= 0 ){
    $errores_validacion['cantidad'] ='La cantidad no puede ser negativa';
}
if(count($errores_validacion)){
    $erroresJson = json_encode($errores_validacion);
    
    header('Location: ../index.php?seccion=tienda&status=error');
    exit;
}

if(isset($_POST['agregar'])){
    $id_producto = $_POST['id'];
    $producto_agregado = $_POST['nombre'];
    $precio = $_POST['precio'];
    $portada = $_POST['portada'];
    $cantidad = $_POST['cantidad'];

    $_SESSION['carrito'][$id_producto]['nombre'] = $producto_agregado;
    $_SESSION['carrito'][$id_producto]['precio'] = $precio;
    $_SESSION['carrito'][$id_producto]['portada'] = $portada;
    $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;


    header('Location:../index.php?seccion=tienda&status=ok');


}


//dd($producto_agregado);
?>