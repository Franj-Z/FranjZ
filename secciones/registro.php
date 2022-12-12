<?php 
//dd($_SESSION);

?>



<section class="vh-100 text-light">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="Imagenes/portalFranjZ2.png" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <h1 class="h2 my-3 text-center">Registrate!</h1>
        <form action="procesos/registro.php" method="POST" >
        
        <div class="form-outline mb-4">
            <input type="Nombre" id="form3Example3" class="form-control-lg input" placeholder="Nombre" name="nombre" 
                   value="<?= isset($_SESSION['campos_correctos']) && isset($_SESSION['campos_correctos']['nombre']) ? $_SESSION['campos_correctos']['nombre'] : '' ?>"/>
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
            <input type="Apellido" id="form3Example3" class="form-control-lg input" placeholder="Apellido" name="apellido"
                   value="<?= isset($_SESSION['campos_correctos']) && isset($_SESSION['campos_correctos']['apellido']) ? $_SESSION['campos_correctos']['apellido'] : '' ?>" />
            
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
            <input type="Nombre del usuario" id="form3Example3" class="form-control-lg input" placeholder="Nombre de usuario" name="usuario" 
                   value="<?= isset($_SESSION['campos_correctos']) && isset($_SESSION['campos_correctos']['usuario']) ? $_SESSION['campos_correctos']['usuario'] : '' ?>" />
            
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
            <input type="email" id="form3Example3" class="form-control-lg input" placeholder="Email" name="email" 
                   value="<?= isset($_SESSION['campos_correctos']) && isset($_SESSION['campos_correctos']['email']) ? $_SESSION['campos_correctos']['email'] : '' ?>" />
            
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

          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control-lg input" placeholder="Contraseña" name="password" />
            <?php 
                  if (isset($_SESSION['errores']) && isset($_SESSION['errores']['password'] )):
            ?>
                    <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                        <?= $_SESSION['errores']['password']?>
                    </div>
                  <?php 
                    endif;
                  ?>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Registrar</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">¿Ya tienes una cuenta?<a href="index.php?seccion=login"
                class="link-danger ms-1">Logueate</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>