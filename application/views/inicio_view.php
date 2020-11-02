<!DOCTYPE html>
<html lang="en">
<head>
<title>myHOME</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="myHOME - real estate template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="<?= base_url() ?>static/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/plugins/OwlCarousel2-2.3.4/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/plugins/OwlCarousel2-2.3.4/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/plugins/OwlCarousel2-2.3.4/animate.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/styles/responsive.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/styles/botones.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>
</head>
<body>

<div class="super_container">
	<div class="super_overlay"></div>
	
	<!-- Header -->

	<header class="header">

		<!-- Header Content -->
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			<div class="logo"><a href="#">my<span>home</span></a></div>
			<nav class="main_nav">
				<ul class="d-flex flex-row align-items-start justify-content-start">
					<li class="active"><a href="#">Inicio</a></li>
					<li><a href="<?= base_url() ?>index.php/pagos">Pagos</a></li>
					<li><a href="<?= base_url() ?>index.php/quejas">Quejas</a></li>
					<li><a href="<?= base_url() ?>index.php/preguntas">Preguntas frecuentes</a></li>
				</ul>
			</nav>
			<button id="btn-cerrar" onclick="cerrar()" class="ml-auto btn rounded-0">Cerrar Sesión</button>
			<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
		</div>

	</header>

	<!-- Menu -->

	<div class="menu text-right">
		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="menu_log_reg">
			<nav class="menu_nav">
				<ul>
					<li><a href="#">Inicio</a></li>
					<li><a href="<?= base_url() ?>index.php/pagos">Pagos</a></li>
					<li><a href="<?= base_url() ?>index.php/quejas">Quejas</a></li>
					<li><a href="<?= base_url() ?>index.php/preguntas">Preguntas Frecuentes</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<!-- Home -->

	<div class="home">
		
		<!-- Home Slider -->
		<div class="home_slider_container">
		<h2 class="avisos">Avisos Generales</h2>
		
		<div id="demo" class="carousel slide" data-interval="false" data-ride="carousel">

			<!-- The slideshow -->
			<div id="avisosGenerales" class="carousel-inner">
			<div class="carousel-item active">
				<img src="" class="mx-auto d-block mt-3 rounded-circle" style="height: 200px; width: 200px;" alt="Los Angeles">
				<div class="mt-3">
				<div class="col d-flex justify-content-center mb-3">
					<span class="border bg-info text-white rounded p-1">Experiencia:</span>  
				</div>
				<div class="col d-flex justify-content-center mb-3">
					<span class="border bg-info text-white rounded p-1">Edad:</span>  
				</div>
				</div>
				<div class="row justify-content-center mt-3">
				<button class="btn btn-light mx-auto text-info"><i class="fas fa-file-alt" style="padding-right: 5px;"></i>Ver Currículum</button>
				<button class="btn btn-light mx-auto text-info"><i class="fas fa-comments" style="padding-right: 5px;"></i>Enviar Mensaje</button>
				</div>
				<div class="row justify-content-center mt-3">
				<button class="btn btn-danger mx-auto text-white"><i class="fas fa-trash" style="padding-right: 5px;"></i>Eliminar Solicitud</button>  
				</div>
				
			</div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<div class="home_slider_nav_left"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<div class="home_slider_nav"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			</a>

			</div>
			 
		</div>
	</div>

	<!-- Featured -->

	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_title"><h1>Avisos personales y recordatorios</h1></div>
					</div>
				</div>
			</div>
			<table id="dtBasicExample" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
			<thead>
				<tr>
				<th class="th" style="width:60%;">Aviso

				</th>
				<th class="th" style="width:20%;">Fecha

				</th>
				<th class="th" style="width:20%;">Hora

				</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td><button class="btn btn-outline-light text-dark" >Pago atrasado</button></td>
				<td>2011/04/25</td>
				<td>11:04</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Pago atrasado</button></td>
				<td>2011/07/25</td>
				<td>12:35</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Pago atrasado</button></td>
				<td>2009/01/12</td>
				<td>16:45</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Descuento en próxima mensualidad</button></td>
				<td>2012/03/29</td>
				<td>20:50</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark" data-toggle="modal" data-target="#avisoModal">Bienvenido</button></td>
				<td>2008/11/28</td>
				<td>14:32</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Descuento en próxima mensualidad</button></td>
				<td>2012/12/02</td>
				<td>17:13</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
				<th>Aviso
				</th>
				<th>Fecha
				</th>
				<th>Hora
				</th>
				</tr>
			</tfoot>
			</table>
		</div>
	</div>

	<!-- Modal -->
	<div id="avisoModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title text-white">Bienvenida</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			
		</div>
		<div class="modal-body">
			<p>Bienvenido a myHome. Disfrute de su vivienda, le agradecemos enormemente su preferencia.</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
		</div>

	</div>
	</div>

	<footer class="footer">
		<div class="footer_content">
			<div class="container">
				<div class="row">
					
					<!-- Footer Column -->
					<div class="col-xl-4 col-lg-6 footer_col">
						<div class="footer_about">
							<div class="footer_logo"><a href="#">my<span>home</span></a></div>
							<div class="footer_text">
								<p>Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in.</p>
							</div>
							<div class="social">
								<ul class="d-flex flex-row align-items-center justify-content-start">
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-xl-4 col-lg-6 footer_col">
						<div class="footer_column">
							<div class="footer_title">Acerca de nosotros</div>
							<div class="footer_info">
								<ul>
									<!-- Phone -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div><img src="images/phone-call.svg" alt=""></div>
										<span>4611099218</span>
									</li>
									<!-- Address -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div><img src="images/placeholder.svg" alt=""></div>
										<span>Fuerte de Coín 114 Col. El Vergel, Querétaro</span>
									</li>
									<!-- Email -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div><img src="images/envelope.svg" alt=""></div>
										<span>sebastian.ramed@gmail.com</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-xl-4 col-lg-6 footer_col">
						<div class="footer_links usefull_links">
							<div class="footer_title">Enlaces</div>
							<ul>
								<li><a href="#">Inicio</a></li>
								<li><a href="<?= base_url() ?>index.php/pagos">Pagos</a></li>
								<li><a href="<?= base_url() ?>index.php/quejas">Quejas</a></li>
								<li><a href="<?= base_url() ?>index.php/preguntas">Preguntas Frecuentes</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</footer>
</div>

<script src="<?= base_url() ?>static/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>static/js/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>static/styles/bootstrap-4.1.2/popper.js"></script>
<script src="<?= base_url() ?>static/styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="<?= base_url() ?>static/plugins/greensock/TweenMax.min.js"></script>
<script src="<?= base_url() ?>static/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?= base_url() ?>static/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?= base_url() ?>static/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?= base_url() ?>static/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?= base_url() ?>static/plugins/OwlCarousel2-2.3.4/owl.carousel.js"></script>
<script src="<?= base_url() ?>static/plugins/easing/easing.js"></script>
<script src="<?= base_url() ?>static/plugins/progressbar/progressbar.min.js"></script>
<script src="<?= base_url() ?>static/plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="<?= base_url() ?>static/js/custom.js"></script>
</body>
</html>