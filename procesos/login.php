<?php
require_once('../config/config.php');
require_once('../config/funciones.php');

$errores =[];

if (empty($_POST['usuario'])) {
    $errores['usuario'] = 'El usuario no puede estar vacío';
}

if (empty($_POST['password'])) {
    $errores['password'] = 'La contraseña no puede estar vacía';
}

if (count($errores)) {
    $_SESSION['errores'] = $errores ;

    header('Location: ../index.php?seccion=login');
    exit;

}
$usr = mysqli_real_escape_string($cnx, $_POST['usuario']);

$selec_usr = "SELECT * FROM usuarios  
              LEFT JOIN avatars ON avatar_id_fk = avatar_id 
              WHERE usuario = '$usr'";
$res_selec_usr = mysqli_query($cnx, $selec_usr);
$usuario =  mysqli_fetch_assoc($res_selec_usr);

if((!$res_selec_usr -> num_rows) || !password_verify($_POST['password'], $usuario['password'])) {
    unset($_SESSION['errores']);
    $_SESSION['error'] = 'El usuario y/o contraseña están incorrectos';
    header('Location: ../index.php?seccion=login');
    exit;

}

unset($_SESSION['errores']);
unset($_SESSION['error']);
$_SESSION['usuario'] = $usuario;
header('Location: ../index.php?seccion=inicio');
