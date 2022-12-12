<?php 
//dd($_SESSION);
?>
<section class="container my-5">
    <div class="row">
        <?php
            if (!isset($_SESSION['carrito']) || $cantidad_total == 0):
        ?>
            <div class="alert alert-danger alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Tu carrito está vacío
            </div>

        <?php 
            elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']['usuario_tipo_id_fk'] == 1):
        ?>
            <div class="alert alert-warning alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                El usuario Admin no puede realizar compras
            </div>
        <?php
            else:        
        ?>
        <section class="text-white col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                    <h3 class="display-4 text-white mt-5">Mi Carrito</h3>
                        <table class="table text-white">
                            <thead>
                                <tr>
                                <th scope="col">Item</th>
                                <th scope="col"></th>
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
                                    <td><a href="procesos/vaciar_carrito.php?item=<?=$indice?>"><i class="far fa-trash-alt btnIcon text-white"></i></a></td>
                                    <td class="text-center"><?=$arreglo["cantidad"] ?></td>
                                    <td>$<?=$arreglo["precio"] ?></td>
                                </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                    <a href="procesos/vaciar_carrito.php?vaciar=true" class="btn btn-primary">Vaciar Carrito</a>
        </section>
        <section class="text-white col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 resumen">
            <div class="p-1"> 
                <h2 class="my-5 display-6">Resumen: <?= $cantidad_total?>
                <?php  if ($cantidad_total == 1):?> Producto
                <?php else:?>  Productos
                <?php endif;?>
                </h2>
                <hr>
                <p>Al hacer clic en pagar, acepto los términos y condiciones y entiende que todas las ventas son finales. El envío es gratuito. Cualquier descuento o cupón aplicable se reflejará al finalizar la compra.</p>
                <hr>
                <h3 class="display-6">Total a pagar: <p class="d-inline fs-3">(USD)$<?= $monto_total?></p></h3>
                <p><i class="fas fa-truck pe-1 ps-2"></i>Envío Gratis </p>
                <div class="py-3">
                <?php
                    if (!isset($_SESSION['usuario'])):
                ?>
                    <div class="text-center">
                        <p class="alert alert-danger alert-dismissible fade show container my-4">Inicia sesión para finalizar la compra</p>
                    </div>
                <?php
                else:
                ?>
                    <div class="text-center">
                        <a href="index.php?seccion=checkout" class="btn btn-primary botonForm">Finalizar la compra</a>
                    </div>
                </div>
                <?php 
                endif;
                ?>
                </div>
            </div>
        </section> 
        <?php
            endif;
        ?>
        
    </div>
</section>