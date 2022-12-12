<?php

require_once("../../../Config/config.php");
require_once("../../../Config/funciones.php");


//print_r($_POST);
//die();

$erroresFormu = [];

if (empty($_POST['nombre']) || (trim($_POST['nombre']) == '')) {
    $erroresFormu ['nombre'] = 'El nombre no puede estar vacío';
}elseif(strlen($_POST['nombre']) > 80) {
    $erroresFormu['nombre'] = 'El nombre no puede superar los 80 caracteres';
}

if (empty($_POST['precio'])) {
    $erroresFormu ['precio'] = 'El campo precio no puede estar vacío';
}

if (empty($_POST['descripcion']) || (trim($_POST['descripcion']) == '')) {
    $erroresFormu ['descripcion'] = 'El campo descripción no puede estar vacío';
} elseif (strlen($_POST['descripcion']) > 700) {
    $erroresFormu['descripcion'] = 'El campo descripción no pude superar los 700 caracteres';
}

if (empty($_POST['pasos']) || (trim($_POST['pasos']) == '')) {
    $erroresFormu ['pasos'] = 'El campo pasos no puede estar vacío';
}elseif(strlen($_POST['pasos']) > 700){
    $erroresFormu['pasos'] = 'El campo pasos no puede superar los 700 caracteres';
}

if (empty($_POST['fecha'])) {
    $erroresFormu ['fecha'] = 'Debes seleccionar una fecha';
}

if(empty($_POST['direccion']) || (trim($_POST['direccion']) == '')) {
    $erroresFormu ['direccion'] = 'Debes agregarle una direccion de video';
}

if (empty($_POST['sagas'])) {
    $erroresFormu ['sagas'] = 'Debes seleccionar una Saga';
}

if (empty($_POST['dificultad'])) {
    $erroresFormu ['dificultad'] = 'Debes seleccionar una Dificultad';
}

if (empty($_POST['materiales'])) {
    $erroresFormu ['materiales'] = 'Debes seleccionar los materiales';
}

if (empty($_POST['herramientas'])) {
$erroresFormu ['herramientas'] = 'Debes seleccionar las Herramientas';
}

if (count($erroresFormu)) {
    $erroresJson = json_encode($erroresFormu);

    header("Location: ../../index.php?seccion=proyectos_añadir&status=error&campos=$erroresJson");

}

$imagenNombre = null;

if (!empty($_FILES['portada'])) {
   $imagen= $_FILES['portada'];

   if ($imagen['type'] != "image/jpeg") {
    $erroresFormu['portada'] = 'Debes subir una imagen de tipo .jpg';

    $erroresJson = json_encode($erroresFormu);
    
    header("Location: ../../index.php?seccion=proyectos_añadir&status=error&campos=$erroresJson");
    exit;
}

if ($imagen['type'] == "image/jpeg")
    $ext = '.jpg';

    $imagenNombre = basename(time() . $ext);
    move_uploaded_file($imagen['tmp_name'], "../../../Imagenes/Proyectos/$imagenNombre");

}


$imagenProductoNombre = null;

if (!empty($_FILES['productoImg'])) {
   $imagenProducto= $_FILES['productoImg'];

   if ($imagenProducto['type'] != "image/png") {
    $erroresFormu['productoImg'] = 'Debes subir una imagen de tipo .png';

    $erroresJson = json_encode($erroresFormu);
    
    header("Location: ../../index.php?seccion=proyectos_añadir&status=error&campos=$erroresJson");
    exit;
}

if ($imagenProducto['type'] == "image/png")
    $ext = '.png';

    $imagenProductoNombre = basename(time() . $ext);
    move_uploaded_file($imagenProducto['tmp_name'], "../../../Imagenes/Productos/$imagenProductoNombre");

}

// A BASE DE LO VALIDADO ANTERIORMENTE AHORA INSERTAMOS LOS DATOS A LA TABLA----------------------------------------------------

$nombre = mysqli_real_escape_string($cnx, $_POST['nombre']);
$descripcion = mysqli_real_escape_string($cnx, $_POST['descripcion']);
$pasos = mysqli_real_escape_string($cnx, $_POST['pasos']);
$portada = $imagenNombre ?? null;
$productoImg = $imagenProductoNombre ?? null;
$direccion = mysqli_real_escape_string($cnx, $_POST['direccion']);
$fecha = mysqli_real_escape_string($cnx, $_POST['fecha']);
$precio = mysqli_real_escape_string($cnx, $_POST['precio']);
$sagas_id_fk = mysqli_real_escape_string($cnx, $_POST['sagas']);
$dificultad_id_fk = mysqli_real_escape_string($cnx, $_POST['dificultad']);


$insertProyectos = "INSERT INTO proyectos (nombre, descripcion, pasos, portada, productoImg, direccion, fecha, precio, sagas_id_fk, dificultad_id_fk) 
                    VALUES ('$nombre', '$descripcion', '$pasos', '$portada', '$productoImg', '$direccion', '$fecha', '$precio', '$sagas_id_fk','$dificultad_id_fk')";

                    $rpta_insertProyectos = mysqli_query($cnx, $insertProyectos);

//HACEMOS LOS INSERTS A LAS TABLAS QUE UNEN A LOS PROYECTOS CON LOS MATERIALES-------------
    
if($rpta_insertProyectos) {
  
        $proyectos_id_fk = mysqli_insert_id($cnx);
        $materiales = $_POST['materiales'];
        $herramientas = $_POST ['herramientas'];

        $values = '';
            foreach ($materiales as $materiales_id_fk) {
            $values .= "($proyectos_id_fk,$materiales_id_fk),";
        }

        $value2 = '';
            foreach ($herramientas as $herramientas_id_fk) {
            $value2 .= "($proyectos_id_fk,$herramientas_id_fk),";
            }
        
        $values = substr($values, 0, -1);
        $values .= ';';

        $value2 = substr($value2, 0, -1);
        $value2 .= ';';
    
        $insertMateriales = "INSERT INTO proyectos_materiales (proyectos_id_fk, materiales_id_fk) 
        VALUES $values";
        $res_insertMateriales = mysqli_query($cnx, $insertMateriales);

        $insertHerramientas = "INSERT INTO proyectos_herramientas (proyectos_id_fk, herramientas_id_fk) 
        VALUES $value2";
        $res_insertHerramientas = mysqli_query($cnx, $insertHerramientas);


        if ($res_insertMateriales && $res_insertHerramientas ) {
            header("Location: ../../index.php?seccion=lista_proyectos&status=ok&accion=creado");
            exit;
        } else {
            header("Location: ../../index.php?seccion=lista_proyectos&status=error&tipo=materialesherramientas");
            exit;
        }

} else {
    header("Location: ../index.php?seccion=proyectos_añadir&status=error&tipo=proyecto");
    exit;
}
