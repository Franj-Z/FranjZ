<?php 
require_once('../config/config.php');
require_once('../config/funciones.php');

//dd($_POST);
$id = $_POST['id'];
$errores = []; 

//--------VALIDAMOS EL NOMBRE----------------------------------
if (empty($_POST['nombre']) || (trim($_POST['nombre']) == '')) 
    $errores ['nombre'] = 'El nombre no puede estar vacío';
elseif (strlen($_POST['nombre']) > 80) 
    $errores['nombre'] = 'El nombre no puede tener más de 80 caracteres';

//-----------VALIDAMOS EL APELLIDO-------------------------------------
if (empty($_POST['apellido']) || (trim($_POST['apellido']) == ''))
    $errores ['apellido'] = 'El apellido no puede estar vacío';
 elseif (strlen($_POST['apellido']) > 80) 
    $errores['apellido'] = 'El apellido no puede tener más de 80 caracteres';


//---------------VALIDAMOS EL EMAIL-------------------------------------------- 
if (empty($_POST['email']) || (trim($_POST['email']) == ''))
    $errores ['email'] = 'El email no puede estar vacío';
 else {
    $select_email = "SELECT email FROM usuarios WHERE email = '$_POST[email]' NOT LIKE usuario_id = $id";
    $res_select_email = mysqli_query($cnx, $select_email);

    if($res_select_email ->num_rows)
    $errores['email'] = 'El email ya existe';
    
    elseif (strlen($_POST['email']) > 100) 
        $errores ['email'] = 'El email no puede exeder los 100 caracteres';
}

//-----------------VALIDAMOS EL NOMBRE DEL USUARIO----------------------

if (empty($_POST['usuario']) || (trim($_POST['usuario']) == ''))
    $errores ['usuario'] ='El nombre no puede estar vacío';
 else {
    $selec_usuario = "SELECT usuario FROM usuarios  WHERE usuario = '$_POST[usuario]' NOT LIKE usuario_id = $id";
    $res_selec_usuario = mysqli_query($cnx, $selec_usuario);
    
    if($res_selec_usuario ->num_rows)
        $errores['usuario'] = 'El usuario ya existe';
        
        elseif (strlen($_POST['usuario']) > 60) 
            $errores ['usuario'] = 'El nombre de usuario no puede exeder los 60 caracteres';
    }


//---------VALIDAMOS EL AVATAR ---------------------------------------------------

if (empty($_POST['avatar'])) 
    $errores ['avatar'] = 'Debes seleccionar un Avatar para el usuario';


//---------------------------Validaciones totales-----------------------------------------
if(count($errores)){
    $_SESSION['errores'] = $errores;

    header("Location: ../index.php?seccion=editar_perfil");
    exit;
}

//ACTUALIZAMOS LOS DATOS----------------------------------------------------------

$nombre = mysqli_real_escape_string($cnx, $_POST['nombre']);
$apellido = mysqli_real_escape_string($cnx, $_POST['apellido']);
$email = mysqli_real_escape_string($cnx, $_POST['email']);
$usuario = mysqli_real_escape_string($cnx, $_POST['usuario']);
$avatar = mysqli_real_escape_string($cnx, $_POST['avatar']);


$query_editar_perfil = "UPDATE usuarios SET
                                    nombre = '$nombre',
                                    apellido = '$apellido',
                                    usuario = '$usuario',
                                    email = '$email', 
                                    avatar_id_fk = '$avatar'
                    WHERE usuario_id = $id";

$respuesta_editar_perfil = mysqli_query($cnx, $query_editar_perfil);
$usuario_editado =  mysqli_fetch_assoc($respuesta_editar_perfil);



if ($respuesta_editar_perfil){

    unset($_SESSION['errores']);
    unset($_SESSION['usuario']);
    
    $usr = mysqli_real_escape_string($cnx, $_POST['usuario']);
    $select_usr_editado = "SELECT * FROM usuarios  
              LEFT JOIN avatars ON avatar_id_fk = avatar_id 
              WHERE usuario = '$usr'";
    $res_select_usr_editado = mysqli_query($cnx, $select_usr_editado);
    $usuario =  mysqli_fetch_assoc($res_select_usr_editado);
    
    $_SESSION['usuario'] = $usuario;
    $_SESSION['ok'] = 'Genial!! Tu perfil se actualizó con éxito';
    header('Location:../index.php?seccion=perfil');
}else{
    
    $_SESSION['campos_correctos'] = $_POST;
    unset($_SESSION['errores']);


    header('Location:../index.php?seccion=editar_perfil&status=error');

}














?>