<?php 
$errores_form = [];
if (!empty($_GET['campos']))
   $errores_form = json_decode($_GET['campos']);



?>
<?php 
if (!empty($_GET['status']) && $_GET['status'] == 'ok'):
?>
    <div class="alert alert-success alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-envelope"></i>                
                El email se envio con éxito
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php 
endif;
?>
<section class="text-light fondoContactos p-5">
  <div class="container">
    <div class="">
      <div class="row align-items-center justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-9 my-5">
        <h1 class="contactame fs-1">Contactame</h1>
        <p>Si tienes un proyecto o idea en mente para que yo lo realice para el canal o quieres consultar por el stock de algún producto que te llamó la atención puedes llenar este formulario.</p>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3 col-xxl-3">
        <form action="procesos/form.php" enctype="multipart/form-data" method="POST">
            <div class="form-group mb-3">
              <input type="text" placeholder="Nombre" class="form-control" name="nombre">
              <?php 
                    if(isset($errores_form ->nombre)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $errores_form->nombre ?>
                          </div>
                <?php 
                      endif;
                ?>
            </div>
            <div class="form-group mb-3">
              <input type="text" placeholder="Apellido" class="form-control" name="apellido">
              <?php 
                    if(isset($errores_form ->apellido)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $errores_form->apellido ?>
                          </div>
                <?php 
                      endif;
                ?>
            </div>
            <div class="form-group mb-3">
              <input type="mail" placeholder="Email" class="form-control" name="email">
              <?php 
                    if(isset($errores_form ->email)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $errores_form->email ?>
                          </div>
                <?php 
                      endif;
                ?>
            </div>
            <div class="form-group mb-3">
              <textarea name="comentario" id="" cols="30" rows="2" class="form-control" placeholder="Dejame tú idea o pregunta aquí"></textarea>
              <?php 
                    if(isset($errores_form ->comentario)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $errores_form->comentario ?>
                          </div>
                <?php 
                      endif;
                ?>
            </div>
            
            <div class="mb-3">
              <p class="mb-3s">Tengo en mente estos proyectos ¿Cual quieres que realice?</p>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="check">
                <label for="" class="form-check-label">Espada de Heimdall</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="check">
                <label for="" class="form-check-label">Casco de Iron Man</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="check">
                <label for="" class="form-check-label">Batarangs funcionales</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="check">
                <label for="" class="form-check-label">Stormbraker</label>
              </div>
            </div>

            <div>
            <div class="btns btn-secondary">
              <button class="botonForm">Enviar</button>
            </div>
            </div>
            
        </form>
        </div>
        
      </div>
    </div>
  </div>
</section>