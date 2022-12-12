<?php 
$usuarios = [];
$usuario_tipo = [];

$accion= 'Crear';
$funcionalidad= 'crear.php';

// VALIDAMOS LOS CAMPOS DEL FORMULARIO-------------------------------------
$erroresFormu = [];
if (!empty($_GET['campos']))
   $erroresFormu = json_decode($_GET['campos']);

// Traemos los tipos de usuarios -------------------------------------
$select_tipo ="SELECT usuario_tipo_id, tipo FROM usuario_tipo;";
$rta_select_tipo= mysqli_query($cnx, $select_tipo);

// Traemos los avatars -------------------------------------
$select_avatar ="SELECT avatar_id, nombre_avatar FROM avatars;";
$rta_select_avatar= mysqli_query($cnx, $select_avatar);

//Traemos los datos de los usuarios-----------------------------------------------
if (!empty($_GET['id'])) {
    
    $usuario_id = $_GET['id'];
    $usuario_seleccionado = "SELECT * FROM usuarios
                              LEFT JOIN usuario_tipo ON usuario_tipo_id_fk = usuario_tipo_id
                              LEFT JOIN avatars ON avatar_id_fk = avatar_id
                              WHERE usuario_id=$usuario_id";

    $rpta_usuario_seleccionado = mysqli_query($cnx, $usuario_seleccionado);

    if(!$rpta_usuario_seleccionado->num_rows) {
        header('Location: index.php?seccion=lista_usuarios&status=error');
        exit;
    }

    $accion='Editar';
    $funcionalidad= 'editar.php';
    $usuarios= mysqli_fetch_assoc($rpta_usuario_seleccionado);

}

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
<div class="container">
<form action="acciones/usuarios/<?=$funcionalidad?>" enctype="multipart/form-data" method="POST">
        <div class="row my-5">
                    <?php
                    if(isset($usuarios['usuario_id'])):
                    ?>
                        <input type="hidden" name="id" value="<?= $usuarios['usuario_id'] ?>">
                    <?php
                    endif;
                    ?>
                <div class="container">
                    <h2 class="my-5"><?= $accion ?> Perfil</h2>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="Nombre" name="nombre" 
                                value="<?= isset($usuarios['nombre']) ? $usuarios['nombre'] : '' ?>"/>
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
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="Email" name="email" 
                                value="<?= isset($usuarios['email']) ? $usuarios['email'] : '' ?>"/>
                                <?php 
                                if (isset($erroresFormu ->email)):
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->email ?>
                                </div>
                                <?php 
                                endif;
                                ?>       
                    </div>
                    <div class="form-outline mb-4">
                                <select name="usuario_tipo" id="usuario_tipo" class="form-control-lg input">
                                    <?php 
                                        while ($tipo = mysqli_fetch_assoc($rta_select_tipo)):
                                    ?>
                                        <option value="<?= $tipo['usuario_tipo_id']?>" 
                                        <?= (isset($usuarios['usuario_tipo_id_fk']) && $usuarios['usuario_tipo_id_fk'] == $tipo['usuario_tipo_id']) ? 'selected' : '' ?>>
                                        <?= $tipo['tipo']?></option>
                                    <?php 
                                        endwhile;
                                    ?>
                                    <?php 
                                        if (isset($erroresFormu ->usuario_tipo)):
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                        <?= $erroresFormu->usuario_tipo ?>
                                        </div>
                                    <?php 
                                        endif;
                                    ?>
                                </select> 
                        
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example3" class="form-control-lg input" placeholder="Contraseña" name="password" 
                                value="<?= isset($usuarios['password']) ? $usuarios['password'] : '' ?>"/>
                                <?php 
                                if (isset($erroresFormu ->password)):
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->password ?>
                                </div>
                                <?php 
                                endif;
                                ?>                   
                    </div>
                    <button type="submit" class=" btn btn-lg btn-info float-right my-5"><?= $accion ?> Usuario</button>                                           
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="Apellido" name="apellido" 
                                value="<?= isset($usuarios['apellido']) ? $usuarios['apellido'] : '' ?>"/>
                                <?php 
                                if (isset($erroresFormu ->apellido)):
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->apellido ?>
                                </div>
                                <?php 
                                endif;
                                ?>
                </div>
                <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="usuario" name="usuario" 
                                value="<?= isset($usuarios['usuario']) ? $usuarios['usuario'] : '' ?>"/>
                                <?php 
                                if (isset($erroresFormu ->usuario)):
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                <?= $erroresFormu->usuario ?>
                                </div>
                                <?php 
                                endif;
                                ?>                   
                </div>
                <div class="form-outline mb-4">
                                <select name="avatar" id="avatar" class="form-control-lg input">
                                    <?php 
                                        while ($avatar = mysqli_fetch_assoc($rta_select_avatar)):
                                    ?>
                                        <option value="<?= $avatar['avatar_id']?>" 
                                        <?= (isset($usuarios['avatar_id_fk']) && $usuarios['avatar_id_fk'] == $avatar['avatar_id']) ? 'selected' : '' ?>>
                                        <?= $avatar['nombre_avatar']?></option>
                                    <?php 
                                        endwhile;
                                    ?>
                                    <?php 
                                        if (isset($erroresFormu ->avatar)):
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                        <?= $erroresFormu->avatar ?>
                                        </div>
                                    <?php 
                                        endif;
                                    ?>
                                </select> 
                    </div>
                    
                </div>

        </div>
    </form>
</div>
