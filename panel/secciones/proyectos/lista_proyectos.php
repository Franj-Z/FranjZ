<?php



$query = <<<PROYECTOS

SELECT p.proyectos_id, p.nombre, p.direccion, p.fecha, s.saga, d.dificultad
       FROM proyectos as p
       LEFT JOIN sagas as s ON sagas_id_fk = s.sagas_id
       LEFT JOIN dificultad as d ON dificultad_id_fk = d.dificultad_id

PROYECTOS;

$rta = mysqli_query($cnx, $query);


?>

<?php 
if (!empty($_GET['tipo']) && $_GET['tipo'] == 'materialesherramientas'):
?>
    <div class="alert alert-warning alert-dismissible fade show container my-4" role="alert">
                <i class="far fa-check-circle"></i>
                Se creó/Editó el producto pero no se le pudieron agregar los materiales :(
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php 
endif;
?>
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

<?php
    if ((!empty($_GET['status']) && $_GET['status'] == 'ok') &&
        (!empty($_GET['accion']) && ($_GET['accion'] == 'creado' || $_GET['accion'] == 'eliminado' || $_GET['accion'] == 'editado'))
    ):
        $accion = $_GET['accion'];
        ?>
        <div class="alert alert-success alert-dismissible fade show container my-4" role="alert">
                <i class="far fa-check-circle"></i>
                El Proyecto/Producto se a <?= $accion ?> correctamente
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
    endif;
    ?>

<section class="container">
        <div class="row my-4">
            <article class="col-12">
            <div class="table-responsive">
                 <table class="table align-middle text-light text-center">
                        <thead id="panel">
                            <tr>
                                <th>Identificador</th>
                                <th>Nombre</th>
                                <th>Nombre Saga</th>
                                <th>dificultad</th>
                                <th>Fecha</th>
                                <th>Editar/Borrar</th>
                            </tr>
                                </thead>
                                <tbody class="text-center" id="panelLista">
                               
                                        <?php 
                                            if(!empty($rta)):
                                            while ($proyecto = mysqli_fetch_assoc($rta)) :
                                        ?>    
                                            <tr>
                                                <td><?= $proyecto["proyectos_id"] ?></td>
                                                <td><?= $proyecto["nombre"] ?></td>
                                                <td><?= $proyecto["saga"] ?></td>
                                                <td><?= $proyecto["dificultad"] ?></td>
                                                <td><?= $proyecto["fecha"] ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Editar/Borrar
                                                        </button>
                                                             
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="index.php?seccion=proyectos_añadir&id=<?=$proyecto["proyectos_id"]?>">Editar</a>
                                                                
                                                        <form action="acciones/proyectos/eliminar.php" method="POST">
                                                            <input type="hidden" value="<?= $proyecto["proyectos_id"] ?>" name="id">
                                                            <button type="submit" class="dropdown-item">Borrar</button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                 <?php
                                    endwhile;
                                    
                                    else:
                                ?>   
                                        <tr>
                                            <td colspan="8" class="text-danger text-center">No tenemos ningun proyecto cargado</td>
                                        </tr>
                                <?php
                                    endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="index.php?seccion=proyectos_añadir" class="btn btn-lg btn-info float-right my-2">Nuevo Proyecto</a>
            </article>
        </div>
    </section>
