<?php
$query_usuarios = <<<USUARIOS
                    SELECT u.usuario_id, u.nombre, u.apellido, u.usuario, u.email, u.usuario_tipo_id_fk, t.tipo 
                    FROM usuarios as u
                    LEFT JOIN usuario_tipo as t ON usuario_tipo_id_fk = t.usuario_tipo_id

USUARIOS; 

$rta_usuarios = mysqli_query($cnx, $query_usuarios);


?>
<?php
    if ((!empty($_GET['status']) && $_GET['status'] == 'ok') &&
        (!empty($_GET['accion']) && ($_GET['accion'] == 'creado' || $_GET['accion'] == 'eliminado' || $_GET['accion'] == 'editado'))
    ):
        $accion = $_GET['accion'];
        ?>
        <div class="alert alert-success alert-dismissible fade show container my-4" role="alert">
                <i class="far fa-check-circle"></i>
                El Usuario se a <?= $accion ?> correctamente
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
                        <th>Apellido</th>
                        <th>Nombre del Usuario</th>
                        <th>Email</th>
                        <th>Tipo de usuario</th>
                        <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="panelLista">
                               
                                        <?php 
                                            if(!empty($rta_usuarios)):
                                            while ($usuario = mysqli_fetch_assoc($rta_usuarios)) :
                                        ?>    
                                            <tr>
                                                <td><?= $usuario["usuario_id"] ?></td>
                                                <td><?= $usuario["nombre"] ?></td>
                                                <td><?= $usuario["apellido"] ?></td>
                                                <td><?= $usuario["usuario"] ?></td>
                                                <td><?= $usuario["email"] ?></td>
                                                <td><?= $usuario["tipo"] ?></td>
                                                <td>
                                                <div class="dropdown">
                                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Editar/Borrar
                                                        </button>    
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="index.php?seccion=usuarios_añadir&id=<?=$usuario["usuario_id"]?>">Editar</a>       
                                                            <form action="acciones/usuarios/eliminar.php" method="POST">
                                                                <input type="hidden" value="<?= $usuario["usuario_id"] ?>" name="id">
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
                                            <td colspan="8" class="text-danger text-center">No tenemos ningun usuario cargado</td>
                                        </tr>
                                <?php
                                    endif;
                                ?>
                                </tbody>
                </table>
                <a href="index.php?seccion=usuarios_añadir" class="btn btn-lg btn-info float-right my-2">Nuevo Usuario</a>

            </div>
        </article>
    </div>

</section>