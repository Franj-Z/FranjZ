
<?php 
//dd($_SESSION);
if(!empty($_SESSION['ok'])):

?>
<div class="alert alert-success d-flex align-items-center container" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    <?= $_SESSION['ok'] ?>
  </div>
</div>
<?php
endif;
unset($_SESSION['ok']);
?>
<section class="container my-5">
    <div class="row">
        <?php
                if (!isset($_SESSION['usuario'])):
        ?>
            <div class="alert alert-danger alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Debes iniciar sesión para poder visualizar tus datos
            </div>

        <?php
                else:
        ?>
        <div class="col-sm-12 col-lg-6 text-center mt-5">
        <img src="Imagenes/Avatars/<?= ucwords($_SESSION['usuario']['imagen']) ?>" alt="Avatar del usuario" class="img-fluid pImagenperf">
        </div>
        <div class="col-sm-12 col-lg-6 mb-5">
        <h2 class="my-4">Perfil del usuario</h2>
        <table class="table bordeperfil">
                <thead >
                    <tr>
                        <div class="trperfil">
                            <p class="pperfil">Detalles de la cuenta</p>
                        </div>
                    </tr>
                </thead>
                <tbody class="text-white">
                <tr>
                    <td>Nombre</td>
                    <td><?= ucwords($_SESSION['usuario']['nombre']) ?></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><?= ucwords($_SESSION['usuario']['apellido']) ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= ucwords($_SESSION['usuario']['email']) ?></td>
                </tr>
                <tr>
                    <td>Nombre de usuario</td>
                    <td><?= ucwords($_SESSION['usuario']['usuario']) ?></td>
                </tr>
                </tbody>
            </table>
            <a href="index.php?seccion=editar_perfil" class="btn btn-outline-light my-5"><i class="fas fa-pen mx-2"></i>Editar Perfil</a>
        </div>
        <?php
            endif;
        ?>
    </div>
</section>
