<?php
require_once("../../../Config/config.php");
require_once("../../../Config/funciones.php");


if (empty($_POST['id'])) {
    header("Location: ../../index.php?seccion=lista_usuarios&status=error");
    exit;
}                                                                                                   
$usuarios_id = intval($_POST['id']);
$select_prod = "SELECT usuario_id FROM usuarios WHERE usuario_id=$usuarios_id";
$res_selec = mysqli_query($cnx, $select_prod);

if (!$res_selec->num_rows) {
    header("Location: ../../index.php?seccion=lista_usuarios&status=error");
    exit;
}

$delete = "DELETE FROM usuarios WHERE usuario_id=$usuarios_id";
$res_delete = mysqli_query($cnx, $delete);

if ($res_delete) {
    header("Location: ../../index.php?seccion=lista_usuarios&status=ok&accion=eliminado");
} else {
    header("Location: ../../index.php?seccion=lista_usuarios&status=error");
}






?>