<?php 
require_once('../config/config.php');
require_once('../config/funciones.php');
//dd($_POST);

$erroes_checkout = [];
//-----------VALIDAMOS EL NOMBRE-------------------------------------

if (empty($_POST['nombre']) || (trim($_POST['nombre']) == '')) {
    $erroes_checkout['nombre'] = 'El nombre no puede estar vacío';
} elseif (strlen($_POST['nombre']) > 80)  {
    $erroes_checkout['nombre'] = 'El nombre no puede superar los 80 caracteres';
}

//-----------VALIDAMOS EL APELLIDO-------------------------------------
if (empty($_POST['apellido']) || (trim($_POST['apellido']) == ''))
    $erroes_checkout ['apellido'] = 'El apellido no puede estar vacío';
 elseif (strlen($_POST['apellido']) > 80) 
    $erroes_checkout['apellido'] = 'El apellido no puede tener más de 80 caracteres';

//---------------VALIDAMOS EL EMAIL-------------------------------------------- 
if (empty($_POST['email']) || (trim($_POST['email']) == '')) {
    $erroes_checkout ['email'] = 'El email no puede estar vacío';
}
 elseif (strlen($_POST['email']) > 100) 
          $erroes_checkout ['email'] = 'El email no puede exeder los 100 caracteres';


//-----------------VALIDAMOS EL NOMBRE DEL USUARIO----------------------

if (empty($_POST['usuario']) || (trim($_POST['usuario']) == '')) {
    $erroes_checkout ['usuario'] ='El nombre no puede estar vacío';
}
elseif (strlen($_POST['usuario']) > 60) {
            $erroes_checkout ['usuario'] = 'El nombre de usuario no puede exeder los 60 caracteres';
} 

//--------------------VALIDAMOS LA DIRECCION---------------------------------

if (empty($_POST['casa']) || (trim($_POST['casa']) == '')) {
    $erroes_checkout['casa'] = 'La direccion no puede estar vacío';
} elseif (strlen($_POST['casa']) > 80)  {
    $erroes_checkout['casa'] = 'La direccion no puede superar los 80 caracteres';
}

//--------------------VALIDAMOS EL PAIS---------------------------------

if (empty($_POST['pais'])) {
    $erroes_checkout['pais'] = 'El pais no puede estar vacío';
} 

//--------------------VALIDAMOS LA PROVINCIA---------------------------------

if (empty($_POST['provincia'])) {
    $erroes_checkout['provincia'] = 'La provincia no puede estar vacía';
} 

//--------------------VALIDAMOS EL CODIGO POSTAL---------------------------------

if (empty($_POST['codigo'])) {
    $erroes_checkout['codigo'] = 'El codigo postal no puede estar vacío';
} 

//-------------------------------------------------------------------------------VALIDAMOS LA TARJETA----------------------------------------------------------

//-----------------VALDAMOS EL NUMERO DE LA TARJETA---------------------

if (empty($_POST['numero_tarjeta']) || (trim($_POST['numero_tarjeta']) == '')) {
    $erroes_checkout['numero_tarjeta'] = 'El numero de la tarjeta no puede estar vacío';
}

//-----------------VALDAMOS EL AÑO---------------------

if (empty($_POST['year'])) {
    $erroes_checkout['year'] = 'El año no puede estar vacío';
}

//-----------------VALDAMOS EL MES---------------------

if (empty($_POST['mes'])) {
    $erroes_checkout['mes'] = 'El mes no puede estar vacío';
}

//-----------------VALDAMOS EL NOMBRE DEL TITULAR---------------------

if (empty($_POST['titular']) || (trim($_POST['titular']) == '')) {
    $erroes_checkout['titular'] = 'El nombre del titular no puede estar vacío';
}

//-----------------VALDAMOS EL NOMBRE CVV---------------------

if (empty($_POST['cvv']) || (trim($_POST['cvv']) == '')) {
    $erroes_checkout['cvv'] = 'El cvv no puede estar vacío';
}

//-------------------------------CONTAMOS LOS ERROES------------------------------------

if (count($erroes_checkout)) {
    $erroresJson = json_encode($erroes_checkout);

    //dd($erroes_checkout);

    header("Location: ../index.php?seccion=checkout&status=error&campos=$erroresJson");
    exit;

} else {
    header("Location: ../index.php?seccion=resumen_compra&status=ok");
    exit;
}













?>