<?php 
$query_producto = 'SELECT * FROM proyectos';
$rta_producto = mysqli_query($cnx, $query_producto);

//dd($_SESSION);


?>
<section class="banner_tienda">
    <figure class="contenedor_banner">
        <img src="Imagenes/guardians1.jpg" alt="BannerThor" class="img-fluid">
    </figure>
        <div class="imagen_texto text-white">
            <h2 class="titulo_proyectos">TIENDA</h2>
            <p class="w-100 d-none d-md-block pt-2 descripcion_proyectos">Aquí puedes encontrar todos los proyectos vistos en el canal a la venta. <br> ¿Qué esperas para tener tu réplica hecha por el mismísimo FranjZ?</p>
        </div>
</section>
<?php 
if (!empty($_GET['status']) && $_GET['status'] == 'error'):
?>
    <div class="alert alert-danger alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Hubo un error al agregar el producto al carrito
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php 
endif;
?>
<?php 
if (!empty($_GET['status']) && $_GET['status'] == 'ok'):
?>
    <div class="alert alert-success alert-dismissible fade show container my-4" role="alert">
                <i class="fas fa-check-circle"></i>
                Se agregó el producto exitosamente!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php 
endif;
?>
<div class="container py-5">
    <div class="">
        <div class="text-center">
            <?php
                while ($producto = mysqli_fetch_assoc($rta_producto)) :
            ?>
            <div class="card-tienda text-start">
                        <div class="imgBx">
                            <img src="Imagenes/Productos/<?= $producto["productoImg"]; ?>" class="img-fluid" alt="<?= $producto["productoImg"];?>">
                        </div>
                        <div class="contentBx">
                                <h3><?= $producto["nombre"]; ?></h3>
                                <h2 class="price"> $<?= $producto["precio"]; ?></h2>
                                    <?php 
                                        if (isset($_SESSION['usuario']) && $_SESSION['usuario']['usuario_tipo_id_fk'] == 1):
                                    ?>
                                    <a href="index.php?seccion=detalle_producto&id=<?= $producto["proyectos_id"] ?>"class="btn btn-outline-light my-2 buyNum">Leer más <i class="fas fa-plus-circle m-1"></i></a>
                                    <button class="btn btn-secondary  btn-sm disabled " type="submit" name="agregar" >Agregar al carrito</button>
                                    <?php 
                                        elseif (!isset($_SESSION['usuario'])):
                                    ?>
                                    <a href="index.php?seccion=detalle_producto&id=<?= $producto["proyectos_id"] ?>"class="btn btn-outline-light my-2 buyNum">Leer más <i class="fas fa-plus-circle m-1"></i></a>
                                    <button class="btn btn-secondary  btn-sm disabled " type="submit" name="agregar" >Agregar al carrito</button>
                                    <?php 
                                        else:
                                    ?>
                                    <form action="procesos/agregar_carrito.php" class="text-center" method="POST">
                                    <input type="hidden" name="id" value="<?= $producto["proyectos_id"]; ?>">
                                    <input type="hidden" name="nombre" value="<?= $producto["nombre"]; ?>"> 
                                    <input type="hidden" name="precio" value="<?= $producto["precio"]; ?>">
                                    <input type="hidden" name="portada" value="<?= $producto["portada"]; ?>">  
                                    <input type="hidden" name="cantidad"class="form-control buyNum" value="1">
                                    <a href="index.php?seccion=detalle_producto&id=<?= $producto["proyectos_id"] ?>"class="btn btn-outline-light my-2 buyNum">Leer más <i class="fas fa-plus-circle m-1"></i></a>
                                    <button class="buy" type="submit" name="agregar" >Agregar al carrito</button>
                                    </form>
                                    <?php 
                                        endif;
                                    ?>
                        </div>
            </div> 
            <?php
            endwhile;
            ?>  
        </div>
    </div>
</div>



            