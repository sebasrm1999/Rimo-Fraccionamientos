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

<div id="loader" class="loader" style="display:block;"></div>

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
					<li><a href="<?= base_url() ?>index.php/avisoscrud">Avisos</a></li>
					<li><a href="<?= base_url() ?>index.php/pagoscrud">Pagos</a></li>
					<li><a href="<?= base_url() ?>index.php/quejascrud">Quejas</a></li>
					<li><a href="<?= base_url() ?>index.php/preguntascrud">Preguntas</a></li>
					<li><a href="<?= base_url() ?>index.php/areascrud">Áreas</a></li>
					<li><a href="<?= base_url() ?>index.php/usuarioscrud">Usuarios</a></li>
                    <li class="active"><a href="#">Subcolonias</a></li>
					<li><a href="<?= base_url() ?>index.php/parametroscrud"><i class="fa fa-cog fa-3x"></i></a></li>
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
					<li><a href="<?= base_url() ?>index.php/avisoscrud">Avisos</a></li>
					<li><a href="<?= base_url() ?>index.php/pagoscrud">Pagos</a></li>
					<li><a href="<?= base_url() ?>index.php/quejascrud">Quejas</a></li>
					<li><a href="<?= base_url() ?>index.php/preguntascrud">Preguntas Frecuentes</a></li>
					<li><a href="<?= base_url() ?>index.php/areascrud">Áreas</a></li>
					<li><a href="<?= base_url() ?>index.php/usuarioscrud">Usuarios</a></li>
                    <li><a href="#">Subcolonias</a></li>
					<li><a href="<?= base_url() ?>index.php/parametroscrud"><i class="fa fa-cog fa-3x"></i></a></li>
				</ul>
			</nav>
		</div>
	</div>

	<!-- Featured -->

	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_title"><h1>Subcolonias</h1></div>
					</div>
				</div>
			</div>
			<table id="dtBasicExample" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
			<thead>
				<tr>
				<th class="th" style="width:70%;">Nombre

				</th>
                <th class="th" style="width:30%;">

				</th>
				</tr>
			</thead>
			<tbody id="subcolonias">
				
			</tbody>
			<tfoot>
				<tr>
				<th>Nombre
				</th>
                <th>
				</th>
				</tr>
			</tfoot>
			</table>
		</div>

        <div class="my-3 d-flex justify-content-center">
    <button id="btn-nuevo-subcolonia" class="btn p-2 px-4 text-white btn-quejas">
    <div class="row">
        <i class="fa fa-plus fa-3x mr-2"></i><h3 class="text-white mt-2">Nueva subcolonia</h3>
    </div>    
    </button>
    </div>

    <div id="form-subcolonia" action="#" class="mx-5 my-5" style="display: none;">

        <div id="alerta-tarjeta"></div>
        <form role="form">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" placeholder="Nombre de la subcolonia" name="nombre" required class="form-control">
        </div>
        <button id="btn-confirmar" type="button" class="subscribe btn btn-confirmar btn-block rounded-pill shadow-sm" onclick="agregaraviso()"> Confirmar  </button>
        </form>

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

	<div id="alertaModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 id="info-modal-titulo" class="modal-title text-white">Error</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p id="info-modal-cuerpo" style="color: 000#;"></p>
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
								<li><a href="<?= base_url() ?>index.php/avisoscrud">Avisos</a></li>
								<li><a href="<?= base_url() ?>index.php/pagoscrud">Pagos</a></li>
								<li><a href="<?= base_url() ?>index.php/quejascrud">Quejas</a></li>
								<li><a href="<?= base_url() ?>index.php/preguntascrud">Preguntas Frecuentes</a></li>
                                <li><a href="<?= base_url() ?>index.php/areascrud">Áreas</a></li>
								<li><a href="<?= base_url() ?>index.php/usuarioscrud">Usuarios</a></li>
                                <li><a href="#">Subcolonias</a></li>
								<li><a href="<?= base_url() ?>index.php/parametroscrud"><i class="fa fa-cog fa-3x"></i></a></li>
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
<script src="<?= base_url() ?>static/js/subcoloniasCrud.js"></script>
</body>
</html>