<?php 

$proyecto=[];
$proyecto_mate =[];
$proyecto_herr=[];
$accion= 'Crear';
$funcionalidad= 'crear.php';

// TRAEMOS LAS SAGAS -------------------------------------
$select_saga ="SELECT sagas_id, saga FROM sagas;";
$rta_select_saga= mysqli_query($cnx, $select_saga);

// TRAEMOS LA DIFICULTAD DEL PROYECTO -------------------------------------
$select_dificult = "SELECT * FROM dificultad;";
$rta_select_dificult=mysqli_query($cnx, $select_dificult);

// TRAEMOS LOS DATOS DE LOS PROYECTOS-------------------------------------
$select_proyectos = "SELECT * FROM proyectos;";
$rta_select_proyectos= mysqli_query($cnx, $select_proyectos);

// TRAEMOS LOS MATERIALES-------------------------------------
$select_materiales = "SELECT * FROM materiales;";
$rta_select_materiales= mysqli_query($cnx, $select_materiales);

// TRAEMOS LAS HERRAMIENTAS-------------------------------------
$select_herramientas = "SELECT * FROM herramientas;";
$rta_select_herramientas= mysqli_query($cnx, $select_herramientas);


// VALIDAMOS LOS CAMPOS DEL FORMULARIO-------------------------------------
$erroresFormu = [];
if (!empty($_GET['campos']))
   $erroresFormu = json_decode($_GET['campos']);

// VALIDAMOS Y TRAEMOS LOS DATOS PARA EDITAR EL PROYECTO---------------------------------------------
if (!empty($_GET['id'])) {
    
    $proyecto_id = $_GET['id'];
    $proyecto_seleccionado = "SELECT * FROM proyectos
                              JOIN sagas ON sagas_id_fk = sagas_id
                              JOIN dificultad ON dificultad_id_fk = dificultad_id 
                              WHERE proyectos_id=$proyecto_id";

    $rpta_proyecto_seleccionado = mysqli_query($cnx, $proyecto_seleccionado);

    if(!$rpta_proyecto_seleccionado->num_rows) {
        header('Location: index.php?seccion=lista_proyectos&status=error');
        exit;
    }

    $accion='Editar';
    $funcionalidad= 'editar.php';
    $proyecto= mysqli_fetch_assoc($rpta_proyecto_seleccionado);


    // TRAEMOS LOS MATERIALES DEL PROYECTO SELECCIONADO-------------------------------------
    $material_seleccionado = "SELECT materiales_id_fk FROM proyectos_materiales WHERE proyectos_id_fk=$proyecto_id;";
    $rpta_material_seleccionado = mysqli_query($cnx, $material_seleccionado);
    
    while ($material_proyecto_respuesta = mysqli_fetch_assoc($rpta_material_seleccionado)) {
        $proyecto_mate[] = $material_proyecto_respuesta['materiales_id_fk'];
    }
    
    // TRAEMOS LAS HERRAMIENTAS DEL PROYECTO SELECCIONADO-------------------------------------------
    $herraienta_seleccionada = "SELECT herramientas_id_fk FROM proyectos_herramientas WHERE proyectos_id_fk=$proyecto_id;";
    $rpta_herramienta_seleccionada= mysqli_query($cnx, $herraienta_seleccionada);

    while ($herramienta_proyecto_respuesta = mysqli_fetch_assoc($rpta_herramienta_seleccionada)) {
        $proyecto_herr[] = $herramienta_proyecto_respuesta['herramientas_id_fk'];
    }

}



?>

<section class="container">


