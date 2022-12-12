<?php
    if ((!empty($_GET['status']) && $_GET['status'] == 'ok') && isset($_SESSION['carrito'])):
?>
        <div class="alert alert-success alert-dismissible fade show container my-4" role="alert">
                <i class="far fa-check-circle"></i>
                Compra realizada con éxito
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<section class="container my-5">
    <div class="row">
        <section class="text-white col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                    <h3 class="display-4 text-white mt-5">Resumen</h3>
                        <table class="table text-white">
                            <thead>
                                <tr>
                                <th scope="col">Item</th>
                                <th scope="col"></th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                </tr>
                            </thead>
                        <tbody>
                        <?php 
                        $monto_total = 0;
                        $cantidad_total = 0;
                        foreach($_SESSION['carrito'] as $indice =>$arreglo): 
                        $monto_total += $arreglo ['cantidad'] * $arreglo['precio'];
                        $cantidad_total += $arreglo['cantidad'];             
                        ?>
                        <?php foreach($arreglo as $key => $value):?>
                        <?php endforeach; ?>
                                <tr>
                                    <th ><img src="Imagenes/Proyectos/<?= $arreglo['portada'] ?>" alt="<?= $arreglo['nombre']?>" class="w-25"> <?= $arreglo['nombre'] ?> </th>
                                    <td></td>
                                    <td class="text-center"><?=$arreglo["cantidad"] ?></td>
                                    <td>$<?=$arreglo["precio"] ?></td>
                                </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
        </section>
        <section class="text-white col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 resumen">
            <div class="p-1"> 
                <h2 class="my-5 display-6"><?= $cantidad_total?>
                <?php  if ($cantidad_total == 1):?> Producto
                <?php else:?>  Productos
                <?php endif;?>
                </h2>
                <hr>
                <h3 class="display-6">Total pagado: <p class="d-inline fs-3">$<?= $monto_total?></p></h3>
                <p><i class="fas fa-truck pe-1 ps-2"></i>Envío Gratis </p>
                <div class="py-3">
                </div>
            </div>
        </section> 
    </div>
</section>

<?php
    unset($_SESSION['carrito']);
    else:
?>
<div class="alert alert-success alert-dismissible fade show container my-4" role="alert">
                <i class="far fa-check-circle"></i>
                Agrega Productos al carrito y realiza la compra para poder visualizar tu resumen de compra
</div>
<?php
    endif;
?>