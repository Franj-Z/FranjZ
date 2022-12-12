<?php

require_once("../../../Config/config.php");
require_once("../../../Config/funciones.php");

$id = $_POST['id'];
$proyecto_seleccionado = "SELECT * FROM proyectos WHERE proyectos_id=$id";
$res_proyecto_seleccionado = mysqli_query($cnx, $proyecto_seleccionado);

if (!$res_proyecto_seleccionado->num_rows) {
    header('Location: index.php?secciones=proyecto_añadir&status=error');
    exit;
}


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
    $erroresFormu['decripcion'] = 'El campo descripción no pude superar los 700 caracteres';
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

// EDITAR IMAGEN RPOYECTO SIN MODIFICAR LA ANTERIOR SI NO ELEGIMOS UNA NUEVA IMAGEN ---------------------------------------------
$imagenNombre = null;

if (!empty($_FILES['portada'])&& $_FILES['portada']['size'] > 0) {
   $imagen= $_FILES['portada'];

   if ($imagen['type'] != "image/jpeg") {
    $erroresFormu['portada'] = 'Debes subir una imagen de tipo .jpg';
}

if ($imagen['type'] == "image/jpeg")
    $ext = '.jpg';

    $imagenNombre = basename(time() . $ext);
    move_uploaded_file($imagen['tmp_name'], "../../../Imagenes/Proyectos/$imagenNombre");

$portada = $imagenNombre ?? null;
$insert_imagen = "UPDATE proyectos SET 
                portada='$portada'
                WHERE proyectos_id = $id";

        $rpta_imagen_portada = mysqli_query($cnx, $insert_imagen);
}

//IMAGEN DEL PRODUCTO --------------------------------------------

$imagenProductoNombre = null;

if (!empty($_FILES['productoImg'])&& $_FILES['productoImg']['size'] > 0) {
    $imagenProducto= $_FILES['productoImg'];
 
    if ($imagenProducto['type'] != "image/png") {
     $erroresFormu['productoImg'] = 'Debes subir una imagen de tipo .png';  
 }
 
 
 if ($imagenProducto['type'] == "image/png")
     $ext = '.png';
 
     $imagenProductoNombre = basename(time() . $ext);
     move_uploaded_file($imagenProducto['tmp_name'], "../../../Imagenes/Productos/$imagenProductoNombre");

$productoImg = $imagenProductoNombre ?? null;
$insert_imagen_producto = "UPDATE proyectos SET 
                productoImg='$productoImg'
                WHERE proyectos_id = $id";

        $rpta_imagen_producto = mysqli_query($cnx, $insert_imagen_producto);
 
 }

if (count($erroresFormu)) {
    $erroresJson = json_encode($erroresFormu);

    header("Location: ../../index.php?seccion=proyectos_añadir&id=$id&status=error&campos=$erroresJson");
    exit;
}


// A BASE DE LO VALIDADO ANTERIORMENTE AHORA EDITAMOS LOS DATOS A LA TABLA----------------------------------------------------

$nombre = mysqli_real_escape_string($cnx, $_POST['nombre']);
$descripcion = mysqli_real_escape_string($cnx, $_POST['descripcion']);
$pasos = mysqli_real_escape_string($cnx, $_POST['pasos']);
$direccion = mysqli_real_escape_string($cnx, $_POST['direccion']);
$fecha = mysqli_real_escape_string($cnx, $_POST['fecha']);
$precio = mysqli_real_escape_string($cnx, $_POST['precio']);
$sagas_id_fk = mysqli_real_escape_string($cnx, $_POST['sagas']);
$dificultad_id_fk = mysqli_real_escape_string($cnx, $_POST['dificultad']);


$insertProyectos = "UPDATE proyectos SET 
                                nombre='$nombre', 
                                descripcion='$descripcion', 
                                pasos='$pasos', 
                                direccion='$direccion', 
                                fecha='$fecha', 
                                precio=$precio,
                                sagas_id_fk='$sagas_id_fk',
                                dificultad_id_fk='$dificultad_id_fk' 
                    WHERE proyectos_id = $id";

                    $rpta_insertProyectos = mysqli_query($cnx, $insertProyectos);


//HACEMOS LOS INSERTS A LAS TABLAS QUE UNEN A LOS PROYECTOS CON LOS MATERIALES-------------
    
