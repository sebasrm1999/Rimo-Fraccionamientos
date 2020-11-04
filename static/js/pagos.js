let base_url = 'http://localhost/myhome_ci/';

$(document).ready(function()
{
    cargartabla();
      
      pagoactual();

      var header = $('.header');

      initMenu();

        setHeader();

      $(window).on('resize', function()
	{
		setHeader();

		setTimeout(function()
		{
			$(window).trigger('resize.px.parallax');
		}, 375);
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	/* 

	2. Set Header

	*/

	function setHeader()
	{
		if($(window).scrollTop() > 91)
		{
			header.addClass('scrolled');
		}
		else
		{
			header.removeClass('scrolled');
		}
	}

	/* 

	3. Init Menu

	*/

	function initMenu()
	{
		if($('.menu').length && $('.hamburger').length)
		{
			var menu = $('.menu');
			var hamburger = $('.hamburger');
			var close = $('.menu_close');
			var superOverlay = $('.super_overlay');

			hamburger.on('click', function()
			{
				menu.toggleClass('active');
				superOverlay.toggleClass('active');
			});

			close.on('click', function()
			{
				menu.toggleClass('active');
				superOverlay.toggleClass('active');
			});

			superOverlay.on('click', function()
			{
				menu.toggleClass('active');
				superOverlay.toggleClass('active');
			});
		}
	}

	$('#btn-tarjeta').click(function(){
		var visibilidad = $('#form-pago').css('display');
		if(visibilidad == 'none'){
			$('#form-pago').css('display', 'block');
		} else {
			$('#form-pago').css('display', 'none');
		}
	});
});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function pagoactual(){

	var id = sessionStorage.getItem('id');

    $.ajax({
        "url" : base_url + "BackEnd/pagoactual",
        "type" : "post",
        "data" : {
            "id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

			document.getElementById('mes').innerHTML = json[0].mes;
			document.getElementById('estado').innerHTML = json[0].status == 1 ? 'Pagado' : 'Pendiente';
			$("#btn-pagar-tarjeta").attr("onclick",`pagar(${json[0].id_pago})`);

			if($('#estado').text() == 'Pendiente'){
				$('#btn-pagar').css('display', 'block');
			  } else {
				$('#btn-pagar').css('display', 'none'); 
			  }
            
        }
    });
}

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
	var pagos = document.getElementById('pagos');
	var id = sessionStorage.getItem('id');

    pagos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/pagosxusuario",
        "type" : "post",
        "data" : {
            "id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

            json.pagos.forEach(doc => {
                pagos.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" onclick="pago(${doc.id_pago})">${doc.mes}</button></td>
				<td>${doc.anio}</td>
				<td>${doc.fecha}</td>
				<td>${doc.hora}</td>
				<td>${doc.pronto == 1 ? 'Sí' : 'No'}</td>
				</tr>`;
            });

            $('#dtBasicExample').DataTable({
                "destroy": true,
                "pagingType": "simple_numbers"
              });
            
        }
    });
}

function pago(id){

    $.ajax({
        "url" : base_url + "BackEnd/pago",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            $('#detalleModal').modal('show');

            document.getElementById('pago-titulo').innerHTML = `${json[0].mes} ${json[0].anio}`;
            document.getElementById('id-pago').innerHTML = json[0].id_pago;
            document.getElementById('usuario-pago').innerHTML = json[0].nombre;
            document.getElementById('status-pago').innerHTML = json[0].status == 1 ? 'Pagado' : 'Pendiente';

            if(json[0].status == 1){
                if(json[0].tipo == 1){
                    document.getElementById('forma-pago').innerHTML = 'Tarjeta de Crédito/Débito';
                } else if(json[0].tipo == 2){
                    document.getElementById('forma-pago').innerHTML = 'Paypal';
                } else if(json[0].tipo == 3){
                    document.getElementById('forma-pago').innerHTML = 'Oxxo';
                }
                $('#info-pagado').css('display', 'block');
                document.getElementById('fecha-pago').innerHTML = `${json[0].fecha} ${json[0].hora}`;
                document.getElementById('pronto-pago').innerHTML = json[0].pronto == 1 ? 'Sí' : 'No';
            } else {
                $('#info-pagado').css('display', 'none');
            }
            
        }
    });
    
}

function pagar(id){
	let nombre = document.getElementById('nombre-tarjeta').value;
    let numero = document.getElementById('numero-tarjeta').value;
    let mes = document.getElementById('mes-expiracion').value;
    let anio = document.getElementById('anio-expiracion').value;
	let cvv = document.getElementById('cvv').value;
	
	document.getElementById('cvv-error').innerHTML = '';
	document.getElementById('expiracion-error').innerHTML = '';
	document.getElementById('numero-error').innerHTML = '';

    if(mes != '' && nombre != '' && cvv != '' && numero != '' && anio != ''){
        if(numero.length == 16){
            if(mes.length == 2 && anio.length == 2){
                if(cvv.length == 3){
					$.ajax({
						"url" : base_url + "BackEnd/pagar",
						"type" : "post",
						"data" : {
							"id" : id,
							"tipo" : 1
						},
						"dataType" : "json",
						"success" : function(json){
							if(json.resultado){
								pagoactual();
								cargartabla();
								$('#pagoModal').modal('hide');
							} else {
								alert('Error inesperado');
							}
						}
					});
				} else {
					document.getElementById('cvv-error').innerHTML = 'El CVV de la tarjeta debe contener 3 dígitos';
				}
            } else {
                document.getElementById('expiracion-error').innerHTML = 'El mes y año de expiración deben contener 2 dígitos cada uno';
            }
        } else {
            document.getElementById('numero-error').innerHTML = 'El número de la tarjeta debe contener 16 dígitos';
        }
    } else {
        alert('Debe llenar todos los campos...');
    }
}