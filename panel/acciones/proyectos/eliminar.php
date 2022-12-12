<?php
require_once("../../../Config/config.php");
require_once("../../../Config/funciones.php");


if (empty($_POST['id'])) {
    header("Location: ../../index.php?seccion=lista_proyectos&status=error");
    exit;
}                                                                                                   
$proyectos_id = intval($_POST['id']);
$select_prod = "SELECT proyectos_id FROM proyectos WHERE proyectos_id=$proyectos_id";
$res_selec = mysqli_query($cnx, $select_prod);

if (!$res_selec->num_rows) {
    header("Location: ../../index.php?seccion=lista_proyectos&status=error");
    exit;
}

$delete = "DELETE FROM proyectos WHERE proyectos_id=$proyectos_id";
$res_delete = mysqli_query($cnx, $delete);

if ($res_delete) {
    header("Location: ../../index.php?seccion=lista_proyectos&status=ok&accion=eliminado");
} else {
    header("Location: ../../index.php?seccion=lista_proyectos&status=error");
}

?>