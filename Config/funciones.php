<?php


function error(){
    echo "ERROR 404!!!!!!!!!";
}
function dd($valor)
{
    echo '<pre>';
    var_dump($valor);
    echo '</pre>';
    exit;
}
function dd2($valor)
{
    echo '<pre>';
    var_dump($valor);
    echo '</pre>';
}
function select($query){

    global $cnx;

    $resultados = [];
    $rta = mysqli_query($cnx, $query);

    if(mysqli_error($cnx))
        die(mysqli_error($cnx));

    if(mysqli_num_rows($rta) == 0)
        return $resultados;

    while($resultado = mysqli_fetch_assoc($rta)):
        $resultados[] = $resultado;
    endwhile;

    mysqli_free_result($rta);

    return $resultados;
}


function query($query){
    global $cnx;

    $rta = mysqli_query($cnx, $query);

    if(mysqli_error($cnx))
        return mysqli_error($cnx);

    return $rta;
}


function mostrar_array($valor, $dump = false){    
    echo "<pre>";
        if($dump)
            var_dump($valor);
        else
            print_r($valor);
    echo "</pre>";

}

function selected($fk, $id){
    return $fk == $id ? "selected" : "";
}

function imagen_proyecto($proyecto){
    return isset($proyecto) && !empty($proyecto["portada"]) ? $proyecto["portada"] : IMAGEN_DEFAULT;
}

function imagen_producto($proyecto){
    return isset($proyecto) && !empty($proyecto["productoImg"]) ? $proyecto["productoImg"] : IMAGEN_DEFAULT;
}


?>