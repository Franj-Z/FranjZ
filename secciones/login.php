<?php 

if(!empty($_SESSION['ok'])):

?>
<div class="alert alert-success d-flex align-items-center container my-5" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    <?= $_SESSION['ok'] ?>
  </div>
</div>
<?php
elseif (!empty($_SESSION['error'])):  
?>
    <div class="alert alert-danger d-flex align-items-center container my-3" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
          <?= $_SESSION['error'] ?>
  </div>
    </div>
<?php
endif;
unset($_SESSION['error']);
unset($_SESSION['ok']);

?>
<section class="vh-100 text-light">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="Imagenes/bifrost.png" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="procesos/login.php" method="POST">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
          </div>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="name" id="form3Example3" class="input form-control-lg" placeholder="Ingresa tu nombre de usuario" name="usuario"/>
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

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="input form-control-lg" placeholder="Enter password" name="password" />
            <?php 
                  if (isset($_SESSION['errores']) && isset($_SESSION['errores']['password'] )):
            ?>
                    <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                        <?= $_SESSION['errores']['password']?>
                    </div>
                  <?php 
                    endif;
                    unset($_SESSION['errores']);
                  ?>
          </div>

         
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes una cuenta? <a href="index.php?seccion=registro"
                class="link-danger">Registrate</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>