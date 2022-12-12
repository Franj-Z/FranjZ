<?php
// VALIDAMOS LOS CAMPOS DEL FORMULARIO-------------------------------------
$erroes_checkout = [];
if (!empty($_GET['campos']))
   $erroes_checkout = json_decode($_GET['campos']);
?>


<?php 
if (isset($_SESSION['usuario']) && $_SESSION['usuario']['usuario_tipo_id_fk'] == 1):
?>
<div class="alert alert-warning alert-dismissible fade show container" role="alert">
      <i class="fas fa-exclamation-triangle"></i>
            El usuario Admin no puede realizar compras
</div>
<?php 
else:
?>

<div class="container text-white">
  <main>
    <div class="row g-5 my-5">
      <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="">Tu Carrito</span>
            </h4>
            <?php 
              if(!isset($_SESSION['carrito'])):
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                    El carrito esta vacío
              </div>
            <?php
            else:
            ?>
            <ul class="list-group mb-3">
            <?php 
                        $monto_total = 0;
                        $cantidad_total = 0;
                        foreach($_SESSION['carrito'] as $indice =>$arreglo): 
                        $monto_total += $arreglo ['cantidad'] * $arreglo['precio'];
                        $cantidad_total += $arreglo['cantidad'];             
            ?>
            <?php foreach($arreglo as $key => $value):?>
            <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0"><?=$arreglo["nombre"] ?></h6>
                    <small class="text-muted">x<?=$arreglo["cantidad"] ?></small>
                    </div>
                    <span class="text-muted">$<?=$arreglo["precio"] ?></span>
                </li>
            <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$<?= $monto_total?></strong>
                </li>
            </ul>
            <?php
            endif;
            ?>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Datos</h4>

        <?php
        if(!isset($_SESSION['usuario'])):
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                No estas logueado para poder realizar una compra
          </div>

        <?php 
          else:
        ?>
