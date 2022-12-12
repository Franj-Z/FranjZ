<?php 
require_once('../config/config.php');
require_once('../config/funciones.php');


//dd($_POST);

$errores_form = [];

//--------VALIDAMOS EL NOMBRE----------------------------------
if (empty($_POST['nombre']) || (trim($_POST['nombre']) == '')) 
    $errores_form ['nombre'] = 'El nombre no puede estar vacío';
elseif (strlen($_POST['nombre']) > 80) 
    $errores_form['nombre'] = 'El nombre no puede tener más de 80 caracteres';

//-----------VALIDAMOS EL APELLIDO-------------------------------------
if (empty($_POST['apellido']) || (trim($_POST['apellido']) == ''))
    $errores_form ['apellido'] = 'El apellido no puede estar vacío';
 elseif (strlen($_POST['apellido']) > 80) 
    $errores_form['apellido'] = 'El apellido no puede tener más de 80 caracteres';


//---------------VALIDAMOS EL EMAIL-------------------------------------------- 
if (empty($_POST['email']) || (trim($_POST['email']) == ''))
    $errores_form ['email'] = 'El email no puede estar vacío';


//--------VALIDAMOS EL NOMBRE----------------------------------
if (empty($_POST['comentario']) || (trim($_POST['comentario']) == '')) 
    $errores_form ['comentario'] = 'El nombre no puede estar vacío';


//------------------VALIDAMOS LOS ERROES-----------------------

if (count($errores_form)) {
    $erroresJson = json_encode($errores_form);

    //dd($erroes_checkout);

    header("Location: ../index.php?seccion=contactos&status=error&campos=$erroresJson");
    exit;

} else {
    header("Location: ../index.php?seccion=contactos&status=ok");
    exit;
}
























?>