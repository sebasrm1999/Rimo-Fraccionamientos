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
					<li><a href="<?= base_url() ?>index.php/avisoscrud">Avisos</a></li>
					<li><a href="<?= base_url() ?>index.php/pagoscrud">Pagos</a></li>
					<li><a href="<?= base_url() ?>index.php/quejascrud">Quejas</a></li>
					<li><a href="<?= base_url() ?>index.php/preguntascrud">Preguntas</a></li>
					<li><a href="<?= base_url() ?>index.php/areascrud">Áreas</a></li>
					<li class="active"><a href="#">Usuarios</a></li>
					<li><a href="<?= base_url() ?>index.php/subcoloniascrud">Subcolonias</a></li>
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
					<li><a href="#">Usuarios</a></li>
					<li><a href="<?= base_url() ?>index.php/subcoloniascrud">Subcolonias</a></li>
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
						<div class="section_title"><h1>Usuarios</h1></div>
					</div>
				</div>
			</div>
			<h3>Filtros</h3>
			<div class="row form-group mb-4">
						
				<div class="col-md-4 mb-3 mb-md-0">
					<label for="subcolonias">Subcolonia: </label>
					<select class="form-control" id="subcolonias">
						<option value="0">---</option>
					</select>
				</div>

				<div class="col-md-4 mb-3 mb-md-0">
					<label for="duenio-filtro">Dueño: </label>
					<select class="form-control" id="duenio-filtro">
						<option value="3">---</option>
						<option value="1">SÍ</option>
						<option value="2">NO</option>
					</select>
				</div>

				<div class="col-md-4 mb-3 mb-md-0">
					<label for="verificado-filtro">Verificado: </label>
					<select class="form-control" id="verificado-filtro">
						<option value="3">---</option>
						<option value="1">SÍ</option>
						<option value="0">NO</option>
					</select>
				</div>
				
			</div>
			<table id="dtBasicExample" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
			<thead>
				<tr>
				<th class="th" style="width:5%;">ID

				</th>
				<th class="th" style="width:10%;">Nombre

				</th>
				<th class="th" style="width:10%;">Tipo de usuario

				</th>
                <th class="th" style="width:20%;">Correo

				</th>
                <th class="th" style="width:10%;">Fecha registro

				</th>
				<th class="th" style="width:10%;">Fecha últ. pago

				</th>
                <th class="th" style="width:5%;">Verificado

				</th>
                <th class="th" style="width:30%;">

				</th>
				</tr>
			</thead>
			<tbody id="usuarios">
				
			</tbody>
			<tfoot>
				<tr>
				<th>ID
				</th>
				<th>Nombre
				</th>
				<th>Tipo de usuario
				</th>
                <th>Correo
				</th>
                <th>Fecha registro
				</th>
				<th>Fecha últ. pago
				</th>
                <th>Verificado
				</th>
                <th>
				</th>
				</tr>
			</tfoot>
			</table>
		</div>

		<div class="my-3 d-flex justify-content-center">
		<button id="btn-nuevo-usuario" class="btn p-2 px-4 text-white btn-quejas">
		<div class="row">
			<i class="fa fa-plus fa-3x mr-2"></i><h3 class="text-white mt-2">Nuevo usuario</h3>
		</div>    
		</button>
		</div>

        <div id="form-usuario" action="#" class="mx-5 my-5" style="display: none;">

        <div id="alerta-tarjeta"></div>
        <form role="form">
		<div class="form-group">
            <label for="tipo">Tipo de usuario</label>
            <select class="form-control" id="tipo">
				<option value="1">Inquilino</option>
				<option value="3">Encargado de área</option>
			</select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" placeholder="Nombre del usuario" name="nombre" required class="form-control">
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input id="correo" type="text" name="correo" required class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required class="form-control">
        </div>
        <div class="form-group">
            <label for="con-password">Confirmar Contraseña</label>
            <input id="con-password" type="password" name="con-password" required class="form-control">
        </div>
        <div id="duenio-div" class="form-group" style="display: block;">
            <label for="duenio">Dueño</label>
            <select class="form-control" id="duenio">
				<option value="0">NO</option>
				<option value="1">SI</option>
			</select>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="text" name="telefono" required class="form-control">
        </div>
		<div id="area-div" class="form-group" style="display: none;">
            <label for="area">Área</label>
            <select class="form-control" id="area">
			</select>
        </div>
        <div id="direccion-div" class="form-group" style="display: block;">
            <label for="direccion">Dirección</label>
            <input id="direccion" type="text" name="direccion" required class="form-control">
        </div>
		<div id="subcolonia-div" class="form-group" style="display: block;">
            <label for="subcolonia-input">Subcolonia</label>
            <select class="form-control" id="subcolonia-input">
			</select>
        </div>
        <div class="form-group">
            <label for="verificado">Verificado</label>
            <select class="form-control" id="verificado">
				<option value="0">NO</option>
				<option value="1">SI</option>
			</select>
        </div>
        <button id="btn-confirmar" type="button" class="subscribe btn btn-confirmar btn-block rounded-pill shadow-sm" onclick="agregaraviso()"> Confirmar  </button>
        </form>

    </div>

	</div>

	<!-- Modal -->
	<div id="usuarioModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
		<div class="modal-header">
		<h4 id="usuario-titulo" class="modal-title text-white">Bienvenida</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			
		</div>
		<div class="modal-body">
			<div class="row ml-3">
				<h4><strong>Correo Electrónico :</strong></h4><h4 class="ml-1" id="correo-usuario"></h4>
			</div>
			<div class="row ml-3 mt-2">
				<h4><strong>Dirección :</strong></h4><h4 class="ml-1" id="direccion-usuario"></h4>
			</div>
			<div class="row ml-3 mt-2">
				<h4><strong>Subcolonia :</strong></h4><h4 class="ml-1" id="subcolonia-usuario"></h4>
			</div>
			<div class="row ml-3 mt-2 d-flex justify-content-between">
					<div class="row ml-1">
						<h4><strong>Teléfono :</strong></h4><h4 class="ml-1" id="telefono-usuario"></h4>
					</div>
					<div class="row mr-4">
						<h4><strong>Dueño :</strong></h4><h4 class="ml-1" id="duenio-usuario"></h4>
					</div>
				</div>
				<div class="row ml-3 mt-2">
					<h4><strong>Verificado :</strong></h4><h4 class="ml-1" id="verificado-usuario"></h4>
				</div>
				<div class="row ml-3 mt-2">
					<h4><strong>Fecha de registro :</strong></h4><h4 class="ml-1" id="fecha-usuario"></h4>
				</div>
				<div class="row ml-3 mt-2">
					<h4><strong>Fecha de último pago :</strong></h4><h4 class="ml-1" id="fecha-pago-usuario"></h4>
				</div>
				<div class="row ml-3 mt-2">
					<h4><strong>Área :</strong></h4><h4 class="ml-1" id="area-usuario"></h4>
				</div>
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
								<li><a href="#">Usuarios</a></li>
								<li><a href="<?= base_url() ?>index.php/subcoloniascrud">Subcolonias</a></li>
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
<script src="<?= base_url() ?>static/js/usuariosCrud.js"></script>
</body>
</html>