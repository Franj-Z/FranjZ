<?php 
// Traemos los avatars -------------------------------------
$select_avatar ="SELECT avatar_id, nombre_avatar, imagen FROM avatars;";
$rta_select_avatar= mysqli_query($cnx, $select_avatar);

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
if (!isset($_SESSION['usuario'])):
?>
<div class="alert alert-warning alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Logueate para editar tu perfil
</div>
<?php 
else:
?>
<div class="container">
<form action="procesos/editar.php" enctype="multipart/form-data" method="POST">
        <div class="row my-5">
                    
                <input type="hidden" name="id" value="<?= ucwords($_SESSION['usuario']['usuario_id']) ?>">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="container">
                        <h2 class="my-5">Editar Perfil</h2>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="Nombre" name="nombre" 
                                value="<?= ucwords($_SESSION['usuario']['nombre']) ?>"/>
                                <?php 
                                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['nombre'] )):
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                        <?= $_SESSION['errores']['nombre']?>
                                    </div>
                                <?php 
                                    endif;
                                ?>   
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="Apellido" name="apellido" 
                                value="<?= ucwords($_SESSION['usuario']['apellido']) ?>"/>
                                <?php 
                                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['apellido'] )):
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                        <?= $_SESSION['errores']['apellido']?>
                                    </div>
                                <?php 
                                    endif;
                                ?>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="Email" name="email" 
                                value="<?= ucwords($_SESSION['usuario']['email']) ?>"/>
                                <?php 
                                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['email'] )):
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                        <?= $_SESSION['errores']['email']?>
                                    </div>
                                <?php 
                                    endif;
                                ?>    
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" class="form-control-lg input" placeholder="usuario" name="usuario" 
                                value="<?= ucwords($_SESSION['usuario']['usuario']) ?>"/>
                                <?php 
                                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['usuario'] )):
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                        <?= $_SESSION['errores']['usuario']?>
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
                                        <?= (isset($_SESSION['usuario']['avatar_id_fk']) && $_SESSION['usuario']['avatar_id_fk'] == $avatar['avatar_id']) ? 'selected' : '' ?>>
                                        <?= $avatar['nombre_avatar']?></option>
                                    <?php 
                                        endwhile;
                                    ?>
                                    <?php 
                                        if (isset($_SESSION['errores']) && isset($_SESSION['errores']['avatar'] )):
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                                            <?= $_SESSION['errores']['avatar']?>
                                        </div>
                                    <?php 
                                        endif;
                                    ?>
                                </select> 
                    </div>
                    <button type="submit" class=" btn btn-lg btn-info float-right my-5">Editar Perfil</button>    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 text-center mt-5">
                <img src="Imagenes/Avatars/<?= ucwords($_SESSION['usuario']['imagen']) ?>" alt="Avatar del usuario" class="img-fluid pImagenEditarPerfil">
                <h3 class="mt-3 text-white">Elige uno de estos avatars</h3>

                <div class="wrapper">
                        <div class="sliderAva">
                            <div class="slideA">
                                <img src="Imagenes/Avatars/grievous.png" />
                                <img src="Imagenes/Avatars/vader.png" />
                                <img src="Imagenes/Avatars/indi.png" />
                                <img src="Imagenes/Avatars/baby.png" />
                                <img src="Imagenes/Avatars/kratos.png" />
                                <img src="Imagenes/Avatars/obi.png" />
                                <img src="Imagenes/Avatars/tony.png" />
                                <img src="Imagenes/Avatars/gandalf.png" />
                                <img src="Imagenes/Avatars/boba.png" />
                                <img src="Imagenes/Avatars/rocket.png" />
                                <img src="Imagenes/Avatars/thanos.png" />

                            </div>
                            <div class="slideA">
                                <img src="Imagenes/Avatars/grievous.png" />
                                <img src="Imagenes/Avatars/vader.png" />
                                <img src="Imagenes/Avatars/indi.png" />
                                <img src="Imagenes/Avatars/baby.png" />
                                <img src="Imagenes/Avatars/kratos.png" />
                                <img src="Imagenes/Avatars/obi.png" />
                                <img src="Imagenes/Avatars/tony.png" />
                                <img src="Imagenes/Avatars/boba.png" />
                                <img src="Imagenes/Avatars/rocket.png" />
                                <img src="Imagenes/Avatars/thanos.png" />
 
                            </div>
                        </div>
                </div>
                
            
                </div>
        </div>
    </form>
</div>
<?php
endif;
?>