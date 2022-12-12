<?php
    $id = $_GET["id"];
   
 // TRAEMOS LOS DATOS DEL PROYECTO------------------------------------------------------------------------------------------  
    
 $proyectosId = <<<PROYECTOS
    SELECT p.proyectos_id, p.nombre, p.portada, p.descripcion, p.direccion, p.pasos, p.fecha, p.precio,  s.saga, s.descripcion_saga, s.background, s.logo, s.banner, d.dificultad
        FROM proyectos as p 
        LEFT JOIN sagas as s ON sagas_id_fk = s.sagas_id
        LEFT JOIN dificultad as d ON dificultad_id_fk = dificultad_id

        WHERE p.proyectos_id = $id
PROYECTOS;

$rta_proyectos = mysqli_query($cnx, $proyectosId);
$proyecto = mysqli_fetch_assoc($rta_proyectos);


if (!$proyecto){
    header('Location: index.php?seccion=proyectos&error=proyecto_no_encontrado');
    exit;
}

?>
<section class="banner_proyectos">
    <figure class="contenedor_banner">
        <img src="Imagenes/Sagas/<?= $proyecto['banner']?>" alt="Banner <?= $proyecto['nombre']?> " class="img-fluid">
    </figure>
        <div class="imagen_texto text-white">
            <img src="Imagenes/Sagas/<?=$proyecto["logo"];?>" alt="Logo FranjZ" class="logoPersonalizado pb-3">
            <h2 class="titulo_proyectos d-none d-md-block"><?= $proyecto["nombre"]; ?></h2>
            <p class="w-100 d-none d-lg-block descripcion_proyectos"><?= $proyecto['descripcion']?></p>
        </div>
</section>
<div class="Banner">
<section class="container">
<div class="row">
        <h1 class="my-5 text-white detalle_video_titulo">Detalle del Producto</h1>
            <div class="col-sm12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 text-center">
                <img src="Imagenes/Proyectos/<?= $proyecto['portada']?>" alt="<?= $proyecto['nombre']?>" class="img-fluid w-75">
            </div>
            <div class="col-sm12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 text-white">
            <h2> Este producto pertenece a la saga de: <?= $proyecto['saga']?></h2>
            <p class="w-100 d-none d-md-block descripcion_proyectos"><?= $proyecto['descripcion_saga']?></p>
            <div>
                <h3 class="mt-2">$ <?= $proyecto['precio']?></h3>
                <hr>
                <?php 
                    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['usuario_tipo_id_fk'] == 1):
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                    El usuario Admin no puede realizar compras
                </div>
                <?php 
                    elseif (!isset($_SESSION['usuario'])):
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                    Logueate para agregar productos al carrito
                </div>
                <?php 
                else:
                ?>
                    <form action="procesos/agregar_carrito.php" method="POST" class="text-center">
                            <input type="hidden" name="id" value="<?= $proyecto["proyectos_id"]; ?>">
                            <input type="hidden" name="nombre" value="<?= $proyecto["nombre"]; ?>"> 
                            <input type="hidden" name="precio" value="<?= $proyecto["precio"]; ?>">
                            <input type="hidden" name="portada" value="<?= $proyecto["portada"]; ?>">  
                            <input type="number" name="cantidad"class="btn btn-light boton_detalle" value="1">
                            <button class="btn btn-primary" type="submit" name="agregar" >Agregar al carrito</button>
                    </form>
                <?php 
                endif;
                ?>
            </div>
            </div>
            <div class="col-12 my-5">
                <div class="ratio ratio-21x9">
                        <iframe src="<?= $proyecto['direccion']?>" title="YouTube video" allowfullscreen></iframe>
                </div>
            </div>
</div>
</section>
</div>