<form class="needs-validation formulario-tarjetas" novalidate="" action="procesos/checkout.php" enctype="multipart/form-data" method="POST" id="formulario-tarjetas">
    <div class="row g-3">
        <div class="col-sm-6">
                <label for="firstName" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="firstName" name="nombre" placeholder="" value="<?= ucwords($_SESSION['usuario']['nombre']) ?>" required="">
                <?php 
                    if(isset($erroes_checkout ->nombre)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->nombre ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>
        <div class="col-sm-6">
              <label for="lastName" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="lastName" name="apellido" placeholder="" value="<?= ucwords($_SESSION['usuario']['apellido']) ?>" required="">
              <?php 
                    if(isset($erroes_checkout ->apellido)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->apellido ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>

        <div class="col-12">
              <label for="username" class="form-label">Nombre de usuario</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" name="usuario" placeholder="Username" required="" value="<?= ucwords($_SESSION['usuario']['usuario']) ?>">
                <?php 
                    if(isset($erroes_checkout ->usuario)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->usuario ?>
                          </div>
                <?php 
                      endif;
                ?>
              </div>
        </div>

        <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?= ucwords($_SESSION['usuario']['email']) ?>">
              <?php 
                    if(isset($erroes_checkout ->email)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->email ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>

        <div class="col-12">
              <label for="address" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="address" name="casa" placeholder="Ejemplo: Ricardo Balbín 1234">
              <?php 
                    if(isset($erroes_checkout ->casa)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->casa ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>

        <div class="col-md-5">
              <label for="country" class="form-label">País</label>
              <select class="form-select" id="country" required="" name="pais">
                <option>Argentina</option>
              </select>
              <?php 
                    if(isset($erroes_checkout ->pais)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->pais ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>

        <div class="col-md-4">
              <label for="state" class="form-label">Provincia</label>
              <select class="form-select" id="state" required="" name="provincia">
                <option>Buenos Aires</option>
              </select>
              <?php 
                    if(isset($erroes_checkout ->provincia)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->provincia ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>

        <div class="col-md-3">
              <label for="zip" class="form-label">Código postal</label>
              <input type="text" class="form-control" id="zip"   name="codigo">
              <?php 
                    if(isset($erroes_checkout ->codigo)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->codigo ?>
                          </div>
                <?php 
                      endif;
                ?>
        </div>
    </div>

  <hr class="my-4">
  <h4 class="mb-3">Pago</h4>
  
  <!-- MAQUETAMOS LA TARJETA ANIMADA ------------------------------------------------------ -->

  <section class="TarjetaEpica my-4" id="TarjetaEpica">
			<div class="delantera">
            <div class="logo-marca" id="logo-marca">
              <!-- <img src="img/logos/visa.png" alt=""> -->
            </div>
				    <img src="Imagenes/Tarjeta/chip-tarjeta.png" class="chip" alt="">
            <div class="datos">
                  <div class="grupo" id="numero">
                    <p class="label">Número Tarjeta</p>
                    <p class="numero">#### #### #### ####</p>
                  </div>
              <div class="flexbox">
                  <div class="grupo" id="nombre">
                    <p class="label">Nombre Tarjeta</p>
                    <p class="nombre">########</p>
                  </div>

                  <div class="grupo" id="expiracion">
                    <p class="label">Expiracion</p>
                    <p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
                  </div>
              </div>
            </div>
			</div>

			<div class="trasera">
				<div class="barra-magnetica"></div>
          <div class="datos">
              <div class="grupo" id="firma">
                  <p class="label">Firma</p>
                  <div class="firma"><p></p></div>
              </div>
              <div class="grupo" id="ccv">
                  <p class="label">CCV</p>
                  <p class="ccv"></p>
              </div>
          </div>
				<p class="leyenda">Las religiones y las armas antiguas no son rival cuando tienes un buen blaster a tu lado.</p>
				<p  class="link-banco">www.FranjZ.com</p>
			</div>
		</section>

  <!-- CAMPOS DE LA TARJETA ------------------------------------------------------ -->

  <div class="row gy-3">  
      <div class="col-md-6">
              <label for="cc-number" class="form-label">Número de la tarjeta</label>
              <input type="text" class="form-control" id="inputNumero" maxlength="19" autocomplete="off" name="numero_tarjeta">
              <?php 
                    if(isset($erroes_checkout ->numero_tarjeta)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->numero_tarjeta ?>
                          </div>
                <?php 
                      endif;
                ?>
      </div>

      <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Mes</label>
              <select name="mes" id="selectMes" class="form-select">
								<option disabled selected>Mes</option>
							</select>
              <?php 
                    if(isset($erroes_checkout ->mes)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->mes ?>
                          </div>
                <?php 
                      endif;
                ?>
      </div>
      <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Año</label>
              <select name="year" id="selectYear" class="form-select">
								<option disabled selected>Año</option>
							</select>
              <?php 
                    if(isset($erroes_checkout ->year)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->year ?>
                          </div>
                <?php 
                      endif;
                ?>
      </div>

      <div class="col-md-6">
              <label for="cc-name" class="form-label">Nombre del titular</label>
              <input type="text" class="form-control" id="inputNombre" name="titular">
              <?php 
                    if(isset($erroes_checkout ->titular)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->titular ?>
                          </div>
                <?php 
                      endif;
                ?>
      </div>

      <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" name="cvv"  id="inputCCV" maxlength="3">
              <?php 
                    if(isset($erroes_checkout ->cvv)):
                ?>
                          <div class="alert alert-danger alert-dismissible fade show m-1 py-3" role="alert">
                              <?= $erroes_checkout->cvv ?>
                          </div>
                <?php 
                      endif;
                ?>
      </div>
  </div>

          <hr class="my-4">
          <?php 
              if(!isset($_SESSION['carrito'])):
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Sin productos agregados no pueder realizar la compra
              </div>
          <?php 
            else:
          ?>
          <button class="w-100 btn btn-primary btn-lg" type="submit">Realizar la compra</button>
          <?php 
            endif;
          ?>
        </form>
        <?php 
        endif;
        ?>
      </div>
    </div>
  </main>
</div>

<?php
endif;
?>
<script src="js/main.js"></script>
