<?php
require_once('../config/config.php');
require_once('../config/funciones.php');

//dd($_POST);

$errores = [];

//----------------------------Validacion Nombre-------------------------------------------
if(empty($_POST['nombre']) || (trim($_POST['nombre']) == ''))
    $errores ['nombre'] = 'El nombre no puede estar vacio';
elseif (strlen($_POST['nombre']) > 80)
    $errores['nombre'] = 'El nombre no puede tener más de 80 caracteres';


//------------------------Validacion apellido------------------------------------------------
if(empty($_POST['apellido']) || (trim($_POST['apellido']) == ''))
    $errores ['apellido'] = 'El apellido no puede estar vacio';
elseif (strlen($_POST['apellido']) > 80)
    $errores['apellido'] = 'El  apellido no puede tener más de 80 caracteres';


//------------------------------Validacion nombre ususario-------------------------------
if(empty($_POST['usuario']) || (trim($_POST['usuario']) == ''))
$errores ['usuario'] = 'El usuario no puede estar vacio';
else {
$selec_usuario = "SELECT usuario FROM usuarios  WHERE usuario = '$_POST[usuario]' ";
$res_selec_usuario = mysqli_query($cnx, $selec_usuario);

if($res_selec_usuario ->num_rows)
    $errores['usuario'] = 'El usuario ya existe';
    
    elseif (strlen($_POST['usuario']) > 60) 
        $errores ['usuario'] = 'El nombre de usuario no puede exeder los 60 caracteres';
}


//-----------------------Validacion Email------------------------------------------------------
if(empty($_POST['email']) || (trim($_POST['email']) == ''))
    $errores ['email'] = 'El email no puede estar vacio';
    else {
        $selec_email = "SELECT email FROM usuarios  WHERE email = '$_POST[email]' ";
        $res_selec_email = mysqli_query($cnx, $selec_email);
    
        if($res_selec_email -> num_rows)
            $errores['email'] = 'El email ya esta registrado';
            
            elseif (strlen($_POST['email']) > 100) 
                $errores ['email'] = 'El  email no puede exeder los 100 caracteres';
    }

//----------------------Validacion Contraseña---------------------------------------------------

if(empty($_POST['password']) || (trim($_POST['password']) == ''))
    $errores ['password'] = 'La contraseña no puede estar vacia';
elseif (strlen($_POST['password']) < 4)
    $errores['password'] = 'La contraseña debe contener mínimo 4 caracteres';

//---------------------------Validaciones totales-----------------------------------------

if(count($errores)){
    $_SESSION['errores'] = $errores;
    $_SESSION['campos_correctos'] = $_POST;


    header("Location: ../index.php?seccion=registro");
    exit;
}

//-----------------------Insertamos los datos-----------------------------------------------------------------------------

$nombre = mysqli_real_escape_string($cnx, $_POST['nombre']);
$apellido = mysqli_real_escape_string($cnx, $_POST['apellido']);
$email = mysqli_real_escape_string($cnx, $_POST['email']);
$usuario = mysqli_real_escape_string($cnx, $_POST['usuario']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT );



$insert = "INSERT INTO usuarios (nombre, apellido, email, usuario, password, usuario_tipo_id_fk, avatar_id_fk) 
                      VALUES ('$nombre', '$apellido', '$email', '$usuario', '$password' , '2', '1');";

$res_insert = mysqli_query($cnx, $insert);


if ($res_insert){

    unset($_SESSION['errores']);
    unset($_SESSION['campos_correctos']);
    
    $_SESSION['ok'] = 'Gracias!! Ya puedes iniciar sesión';
    header('Location:../index.php?seccion=login');
}else{
    
    $_SESSION['campos_correctos'] = $_POST;
    unset($_SESSION['errores']);


    header('Location:../index.php?seccion=registro&status=error');

}



