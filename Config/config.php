<?php 
	ini_set("display_errors", true);
	error_reporting(E_ALL);


define("DB_HOST","127.0.0.1");
define("DB_NAME","franjz");
define("DB_USER","root");
define("DB_PASS","");

define('SECCIONES', 'secciones/');


$cnx = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

if(!$cnx){
    die("NO ES POSIBLE CONECTAR CON LA BASE DE DATOS");
}

mysqli_set_charset($cnx,"UTF8");


if(strpos("panel", $_SERVER["REQUEST_URI"]) != -1){
    $url = explode("panel",$_SERVER["REQUEST_URI"])[0];
}else{
    $url = explode("index.php",$_SERVER["REQUEST_URI"])[0];
}

$ruta = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"]  . $url;

define("WEB_URL", $ruta);

$root = explode("config",__DIR__)[0];

define("ROOT", $root);

define("RUTA_IMAGENES", "Imagenes");

define("IMAGEN_DEFAULT", "edi.jpg");

session_start();


?>