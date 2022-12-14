
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
			<p>Holaa! Bienvenido al sitio oficial de Franj_Z, aqu?? encontrar??s todos los proyectos vistos en el canal, asesoramiento en el momento de realizar las r??plicas, im??genes, instrucciones, listas con los materiales etc.</p> 
			<p>Tambi??n podr??s encontrar un "Shop" por donde encargo estar?? vendiendo las r??plicas hechas por m??, ??Que es mejor que tener una r??plica de t?? serie, pel??cula favorita hecho por el mism??simo Franj_Z?. Por lo tanto, te invito a que disfrutes de esta ??pica p??gina web, ya que de seguro encontrar??s cosas que te fascinen y m??s. </p>
		</div>
		</div>
</div>
</section>
	<section class="fondoIni2">
	<div class= "container">
	<div class="row">
	<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-light">
	<h2 class=" display-6 text-center my-5">??C??mo surgi?? la idea del canal?</h2>
		<p>Bueno para empezar podemos decir que soy muy fan??tico del mundo del cine y por otro lado soy una persona muy creativa, en lo cual siempre me gusto el arte de realizar cosas con las manos. Por lo tanto, a lo largo de mi vida fui aprendiendo distintos tipos de t??cnicas para crear cosas, como, por ejemplo, fui aprendiendo lo que es la talla de madera, modelado y realizaci??n de esculturas, fundici??n de metales y herrer??a.  
		</p>
		<p>Entonces, un d??a dije ?????Por qu?? no mezclar el mundo del cine con mi arte???? Luego de eso empec?? a realizar r??plicas de cosas que aparec??an en las pel??culas. Como los resultados de mis obras le gustaban a la gente se me ocurri?? grabarme y mostrarle al mundo mis creaciones.</p>
		<p>Desde ese d??a no deje de hacerlo, ya que es uno de mis hobbies favoritos, si se podr??a decir es ???un cable a tierra??? para m??, y por otro lado a la gente le encantaba mi contenido, escribi??ndome comentarios, d??ndome ideas para pr??ximos proyectos y suscribi??ndose a mi canal. </p>
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
	<h2 class="text-center display-6 p-5">Galer??a</h2>
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
