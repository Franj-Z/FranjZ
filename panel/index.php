<!DOCTYPE html>
<?php
    define("GUIA","../");
    
    require_once(GUIA . "Config/arrays.php");
    require_once(GUIA . "Config/config.php");
    require_once(GUIA . "Config/funciones.php");

	if (!isset($_SESSION['usuario'])) {
		$_SESSION['error'] = 'No tenés permisos para ingresar a esa sección';
		header('Location: ../index.php?seccion=inicio');
	}
	if(isset($_SESSION['usuario']) && $_SESSION['usuario']['usuario_tipo_id_fk'] == 2){
		$_SESSION['error'] = 'No tenés permisos para ingresar a esa sección';
		header('Location: ../index.php?seccion=inicio');
	}


    $seccion = $_GET["seccion"] ?? "lista_proyectos";

?>

<html lang="es">
<head>
	
	<meta charset="UTF-8">
	<title>Franj Z</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="<?= GUIA; ?>bootstrap5/css/bootstrap.css">
	 <link rel="stylesheet" href="<?= GUIA; ?>estilos.css">
	 <link rel="stylesheet" href="<?= GUIA; ?>iconos/css/all.css">
</head>


<header class="container-fluid">
</header>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
			<a class="navbar-brand p-3" href="#" id="franjZ">F_Z</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<?php
					foreach ($botoneraPanel as $boton => $url):
						if(!$url["visible"])
						continue;
					?>
				
				
			
					<li class= "nav-item <?=$boton == $url ?>" >
							<a class="nav-link" href="index.php?seccion=<?= $boton; ?>"> <?= $url["sec"]; ?> </a>	
				</li>

					<?php
					endforeach;
					?>
		</ul>
		<li class="nav-item d-xl-block ml-xl-auto">
                    <a href="../index.php?seccion=inicio" class="btn btn-outline-marvel <?= ('login') ?> my-2">
                        Ir a la pagina
                    </a>
                </li>
		
	</div>
	</div>
	</nav>
	<main> 
		

        <?php

        $secciones = opendir("secciones");

        while($carpeta = readdir($secciones)){
            if($carpeta == "." || $carpeta == ".."){
                continue;
            }

            if(file_exists("secciones/$carpeta/$seccion.php")){
                $cargado = true;
                require_once("secciones/$carpeta/$seccion.php");
            }
            
        }

        if(!isset($cargado)){
          require_once(GUIA ."secciones/error.php");
       }

        ?>




	</main>
	<footer class="bg-dark">
		<div class="container ">
			<div class="row">
				<div class="col-12 col-lg-6"><img src="<?= GUIA; ?>Imagenes/heloo.svg" alt="banner"></div>
				<div class="col-12 col-lg-6 text-lg-right centro1">
					<ul class="redes">
						<li><a href="https://es-la.facebook.com/" target="_blank"><img class="social" src= " <?= GUIA; ?>Imagenes/rs-fb.svg" alt="Facebook"></a></li>
						<li><a href="https://twitter.com/?lang=es" target="_blank"><img class="social" src=" <?= GUIA; ?>Imagenes/rs-tw.svg" alt="Twitter"></a></li>
						<li><a href="https://www.youtube.com/channel/UCJTDtX4l8ACbfhESBM4Qr2Q" target="_blank"><img class="social" src=" <?= GUIA; ?>Imagenes/rs-yt.svg" alt="Youtube"></a></li>
						<li><a href="https://www.instagram.com/franj_z/?hl=es-la" target="_blank"><img class="social" src=" <?= GUIA; ?>Imagenes/rs-ins.svg" alt="Instagram"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>







	<script src="<?= GUIA; ?>js/jquery-3.4.1.js"></script>
	<script src="<?= GUIA; ?>js/bootstrap.bundle.js"></script>
	<script src="<?= GUIA; ?>bootstrap5/js/bootstrap.js"></script>
	
</body>
</html>


