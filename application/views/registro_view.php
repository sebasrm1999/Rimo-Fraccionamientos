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

                    <div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label class="font-weight-bold" for="subcolonia">Cerrada o Circuito</label>
                        <select class="form-control" id="subcolonia">
                        </select>
                    </div>
                    <div id="subcolonia-error"></div>
                    </div>

                    <div class="row form-group mb-4">
                    
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label class="font-weight-bold" for="telefono">Teléfono</label>
                        <input type="text" id="telefono" class="form-control">
                    </div>
                    <div id="telefono-error"></div>
                    </div>

                    <label class="font-weight-bold" for="optradio">¿Es dueño de una propiedad?</label>

                    <div class="row form-group my-4">

                    <div class="col-md-3 mb-md-0">
                        <div class="radio">
                        <label><input class="mr-2" type="radio" name="optradio" value="1" checked>Soy dueño</label>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3 mb-md-0">
                        <div class="radio">
                            <label><input class="mr-2" type="radio" value="2" name="optradio">No soy dueño</label>
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

                    <div class="col-md-12 mb-3 mb-md-0">
                    <div class="checkbox">
                      <label class="font-weight-bold"><input id="privacidad" type="checkbox" value="">    He leído y acepto las <button id="btn-politicas" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#politicasModal">políticas de privacidad</button>.</label>
                    </div>
                    </div>

                    <div class="row justify-content-center">
                    <div class="justify-content-center">
                    <button id="btn-login" class="btn btn-lg" onclick="registro()">Registrarme</button>
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

<div id="politicasModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 id="info-modal-titulo" class="modal-title text-white">Políticas de Privacidad</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p id="politicas-modal-cuerpo" style="color: 000#;">
        El presente Política de Privacidad establece los términos en que myHome usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. 
        Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. 
        Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos <br><br>
        
        Información que es recogida<br><br>

        Nuestro sitio web podrá recoger información personal por ejemplo: Nombre,  información de contacto como  su dirección de correo electrónica e información demográfica. 
        Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.<br><br>

        Uso de la información recogida<br><br>

        Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios.  
        Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, 
        estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.<br><br>

        myHome está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.<br><br>

        Cookies<br><br>

        Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. 
        Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.<br><br>

        Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. 
        Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. 
        Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente. 
        Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. 
        Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.<br><br>

        Enlaces a Terceros<br><br>

        Este sitio web pudiera contener enlaces a otros sitios que pudieran ser de su interés. 
        Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. 
        Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.<br><br>

        Control de su información personal<br><br>

        En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web.  
        Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico.  
        En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.<br><br>

        Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.<br><br>

        myHome se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.<br><br>

        Esta politica de privacidad se han generado en politicadeprivacidadplantilla.com.<br><br>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<div id="registroModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 id="registro-modal-titulo" class="modal-title text-white">Bienvenido</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p id="registro-modal-cuerpo" style="color: 000#;">Su cuenta se verificará. Será notificado por correo electrónico cuando pueda ingresar.</p>
      </div>
      <div class="modal-footer">
      <button type="button" id="btn-registro-modal" class="btn btn-success" data-dismiss="modal">Aceptar</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha512-VZ6m0F78+yo3sbu48gElK4irv2dzPoep8oo9LEjxviigcnnnNvnTOJRSrIhuFk68FMLOpiNz+T77nNY89rnWDg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js" integrity="sha512-VGxuOMLdTe8EmBucQ5vYNoYDTGijqUsStF6eM7P3vA/cM1pqOwSBv/uxw94PhhJJn795NlOeKBkECQZ1gIzp6A==" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="<?= base_url() ?>static/js/registro.js"></script>
    
  </body>
</html>