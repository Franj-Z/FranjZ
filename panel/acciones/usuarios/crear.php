<?php
require_once("../../../Config/config.php");
require_once("../../../Config/funciones.php");

$erroresFormu = [];

//dd($_POST);
//----------------------------Validacion Nombre-------------------------------------------
if(empty($_POST['nombre']) || (trim($_POST['nombre']) == ''))
    $erroresFormu ['nombre'] = 'El nombre no puede estar vacio';
elseif (strlen($_POST['nombre']) > 80)
    $erroresFormu['nombre'] = 'El nombre no puede tener más de 80 caracteres';


//------------------------Validacion apellido------------------------------------------------
if(empty($_POST['apellido']) || (trim($_POST['apellido']) == ''))
    $erroresFormu ['apellido'] = 'El apellido no puede estar vacio';
elseif (strlen($_POST['apellido']) > 80)
    $erroresFormu['apellido'] = 'El  apellido no puede tener más de 80 caracteres';


//------------------------------Validacion nombre ususario-------------------------------
if(empty($_POST['usuario']) || (trim($_POST['usuario']) == ''))
$erroresFormu ['usuario'] = 'El usuario no puede estar vacio';
else {
$selec_usuario = "SELECT usuario FROM usuarios  WHERE usuario = '$_POST[usuario]' ";
$res_selec_usuario = mysqli_query($cnx, $selec_usuario);

if($res_selec_usuario ->num_rows)
    $erroresFormu['usuario'] = 'El usuario ya existe';
    
    elseif (strlen($_POST['usuario']) > 60) 
        $erroresFormu ['usuario'] = 'El nombre de usuario no puede exeder los 60 caracteres';
}


//-----------------------Validacion Email------------------------------------------------------
if(empty($_POST['email']) || (trim($_POST['email']) == ''))
    $erroresFormu ['email'] = 'El email no puede estar vacio';
    else {
        $selec_email = "SELECT email FROM usuarios  WHERE email = '$_POST[email]' ";
        $res_selec_email = mysqli_query($cnx, $selec_email);
    
        if($res_selec_email -> num_rows)
            $erroresFormu['email'] = 'El email ya esta registrado';
            
            elseif (strlen($_POST['email']) > 100) 
                $erroresFormu ['email'] = 'El  email no puede exeder los 100 caracteres';
    }

//----------------------Validacion Contraseña---------------------------------------------------

if(empty($_POST['password']) || (trim($_POST['password']) == ''))
    $erroresFormu ['password'] = 'La contraseña no puede estar vacia';
elseif (strlen($_POST['password']) < 4)
    $erroresFormu['password'] = 'La contraseña debe contener mínimo 4 caracteres';


//----------------------Validacion Contraseña---------------------------------------------------

if(empty($_POST['avatar']))
    $erroresFormu ['avatar'] = 'El avatar no puede estar vacío';

//----------------------Validacion Contraseña---------------------------------------------------

if(empty($_POST['usuario_tipo']))
    $erroresFormu ['usuario_tipo'] = 'El tipo de usuario no puede estar vacío';

//------------------------------Validamos  los errores---------------------------------
if (count($erroresFormu)) {
    $erroresJson = json_encode($erroresFormu);

    header("Location: ../../index.php?seccion=usuarios_añadir&status=error&campos=$erroresJson");
    exit;

}

//-----------------------Insertamos los datos-----------------------------------------------------------------------------

$nombre = mysqli_real_escape_string($cnx, $_POST['nombre']);
$apellido = mysqli_real_escape_string($cnx, $_POST['apellido']);
$email = mysqli_real_escape_string($cnx, $_POST['email']);
$usuario = mysqli_real_escape_string($cnx, $_POST['usuario']);
$tipo_usuario = mysqli_real_escape_string($cnx, $_POST['usuario_tipo']);
$avatar = mysqli_real_escape_string($cnx, $_POST['avatar']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT );


$insert = "INSERT INTO usuarios (nombre, apellido, email, usuario, password, usuario_tipo_id_fk, avatar_id_fk) 
                      VALUES ('$nombre', '$apellido', '$email', '$usuario', '$password' , '$tipo_usuario', '$avatar');";

$res_insert = mysqli_query($cnx, $insert);

if ($res_insert ){
    header("Location: ../../index.php?seccion=lista_usuarios&status=ok&accion=creado");
    exit;
} else {
header("Location: ../../index.php?seccion=usuarios_añadir&status=error&tipo=usuario");
exit;
}
































?>