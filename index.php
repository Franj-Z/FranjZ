<!DOCTYPE html>
<?php 
	
	require_once('Config/arrays.php');
	require_once('Config/config.php');
	require_once('Config/funciones.php');
	
	$seccion = $_GET["seccion"] ?? "inicio";
	
	
	//dd($_SESSION);

// Hacemos el calculo de cuanto productos tenemos añadidos al carrito-------------
$cantidad_total = 0;
	if (isset ($_SESSION['carrito'])) {
		foreach($_SESSION['carrito'] as $indice =>$arreglo){
			$cantidad_total += $arreglo['cantidad'];
	}
}
	
	?>

<html lang="es">
<head>
	
	<meta charset="UTF-8">
	<title>Franj Z</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">
	 <link rel="stylesheet" href="estilos.css">
	 <link rel="stylesheet" href="iconos/css/all.css">
	 <link href="https://fonts.googleapis.com/css?family=Lato|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="css/estilos_tarjeta.css">
	 <link href="favicon.ico" rel="icon" type="image/ico"/>

</head>
<body>
	<header class="container-fluid navbar-light bg-light">
	</header>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand p-3" href="#" id="franjZ"><img src="Imagenes/logo.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	  	<?php
            foreach ($botonera as $boton => $url):
                if(!$url["visible"])
                 continue;
    	?>
			<li class= "nav-item ms-4 <?=$boton == $url ?>" >
				<a class="nav-link efect" href="index.php?seccion=<?= $boton; ?>"> <?= $url["sec"]; ?> 
				</a>	
			</li>

		<?php
	        endforeach;
	    ?>
      </ul>
	  <ul class="navbar-nav text-center ulcarrito">
                   
            <?php
            if (!isset($_SESSION['usuario'])):
            ?>

                <li class="nav-item d-xl-block ml-xl-auto">
                    <a href="index.php?seccion=login" class="btn btn-outline-marvel <?= ('login') ?> my-2">
                        Iniciar Sesión
                    </a>
                </li>
                <li class="nav-item ml-xl-3 ms-1">
                    <a href="index.php?seccion=registro" class="btn btn-marvel <?= ('registro') ?> my-2">
                        Registro
                    </a>
                </li>	
            <?php
            else:
            ?>
				<li class="nav-item ml-xl-3 ms-3">
					<div class="dropdown text-white">
						<?= ucwords($_SESSION['usuario']['usuario']) ?>
						<img src="Imagenes/Avatars/<?= ucwords($_SESSION['usuario']['imagen']) ?>" class="text-white ms-2 pImagen" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" alt="Avatar del usuario">
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							<li><a class="dropdown-item" href="index.php?seccion=perfil">Ver Perfil</a></li>
							<li><a class="dropdown-item" href="procesos/logout.php">Cerrar Sesión</a></li>
						</ul>
					</div>
				</li>
				<?php 
				if ($_SESSION['usuario']['usuario_tipo_id_fk'] == 1):
				?>
						<li class="nav-item ml-xl-3 ms-2 ">
							<a href="panel/index.php" class="my-2 btn btn-marvel">Ir al panel</a>
						</li>
				<?php 
					else:
				?>
						<li class="nav-item ml-xl-3 ms-2 ">
							<a href="index.php?seccion=carrito" class="my-2">
								<i class="fas fa-shopping-cart text-white"></i>
							</a>
							<span class="badge bg-product rounded-pill"><?= $cantidad_total?></span>
						</li>
				<?php 
					endif;
				?>
            <?php
            endif;
            ?>
        </ul>
    
    <div class="d-flex align-items-center">
    </div>
    </div>
  </div>
</nav>	
<main> 
		
<?php
    
		
	$seccion = $_GET['seccion'] ?? 'inicio';
	if (empty($seccion))
    		$seccion = 'inicio';
			$ruta = SECCIONES . $seccion . '.php';

	if (file_exists($ruta))
    	require_once($ruta);
		
	else
   		 require_once(SECCIONES . 'error.php');
		
?>

	

	</main>
	<footer class="bg-dark">
		<div class="container ">
			<div class="row">
				<div class="col-12 col-lg-6"><img src="Imagenes/heloo.svg" alt="banner" id="LogoFoot"></div>
				<div class="col-12 col-lg-6 text-end centro1">
					<ul class="redes">
						<li><a href="https://es-la.facebook.com/" target="_blank"><img class="social" src="Imagenes/rs-fb.svg" alt="Facebook"></a></li>
						<li><a href="https://twitter.com/?lang=es" target="_blank"><img class="social" src="Imagenes/rs-tw.svg" alt="Twitter"></a></li>
						<li><a href="https://www.youtube.com/channel/UCJTDtX4l8ACbfhESBM4Qr2Q" target="_blank"><img class="social" src="Imagenes/rs-yt.svg" alt="Youtube"></a></li>
						<li><a href="https://www.instagram.com/franj_z/?hl=es-la" target="_blank"><img class="social" src="Imagenes/rs-ins.svg" alt="Instagram"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>






	<script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
	<script src="bootstrap5/js/bootstrap.js"></script>

</body>
</html>