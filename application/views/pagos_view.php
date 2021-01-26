
<!DOCTYPE html>
<html lang="en">
<head>
<title>myHOME</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="myHOME - real estate template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://js.stripe.com/v3/"></script>
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

<div id="loader" class="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">

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
				<h2 id="estado-pronto" style="margin-top: 10px; margin-left: 10px;"></h2>
				<input id="pronto-status" type="hidden" value="">
				</div>
				
			</div>
		</div>
		<button id="btn-pagar" class="btn btn-outline-success">Pagar</button>
		<div class="my-3 d-flex justify-content-center">
		<button id="btn-adelantado" onclick="adelantadoModal()" class="btn btn-lg mt-5 p-2 px-4 btn-outline-success">
		Pagar Siguiente Mes por Adelantado   
		</button>
		</div>
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
				<th class="th" style="width:15%;">Estado

				</th>
				<th class="th" style="width:15%;">Fecha de pago

				</th>
				<th class="th" style="width:15%;">Hora de pago

				</th>
				<th class="th" style="width:5%;">Pronto pago

				</th>
				<th class="th" style="width:5%;">Verificado
				</th>
				<th class="th" style="width:5%;">
				</th>
				</tr>
			</thead>
			<tbody id="pagos">
			</tbody>
			<tfoot>
				<tr>
				<th>Mes
				</th>
				<th>Año
				</th>
				<th>Estado
				</th>
				<th>Fecha de pago
				</th>
				<th>Hora de pago
				</th>
				<th>Pronto pago
				</th>
				<th>Verificado
				</th>
				<th>Verificado
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
		<input id="id-pago-input" type="hidden" value="">
		<input id="fecha-pago-input" type="hidden" value="0">
			<div class="row m-3">
				<h3>Total a pagar: </h3><h3 class="ml-1" id="total">$ 2000.00</h3>
			</div>
			<h3 class="m-3">Escoja un método de pago: </h3>
			<div class="row botones-pago">
				<button id="btn-tarjeta" class="btn text-white btn-tipo"><i class="fa fa-credit-card fa-3x" aria-hidden="true"></i></button>
				<button id="btn-paypal" class="btn text-white btn-tipo"><i class="fa fa-paypal fa-3x"></i></button>
				<button id="btn-oxxo" class="btn text-white btn-tipo"><img src="<?= base_url() ?>static/images/Oxxo_Logo.svg" style="height: 45px; width: 60px;"></button>
			</div>
			<div id="form-pago" action="#" class=" mt-5">

				<div class="d-flex align-items-center justify-content-center">
					<h2 id="titulo-cuenta">Transferir a Cuenta: </h2>
				</div>

				<div class="row m-3">
					<div id="imagen-banco">
					
					</div>
					<div class="col">
						<h3 class="font-weight-bold mb-2">Número de tarjeta: </h3>
						<h3 class="font-weight-bold">CLABE: </h3>
					</div>
					<div class="col">
						<h3 class="mb-2" id="numero-cuenta"></h3>
						<h3 id="clabe-cuenta"></h3>
					</div>
					
				</div>

				<div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-md-0">
                        <label class="font-weight-bold" for="comprobante">Comprobante del pago: </label>
                        <input type="file" id="comprobante" class="form-control-file border">
                    </div>
                    <div id="comprobante-error"></div>
				</div>

				<div class="row justify-content-center">
                    <div class="justify-content-center">
                    <button id="btn-confirmar" class="btn btn-lg" onclick="">Subir Comprobante</button>
                    </div>
				</div>
				
					<!--					
                    <div class="d-flex align-items-center justify-content-center">
                        <h4>Tarjeta de crédito/débito</h4>
                    </div>

                    <div id="alerta-tarjeta"></div>
					<form role="form" id="pago-tarjeta">
					<input type="hidden" id="id-pago-form">
					<div class="form-group">
						<label for="username">Nombre completo (en la tajeta)</label>
						<input type="text" required class="form-control">
						<div class="error" id="nombre-error"></div>
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
						<div class="error" id="numero-error"></div>
					</div>
					<div class="row">
						<div class="col-sm-8">
						<div class="form-group">
							<label><span class="hidden-xs">Expiración</span></label>
							<div class="input-group">
							<input type="text" maxlength="2" placeholder="MM" class="form-control" required>
							<input type="text" maxlength="2" placeholder="YY" class="form-control" required>
							</div>
							<div class="error" id="expiracion-error"></div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group mb-4">
							<label data-toggle="tooltip" title="Código de 3 dígitos en parte trasera de su tarjeta">CVV
								<i class="fa fa-question-circle"></i>
							</label>
							<input type="text" maxlength="3" required class="form-control">
							<div class="error" id="cvv-error"></div>
						</div>
						</div>


					</div>
					<button class="subscribe btn btn-confirmar btn-block rounded-pill shadow-sm"> Confirmar  </button>

					<input type="text" name="conektaTokenId" id="conektaTokenId">
					</form>
					-->


                </div>
					
				<div id="paypal-container" class="mt-3" style="display: none;">
				<div id="paypal-button-container"></div>
				<div id="paypal-button"></div>
				</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
		</div>

	</div>
	</div>

	<!-- Modal -->
	<div id="detalleModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
		<div class="modal-header">
		<h4 id="pago-titulo" class="modal-title text-white">Bienvenida</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			
		</div>
		<div class="modal-body">
			<div class="row ml-3">
				<h4><strong>Folio de pago :</strong></h4><h4 class="ml-1" id="id-pago"></h4>
			</div>
			<div class="row float-right mr-3 mt-2">
				<h4><strong>Usuario :</strong></h4><h4 class="ml-1" id="usuario-pago"></h4>
			</div>
			<div class="row ml-3 mt-2">
				<h4><strong>Status :</strong></h4><h4 class="ml-1" id="status-pago"></h4>
			</div>
			<div class="mt-2" id="info-pagado" style="display: none;">
				<div class="row ml-3 d-flex justify-content-between">
					<div class="row ml-1">
						<h4><strong>Pronto Pago :</strong></h4><h4 class="ml-1" id="pronto-pago"></h4>
					</div>
					<div class="row mr-4">
						<h4><strong>Fecha de pago :</strong></h4><h4 class="ml-1" id="fecha-pago"></h4>
					</div>
				</div>
				<div class="row ml-3 mt-2">
					<h4><strong>Forma de Pago :</strong></h4><h4 class="ml-1" id="forma-pago"></h4>
				</div>
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

</div>

<script src="<?= base_url() ?>static/js/jquery-3.3.1.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AVw6a0qki2LSaKShcKzL1DY9v7GuhbAVJfh6qK9_8TQ8xQaNnndXG_fi08phj1Dqs2ofcUyOnhRnuphI&currency=MXN&disable-funding=credit,card"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js" integrity="sha512-VGxuOMLdTe8EmBucQ5vYNoYDTGijqUsStF6eM7P3vA/cM1pqOwSBv/uxw94PhhJJn795NlOeKBkECQZ1gIzp6A==" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="<?= base_url() ?>static/js/pagos.js"></script>
</body>
</html>