if($rpta_insertProyectos) {
    
    $select_mate_proyecto = "SELECT materiales_id_fk FROM proyectos_materiales WHERE proyectos_id_fk=$id";
    $res_select_mate_proyecto = mysqli_query($cnx, $select_mate_proyecto);
    while ($proyect_material_res = mysqli_fetch_assoc($res_select_mate_proyecto)) {
        $proyecto_material[] = $proyect_material_res['materiales_id_fk'];
    }

    $select_herr_proyecto = "SELECT herramientas_id_fk FROM proyectos_herramientas WHERE proyectos_id_fk=$id";
    $res_select_herr_proyecto = mysqli_query($cnx, $select_herr_proyecto);
    while ($proyect_herramienta_res = mysqli_fetch_assoc($res_select_herr_proyecto)) {
        $proyecto_herramienta[] = $proyect_herramienta_res['herramientas_id_fk'];
    }

    $materialEliminar = array_diff($proyecto_material, $_POST['materiales']);
    $materialAgregar = array_diff($_POST['materiales'], $proyecto_material);
    
    $herramientaEliminar = array_diff($proyecto_herramienta, $_POST['herramientas']);
    $herramientaAgregar = array_diff($_POST['herramientas'], $proyecto_herramienta);

    if (!count($materialAgregar) && !count($materialEliminar) && !count($herramientaAgregar) && !count($herramientaEliminar)) {
        header("Location: ../../index.php?seccion=lista_proyectos&status=ok&accion=editado");
        exit;
    }

    if(count($materialAgregar)); {
        
        $values_agregar_material = '';
        foreach ($materialAgregar as $materiales_id_fk) {
            $values_agregar_material .= "($id,$materiales_id_fk),";
        }
        $values_agregar_material = substr($values_agregar_material, 0, -1);
        $values_agregar_material .= ';';

        $insert_material = "INSERT INTO proyectos_materiales (proyectos_id_fk, materiales_id_fk)
        VALUES $values_agregar_material";
        $res_insert_material = mysqli_query($cnx, $insert_material);
    }

    if(count($herramientaAgregar)); {
        
        $values_agregar_herramienta = '';
        foreach ($herramientaAgregar as $herramientas_id_fk) {
            $values_agregar_herramienta .= "($id,$herramientas_id_fk),";
        }
        $values_agregar_herramienta = substr($values_agregar_herramienta, 0, -1);
        $values_agregar_herramienta .= ';';

        $insert_herramienta = "INSERT INTO proyectos_herramientas (proyectos_id_fk, herramientas_id_fk)
        VALUES $values_agregar_herramienta";
        $res_insert_herramienta = mysqli_query($cnx, $insert_herramienta);
    }

    if(count($materialEliminar)); {
        
        $values_eliminar_material = '';
        foreach ($materialEliminar as $materiales_id_fk) {
            $values_eliminar_material .= "materiales_id_fk = $materiales_id_fk OR ";
        }
        $values_eliminar_material = substr($values_eliminar_material, 0, -4);
        $values_eliminar_material .= ';';

        $eliminar_materiales = "DELETE FROM proyectos_materiales WHERE $values_eliminar_material";
        $res_eliminar_materiales = mysqli_query($cnx, $eliminar_materiales);
    }

    if(count($herramientaEliminar)); {
        
        $values_eliminar_herramienta = '';
        foreach ($herramientaEliminar as $herramientas_id_fk) {
            $values_eliminar_herramienta .= "herramientas_id_fk = $herramientas_id_fk OR ";
        }
        $values_eliminar_herramienta = substr($values_eliminar_herramienta, 0, -4);
        $values_eliminar_herramienta .= ';';

        $eliminar_herramientas = "DELETE FROM proyectos_herramientas WHERE $values_eliminar_herramienta";
        $res_eliminar_herramientas = mysqli_query($cnx, $eliminar_herramientas);
    }
    
    if ($res_insert_material || $res_eliminar_materiales || $res_insert_herramienta || $res_eliminar_herramientas) {
        header("Location: ../../index.php?seccion=lista_proyectos&status=ok&accion=editado");
        exit;
    } else {
        header("Location: ../../index.php?seccion=lista_proyectos&status=error&tipo=materialesherramientas");
        exit;
    }

   
} else {
    header("Location: ../../index.php?seccion=proyectos_añadir&id=$id&status=error&tipo=proyecto");
    exit;
}