<?php 
if (!empty($_GET['status']) && $_GET['status'] == 'error'):
?>
    <div class="alert alert-danger alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                No se puede realizar la accion
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php 
endif;
?>

    <form action="acciones/proyectos/<?=$funcionalidad?>" enctype="multipart/form-data" method="POST">
                    <?php
                    if(isset($proyecto['proyectos_id'])):
                    ?>
                        <input type="hidden" name="id" value="<?= $proyecto['proyectos_id'] ?>">
                    <?php
                    endif;
                    ?>

        <div class="row mb-4 text-light">
            <h2 class="text-center my-2 py-3"><?= $accion ?> Proyecto</h2>
            <div class="col-4">
                <div class="form-group my-2">
                        <label for="nombre">Nombre*</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" 
                            value="<?= isset($proyecto['nombre']) ? $proyecto['nombre'] : '' ?>">
                                <?php 
                                if (isset($erroresFormu ->nombre)):
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->nombre ?>
                                </div>
                                <?php 
                                endif;
                                ?>
                </div>
            </div> 
            <div class="col-4 my-2">
                <div class="form-group">
                        <label for="fecha">Fecha*</label>
                            <input type="date" class="form-control" min="2016-01-01" max="2021-12-31" id="fecha" name="fecha"
                            value="<?= isset($proyecto['fecha']) ? $proyecto['fecha'] : '' ?>">
                                <?php 
                                if (isset($erroresFormu ->fecha)):
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->fecha ?>
                                </div>
                                <?php 
                                endif;
                                ?>
                </div>
            </div>
            <div class="col-4 my-2">
                <div class="form-group">
                        <label for="precio">Precio*</label>
                            <input type="number" class="form-control" id="precio" name="precio"
                            value="<?= isset($proyecto['precio']) ? $proyecto['precio'] : '' ?>">
                            <?php 
                            if (isset($erroresFormu ->precio)):
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                            <?= $erroresFormu->precio ?>
                            </div>
                            <?php 
                            endif;
                            ?>
                </div>
            </div>
            <div class="col-6 my-2">
                <div class="form-group">
                        <label for="sagas">Seleccione una Saga*</label>
                        <select name="sagas" id="sagas" class="form-control ">
                            <?php 
                                while ($sagas = mysqli_fetch_assoc($rta_select_saga)):
                            ?>
                                <option value="<?= $sagas['sagas_id']?>" 
                                <?= (isset($proyecto['sagas_id_fk']) && $proyecto['sagas_id_fk'] == $sagas['sagas_id']) ? 'selected' : '' ?>>
                                <?= $sagas['saga']?></option>
                            <?php 
                                endwhile;
                            ?>
                            <?php 
                                if (isset($erroresFormu ->sagas)):
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->sagas ?>
                                </div>
                            <?php 
                                endif;
                            ?>
                        </select>                                            
                </div>
            </div>
            <div class="col-6 my-2">
                <div class="form-group">
                        <label for="dificultad">Seleccione la dificultad del proyecto*</label>
                        <select name="dificultad" id="dificultad" class="form-control">
                            <?php 
                            while ($dificultad= mysqli_fetch_assoc($rta_select_dificult)):
                            ?>
                                <option value="<?= $dificultad['dificultad_id']?>"
                                <?= (isset($proyecto['dificultad_id_fk']) && $proyecto['dificultad_id_fk'] == $dificultad['dificultad_id']) ? 'selected' : '' ?>>
                                <?= $dificultad['dificultad']?></option>  
                            <?php
                            endwhile
                            ?> 
                        </select>
                </div>
            </div>
            <div class="col-12 my-2">
                <div class="form-group">
                        <label for="descripcion">Descripción*</label>
                            <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="3"><?= isset($proyecto['descripcion']) ? $proyecto['descripcion'] : '' ?></textarea>
                        <?php 
                        if (isset($erroresFormu ->descripcion)):
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->descripcion ?>
                            </div>
                        <?php 
                        endif;
                        ?>
                </div>
            </div> 
            <div class="col-6 my-2">
                <div class="form-group">
                        <label for="materiales">Materiales*</label>
                        <select name="materiales[]" id="materiales" class="form-control select2" multiple>
                            <?php 
                            while ($mats= mysqli_fetch_assoc($rta_select_materiales)):
                            ?>
                            <option value="<?= $mats['materiales_id']?>" 
                                <?= in_array($mats['materiales_id'], $proyecto_mate) ? 'selected' : '' ?>>
                                <?= $mats['nombre']?>
                            </option>  
                            <?php
                            endwhile
                            ?>                   
                            </select>
                           <?php 
                            if (isset($erroresFormu ->materiales)):
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->materiales ?>
                                </div>
                            <?php 
                            endif;
                            ?>
                                                 
                </div>
            </div>
            <div class="col-6 my-2">
                <div class="form-group">
                    <label for="herramientas">Herramientas*</label>
                        <select name="herramientas[]" id="herramientas" class="form-control select2" multiple>
                            <?php 
                            while ($herr= mysqli_fetch_assoc($rta_select_herramientas)):
                            ?>
                                <option value="<?= $herr['herramientas_id']?>" 
                                <?= in_array($herr['herramientas_id'], $proyecto_herr) ? 'selected' : '' ?>>
                                <?= $herr['nombre']?>
                                </option>  
                            <?php
                            endwhile
                            ?>                  
                            </select> 
                            <?php 
                            if (isset($erroresFormu ->herramientas)):
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->herramientas ?>
                                </div>
                            <?php 
                            endif;
                            ?>
                </div>
            </div>
            <div class="col-12 my-2">
                <div class="form-group">
                        <label for="pasos">Pasos a seguir*</label>
                        <textarea name="pasos" class="form-control" id="pasos" cols="30" rows="3"><?= isset($proyecto['pasos']) ? $proyecto['pasos'] : '' ?></textarea>
                        <?php 
                        if (isset($erroresFormu ->pasos)):
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                            <?= $erroresFormu->pasos ?>
                            </div>
                        <?php 
                        endif;
                        ?>
                </div>
            </div>
            <div class="col-12 my-2">
                <div class="form-group">
                            <label for="direccion">Direccion URL*</label>
                            <input type="text" class="form-control" name="direccion" id="direccion"
                            value="<?= isset($proyecto['direccion']) ? $proyecto['direccion'] : '' ?>">
                            <?php 
                            if (isset($erroresFormu ->direccion)):
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->direccion ?>
                                </div>
                            <?php 
                            endif;
                            ?>
                </div>
            </div>
            <div class="col-xxl-6 my-2 py-3">
                <div class="col-6">
                        <figure class="card shadow border">
                            <img src="../Imagenes/Proyectos/<?=@imagen_proyecto($proyecto) ?>" alt="imagen agregar" class="img-fluid">
                        </figure>
                        <div class="form-group mt-0 pt-0">
                            <label for="portada"></label>
                            <input type="file" class="form-control-file" name="portada" id="portada" aria-describedby="fileHelpId">
                            <small id="fileHelpId" class="form-text text-muted">El formato de la imagen debe ser <b>JPG</b></small>
                        </div>
                            <?php 
                            if (isset($erroresFormu ->portada)):
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->portada ?>
                                </div>
                            <?php 
                            endif;
                            ?>
                </div>
            </div>
            <div class="col-xxl-6 my-2 py-3">
                <div class="col-6">
                        <figure class="card shadow border">
                            <img src="../Imagenes/Productos/<?=@imagen_producto($proyecto) ?>" alt="imagen agregar" class="img-fluid">
                        </figure>
                        <div class="form-group mt-0 pt-0">
                            <label for="productoImg"></label>
                            <input type="file" class="form-control-file" name="productoImg" id="productoImg" aria-describedby="fileHelpId">
                            <small id="fileHelpId" class="form-text text-muted">El formato de la imagen debe ser <b>PNG</b></small>
                        </div>
                            <?php 
                            if (isset($erroresFormu ->productoImg)):
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->productoImg ?>
                                </div>
                            <?php 
                            endif;
                            ?>
                </div>
            </div>
            <div class="col-4">
            <button type="submit" class=" btn btn-lg btn-info float-right my-5"><?= $accion ?> Proyecto</button>
            </div>
        </div>
    </form>
</section>