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
					<li><a href="<?= base_url() ?>index.php/inicio">Inicio</a></li>
					<li class="active"><a href="#">Pagos</a></li>
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
					<li><a href="<?= base_url() ?>index.php/inicio">Inicio</a></li>
					<li><a href="#">Pagos</a></li>
					<li><a href="<?= base_url() ?>index.php/quejas">Quejas</a></li>
					<li><a href="<?= base_url() ?>index.php/preguntas">Preguntas Frecuentes</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="container pagos_mes">
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
				<h1>Mes: </h1><h2 id="mes" style="margin-top: 10px; margin-left: 10px;">Septiembre</h2>
				</div>
				
			</div>
			<div class="col-lg-6">
				<div class="row">
				<h1>Estado: </h1><h2 id="estado" style="margin-top: 10px; margin-left: 10px;">Pendiente</h2>
				</div>
				
			</div>
		</div>
		<button id="btn-pagar" class="btn btn-outline-success" data-toggle="modal" data-target="#pagoModal">Pagar</button>
	</div>

	<!-- Featured -->

	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_title"><h1>Pagos anteriores</h1></div>
					</div>
				</div>
			</div>
			<table id="dtBasicExample" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
			<thead>
				<tr>
				<th class="th" style="width:20%;">Mes

				</th>
				<th class="th" style="width:20%;">Año

				</th>
				<th class="th" style="width:20%;">Fecha de pago

				</th>
				<th class="th" style="width:20%;">Hora de pago

				</th>
				<th class="th" style="width:20%;">Pronto pago

				</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td><button class="btn btn-outline-light text-dark" >Enero</button></td>
				<td>2011</td>
				<td>2011/04/25</td>
				<td>11:04</td>
				<td>No</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Febrero</button></td>
				<td>2011</td>
				<td>2011/07/25</td>
				<td>12:35</td>
				<td>No</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Marzo</button></td>
				<td>2009</td>
				<td>2009/01/12</td>
				<td>16:45</td>
				<td>Si</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Abril</button></td>
				<td>2012</td>
				<td>2012/03/29</td>
				<td>20:50</td>
				<td>Si</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark" data-toggle="modal" data-target="#avisoModal">Mayo</button></td>
				<td>2008</td>
				<td>2008/11/28</td>
				<td>14:32</td>
				<td>No</td>
				</tr>
				<tr>
				<td><button class="btn btn-outline-light text-dark">Junio</button></td>
				<td>2012</td>
				<td>2012/12/02</td>
				<td>17:13</td>
				<td>Si</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
				<th>Mes
				</th>
				<th>Año
				</th>
				<th>Fecha de pago
				</th>
				<th>Hora de pago
				</th>
				<th>Pronto pago
				</th>
				</tr>
			</tfoot>
			</table>
		</div>
	</div>

	<!-- Modal -->
	<div id="pagoModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title text-white">Pagar</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			
		</div>
		<div class="modal-body">
			<div class="row m-3">
				<h3>Total a pagar: </h3><h3 id="total">$ 2000.00</h3>
			</div>
			<h3 class="m-3">Escoja un método de pago: </h3>
			<div class="row botones-pago">
				<button id="btn-tarjeta" class="btn text-white btn-tipo"><i class="fa fa-credit-card fa-3x" aria-hidden="true"></i></button>
				<button class="btn text-white btn-tipo"><i class="fa fa-paypal fa-3x"></i></button>
				<button class="btn text-white btn-tipo"><img src="<?= base_url() ?>static/images/Oxxo_Logo.svg" style="height: 45px; width: 60px;"></button>
			</div>
			<div id="form-pago" action="#" class=" mt-5">

                    <div class="d-flex align-items-center justify-content-center">
                        <h4>Tarjeta de crédito/débito</h4>
                    </div>

                    <div id="alerta-tarjeta"></div>
					<form role="form">
					<div class="form-group">
						<label for="username">Nombre completo (en la tajeta)</label>
						<input type="text" name="username" required class="form-control">
					</div>
					<div class="form-group">
						<label for="cardNumber">Número de tarjeta</label>
						<div class="input-group">
						<input type="text" maxlength="16" name="cardNumber" placeholder="Tu número de tarjeta" class="form-control" required>
						<div class="input-group-append">
							<span class="input-group-text text-muted">
								<i class="fa fa-cc-visa mx-1"></i>
								<i class="fa fa-cc-amex mx-1"></i>
								<i class="fa fa-cc-mastercard mx-1"></i>
							</span>
						</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-8">
						<div class="form-group">
							<label><span class="hidden-xs">Expiración</span></label>
							<div class="input-group">
							<input type="number" placeholder="MM" name="" min="1" max="12" class="form-control" required>
							<input type="number" placeholder="YY" name="" min="00" max="99" class="form-control" required>
							</div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group mb-4">
							<label data-toggle="tooltip" title="Código de 3 dígitos en parte trasera de su tarjeta">CVV
								<i class="fa fa-question-circle"></i>
							</label>
							<input type="text" maxlength="3" required class="form-control">
						</div>
						</div>


					</div>
					<button type="button" class="subscribe btn btn-confirmar btn-block rounded-pill shadow-sm"> Confirmar  </button>
					</form>

                </div>
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
								<li><a href="<?= base_url() ?>index.php/inicio">Inicio</a></li>
								<li><a href="#">Pagos</a></li>
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
<script src="<?= base_url() ?>static/js/pagos.js"></script>
</body>
</html>