
<?php
   
    $query = <<<PROYECTOS
     SELECT p.proyectos_id, p.nombre, p.portada, s.saga
        FROM proyectos as p 
        LEFT JOIN sagas as s ON sagas_id_fk = s.sagas_id


PROYECTOS;
$rta = mysqli_query($cnx, $query);

?>

<section class="banner_proyectos">
    <figure class="contenedor_banner">
        <img src="Imagenes/probanner.jpg" alt="BannerThor" class="img-fluid">
    </figure>
        <div class="imagen_texto">
            <h2 class="titulo_proyectos titu">PROYECTOS</h2>
            <p class="w-100 d-none d-md-block pt-2 descripcion_proyectos">En esta sección encontrarás todos los proyectos realizados en el canal junto a sus materiales y procedimiento para que los puedas realizar tú mismo. Espero que lo disfrutes y ¡Manos a la obra.!</p>
        </div>
</section>

<section class="fondoSection p-4">
    <div class="container py-4">
        <?php 
            if(isset($_GET['error']) && $_GET['error'] == 'proyecto_no_encontrado'):
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                El proyecto solicitado no se encuentra disponible. Acuérdate, si tienes uno en mente déjalo por escrito en la sección "Contactos" para que yo lo realice.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
    </div>
        <div class="galProd1 conyainer">
            <ul class="productos">
            <?php
            while ($proyecto = mysqli_fetch_assoc($rta)) :
            ?>
                <li class="producto">
                    <div class="img__wrapper ">
                    <img src="Imagenes/Proyectos/<?= $proyecto["portada"]; ?>" alt="<?= $proyecto["nombre"] ?>" class="img-fluid cardimagenpro">
                    </div>
                    <div class="efecto_card py-3">
                        <p class="card-title h5 pt-3 portpro card_contenido"><?= $proyecto["nombre"]; ?></p>
                        <p class="h6 card-title card_contenido"><?=$proyecto["saga"];?></p>
                        <div class="pt-2">
                            <a href="index.php?seccion=detalle_proyecto&id=<?= $proyecto["proyectos_id"] ?>" class="btn btn-outline-light card_contenido">Leer más <i class="fas fa-plus-circle m-1"></i></a>
                        </div>
                    </div>
                </li> 
            <?php
            endwhile;
            ?>
            </ul>
        </div>
    </section>

