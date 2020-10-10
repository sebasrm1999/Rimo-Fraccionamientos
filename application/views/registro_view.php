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
			<div class="logo"><a href="<?= base_url() ?>index.php">my<span>home</span></a></div>
		</div>

	</header>

    <div class="hero-wrap js-fullheight" style="background-image: url('<?= base_url() ?>static/images/index.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center p-5">
        <div class="col-xl-10 ftco-animate mt-2 pt-3">
            
        <div class="col-md-12 mt-3">
                
                <div action="#" class="shadow p-5 bg-white rounded">

                    <div class="d-flex align-items-center justify-content-center">
                        <h2 style="color:#adc867;">Registro</h2>
                    </div>

                    <div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-3 mb-md-0">
                    <label class="font-weight-bold" for="nombre">Nombre Completo</label>
                        <input type="text" id="nombre" class="form-control">
                    </div>
                    <div id="nombre-error"></div>
                    </div>

                    <div class="row form-group mb-4">
                    
                    <div class="col-md-9 mb-3 mb-md-0">
                        <label class="font-weight-bold" for="calle">Calle</label>
                        <input type="text" id="calle" class="form-control">
                    </div>
                    <div id="calle-error"></div>

                    
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label class="font-weight-bold" for="numero">Número</label>
                        <input type="text" id="numero" class="form-control">
                    </div>
                    <div id="numero-error"></div>
                    </div>

                    <label class="font-weight-bold" for="optradio">¿Es dueño de una propiedad?</label>

                    <div class="row form-group my-4">

                    <div class="col-md-3 mb-md-0">
                        <div class="radio">
                        <label><input class="mr-2" type="radio" name="optradio" checked>Soy dueño</label>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3 mb-md-0">
                        <div class="radio">
                            <label><input class="mr-2" type="radio" name="optradio">No soy dueño</label>
                        </div>
                    </div>

                    </div>

                    <div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-md-0">
                        <label class="font-weight-bold" for="comprobante">Comprobante de domicilio menor a 3 meses</label>
                        <input type="file" id="comprobante" class="form-control-file border">
                    </div>
                    <div id="comprobante-error"></div>
                    </div>
                    
                    <div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-3 mb-md-0">
                    <label class="font-weight-bold" for="email">Correo electrónico</label>
                        <input type="email" id="email" class="form-control">
                    </div>
                    <div id="email-error"></div>
                    </div>

                    <div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-3 mb-md-0">
                    <label class="font-weight-bold" for="password">Contraseña</label>
                        <input type="password" id="password" class="form-control">
                    </div>
                    <div id="password-error"></div>
                    </div>

                    <div class="row form-group mb-4">

                    <div class="col-md-12 mb-3 mb-md-0">
                    <label class="font-weight-bold" for="con-password">Confirmar Contraseña</label>
                        <input type="password" id="con-password" class="form-control">
                    </div>
                    <div id="con-password-error"></div>
                    </div>

                    <div class="row justify-content-center">
                    <div class="justify-content-center">
                    <button id="btn-login" class="btn btn-lg" onclick="login()">Registrarme</button>
                    </div>
                    </div>

                </div>
                
            </div>
            
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="<?= base_url() ?>static/js/registro.js"></script>
    
  </body>
</html>