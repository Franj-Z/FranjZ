<?php
    $id = $_GET["id"];
   
 // TRAEMOS LOS DATOS DEL PROYECTO------------------------------------------------------------------------------------------  
    
 $proyectosId = <<<PROYECTOS
    SELECT p.proyectos_id, p.nombre, p.portada, p.descripcion, p.direccion, p.pasos, p.fecha,  s.saga, s.descripcion_saga, s.background, s.logo, d.dificultad
        FROM proyectos as p 
        LEFT JOIN sagas as s ON sagas_id_fk = s.sagas_id
        LEFT JOIN dificultad as d ON dificultad_id_fk = dificultad_id

        WHERE p.proyectos_id = $id
PROYECTOS;

$rta_proyectos = mysqli_query($cnx, $proyectosId);
$proyecto = mysqli_fetch_assoc($rta_proyectos);

 // TRAEMOS LOS MATERIALES DEL PROYECTO------------------------------------------------------------------------------------------  

    $materiales = 'SELECT * FROM proyectos_materiales 
                   JOIN materiales ON materiales_id= materiales_id_fk 
                   WHERE proyectos_id_fk = ' . $_GET['id'];

    $rta_materiales = mysqli_query($cnx, $materiales);



 // TRAEMOS LAS HERRAMIENTAS DEL PROYECTO------------------------------------------------------------------------------------------  
    
    $herramientas = 'SELECT * FROM proyectos_herramientas 
                     JOIN herramientas ON herramientas_id= herramientas_id_fk 
                     WHERE proyectos_id_fk = ' . $_GET['id'];

    $rta_herramientas = mysqli_query($cnx, $herramientas);





if (!$proyecto){
    header('Location: index.php?seccion=proyectos&error=proyecto_no_encontrado');
    exit;
}

?>
<style>
    .Banner {
        background: url(Imagenes/Sagas/<?= $proyecto["background"]; ?>);
    }
 
</style>
<div class="Banner">
    <div class="p-5">
            <img src="Imagenes/Sagas/<?=$proyecto["logo"];?>" alt="Logo FranjZ" class="logoPersonalizado">
            <div class="pb-2">
                <h2 class="h5 Caract">
                    <span><?= $proyecto["saga"];?></span>
                    <span><?= $proyecto["dificultad"];?></span>
                    <span><?= $proyecto["fecha"];?></span>
                </h2>
            </div>
            <div class="pb-2 pt-2">
                <button onclick="toggle();" class="play"><i class="fas fa-play"></i>
                Mirar Video
                </button>
            </div>
            <div>
            
            </div>
            <p class="Contenido text-light"><?= $proyecto["descripcion_saga"]; ?></p>
            <p class="Contenido text-light"><?= $proyecto["descripcion"]; ?></p>
            <hr class="text-light">
            <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                <h1 class="text-light encabezado"><?= $proyecto["nombre"];?></h1>
                <p class="Contenido text-light"><?= $proyecto["pasos"]; ?></p>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                <h3 class="text-light encabezado"><i class="fas fa-pencil-ruler"></i> Materiales</h3>
                <ul class="Contenido text-light">
                <?php
                    while($material = mysqli_fetch_assoc($rta_materiales)):
                    ?>
                    <li class=""><?= $material['nombre'] ?></li>
                 <?php
                    endwhile;
                ?> 
            </ul>

            <h3 class="text-light encabezado"><i class="fas fa-tools"></i> Herramientas</h3>
                <ul class="Contenido text-light">
                <?php
                    while($herramienta = mysqli_fetch_assoc($rta_herramientas)):
                    ?>
                    <li class=""><?= $herramienta['nombre'] ?></li>
                 <?php
                    endwhile;
                ?> 
            </ul>
            </div>
            </div>
            </div>
            
    
    </div>
    <div class="video">
        <iframe width="560" height="315" src="<?=$proyecto["direccion"];?>" allowfullscreen></iframe>            
        <i class="fas fa-times cerrar" onclick="toggle();"></i>
    </div>
</div>
<script>
    function toggle(){
        let video = document.querySelector('.video');
        video.classList.toggle('active');
    }
</script>