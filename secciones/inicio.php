
<?php 
 if(isset($_SESSION['error'])):
?>
	<div class="alert alert-warning alert-dismissible fade show container my-2" role="alert">
		<?= $_SESSION['error'] ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php
	endif;
	unset($_SESSION['error']);
?>
 


<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
		<div class="carousel-item active">
      		<img src="Imagenes/portada1.jpg" class="d-block w-100" alt="...">
			<div class="cotenedorInfo">
					<img src="Imagenes/franj2.png" alt="Logo" class="ImagenLogo img-fluid d-none d-md-block">
			</div>
			<div class="carousel-caption">
			<a href="https://www.youtube.com/channel/UCJTDtX4l8ACbfhESBM4Qr2Q"><button class="btn btn-marvel btn-lg"><i class="fas fa-play"></i>Ir al Canal</button></a>
			</div>
    	</div>
		<div class="carousel-item">
      		<img src="Imagenes/banner3.jpg" class="d-block w-100" alt="...">
			<div class="cotenedorInfo2">
					<img src="Imagenes/franjz.png" alt="Logo" class="ImagenLogo img-fluid d-none d-md-block">
			</div>
			<div class="carousel-caption">
				<div class="fondo">
					<a href="index.php?seccion=tienda"><button class="btn btn-light"><i class="fas fa-shopping-cart text-black"></i> Ir a la tienda</button></a>
				</div>
			</div>
    	</div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
	<section class="fondoIni">
		<div class= "container pt-3 text-light">
		<div class="row pt-3">
		<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
		<div class="mb-3 pics animation all 2 ">
			<img class="img-fluid" src="Imagenes/port.png" alt="hello">
		</div>
		</div>
		
		<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 ">
			<h1 class=" display-4 text-center p-3 bienvenido">Bienvenido</h1>
			<p>Holaa! Bienvenido al sitio oficial de Franj_Z, aquí encontrarás todos los proyectos vistos en el canal, asesoramiento en el momento de realizar las réplicas, imágenes, instrucciones, listas con los materiales etc.</p> 
			<p>También podrás encontrar un "Shop" por donde encargo estaré vendiendo las réplicas hechas por mí, ¿Que es mejor que tener una réplica de tú serie, película favorita hecho por el mismísimo Franj_Z?. Por lo tanto, te invito a que disfrutes de esta épica página web, ya que de seguro encontrarás cosas que te fascinen y más. </p>
		</div>
		</div>
</div>
</section>
	<section class="fondoIni2">
	<div class= "container">
	<div class="row">
	<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-light">
	<h2 class=" display-6 text-center my-5">¿Cómo surgió la idea del canal?</h2>
		<p>Bueno para empezar podemos decir que soy muy fanático del mundo del cine y por otro lado soy una persona muy creativa, en lo cual siempre me gusto el arte de realizar cosas con las manos. Por lo tanto, a lo largo de mi vida fui aprendiendo distintos tipos de técnicas para crear cosas, como, por ejemplo, fui aprendiendo lo que es la talla de madera, modelado y realización de esculturas, fundición de metales y herrería.  
		</p>
		<p>Entonces, un día dije “¿Por qué no mezclar el mundo del cine con mi arte?” Luego de eso empecé a realizar réplicas de cosas que aparecían en las películas. Como los resultados de mis obras le gustaban a la gente se me ocurrió grabarme y mostrarle al mundo mis creaciones.</p>
		<p>Desde ese día no deje de hacerlo, ya que es uno de mis hobbies favoritos, si se podría decir es “un cable a tierra” para mí, y por otro lado a la gente le encantaba mi contenido, escribiéndome comentarios, dándome ideas para próximos proyectos y suscribiéndose a mi canal. </p>
	</div>
	<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-light">
		
		<div class="mb-3 pics animation all 2 ">
						 <img class="img-fluid" src="Imagenes/yo4.png" alt="hello">
			</div>
	</div>
	</div>
	</div>
</section>

<section id="galeriaImg">
	<h2 class="text-center display-6 p-5">Galería</h2>
	<div class="galAnch">
	<div class="galGrid">
		<?php 
			foreach($galeriaImg as $pos => $imagenes):
		?>
		
		
			<a href="#">
				<img src="<?= $imagenes?>" alt="Idolo" class="imagenGal">
			</a>

		<?php
			endforeach;
		?>
	</div>
	</div>

</section>
