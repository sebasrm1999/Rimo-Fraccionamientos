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
  </head>
  <body>

  <header class="header">

		<!-- Header Content -->
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			<div class="logo"><a href="#">my<span>home</span></a></div>
		</div>

	</header>

    <div class="hero-wrap js-fullheight" style="background-image: url('<?= base_url() ?>static/images/index.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center p-5">
        <div class="col-xl-10 ftco-animate mt-5 mb-5 pb-5">
            
        <div class="col-md-12 mt-5 mb-5">
                
                <div action="#" class="shadow p-5 bg-white rounded">

                    <div class="d-flex align-items-center justify-content-center">
                        <span style="color:#adc867;"><i class="fa fa-home fa-5x"></i></span>
                    </div>

                    <div class="row form-group mb-4">
                    <label class="font-weight-bold" for="email-empleado">Correo electrónico</label>
                    <div class="col-md-12 mb-3 mb-md-0">
                        <input type="email" id="email" class="form-control">
                    </div>
                    <div id="email-error"></div>
                    </div>

                    <div class="row form-group mb-4">
                    <label class="font-weight-bold" for="password-empleado">Contraseña</label>
                    <div class="col-md-12 mb-3 mb-md-0">
                        <input type="password" id="password" class="form-control">
                    </div>
                    <div id="password-error"></div>
                    </div>

                    <div class="row mb-2">
                      <p style="color: #000000;">¿Aún no tienes una cuenta?</p>
                      <a class="ml-2 mt-1" href="<?= base_url() ?>index.php/registro" style="color: #637a26;">Regístrate aquí</a>
                    </div>

                    <div class="row mb-2">
                      <p style="color: #000000;">¿Olvidó su contraseña?</p>
                      <a class="ml-2 mt-1" href="<?= base_url() ?>index.php/olvidar" style="color: #637a26;">De clic aquí</a>
                    </div>

                    <div class="row justify-content-center">
                    <div class="justify-content-center">
                    <button id="btn-login" class="btn btn-lg" onclick="login()">Iniciar Sesión</button>
                    </div>
                    </div>

                </div>
                
            </div>
            
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

  <script src="<?= base_url() ?>static/js/jquery-3.3.1.min.js"></script>
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
<script src="<?= base_url() ?>static/js/login.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="<?= base_url() ?>static/js/custom.js"></script>

    
  </body>
</html>