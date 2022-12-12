<?php
require_once("../../../Config/config.php");
require_once("../../../Config/funciones.php");

$id = $_POST['id'];
$usuario_seleccionado = "SELECT * FROM usuarios WHERE usuario_id=$id";
$res_usuario_seleccionado = mysqli_query($cnx, $usuario_seleccionado);

if (!$res_usuario_seleccionado->num_rows) {
    header('Location: index.php?secciones=usuarios_añadir&status=error');
    exit;
}
$erroresFormu = [];
//dd($erroresFormu);
//Validacion campo nombre-----------------------------------------------------------------

if(empty($_POST['nombre']) || (trim($_POST['nombre']) == '')) {
    $erroresFormu ['nombre'] = 'El nombre no puede estar vacio';
}
elseif (strlen($_POST['nombre']) > 80){
    $erroresFormu['nombre'] = 'El nombre no puede tener más de 80 caracteres';
}

//Validacion campo apellido-----------------------------------------------------------------

if(empty($_POST['apellido']) || (trim($_POST['apellido']) == '')) {
    $erroresFormu ['apellido'] = 'El apellido no puede estar vacio';
}
elseif (strlen($_POST['apellido']) > 80) {
    $erroresFormu['apellido'] = 'El apellido no puede tener más de 80 caracteres';
}


//Validacion campo nombre de usuario-----------------------------------------------------------------

if(empty($_POST['usuario']) || (trim($_POST['usuario']) == '')) {
$erroresFormu ['usuario'] = 'El usuario no puede estar vacio';
}
else {
$selec_usuario = "SELECT usuario FROM usuarios  WHERE usuario = '$_POST[usuario]' NOT LIKE usuario_id = $id ";
$res_selec_usuario = mysqli_query($cnx, $selec_usuario);

if($res_selec_usuario ->num_rows)
    $erroresFormu['usuario'] = 'El usuario ya existe';
    
    elseif (strlen($_POST['usuario']) > 60) 
        $erroresFormu ['usuario'] = 'El nombre de usuario no puede exeder los 60 caracteres';
}

//-----------------------Validacion Email------------------------------------------------------
if(empty($_POST['email']) || (trim($_POST['email']) == '')){
    $erroresFormu ['email'] = 'El email no puede estar vacio';
}
else {
        $selec_email = "SELECT email FROM usuarios  WHERE email = '$_POST[email]' NOT LIKE usuario_id = $id ";
        $res_selec_email = mysqli_query($cnx, $selec_email);
    
        if($res_selec_email -> num_rows)
            $erroresFormu['email'] = 'El email ya esta registrado';
            
            elseif (strlen($_POST['email']) > 100) 
                $erroresFormu ['email'] = 'El  email no puede exeder los 100 caracteres';
    }

    //dd($selec_email);

//---------Validacion tipo de usuario---------------------------------------------------

if (empty($_POST['usuario_tipo'])) {
    $erroresFormu ['usuario_tipo'] = 'Debes seleccionar un tipo de usuario';
}

//---------Validacion Avatar---------------------------------------------------

if (empty($_POST['avatar'])) {
    $erroresFormu ['avatar'] = 'Debes seleccionar un Avatar para el usuario';
}

//----------------------Validacion Contraseña---------------------------------------------------

if(empty($_POST['password']) || (trim($_POST['password']) == ''))
    $erroresFormu ['password'] = 'La contraseña no puede estar vacia';
elseif (strlen($_POST['password']) < 4)
    $erroresFormu['password'] = 'La contraseña debe contener mínimo 4 caracteres';

//-----------------------Validaciones totales--------------------------------------------------


if (count($erroresFormu)) {
    $erroresJson = json_encode($erroresFormu);

    header("Location: ../../index.php?seccion=usuarios_añadir&id=$id&status=error&campos=$erroresJson");
    exit;
}


//------------------a base de lo validados vamos a actualizar los datos en la base de datos------------------------------------

$nombre = mysqli_real_escape_string($cnx, $_POST['nombre']);
$apellido = mysqli_real_escape_string($cnx, $_POST['apellido']);
$usuario = mysqli_real_escape_string($cnx, $_POST['usuario']);
$email = mysqli_real_escape_string($cnx, $_POST['email']);
$usuario_tipo = mysqli_real_escape_string($cnx, $_POST['usuario_tipo']);
$avatar = mysqli_real_escape_string($cnx, $_POST['avatar']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT );



$query_editar_usu = "UPDATE usuarios SET 
                                    nombre = '$nombre',
                                    apellido = '$apellido',
                                    usuario = '$usuario',
                                    email = '$email', 
                                    usuario_tipo_id_fk = '$usuario_tipo',
                                    avatar_id_fk = '$avatar',
                                    password = '$password'
                    WHERE usuario_id = $id";

$rpta_edit_usu = mysqli_query($cnx, $query_editar_usu);

//dd($query_editar_usu);
if ($rpta_edit_usu) {
    header("Location: ../../index.php?seccion=lista_usuarios&status=ok&accion=editado");
    exit;
}
 else {
    header("Location: ../../index.php?seccion=usuarios_añadir&id=$id&status=error&tipo=usuario");
    exit;

 }

















?>